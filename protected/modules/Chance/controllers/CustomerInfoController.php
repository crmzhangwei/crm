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
            'user'=>$user,
        ));
    }

    
     public function actionUpdate($id) {
        //$noteinfo = new NoteInfo(); 
        $model = $this->loadModel($id);
        if (isset($_POST['CustomerInfo'])) {
            //保存  
           // $sql = "select * from {{aftermarket_cust_info}} where cust_id=:cust_id";
            //$aftermodel = AftermarketCustInfo::model()->findBySql($sql, array(':cust_id' => $id));  
            $newCustType = $_POST['CustomerInfo']['cust_type'];
            $newCategory = $_POST['CustomerInfo']['category'];
             $_POST['CustomerInfo']['next_time'] = strtotime($_POST['CustomerInfo']['next_time']);
             $model->attributes = $_POST['CustomerInfo'];
             $model->save();
//            if ($aftermodel->cust_type != $newCustType) {
//                //客户分类调整，生成转换明细数据
//                $convt = new CustConvtDetail();
//                $convt->setAttribute('lib_type', 3);
//                $convt->setAttribute('cust_id', $id);
//                $convt->setAttribute('cust_type_1', $aftermodel->cust_type);
//                $convt->setAttribute('cust_type_2', $newCustType);
//                $convt->setAttribute('convt_time', time());
//                $convt->setAttribute('user_id', Yii::app()->user->id);
//                $convt->save();
//            }
            if ($newCustType == 7) {
                //客户分类转成7（放弃），生成公海资源数据
                $blackinfo = new BlackInfo();
                $blackinfo->setAttribute("cust_id", $id);
                $blackinfo->setAttribute('lib_type', 3);
                $blackinfo->setAttribute('old_cust_type', $aftermodel->cust_type);
                $blackinfo->setAttribute('create_time', time());
                $blackinfo->setAttribute('creator', Yii::app()->user->id);
                $blackinfo->save();
            } 
            //更新类目
            if($model->category!=$newCategory){
                $model->category=$newCategory;
                Yii::app()->db->createCommand()->update('{{customer_info}}',array('category' =>$newCategory),"id=$id"); 
            }
     
        
        }
//        //加载页面数据
//        if(!$noteinfo->hasErrors()){
//            //保存成功，没有错误，清除数据
//            $noteinfo->unsetAttributes();
//            $noteinfo->setAttribute("iskey", 0);
//            $noteinfo->setAttribute("isvalid", 0);
//            $noteinfo->setAttribute("dial_id", 0);
//            $noteinfo->setAttribute("message_id", 0);
//            $noteinfo->setAttribute("next_contact", date('Y-m-d',time()));
//            $noteinfo->cust_id = $id;
//        }else{
//            $noteinfo->setAttribute("next_contact", date('Y-m-d',$noteinfo->next_contact));
//        } 
       
        $model->setAttribute("create_time", date("Y-m-d", intval($model->getAttribute("create_time"))));
        $model->setAttribute("assign_time", date("Y-m-d", intval($model->getAttribute("assign_time"))));
        $model->setAttribute("next_time", date("Y-m-d",intval( $model->getAttribute("next_time"))));
      
        $user = Users::model()->findByPk($model->creator);
        $this->render('update', array(
            'model' => $model,
           // 'sharedNote' => $sharedNote,
           // 'historyNote' => $historyNote,
           // 'noteinfo' => $noteinfo,
            'user' => $user,
        ));
    }
    
    
    public function actionNoteInfo($id)
    {
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
                   $model->memo= $noteinfo->memo;
                   $model->save();
                } else {
                    $noteinfo->addError("memo", "请录入小记信息");
                }
                //更新电话拔打记录
                if($noteinfo->dial_id>0){
                    $dialdetail =  DialDetail::model()->findByPk($noteinfo->dial_id);
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
    
    public function actionHistoryNote($id){
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
     public function actionSharedNote($id){ 
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
        $begintime = strtotime( date('Y-m-d',time()));
        $endtime = $begintime+86400;
        $model->begintime=$begintime;
        $model->endtime = $endtime;
        if (isset($_GET['CustomerInfo']))
            $model->attributes = $_GET['CustomerInfo'];
        $this->render('admin', array(
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
        $this->render('admin', array(
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
        $custTypeArr = Utils::mapArray(CustType::findByType(1), 'type_no', 'type_name');
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
        return $category ;
    }
    protected  function getCartTxt($data)
    {
        $code=$data->category;
        $custType = Dic::model()->getCustCart();
        return $code&&!empty($custType[$code])?$custType[$code]:$code;
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
}
