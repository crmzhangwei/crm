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
            if(Yii::app()->user->isGuest)
            {
                $this->redirect(Yii::app()->user->loginUrl);
            }
            $this->moduelid=$module->id;
            $this->allMenu = Yii::app()->params['items'];
            parent::__construct($id, $module);
           // var_dump(Yii::app()->params['items']);
        }
}