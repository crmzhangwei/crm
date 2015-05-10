<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Gcontroller extends Controller
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/colunmg';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
        public $allMenu =array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        public $moduelid;
      
        /**
	 * @return array action filters
	 */
        public function __construct($id, $module = null) {
            header("Content-type: text/html; charset=utf-8");
            if(Yii::app()->user->isGuest)
            {
                $this->redirect(Yii::app()->user->loginUrl);
            }
            $this->moduelid=$module->id;
            $this->allMenu = Yii::app()->params['items'];
            $permission =  Yii::app()->session["tmpuser"];
            $meauinfo = Yii::app()->params['items'];
            $permission = Privilege::model()->SelectRolePermission();
            $meauinfonew = array();
//            foreach ( $meauinfo as $key=> &$v1) {
//                $have = false;
//                $items = array();
//                foreach ($v1['items'] as &$item)
//                {
//                    //var_dump($item['url'][0]);
//                    if(!in_array($item['url'][0],$permission))
//                    {
//                        unset($item);
//                    }else
//                    {
//                        $items[] = $item;
//                        $have = true;
//                    }
//                }
//                $v1['items'] =  $items;
//               
//                if($items)
//                {
//                    $meauinfonew[$key] = $v1;
//                }
//                 if(!$have)
//                {
//                    unset($v1);
//                }
//            }
      
            $this->allMenu  = $meauinfo;
          //  var_dump(Yii::app()->params['items']);
            //var_dump(Yii::app()->session["tmpuser"]);
            parent::__construct($id, $module);
           // var_dump(Yii::app()->params['items']);
       
        }
        
     
        
   /**
     * 检测用户权限
     */
    private function checkPriv() {
        $router = $this->controllerName . '/' . $this->actionName;
        if ($this->moduleName !== '') {
            $router = '/' . $this->moduleName . '/' . $router;
        }
        $router = str_replace('//', '/', $router);
        //尝试3次从redis取出所有权限，如果取不到则退出

         //获取所有的权限
        $permission =  Yii::app()->session["tmpuser"];
        
        if(empty($permission)){
            Common::userLogout();   //用户退出
            $this->redirect(Yii::app()->user->loginUrl);
        }
        //取出用户权限
        $userPer = $this->userData['permission'];
        $hasPriv = false;
        if(!empty($userPer)) {
            foreach ($permission as $v) {   //遍历全部权限
                if ($router == $v['url']) {  //如果路由在所有权限列表中，则进行权限验证
                    if (array_key_exists($router, $userPer)) {
                        $hasPriv = true;
                        //设置页面元素的权限编码
                        $this->percode = $userPer[$router]['percode'];
                    } else {
                        $hasPriv = false;
                    }
                    break;
                } else {        //如果不在权限表中，则默认为有权限
                    $hasPriv = true;
                }
            }
        } 
        return $hasPriv;
    }
}


//class TController extends Controller {
//
//    /**
//     * 用户信息
//     * @var array 
//     */
//    public $userData = array();
//    public $ywuid;   //登录id
//    public $username; //用户名
//    //布局文件
//    public $layout = '//layouts/to8to';
//    //初始化菜单
//    public $menu = array();
//    //面包屑路径    
//    public $breadcrumbs = array();
//
//    /**
//     * 模块名
//     * @var type 
//     */
//    private $moduleName = '';
//
//    /**
//     * 控制器名
//     * @var type 
//     */
//    private $controllerName = '';
//
//    /**
//     * 操作方法名
//     * @var type 
//     */
//    private $actionName = '';
//
//    /**
//     * 页面元素的权限编码，
//     * @var type 
//     */
//    protected $percode = array();
//
//    /**
//     * 当前登录的用户信息
//     * @var  array
//     */
//    protected $userInfo = array();
//
//    /**
//     * 当前登录的用户名
//     * @var  string
//     */
//    protected $name = 'Guest';
//
//    /**
//     * 路由
//     * @var string
//     */
//    public $router = '';
//
//    /**
//     * 客服弹窗状态
//     * @var int
//     */
//    public $window_status;
//
//    /**
//     * 构造函数
//     * @param type $id
//     * @param type $module
//     */
//    public function __construct($id, $module) {
//        parent::__construct($id, $module);
//        
//        $this->testCrm("Yii createWebApplication");
//        //设置当前模块名和控制名
//        $this->moduleName = $module->id;
//        $this->controllerName = $id;
//        $this->testCrm("开始操作 session");
//        if(empty(Yii::app()->session['uid'])){
//            $user = Common::getSess();
//            $this->testCrm("开始写入 session");
//            Yii::app()->session['uid'] = $user['uid'];
//            Yii::app()->session['username'] = $user['username'];
//            $this->testCrm("session 写入完成");
//        }
//        $this->testCrm("session 操作完成");
//        
//        Common::setSess( array('uid'=>Yii::app()->session['uid'],'username'=>Yii::app()->session['username']) );
//        
//        $this->testCrm("Redis: 设置用户session信息");
//               
//        //登录的ID和用户名信息
//        $this->ywuid = Yii::app()->session['uid'];
//        $this->username = Yii::app()->session['username'];
//        
//        //获取当前登录的用户信息
//        $this->getCurrentUserData();
//        $this->testCrm("Redis: 取出当前登录的用户信息");
//
//        //设置当前登录的用户信息
//        $this->userInfo = $this->userData['info'];
//
//        //检测用户登录情况
//        $this->checkUserLogin();
//        $this->testCrm("检测当前用户是否允许登录");
//
//        //设置当前登录的用户菜单
//        $this->menu = $this->userData['menu'];
//
//        if (!empty($this->userData['cs']['crmid']) && !empty($this->userData['cs']['crmpassword']) && !empty($this->userData['cs']['crmbondphone'])) {
//            $this->window_status = 1;
//        }
//
//    }
//
//    /**
//     * 从session中取出用户信息
//     */
//    public function getCurrentUserData() {
//        $sessid = session_id();
//        $userData = Yii::app()->redis_cache->get( 'to8tocrm_userdata_'.$sessid);
//        if( strlen($userData['cs']['crmbondphone']) >=5 )
//        {
//            $userData['cs']['bindType']=1;
//        }else{
//            $userData['cs']['bindType']=2;
//        }
//
//        $this->userData = $userData;
//        return $this->userData;
//    }
//
//    public function getUserData($uid = 0) {
//        if ($uid) {
//            if (Yii::app()->redis_cache->has("to8tocrm_userdata_" . $uid)) {
//                $userData = Yii::app()->redis_cache->get("to8tocrm_userdata_" . $uid);
//                return $userData;
//            }
//        }
//        return null;
//    }
//
//    public function checkUserLogin() {
//        $session_id = session_id(); // 获取当前用户登录的SESSIONID
//        $userId = Yii::app()->session['uid'];
//
//        //非监理，销售对登陆者IP判断
//        $common = new Common();
//        if (!$common->checkAllowedIP() && !in_array($this->userInfo['roleid'], Yii::app()->params['website']['login']['login_role'])) {
//            Common::userLogout();   //用户退出
//            // 记录用户退出的日志信息，临时使用
//            $msg = date("Y-m-d H:i:s") . "\t不被允许 被动退出\tSESSIONID: " . $session_id . " \tUID：".$userId."\tIP: " . Yii::app()->request->userHostAddress . "\tURL: " . Yii::app()->request->requestUri . "\r\n".  var_export($_SESSION, true)."\r\n";
//            Utils::redirect($this->createUrl('/admin/login', array("type"=>2)));
//            exit;
//        }
//
//        if (!isset(Yii::app()->session['uid']) || !Yii::app()->session['uid'] ) {
//            // 记录用户退出的日志信息，临时使用
//            $msg = date("Y-m-d H:i:s") . "\tSESSION过期被动退出\tSESSIONID: " . $session_id . "\tUID：".$userId."\tIP: " . Yii::app()->request->userHostAddress . "\tURL: " . Yii::app()->request->requestUri . "\r\n".  var_export($_SESSION, true)."\r\n";
//            Common::userLogout();   //用户退出
//            Utils::redirect($this->createUrl('/admin/login', array("type"=>3)));
//            exit;
//        }
//
//        $userIP = Yii::app()->request->userHostAddress;
//        $loginIp = Common::getIpFromRedis($userId);
//
//        if ($userIP != $loginIp) {
//            Common::userLogout();   //用户退出
//            $msg = date("Y-m-d H:i:s") . "\t被后登陆者挤出系统\tSESSIONID: " . $session_id . " \tUID：".$userId."\t前IP: " . $userIP . "\t后者IP: " . $loginIp . "\tURL: " . Yii::app()->request->requestUri . "\r\n".  var_export($_SESSION, true)."\r\n";
//            Utils::redirect($this->createUrl('/admin/login', array("type"=>4)));
//            exit;
//        }
//    }
//
//    /**
//     * 在执行每个action前检查权限，如果没有权限跳转到forbidden页面
//     * @param type $action
//     * @return boolean
//     */
//    public function beforeAction($action) {
//        parent::beforeAction($action);
//
//        $this->actionName = $action->id;
//
//        if (method_exists($this, 'getBreadcrumbs')) {
//            $this->getBreadcrumbs();
//        }
//        /**
//         * 首页的模块名为空，不进行权限检测，如果用户没有任何权限，则显示首页
//         */
//        if($this->module->id !== null) {
//            if ($this->checkPriv() === false) {
//    //            if (Yii::app()->request->isAjaxRequest) {
//    //                Utils::showMsg(0, '您未被授权进行此操作.');
//    //            } else {
//                Utils::redirect($this->createUrl('/site/forbidden'));
//    //            }
//    //            exit;
//            }
//        }
//        $this->testCrm("检测当前用户权限");
//        return true;
//    }
//
//    final public function actionCheckPiv() {
//        $module = strtolower($this->module ? $this->module->id : 'home' );
//
//        if (!empty($this->menu[$module]['items'])) {
//            $newArr = current($this->menu[$module]['items']);
//            if (isset($newArr['items'])) {
//                $newArr = current($newArr['items']);
//            }
//            if (isset($newArr['url'])) {
//                $this->redirect($newArr['url']);
//            } else
//                echo '请点击左边菜单进行操作';
//        }
//    }
//
//    /**
//     * 检测用户权限
//     */
//    private function checkPriv() {
//        $router = $this->controllerName . '/' . $this->actionName;
//        if ($this->moduleName !== '') {
//            $router = '/' . $this->moduleName . '/' . $router;
//        }
//        $router = str_replace('//', '/', $router);
//        //尝试3次从redis取出所有权限，如果取不到则退出
//        $this->testCrm('尝试3次从redis取出所有权限');
//        $i=0;
//        while($i<=3){
//            $i++;
//            $permission = Yii::app()->redis_cache->get('to8tocrm_permission');
//            if(!empty($permission)) {
//                $this->testCrm('第'.$i.'次取出所有权限完成');
//                break;
//            }
//        }
//        if(empty($permission)){
//            Common::userLogout();   //用户退出
//            Utils::redirect($this->createUrl('/admin/login', array("type"=>5)));
//        }
//        //取出用户权限
//        $userPer = $this->userData['permission'];
//        $hasPriv = false;
//        if(!empty($userPer)) {
//            foreach ($permission as $v) {   //遍历全部权限
//                if ($router == $v['url']) {  //如果路由在所有权限列表中，则进行权限验证
//                    if (array_key_exists($router, $userPer)) {
//                        $hasPriv = true;
//                        //设置页面元素的权限编码
//                        $this->percode = $userPer[$router]['percode'];
//                    } else {
//                        $hasPriv = false;
//                    }
//                    break;
//                } else {        //如果不在权限表中，则默认为有权限
//                    $hasPriv = true;
//                }
//            }
//        } 
//        return $hasPriv;
//    }
//
//    /**
//     * @return mixed|CWebUser
//     */
//    public function getUser() {
//        return Yii::app()->user;
//    }
//
//    /**
//     * 获取Thrift服务实例
//     */
//    public function thrift($serviceName = '') {
//        if (empty($serviceName)) {
//            throw new Exception('Thrift服务名不能为空!');
//        }
//        return ThriftClient::instance($serviceName);
//    }
//    
//    /**
//     * 获取CRM调用接口的实例
//     */
//    public function crm($serviceName = ''){
//        if (empty($serviceName)) {
//            throw new Exception('服务名不能为空!');
//        }
//        if(class_exists('Crm')){
//            return new Crm($serviceName);
//        } else {
//            throw new Exception('没找到调用接口的类[Crm]');
//        }
//    }
//
//    /**
//     * 取出固定角色
//     */
//    public function getConfigRole() {
//        try {
//            $roles = $this->crm('com.permission')->method('selectAllConfigRole')->send();
//        } catch (Exception $ex) {
//            throw new Exception('获取固定角色失败：'.$ex->getMessage());
//        }
//        $this->testCrm("取出固定角色");
//        return is_array($roles['results']) ? $roles['results'] : array();
//    }
//
//    /**
//     * 取出城市列表
//     */
//    public function getCities() {
//        try {
//            $res = $this->crm('crm.utils')->method('getAllCityList')->send();
//            $cities = $res['citys'];
//        } catch (Exception $ex) {
//            throw new Exception('取出所有城市列表失败'.$ex->getMessage());
//        }
//        $this->testCrm("取出所有城市列表");
//        return is_array($cities) ? $cities : array();
//    }
//
//    /**
//     * 取出城市列表，给select下拉框
//     */
//    public function getSelectCity() {
//        $cities = $this->getCities();
//        $cityList = array();
//        if (!empty($cities)) {
//            foreach ($cities as $k => $v) {
//                $cityList[$k] = array('cityid' => $v['cityid'], 'cityname' => $v['abbr'] . '|' . $v['cityname']);
//            }
//        }
//        return $cityList;
//    }
//
//    /**
//     * 取出城市列表给城市选择JS用
//     */
//    public function getJsCity() {
//        $cities = $this->getCities();
//        $cityList = array();
//        if (!empty($cities)) {
//            foreach ($cities as $k => $v) {
//                $cityList[] = $v['cityid'] . '|' . $v['cityname'] . '|' . $v['pinyin'] . '|' . $v['abbr'];
//            }
//        }
//        return $cityList;
//    }
//
//    /**
//     * 获取当前登录用户所负责的城市
//     */
//    public function getUserCity() {
//        try {
//            $res = $this->crm('com.permission')->method('selectUserCity')->send($this->ywuid);
//        } catch (Exception $ex) {
//            throw new Exception('获取用户城市失败!' . $ex->getMessage());
//        }
//        return is_array($res['results']) ? $res['results'] : array();
//    }
//    /**
//     * 获取当前登录用户所负责的城市
//     * @return type
//     */
//    public function getUserSelectCity() {
//        $cities = $this->getUserCity();
//        $cityList = array();
//        if (!empty($cities)) {
//            foreach ($cities as $k => $v) {
//                $cityList[$k] = array('cityid' => $v['cid'], 'cityname' => $v['abbr'] . '|' . $v['cname']);
//            }
//        }
//        return $cityList;
//    }
//
//    /**
//     * 取出当前登录的用户下级员工
//     */
//    public function getSubStaff() {
//        $common = new Common();
//        $staff = $common->getSubStaff($this->ywuid);
//        $this->testCrm("取出当前登录的用户下级员工");
//        return $staff;
//    }
//    public function testCrm($text) {
//        if (function_exists('testCrm')) {
//            testCrm($text);
//        }
//    }
//
//    public function createPageUrl($params=array())
//    {
//        $route = array($this->moduleName, $this->controllerName, $this->actionName);
//        $route = '/'.trim(implode('/', $route), '/');
//        return $this->createUrl($route, $params);
//    }
//}
