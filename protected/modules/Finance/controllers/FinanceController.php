<?php

class FinanceController extends GController {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

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
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
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
        $model = new Finance;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Finance'])) {
            $model->attributes = $_POST['Finance'];
            //增加创建人，增加时间 
            $model->dept = $_POST['Finance']['dept'];
            $model->group = $_POST['Finance']['group'];
            $acct_time = $model->getAttribute("acct_time");
            $iAcctTime = strtotime($acct_time);
            $model->setAttribute("acct_time", $iAcctTime);
            $model->setAttribute("creator", Yii::app()->user->id);
            $model->setAttribute("create_time", time());
            if ($model->save()) {
                $this->redirect(array('admin'));
            } else {

                $model->acct_time = date("Y-m-d", time());
            }
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
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if ($model) {
            $model->create_time = date('Y-m-d', $model->create_time);
            $model->acct_time = date('Y-m-d', $model->acct_time);
            $user = Users::model()->findByPk($model->sale_user);
            $model->dept = $user->dept_id;
            $model->group = $user->group_id;
            $cust = CustomerInfo::model()->findByPk($model->cust_id);
            $model->cust_name = $cust->cust_name;
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Finance'])) {
            $model->attributes = $_POST['Finance'];
            $acct_time = $model->getAttribute("acct_time");
            $iAcctTime = strtotime($acct_time);
            $model->setAttribute("acct_time", $iAcctTime);
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
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
        $dataProvider = new CActiveDataProvider('Finance');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * 弹出客户列表数据
     */
    public function actionPopCustList() {
        $model = new CustomerInfo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CustomerInfo']))
            $model->attributes = $_GET['CustomerInfo'];

        if (isset($_GET['isajax'])) {
            $this->renderPartial('_custlist', array(
                'model' => $model,
            ));
        } else {
            $this->renderPartial('custlist', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Finance('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['Finance'])) {
            $model->attributes = $_POST['Finance'];
            $model->searchtype = $_POST['Finance']['searchtype'];
            $model->keyword = $_POST['Finance']['keyword'];
            $model->acct_time_start = $_POST['Finance']['acct_time_start'];
            $model->acct_time_end = $_POST['Finance']['acct_time_end'];
            $model->dept = $_POST['Finance']['dept'];
            $model->group = $_POST['Finance']['group'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Finance the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Finance::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Finance $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'finance-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
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
     * 获取所有谈单师用户数组 
     * need to do when role has done.
     */
    public function getAllTransUser() {
        $sql = "select id,name from {{users}} t where exists (select 1 from {{user_role}} where role_id=1 and user_id=t.id  )";
        return CHtml::listData(Users::model()->findAllBySql($sql), 'id', 'name');
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

    public function actionTest() {
        // $content="上周A股市场风格出现分化，在大盘蓝筹股的带动下主板市场屡创新高。面对不断冲高的大盘，市场的恐高心理也有所增加，业内人士认为，近期，在大盘加速冲刺阶段积累了巨量短线获利盘，市场面临巨大的技术性调整压力。当然，也有券商机构喊出，“牛市将持续三年到五年”上周A股市场风格出现分化上周A股市场风格出现分化，，。上周A股市场风格出现分化上周A股市场风格出现";
        //Utils::sendMessage("13536580119", $content,"post"); 
        //Utils::sendMessage("18589075186", $content,"post"); 
        $xmlstr = '<?xml version="1.0" encoding="utf-8"?>
                    <uncall>
                        <result>1</result>
                        <OnClickCall>
                            <Response>success</Response>
                            <ActionID>123456</ActionID>
                            <Message>Originate successfully queued</Message>
                        </OnClickCall>
                    </uncall>';
        $xml = simplexml_load_string($xmlstr);
        echo $xml->OnClickCall->Response;
        
    }

    function Get($phone, $msg) {
        $sms = Yii::app()->params['SMS'];
        $ch = curl_init();
        $timeout = 15;
        $postdata = array('uid' => $sms['uid'],
            'auth' => $sms['auth'],
            'expid' => $sms['expid'],
            'encode' => $sms['encode'],
            'mobile' => $phone,
            'msg' => $msg
        );
        $sUrl = $sms['url'] . "?expid=0&uid=" . $sms['uid'] . "&auth=" . $sms['auth'] . "&encode=" . $sms['encode'] . "&mobile=" . $phone . "&msg=" . $msg;
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("chaetset=utf-8"));
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); // Post提交的数据包
        curl_setopt($ch, CURLOPT_URL, $sUrl);
        //curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
        return $result;
    }

    public function actionTest5() {
        // $content="上周A股市场风格出现分化，在大盘蓝筹股的带动下主板市场屡创新高。面对不断冲高的大盘，市场的恐高心理也有所增加，业内人士认为，近期，在大盘加速冲刺阶段积累了巨量短线获利盘，市场面临巨大的技术性调整压力。当然，也有券商机构喊出，“牛市将持续三年到五年”上周A股市场风格出现分化上周A股市场风格出现分化，，。上周A股市场风格出现分化上周A股市场风格出现";
        //Utils::sendMessage("13536580119", $content,"post"); 
        //Utils::sendMessage("18589075186", $content,"post"); 
        define('DIAL_SERVERES_ADDRESS_WSDL_API', "http://192.168.1.200/uncall_api/index.php?wsdl");
        $soapClient = new SoapClient(DIAL_SERVERES_ADDRESS_WSDL_API);
        $t = time(); //15019213787
        $reslut = $soapClient->OnClickCall("814", "15019213787", '');
        var_dump($reslut);
        echo $t;
    }

    public function actionTest1() {
        // $content="上周A股市场风格出现分化，在大盘蓝筹股的带动下主板市场屡创新高。面对不断冲高的大盘，市场的恐高心理也有所增加，业内人士认为，近期，在大盘加速冲刺阶段积累了巨量短线获利盘，市场面临巨大的技术性调整压力。当然，也有券商机构喊出，“牛市将持续三年到五年”上周A股市场风格出现分化上周A股市场风格出现分化，，。上周A股市场风格出现分化上周A股市场风格出现";
        //Utils::sendMessage("13536580119", $content,"post"); 
        //Utils::sendMessage("18589075186", $content,"post"); 
        define('DIAL_SERVERES_ADDRESS_WSDL_API', "http://192.168.1.200/uncall_api/index.php?wsdl");
        $soapClient = new SoapClient(DIAL_SERVERES_ADDRESS_WSDL_API);
        $t = time();
        $reslut = $soapClient->listenCall("814", "803");
        var_dump($reslut);
        echo $t;
    }

    public function actionTest2() {
        // $content="上周A股市场风格出现分化，在大盘蓝筹股的带动下主板市场屡创新高。面对不断冲高的大盘，市场的恐高心理也有所增加，业内人士认为，近期，在大盘加速冲刺阶段积累了巨量短线获利盘，市场面临巨大的技术性调整压力。当然，也有券商机构喊出，“牛市将持续三年到五年”上周A股市场风格出现分化上周A股市场风格出现分化，，。上周A股市场风格出现分化上周A股市场风格出现";
        //Utils::sendMessage("13536580119", $content,"post"); 
        //Utils::sendMessage("18589075186", $content,"post"); 
        define('DIAL_SERVERES_ADDRESS_WSDL_API', "http://192.168.1.200/uncall_api/index.php?wsdl");
        $soapClient = new SoapClient(DIAL_SERVERES_ADDRESS_WSDL_API);
        $t = time();
        $reslut = $soapClient->getReordingFilesList("804");

        print_r($reslut);

        echo $t;
    }

    public function actionTest3() {
        // $content="上周A股市场风格出现分化，在大盘蓝筹股的带动下主板市场屡创新高。面对不断冲高的大盘，市场的恐高心理也有所增加，业内人士认为，近期，在大盘加速冲刺阶段积累了巨量短线获利盘，市场面临巨大的技术性调整压力。当然，也有券商机构喊出，“牛市将持续三年到五年”上周A股市场风格出现分化上周A股市场风格出现分化，，。上周A股市场风格出现分化上周A股市场风格出现";
        //Utils::sendMessage("13536580119", $content,"post"); 
        //Utils::sendMessage("18589075186", $content,"post"); 
        define('DIAL_SERVERES_ADDRESS_WSDL_API', "http://192.168.1.200/uncall_api/index.php?wsdl");
        $soapClient = new SoapClient(DIAL_SERVERES_ADDRESS_WSDL_API);
        $t = time();
        $reslut = $soapClient->getRecording("1434255149.139");
        echo "<pre>";
        var_dump($reslut);
        echo "</pre>";
        echo $t;
    }

    public function actionTest4() {
        // $content="上周A股市场风格出现分化，在大盘蓝筹股的带动下主板市场屡创新高。面对不断冲高的大盘，市场的恐高心理也有所增加，业内人士认为，近期，在大盘加速冲刺阶段积累了巨量短线获利盘，市场面临巨大的技术性调整压力。当然，也有券商机构喊出，“牛市将持续三年到五年”上周A股市场风格出现分化上周A股市场风格出现分化，，。上周A股市场风格出现分化上周A股市场风格出现";
        //Utils::sendMessage("13536580119", $content,"post"); 
        //Utils::sendMessage("18589075186", $content,"post"); 
        define('DIAL_SERVERES_ADDRESS_WSDL_API', "http://192.168.1.200/uncall_api/index.php?wsdl");
        $soapClient = new SoapClient(DIAL_SERVERES_ADDRESS_WSDL_API);
        $t = time();
        $reslut = $soapClient->popEvent("814");
        echo "<pre>";
        var_dump($reslut);
        echo "</pre>";
        echo $t;
    }

}
