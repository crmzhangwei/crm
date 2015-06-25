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
           * 模块名
           * @var type 
           */
        protected $moduleName = '';

          /**
           * 控制器名
           * @var type 
           */
        protected $controllerName = '';
       // protected $permission = array();

      
        /**
	 * @return array action filters
	 */
        public function __construct($id, $module = null) {
            header("Content-type: text/html; charset=utf-8");
            if(Yii::app()->user->isGuest && $id!='site')
            {
                $this->redirect(Yii::app()->user->loginUrl);
            }
            $this->moduelid=$module?$module->id:null;
            $this->controllerName = $id;
            //$this->allMenu = Yii::app()->params['items'];
            $meauinfo = Yii::app()->params['items'];
            $permission = Yii::app()->session["tmpuser"];
            $meauinfonew = array();
            if ($meauinfo && $permission) {
                foreach ($meauinfo as $key => &$v1) {
                    $have = false;
                    $items = array();
                    foreach ($v1['items'] as &$item) {
                        if (!in_array($item['url'][0], $permission)) {
                            unset($item);
                        } else {
                            $items[] = $item;
                            $have = true;
                        }
                    }
                    $v1['items'] = $items;
                    if ($items) {
                        $meauinfonew[$key] = $v1;
                    }
                    if (!$have) {
                        unset($v1);
                    }
                }
            }

            $this->allMenu  = $meauinfonew;
           // $this->allMenu  = Yii::app()->params['items'];   
            parent::__construct($id, $module);
               
       
        }
        
     public function beforeAction($action) {
        parent::beforeAction($action);

        $this->actionName = $action->id;
        if($this->module&&$this->module->id !== null) {
            if ($this->checkPriv() === false) {
                 Utils::redirect($this->createUrl('/site/forbidden'));
            }
        }
        return true;
    }
        
   /**
     * 检测用户权限
     */
    private function checkPriv() {
        $router = $this->controllerName . '/' . $this->actionName;
        if ($this->moduelid !== '') {
            $router = '/' . $this->moduelid . '/' . $router;
        }
        $router = str_replace('//', '/', $router);
        $userPer = Yii::app()->session["tmpuser"]; 
        if(empty($userPer)){
            Yii::app()->user->logout();
           // $this->redirect(Yii::app()->user->loginUrl);
        }
        //取出所有的用户权限
        $permission = Yii::app()->session["tmpmenu"];
        $hasPriv = false;
        if(!empty($userPer) &&!empty($permission)) {
            foreach ($permission as $v) {   //遍历全部权限
                if ($router == $v) {  //如果路由在所有权限列表中，则进行权限验证
                    if (in_array($router, $userPer)) {
                        $hasPriv = true;
                    } else {
                        $hasPriv = false;
                    }
                    break;
                } else {        
                    $hasPriv = true;
                }
            }
        } 
        return $hasPriv;
    }
}

