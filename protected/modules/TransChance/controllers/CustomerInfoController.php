<?php

class CustomerInfoController extends GController {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//  public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new CustomerInfo;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerInfo'])) {
            $model->attributes = $_POST['CustomerInfo'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate2($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CustomerInfo'])) {
            $model->attributes = $_POST['CustomerInfo'];
            $model->toTimestamp();
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
        $user = Users::model()->findByPk($model->creator);
        $model->toDate();
        $this->render('update', array(
            'model' => $model,
            'user' => $user,
        ));
    }

    private function validCustomerInfo($custtype,$model, $contract) { 
        $ret = true;
        if ($custtype == 17) {
            //已签合同  
            if (!$contract->validate()) {
                $model->addError("cust_type", "客户分类为17类，合同信息不能为空!");
                $ret = false;
            }
        }
        if ($custtype == 18) {
            //放入公海
            if ($model->abandon_reason == '') {
                $model->addError("abandon_reason", "客户分类为18类，放弃原因不能为空!");
                $ret = false;
            }
        }
        return $ret;
    }

    public function actionUpdate($id) {
        $noteinfo = new NoteInfo();
        $noteinfo->setAttribute("iskey", 0);
        $noteinfo->setAttribute("isvalid", 1);
        $noteinfo->setAttribute("dial_id", 0);
        $noteinfo->setAttribute("message_id", 0);
        $noteinfo->setAttribute("next_contact", '');
        $noteinfo->cust_id = $id;
        $model = $this->loadModel($id);
        $trans_info = TransCustInfo::model()->findBySql("select * from {{trans_cust_info}} where cust_id=:cust_id", array(":cust_id" => $id));
        $contract = new ContractInfo();
//        ContractInfo::model()->findBySql("select * from {{contract_info}} where cust_id=:cust_id", array(":cust_id" => $id));
//        if (empty($contract)) {
//            $contract = new ContractInfo();
//        }
        $loginuser = Users::model()->findByPk(Yii::app()->user->id);
        if (isset($_POST['CustomerInfo'])) {
            //保存  
            // $sql = "select * from {{aftermarket_cust_info}} where cust_id=:cust_id";
            //$aftermodel = AftermarketCustInfo::model()->findBySql($sql, array(':cust_id' => $id));  
            $newCustType = $_POST['TransCustInfo']['cust_type'];
            $oldCustType = $trans_info->getAttribute("cust_type"); 
            //$contract->unsetAttributes();
            $contract->attributes = $_POST['ContractInfo'];
            $contract->cust_id = $id;
            $contract->pay_time=  strtotime($contract->pay_time);
            $contract->comm_pay_time=strtotime($contract->comm_pay_time);
            $model->attributes = $_POST['CustomerInfo'];
            $trans_info->cust_type=$newCustType;
            $transaction = Yii::app()->db->beginTransaction();  
            if ($this->validCustomerInfo($newCustType,$model, $contract)) {
                if ($oldCustType != $newCustType) { 
                    //客户分类调整，生成转换明细数据
                    $convt = new CustConvtDetail();
                    $convt->setAttribute('lib_type', 2);
                    $convt->setAttribute('cust_id', $id);
                    $convt->setAttribute('cust_type_1', $oldCustType);
                    $convt->setAttribute('cust_type_2', $newCustType);
                    $convt->setAttribute('convt_time', time());
                    $convt->setAttribute('user_id', Yii::app()->user->id);
                    $convt->save();
                }
                if ($oldCustType != $newCustType && $newCustType == 17) {
                    //到店 生成售后库
                    $after = new AftermarketCustInfo();
                    $after->eno = '';
                    $after->cust_id = $id;
                    $after->cust_type = 0; //初始0类，新分
                    $after->webchat = '';
                    $after->ww = '';
                    $after->assign_eno = $loginuser->eno;
                    $after->assign_time = time();
                    $after->next_time = 0;
                    $after->memo = '';
                    $after->creator = $loginuser->id;
                    $after->create_time = time();
                    $after->save();
                    //当前成交师已分配资源数减1
                    $sql = "update {{users}} set cust_num=cust_num-1 where id={$loginuser->id}";
                    Yii::app()->db->createCommand($sql)->execute(); 
                }
                if ($newCustType == 17) {
                    //已签合同,生成合同信息表
                    $contract->creator = $loginuser->id;
                    $contract->create_time = time();
                    //$contract->pay_time = strtotime($contract->pay_time);
                    //$contract->comm_pay_time = strtotime($contract->comm_pay_time);
                    $contract->save();
                } 
                if (isset($_POST['NoteInfo'])&&$_POST['NoteInfo']['next_contact']!='') {
                    //保存小记 
                    $noteinfo->attributes = $_POST['NoteInfo'];
                    if ($model->iskey != $noteinfo->iskey) {
                        $model->iskey = $noteinfo->iskey;
                    }
                    $noteinfo->next_contact = strtotime($noteinfo->next_contact);
                    $model->last_time=time();//最后联系时间等于今天
                    $noteinfo->setAttribute("eno", Yii::app()->user->id);
                    $noteinfo->setAttribute("create_time", time());
                    if ($noteinfo->save()) {
                        //保存销售库下次联系时间
                        $trans_info->next_time = $noteinfo->next_contact; 
                    } else {
                        $noteinfo->addError("memo", "请录入小记信息");
                    } 
                }  
                if ($newCustType == 18) {
                    //客户分类转成9（公海），生成公海资源数据
                    $blackinfo = new BlackInfo();
                    $blackinfo->setAttribute("cust_id", $id);
                    $blackinfo->setAttribute('lib_type', 1);
                    $blackinfo->setAttribute('old_cust_type', $oldCustType);
                    $blackinfo->setAttribute('create_time', time());
                    $blackinfo->setAttribute('creator', Yii::app()->user->id);
                    $blackinfo->save(); 
                    $trans_info->delete();//删除成交师库记录
                    $model->status='1';
                }else{
                    $trans_info->save();
                }
                $model->save();
                //更新电话拔打记录
                if ($noteinfo->dial_id > 0) {
                    $dialdetail = DialDetail::model()->findByPk($noteinfo->dial_id);
                    //获取通知录音路径，通知时长 
                        $uid = UnCall::getUid($dialdetail->extend_no);
                        $dial_long = UnCall::getDialLength($uid);
                        $record_path = UnCall::getRecord($uid);
                        $dialdetail->uid=$uid;
                        $dialdetail->dial_long=$dial_long;
                        $dialdetail->record_path=$record_path;
                        $dialdetail->save();
                }
            }
            //加载页面数据
            if (!$noteinfo->hasErrors() && !$model->hasErrors()) {
                //提交事务
                $transaction->commit();
                if ($newCustType == 17 || $newCustType == 18) {
                    //客户已经转入到售后库或进入公海资源，跳转到成功页面
                    $this->render("result");
                    return;
                } else {
                    //保存成功，没有错误，清除数据
                    $noteinfo->unsetAttributes();
                    $noteinfo->setAttribute("iskey", 0);
                    $noteinfo->setAttribute("isvalid", 1);
                    $noteinfo->setAttribute("dial_id", 0);
                    $noteinfo->setAttribute("message_id", 0);
                    $noteinfo->setAttribute("next_contact", '');
                    $noteinfo->cust_id = $id;
                }
            } else {
                //回滚事务
                $transaction->rollback();
                $noteinfo->setAttribute("next_contact", '');
            }
        }


        $model->setAttribute("create_time", date("Y-m-d", intval($model->getAttribute("create_time"))));
        $model->setAttribute("assign_time", date("Y-m-d", intval($model->getAttribute("assign_time"))));
        $model->setAttribute("next_time", date("Y-m-d", intval($model->getAttribute("next_time"))));
         
        $sharedNote = NoteInfo::model();
        $sharedNote->setAttribute("cust_id", $model->id);
        $historyNote = NoteInfo::model();
        $historyNote->setAttribute("cust_id", $model->id);
        $user = Users::model()->findByPk($model->creator); 
        
        $this->render('update', array(
            'model' => $model,
            'trans_model' => $trans_info,
            'sharedNote' => $sharedNote,
            'historyNote' => $historyNote,
            'noteinfo' => $noteinfo,
            'contract' => $contract,
            'user' => $user,
        ));
    }

    public function actionNoteInfo($id) {
        $model = $this->loadModel($id);
        $noteinfo = new NoteInfo();
        $user = Users::model()->findByPk($model->creator);
        if (isset($_POST['NoteInfo'])) {
            //保存小记
            $noteinfo->unsetAttributes();
            $noteinfo->attributes = $_POST['NoteInfo'];
            $noteinfo->next_contact = strtotime($noteinfo->next_contact);
            $noteinfo->setAttribute("eno", Yii::app()->user->id);
            $noteinfo->setAttribute("create_time", time());
            if ($noteinfo->save()) {
                //保存售后库
                $model->next_time = $noteinfo->next_contact;
                $model->iskey = $noteinfo->iskey;
                $model->memo = $noteinfo->memo;
                $model->save();
            } else {
                $noteinfo->addError("memo", "请录入小记信息");
            }
            //更新电话拔打记录
            if ($noteinfo->dial_id > 0) {
                $dialdetail = DialDetail::model()->findByPk($noteinfo->dial_id);
                //获取通知录音路径，通知时长 
            }
        }
        $sharedNote = NoteInfo::model();
        $sharedNote->setAttribute("cust_id", $model->id);
        // $historyNote = NoteInfo::model();
        //$historyNote->setAttribute("cust_id", $model->id);
        $this->render('update', array(
            'model' => $model,
            'sharedNote' => $sharedNote,
            // 'historyNote' => $historyNote,
            'noteinfo' => $noteinfo,
            'user' => $user,
        ));
    }

    public function actionHistoryNote($id) {
        $historyNote = NoteInfo::model();
        $model = $this->loadModel($id);
        // var_dump($model);die;
        $user = Users::model()->findByPk($model->creator);
        $this->render('update', array(
            'model' => $model,
            //'sharedNote' => $sharedNote,
            'historyNote' => $historyNote,
            //'noteinfo' => $noteinfo,
            'user' => $user,
        ));
    }

    public function actionSharedNote($id) {
        $sharedNote = NoteInfo::model();
        $model = $this->loadModel($id);
        $user = Users::model()->findByPk($model->creator);
        $this->render('update', array(
            'model' => $model,
            'sharedNote' => $sharedNote,
            'user' => $user,
        ));
    }

    /**
     * 搜索共享小记列表数据
     */
    public function actionSharedNoteList() {
        $model = new NoteInfo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['NoteInfo']))
            $model->attributes = $_GET['NoteInfo'];
        if (isset($_GET['cust_id'])) {
            $custid = $_GET['cust_id'];
            $model->setAttribute("cust_id", $custid);
        }
        $custmodel = $this->loadModel($model->getAttribute("cust_id"));
        if (isset($_GET['isajax'])) {
            $this->renderPartial('_shared_note_list', array(
                'model' => $model,
                'custmodel' => $custmodel
            ));
        }
    }

    /**
     * 搜索历史小记列表数据
     */
    public function actionHistoryNoteList() {
        $model = new NoteInfo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['NoteInfo']))
            $model->attributes = $_GET['NoteInfo'];

        if (isset($_GET['cust_id'])) {
            $custid = $_GET['cust_id'];
            $model->setAttribute("cust_id", $custid);
        }
        $custmodel = $this->loadModel($model->getAttribute("cust_id"));
        if (isset($_GET['isajax'])) {

            $this->renderPartial('_history_note_list', array(
                'model' => $model,
                'custmodel' => $custmodel
            ));
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('CustomerInfo');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

        $model = new CustomerInfo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CustomerInfo']))
            $model->attributes = $_GET['CustomerInfo'];
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * 我的机会
     */
    public function actionTodayList() {

        $model = new CustomerInfo('search');
        $model->unsetAttributes();  // clear any default values
        $begintime = strtotime(date('Y-m-d', time()));
        $endtime = $begintime + 86400;
        $model->begintime = $begintime;
        $model->endtime = $endtime;
        if (isset($_GET['CustomerInfo']))
            $model->attributes = $_GET['CustomerInfo'];
        $this->render('mylist', array(
            'model' => $model,
        ));
    }

    /**
     * 未联系机会
     */
    public function actionOldList() {

        $model = new CustomerInfo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CustomerInfo']))
            $model->attributes = $_GET['CustomerInfo'];
        $this->render('oldlist', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CustomerInfo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = CustomerInfo::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CustomerInfo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-info-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function genCustTypeArray() {
        $custTypeArr = Utils::mapArray(CustType::findByType(2), 'type_no', 'type_name');
        $custTypeArr[0] = '--请选择--';
        ksort($custTypeArr);
        return $custTypeArr;
    }

    protected function genCategoryArray() {
        $custTypeArr = Utils::mapArray(CustType::findByType(1), 'type_no', 'type_name');
        $custTypeArr[0] = '--请选择--';
        ksort($custTypeArr);
        return $custTypeArr;
    }

    /**
     * 获取类目数组
     * @return type
     */
    public function getCategoryArr() {
        $category = Dic::model()->getCustCart();
        return $category;
    }

    protected function getCartTxt($data) {
        $code = $data->category;
        $custType = Dic::model()->getCustCart();
        return $code && !empty($custType[$code]) ? $custType[$code] : $code;
    }

    /**
     * 获取客户分类数组
     * @return type
     */
    public function getCustTypeArr() {
        $sql = "select type_no,type_name from {{cust_type}} where lib_type='3'";
        $custtype = CustType::model()->findAllBySql($sql);
        $empty = new CustType();
        $empty->type_no = '';
        $empty->type_name = "请选择客户分类";
        $custtype = array_merge(array($empty), $custtype);
        return CHtml::listData($custtype, 'type_no', 'type_name');
    }

    protected function getTranUsers() {
        $loginid = Yii::app()->user->id;
        $user = Users::model()->findByPk($loginid);
        $sql = "select u.id,u.eno from {{users}} u "
                . "left join {{user_role}} ur on u.id=ur.user_id "
                . "left join {{role_info}} ri on ur.role_id=ri.id "
                . "where u.dept_id=:dept_id and ri.name='成交师'";
        $users = Users::model()->findAllBySql($sql, array(':dept_id' => $user->dept_id));
        $empty = new Users();
        $empty->id = '';
        $empty->eno = "请选择成交师";
        $users = array_merge(array($empty), $users);
        return CHtml::listData($users, 'id', 'eno');
    }

    /**
     * 批量安排下次联系机会-多选情况
     * @param type $id 客户id
     */
    public function actionAssignNextTime() {

        if (isset($_POST['cust_id'])) {
            /**
             * 在分配页面点击保存按钮
             * 1.更新下次联系时间
             */
            $cust_ids = $_POST['cust_id'];
            $ids = implode(",", $cust_ids);
            $next_time = $_POST['next_time'];
            $next_time = strtotime($next_time);
            Yii::app()->db->createCommand()->update('{{customer_info}}', array('next_time' => $next_time), "id in({$ids})");
            $model = new CustomerInfo();
            $model->addError("next_time", "操作成功!");
            $this->render("result", array(
                'model' => $model,
            ));
            return;
        }
        if (!isset($_POST['select'])) {
            //没有选择记录的情况
            $this->redirect($this->createUrl("customerinfo/admin"));
            return;
        }
        //选择了记录，跳转到分配页面
        $ids = $_POST['select'];
        $model = CustomerInfo::model();
        $sql = "";
        if (is_array($ids)) {
            $sql = "select id,cust_name from {{customer_info}} where id in (" . implode(",", $ids) . ")";
        } else {
            $sql = "select id,cust_name from {{customer_info}} where id=" . $ids;
        }
        $list = $model->findAllBySql($sql);
        $this->render('assign', array('model' => $model, 'custlist' => $list));
    }

}
