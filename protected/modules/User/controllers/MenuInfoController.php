<?php

class MenuInfoController extends GController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public function actionCreate()
	{
		$model=new MenuInfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MenuInfo']))
		{
			$model->attributes=$_POST['MenuInfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        public function actionAdmin() {
   
        $priv = $this->getPrivelege();
       
        if (!empty($priv)) {
            foreach ($priv as $k => $v) {
                $priv[$k] = array(
                    'chk' => '<input type="checkbox" class="chkPid" value="'.$v['id'].'" name="pid">',
                    'id' => $v['id'],
                    'name' => $v['name'],
                    'pid' => $v['parent_id'],
                    'url' => $v['url'],
                    
                    'operation' => '<button href="javascript:;" priv_id="'.$v['id'].'" class="addChildNode  btn  btn-success  btn-minier tooltip-info" data-rel="tooltip" data-placement="bottom" data-original-title="添加子节点"><i class="ace-icon glyphicon glyphicon-plus"></i>添加子节点</button>'
                    . ' <a href="javascript:;" priv_id="'.$v['id'].'" class="editNode btn btn-info btn-minier tooltip-info" data-rel="tooltip" data-placement="bottom" data-original-title="编辑"><i class="ace-icon glyphicon glyphicon-pencil"></i>编辑</a>'
                    . ' <a href="javascript:;" priv_id="'.$v['id'].'" class="removeNode btn btn-info btn-minier tooltip-info" data-rel="tooltip" data-placement="bottom" data-original-title="删除"><i class="ace-icon fa fa-trash-o"></i>  删除</a>',
                );
            }
        }

        $this->render("index", array('priv' => $priv));
       }

     /**
     * 创建节点
     */
    public function actionAddNode() {
        
           if(Yii::app()->request->isPostRequest){
            $pid = Yii::app()->request->getParam("pid");
            $node = Yii::app()->request->getParam("node");
            $node['parent_id'] = $pid;
            try {
                $model=new MenuInfo;
		if(isset($node))
		{
			$model->attributes=$node;
                        $res = $model->save();
				
		}
                if(intval($res) > 0)
                    Utils::showMsg (1, '权限节点添加成功!');
                else
                    Utils::showMsg (0, '权限节点添加失败!');
            } catch (Exception $ex) {
                Utils::showMsg (0, $ex->getMessage());
            }
            exit;
        }
        
        $pid = Yii::app()->request->getParam('pid', 0);
        $priv = $this->getPrivelege();
        if (!empty($priv)) {
            foreach ($priv as $k => $v) {
                $priv[$k] = array(
                    'id' => $v['id'],
                    'pid' => $v['parent_id'],
                    'name' => $v['name'],
                );
            }
        }
        
        $this->renderPartial("addNode", array('priv' => $priv, 'pid'=>$pid));
    }
    /**
     * 编辑节点
     */
    public function actionEditNode() {
        
        if(Yii::app()->request->isPostRequest){
            $pid = Yii::app()->request->getParam("pid");
            $node = Yii::app()->request->getParam("node");
            $node['parent_id'] = $pid;
            try {
                 $model=$this->loadModel($node['id']);
		if(isset($node))
		{
			$model->attributes=$node;
                        $res = $model->save();	
		}
                if(intval($res) > 0)
                    Utils::showMsg (1, '权限节点编辑成功!');
                else
                    Utils::showMsg (0, '权限节点编辑失败!');
            } catch (Exception $ex) {
                Utils::showMsg (0, $ex->getMessage());
            }
            exit;
        }
        
        $id = Yii::app()->request->getParam("id");
        $pid = Yii::app()->request->getParam('pid', 0);
        $priv = $this->getPrivelege();
        if (!empty($priv)) {
            foreach ($priv as $k => $v) {
                $priv[$k] = array(
                    'id' => $v['id'],
                    'pid' => $v['parent_id'],
                    'name' => $v['name'],
                );
            }
        }
        
        try {
            $privilege =$this->loadModel($id);
            $privilege = $privilege->attributes;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        
        $this->renderPartial("editNode", array('priv' => $priv, 'privilege'=>$privilege));
    }

    /**
     * 删除节点
     * @return type
     */
    public function actionRemove(){
        $id = Yii::app()->request->getParam("id");
        try {
            $parent = MenuInfo::model()->findByAttributes(array('parent_id'=>$id));
            if($parent)
            {
                Utils::showMsg (0,'该节点含有子节点，请先删除子节点!');
            }else{
               $res = $this->loadModel($id)->delete();
               if($res)
                Utils::showMsg (1,'删除节点成功!');
               else
                Utils::showMsg (0,'删除节点失败!');
            }
           
        } catch (Exception $ex) {
            Utils::showMsg (0, $ex->getMessage());
        }
    }
    
    /**
     * 删除全部节点
     */
    public function actionRemoveAll(){
        $pids = Yii::app()->request->getParam("pids");
        if(is_array($pids)){
            foreach ($pids as $v){
                try {
                    $parent = MenuInfo::model()->findByAttributes(array('parent_id'=>$v));
                    if($parent)
                    {
                       $res = 3;
                    }else{
                       $res = $this->loadModel($v)->delete();
                       if($res)
                        $res = 1;
                       else
                        $res = 0;
                    }
                } catch (Exception $ex) {
                    Utils::showMsg (0, $ex->getMessage());
                }
            }
        }
        if($res == 1)
            Utils::showMsg (1,'删除节点成功!');
        elseif($res == 3)
            Utils::showMsg (0,'该节点含有子节点，请先删除子节点!');
        else
            Utils::showMsg (0,'删除节点失败!');
    }
    
    
    private function getPrivelege() {
        
        $dataProvider=new CActiveDataProvider('MenuInfo');
        $dataProvider->pagination->pageSize = 1000;
        $data = $dataProvider->getData();
        if($data)
        {
            foreach ($data as $obj)
            {
                $priv[] = $obj->attributes;
            }
        }
        return $priv;
    }
    
    public function loadModel($id)
	{
		$model=MenuInfo::model()->findByPk($id);
		return $model;
	}
}

