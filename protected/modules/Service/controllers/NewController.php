<?php

class NewController extends GController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2'; 
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
     * 进入客户详情页面
     * @param type $id 客户id
     */
    public function actionEdit($id) {
        $noteinfo = new NoteInfo();
        $noteinfo->setAttribute("isvalid", 1);
        $noteinfo->setAttribute("dial_id", 0);
        $noteinfo->setAttribute("uid", '');
        $noteinfo->setAttribute("message_id", 0);
        $noteinfo->setAttribute("next_contact", '');
        $noteinfo->setAttribute("cust_id", $id);
        $model = $this->loadModel($id);

        $noteinfo->setAttribute("iskey", $model->iskey);
        $sql = "select * from {{aftermarket_cust_info}} where cust_id=:cust_id";
        $aftermodel = AftermarketCustInfo::model()->findBySql($sql, array(':cust_id' => $id));
        if ($aftermodel->cust_type == 8) {
            //公海资源
            Yii::app()->user->setFlash('success', '不能打开公海资源!');
            $this->render("result");
            return;
        }
        $sql = "select * from {{contract_info}} where cust_id=:cust_id";
        $contractmodel = ContractInfo::model()->findBySql($sql, array(':cust_id' => $id));
        $model->setAttribute("create_time", date("Y-m-d H:i:s", $model->getAttribute("create_time")));
        $model->setAttribute("assign_time", date("Y-m-d H:i:s", $model->getAttribute("assign_time")));
        $model->setAttribute("next_time", date("Y-m-d H:i:s", $model->getAttribute("next_time")));
        $model->setAttribute("last_time", date("Y-m-d H:i:s", $model->getAttribute("last_time")));
        $aftermodel->setAttribute("assign_time", date("Y-m-d H:i:s", $aftermodel->getAttribute("assign_time")));
        $aftermodel->setAttribute("next_time", date("Y-m-d H:i:s", $aftermodel->getAttribute("next_time")));
        $aftermodel->setAttribute("create_time", date("Y-m-d H:i:s", $aftermodel->getAttribute("create_time")));
        $creator = Users::model()->findByPk($aftermodel->creator);
        $aftermodel->creator = $creator->getAttribute('name');
        $contractmodel->setAttribute("create_time", date("Y-m-d H:i:s", $contractmodel->getAttribute("create_time")));
        $contractmodel->setAttribute("comm_pay_time", date("Y-m-d H:i:s", $contractmodel->getAttribute("comm_pay_time")));
        $contractmodel->setAttribute("pay_time", date("Y-m-d H:i:s", $contractmodel->getAttribute("pay_time")));
        $creator2 = Users::model()->findByPk($contractmodel->creator);
        $contractmodel->creator = $creator2->getAttribute('eno');
        $sharedNote = NoteInfo::model();
        $sharedNote->setAttribute("cust_id", $model->id);
        $historyNote = NoteInfo::model();
        $historyNote->setAttribute("cust_id", $model->id);
        $user = Users::model()->findByPk(Yii::app()->user->id);
        $this->render('update', array(
            'model' => $model,
            'after' => $aftermodel,
            'contract' => $contractmodel,
            'sharedNote' => $sharedNote,
            'historyNote' => $historyNote,
            'noteinfo' => $noteinfo,
            'loginuser' => $user,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $noteinfo = new NoteInfo();
        $noteinfo->setAttribute("isvalid", 1);
        $noteinfo->setAttribute("dial_id", 0);
        $noteinfo->setAttribute("message_id", 0);
        $noteinfo->setAttribute("next_contact", '');
        $noteinfo->setAttribute("cust_id", $id);
        $model = $this->loadModel($id);
        $noteinfo->setAttribute("iskey", $model->iskey);
        $sql = "select * from {{aftermarket_cust_info}} where cust_id=:cust_id";
        $aftermodel = AftermarketCustInfo::model()->findBySql($sql, array(':cust_id' => $id));
        $sql = "select * from {{contract_info}} where cust_id=:cust_id";
        $contractmodel = ContractInfo::model()->findBySql($sql, array(':cust_id' => $id));
        $nextcontact='';
        if (isset($_POST['AftermarketCustInfo'])) {
            //保存   
            $newCustType = $_POST['AftermarketCustInfo']['cust_type'];
            $newCategory = $_POST['CustomerInfo']['category'];
            $transaction = Yii::app()->db->beginTransaction();
            $memo = $_POST['CustomerInfo']['memo'];
            $aftermodel->setAttribute("webchat", $_POST['AftermarketCustInfo']['webchat']);
            $aftermodel->setAttribute("ww", $_POST['AftermarketCustInfo']['ww']);
            $contractmodel->attributes = $_POST['ContractInfo'];
            $contractmodel->pay_time = strtotime($contractmodel->pay_time);
            $contractmodel->comm_pay_time = strtotime($contractmodel->comm_pay_time);
            if ($aftermodel->cust_type != $newCustType) {
                //客户分类调整，生成转换明细数据
                $convt = new CustConvtDetail();
                $convt->setAttribute('lib_type', 3); //售后库
                $convt->setAttribute('cust_id', $id);
                $convt->setAttribute('cust_type_1', $aftermodel->cust_type);
                $convt->setAttribute('cust_type_2', $newCustType);
                $convt->setAttribute('convt_time', time());
                $convt->setAttribute('user_id', Yii::app()->user->id);
                $convt->save();
            }
            //保存合同信息
            $contractmodel->save();
            //保存小记信息
            if (Utils::isNeedSaveNoteInfoForAfter($_POST['NoteInfo'], $newCustType)) {
                //保存小记 
                $nextcontact=$_POST['NoteInfo']['next_contact'];
                $noteinfo->attributes = $_POST['NoteInfo'];
                if ($model->iskey != $noteinfo->iskey) {
                    $model->iskey = $noteinfo->iskey;
                }
                $noteinfo->next_contact = strtotime($noteinfo->next_contact);
                $aftermodel->next_time = $noteinfo->next_contact;
                $model->next_time = $noteinfo->next_contact;
                $noteinfo->cust_type = $newCustType;
                $noteinfo->lib_type = "3";
                $noteinfo->setAttribute("eno", Yii::app()->user->id);
                $noteinfo->setAttribute("create_time", time());
                $noteinfo->save();
                //更新电话拔打记录
                if ($noteinfo->dial_id > 0) {
                    $dialdetail = DialDetail::model()->findByPk($noteinfo->dial_id);
                    //获取通知录音路径，通知时长 
                    $uid = $dialdetail->uid;
                    if ($uid == null || empty(trim($uid))) {
                        $uid = UnCall::getUid2($dialdetail);
                        $dialdetail->uid = $uid;
                    }
                    $dial_long = UnCall::getDialLength($uid);
                    $record_path = UnCall::getRecord($uid);
                    //$dialdetail->uid = $uid;
                    $dialdetail->dial_long = $dial_long;
                    $dialdetail->record_path = $record_path;
                    $dialdetail->save();
                }
            }
            if ($newCustType == 8) {
                //客户分类转成8，生成公海资源数据
                $temp = BlackInfo::model()->findBySql("select * from {{black_info}} where cust_id=$id");
                if (empty($temp)) {
                    $blackinfo = new BlackInfo();
                    $blackinfo->setAttribute("cust_id", $id);
                    $blackinfo->setAttribute('lib_type', 3);
                    $blackinfo->setAttribute('old_cust_type', $aftermodel->cust_type);
                    $blackinfo->setAttribute('create_time', time());
                    $blackinfo->setAttribute('creator', Yii::app()->user->id);
                    $blackinfo->save();
                    $aftermodel->delete(); //删除售后库
                } else {
                    Yii::app()->db->createCommand()->update('{{black_info}}', array('lib_type' => 3,
                            'old_cust_type' => $aftermodel->cust_type,
                            'create_time' => time(),
                            'creator' => Yii::app()->user->id
                             ), "cust_id=$id");
                }
                $model->status = "1";
                //售后员已分配资源数减1
                $sql = "update {{users}} set cust_num=cust_num-1 where eno='{$aftermodel->eno}'";
                Yii::app()->db->createCommand($sql)->execute();
            } else {
                //保存售后库 
                $aftermodel->cust_type = $newCustType;
                $aftermodel->save();
            }
            //更新类目或备注 
            $model->memo = $_POST['CustomerInfo']['memo'];
            $model->qq = $_POST['CustomerInfo']['qq'];
            $model->mail = $_POST['CustomerInfo']['mail'];
            $model->category = $newCategory;
            $model->last_time = time();
            $model->save();
            //加载页面数据
            if (!$noteinfo->hasErrors() && !$contractmodel->hasErrors() && !$aftermodel->hasErrors() && !$model->hasErrors()) {
                $transaction->commit();
                if ($newCustType == 8) {
                    //转入成功页面
                    Yii::app()->user->setFlash('success',"成功放入公海!");
                    $this->render("result");
                    return;
                } else {
                    Yii::app()->user->setFlash('success',"保存成功!");
                    $this->redirect($this->createUrl("edit", array('id' => $id)));
                }
            } else {
                $transaction->rollback();
                if(!empty($nextcontact)){
                    $noteinfo->setAttribute("next_contact", $nextcontact);
                }
            }
        }
        $model->setAttribute("create_time", date("Y-m-d H:i:s", $model->getAttribute("create_time")));
        $model->setAttribute("assign_time", date("Y-m-d H:i:s", $model->getAttribute("assign_time")));
        $model->setAttribute("next_time", date("Y-m-d H:i:s", $model->getAttribute("next_time")));
        $model->setAttribute("last_time", date("Y-m-d H:i:s", $model->getAttribute("last_time")));
        $aftermodel->setAttribute("assign_time", date("Y-m-d H:i:s", $aftermodel->getAttribute("assign_time")));
        $aftermodel->setAttribute("next_time", date("Y-m-d H:i:s", $aftermodel->getAttribute("next_time")));
        $aftermodel->setAttribute("create_time", date("Y-m-d H:i:s", $aftermodel->getAttribute("create_time")));
        $creator = Users::model()->findByPk($aftermodel->creator);
        $aftermodel->creator = $creator->getAttribute('eno');
        $contractmodel->setAttribute("create_time", date("Y-m-d H:i:s", $contractmodel->getAttribute("create_time")));
        $contractmodel->setAttribute("comm_pay_time", date("Y-m-d H:i:s", $contractmodel->getAttribute("comm_pay_time")));
        $contractmodel->setAttribute("pay_time", date("Y-m-d H:i:s", $contractmodel->getAttribute("pay_time")));
        $creator2 = Users::model()->findByPk($contractmodel->creator);
        $contractmodel->creator = $creator2->getAttribute('eno');
        $sharedNote = NoteInfo::model();
        $sharedNote->setAttribute("cust_id", $model->id);
        $historyNote = NoteInfo::model();
        $historyNote->setAttribute("cust_id", $model->id);

        $user = Users::model()->findByPk(Yii::app()->user->id);
        $this->render('update', array(
            'model' => $model,
            'after' => $aftermodel,
            'contract' => $contractmodel,
            'sharedNote' => $sharedNote,
            'historyNote' => $historyNote,
            'noteinfo' => $noteinfo,
            'loginuser' => $user,
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
        if (isset($_GET['isajax'])) {
            $this->renderPartial('_shared_note_list', array(
                'model' => $model,
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
        if (isset($_GET['isajax'])) {

            $this->renderPartial('_history_note_list', array(
                'model' => $model,
            ));
        }
    }

    /**
     * 新分客户
     */
    public function actionList() {
        $model = new AftermarketCustInfo('searchNewList');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AftermarketCustInfo'])) {
            $model->attributes = $_GET['AftermarketCustInfo'];
            $model->dept = $_GET['AftermarketCustInfo']['dept'];
            $model->group = $_GET['AftermarketCustInfo']['group'];
            $model->category = $_GET['AftermarketCustInfo']['category'];
            $model->searchtype = $_GET['AftermarketCustInfo']['searchtype'];
            $model->keyword = $_GET['AftermarketCustInfo']['keyword'];
        }
        $this->render('newlist', array(
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

    /**
     * 获取类目数组
     * @return type
     */
    public function getCategoryArr() {
        $sql = "select code,name from {{dic}} where ctype='cust_category'";
        $category = Dic::model()->findAllBySql($sql);
        $empty = new Dic();
        $empty->code = "";
        $empty->name = "请选择类目";
        $category = array_merge(array($empty), $category);
        return CHtml::listData($category, 'code', 'name');
    }

    /**
     * 获取部门数组 
     */
    public function getDeptArr() {
        $deptarr = DeptInfo::model()->findAll();
        $dept_empty = new DeptInfo();
        $dept_empty->id = 0;
        $dept_empty->name = '--请选择部门--';
        $deptarr = array_merge(array($dept_empty), $deptarr);
        return CHtml::listData($deptarr, "id", "name");
    }

    /**
     * 获取部门下组别数组 
     */
    public function getDeptGroupArr($deptid, $isajax) {
        if ($isajax) {
            $sql = "select t.group_id,g.name as group_name from {{dept_group}} t left join {{group_info}} g on t.group_id=g.id where t.dept_id=:dept_id";
            $grouparr = DeptGroup::model()->findAllBySql($sql, array(':dept_id' => $deptid));
            $group_empty = new DeptGroup();
            $group_empty->group_id = 0;
            $group_empty->group_name = '--请选择组别--';
            $grouparr = array_merge(array($group_empty), $grouparr);
            echo json_encode($grouparr);
        } else {
            $sql = "select t.group_id,g.name as group_name from {{dept_group}} t left join {{group_info}} g on t.group_id=g.id where t.dept_id=:dept_id";
            $grouparr = DeptGroup::model()->findAllBySql($sql, array(':dept_id' => $deptid));
            $group_empty = new DeptGroup();
            $group_empty->group_id = 0;
            $group_empty->group_name = '--请选择组别--';
            $grouparr = array_merge(array($group_empty), $grouparr);
            return CHtml::listData($grouparr, 'group_id', 'group_name');
        }
    }

    /**
     * 获取部门,组别下的用户数组 
     */
    public function getUserArr($deptid, $groupid, $isajax) {
        if ($isajax) {
            $sql = "select id,name from {{users}} where `dept_id`=:dept_id and `group_id`=:group_id";
            $userarr = Users::model()->findAllBySql($sql, array(':dept_id' => $deptid, ':group_id' => $groupid));
            $userarr = array_merge(array('0' => '--请选择用户--'), $userarr);
            echo json_encode($userarr);
        } else {
            $sql = "select id ,name  from {{users}}  where dept_id=:dept_id and group_id=:group_id";
            $userarr = Users::model()->findAllBySql($sql, array(':dept_id' => $deptid, ':group_id' => $groupid));
            $user_empty = new Users();
            $user_empty->id = '0';
            $user_empty->name = '--请选择用户--';
            $userarr = array_merge(array($user_empty), $userarr);
            return CHtml::listData($userarr, 'id', 'name');
        }
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

    /**
     * 拔打电话
     * @param type $cust_id
     */
    public function actionDial($cust_id) {
        $result = array('status' => 0, 'dial_id' => 123, 'message' => 'dial ok');
        echo json_encode($result);
    }

    /**
     * 发短信
     * @param type $cust_id
     */
    public function actionMessage($cust_id) {
        $model = new AftermarketCustInfo();
        $model->cust_id = $cust_id;
        if (isset($_POST['AftermarketCustInfo'])) {
            $model->attributes = $_POST['AftermarketCustInfo'];
            $model->message = $_POST['AftermarketCustInfo']['message'];
            $ret = Utils::sendMessageByCust($model->cust_id, $model->message, 'post');
            Utils::showMsg(1, $ret);
            Yii::app()->end;
            exit();
        }
        $this->renderPartial('message', array(
            'model' => $model,
        ));
    }

    /**
     * 发邮件
     * @param type $cust_id
     */
    public function actionMail($cust_id) {
        echo 'Mail ok';
    }

    /**
     * 监听电话
     * @param type $cust_id
     */
    public function actionListen($cust_id) {
        echo 'Listen ok';
    }

    /**
     * ajax获取部门下组别数组 
     * @param type $deptid
     * @param type $isajax
     * @return type
     */
    public function actionDeptGroupArr($deptid, $isajax) {
        if ($isajax) {
            $sql = "select t.group_id,g.name as group_name from {{dept_group}} t left join {{group_info}} g on t.group_id=g.id where t.dept_id=:dept_id";
            $grouparr = DeptGroup::model()->findAllBySql($sql, array(':dept_id' => $deptid));
            $group_empty = new DeptGroup();
            $group_empty->group_id = 0;
            $group_empty->group_name = '--请选择组别--';
            $grouparr = array_merge(array($group_empty), $grouparr);
            echo json_encode($grouparr);
        } else {
            $sql = "select t.group_id,g.name as group_name from {{dept_group}} t left join {{group_info}} g on t.group_id=g.id where t.dept_id=:dept_id";
            $grouparr = DeptGroup::model()->findAllBySql($sql, array(':dept_id' => $deptid));
            $group_empty = new DeptGroup();
            $group_empty->group_id = 0;
            $group_empty->group_name = '--请选择组别--';
            $grouparr = array_merge(array($group_empty), $grouparr);
            return CHtml::listData($grouparr, 'group_id', 'group_name');
        }
    }

    /**
     * ajax 获取部门,组别下所有用户数组 
     * @param type $deptid
     * @param type $groupid
     */
    public function actionUserArr($deptid, $groupid) {
        $sql = "select id,name from {{users}} where `dept_id`=:dept_id and `group_id`=:group_id";
        $userarr = Users::model()->findAllBySql($sql, array(':dept_id' => $deptid, ':group_id' => $groupid));
        $user_empty = new Users();
        $user_empty->id = '0';
        $user_empty->name = '--请选择用户--';
        $userarr = array_merge(array($user_empty), $userarr);
        echo json_encode($userarr);
    }

    public function get_after_type_text($data) {
        $val = $data->cust_type;
        $lib_type = 3;
        $typeArr = $this->gettypeArr($val, $lib_type);
        $res = isset($typeArr[$val]) ? "【" . $val . "类】" . $typeArr[$val] : $val;
        return $res;
    }

    public function get_type_text($data) {
        $val = $data->cust_type;
        $lib_type = $data->lib_type;
        $typeArr = $this->gettypeArr($val, $lib_type);
        $res = isset($typeArr[$val]) ? "【" . $val . "类】" . $typeArr[$val] : $val;
        return $res;
    }

    public function gettypeArr($type_no, $lib_type) {
        return CHtml::listData(CustType::model()->findAll('lib_type=:lib_type and type_no=:type_no', array(':type_no' => $type_no, 'lib_type' => $lib_type)), 'type_no', 'type_name');
    }

    public function get_eno_text($data) {
        $val = $data->eno;
        $enoArr = $this->getEnoArr($val);
        $res = isset($enoArr[$val]) ? $enoArr[$val] : $val;
        return $res;
    }

    public function get_assign_eno_text($data) {
        $val = $data->assign_eno;
        $enoArr = $this->getEnoArr($val);
        $res = isset($enoArr[$val]) ? $enoArr[$val] : $val;
        return $res;
    }

    public function getEnoArr($eno) {
        return CHtml::listData(Users::model()->findAll('eno=:eno', array(':eno' => $eno)), 'eno', 'name');
    }

    public function get_user_text($data) {
        $val = $data->eno;
        $enoArr = $this->getUserArr2($val);
        $res = isset($enoArr[$val]) ? $enoArr[$val] : $val;
        return $res;
    }

    public function getUserArr2($id) {
        return CHtml::listData(Users::model()->findAll('id=:id', array(':id' => $id)), 'id', 'name');
    }

    public function genNoteRecordInfo($data) {
        return Utils::genNoteDisplayRecord($data);
    }

}
