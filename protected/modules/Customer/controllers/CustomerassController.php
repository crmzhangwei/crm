<?php

class CustomerassController extends GController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAssign()
	{
		$model=new CustomerAss;
		$deptArr = Userinfo::getDept();
		$deptArr = array('0'=>'--请选择部门--') + $deptArr;
		$category = Userinfo::getCategory();//类目
		$ids = Yii::app()->request->getParam('ids');
		$flag = Yii::app()->request->getParam('flag');//判断是不是从公海资源领取那来的
		$model->ids = $ids;
		if(isset($_POST['CustomerAss']))
		{
			$model->attributes=$_POST['CustomerAss'];
			$eno = $model->eno;
			$enoNum = Yii::app()->db->createCommand("select cust_num from {{users}} where eno=:eno")->queryAll(TRUE,array(":eno"=>$eno));
			$enoNum = $enoNum ? (int)$enoNum[0]['cust_num'] : 0;//该用户已分配的资源数
			$assCount = explode(',', $model->ids);
			$assCount = count($assCount);//待分配的资源个数
			$idArr = explode(',', $model->ids);
			if( ($assCount + $enoNum) > 300 ){//每个用户的分配资源数不能超过300个
				exit("<script>alert(\"对不起, 该用户当前已分配了".$enoNum."个资源, 每个用户最多只能分配300个资源, 本次操作失败。\");javascript:history.go(-1);</script>");
			}
			else{
				if(empty($eno))
				{
					exit("<script>alert(\"对不起, 您没有选择被分配人, 本次操作失败。\");javascript:history.go(-1);</script>");
				}
				$allocation = Yii::app()->db->createCommand("select id from {{customer_info}} where eno='$eno' and `status`=0")->queryAll();//已分配的
				if($allocation){
					$alArr = array();
					foreach ($allocation as $k1=>$v1){
						$alArr[] = $v1['id'];
					}
					$diffArr = array_diff($idArr, $alArr);
					if($diffArr){
						$model->ids = implode(',', $diffArr);
						$assCount = count($diffArr);//待分配的资源个数
					}
					else{
						$model->ids = 0;
						$assCount = 0;//待分配的资源个数
					}
				}
				$assign_eno = Yii::app()->session['user']['eno'];
				$assign_time = time();
				$addSet = '';
				if($flag){//如果是从公海领取,status置为1
					$addSet = ",`status`=0,cust_type=-9 ";
					$del_black = "delete from {{black_info}} where cust_id in ({$model->ids})";
					/*********从公海领取时向c_note_info_p表中添加一条记录*********/
					/*$custinfo = Customerinfo::model()->findAll("id in($model->ids)");
					$custArr = array();
					foreach ($custinfo as $k10 => $v10) {
						$custArr[$v10['id']] = $v10;
					}*/
					$creator = Yii::app()->user->id;
					$noteinfo_sql = "insert into {{note_info_p}} (note_type,cust_id,userid,create_time) value ";
					foreach ($idArr as $cust_id) {
						/*$mobile = $custArr[$cust_id['phone']];
						$qq = $custArr[$cust_id['qq']];
						$cust_name = $custArr[$cust_id['cust_name']];
						$memo = $mobile ? "$cust_name.'：电话'.$mobile" : "$cust_name.'：电话'.$qq";*/
						$noteinfo_sql .= "(4,$cust_id,$creator,$assign_time),";
					}
					$noteinfo_sql = trim($noteinfo_sql, ',');
				}
				$sql = "update {{customer_info}} set eno='$eno',assign_time=$assign_time,assign_eno='$assign_eno' $addSet where id in({$model->ids})";
				$sql2 = "update {{users}} set cust_num=cust_num+$assCount where eno='{$model->eno}'";

				/////////////分配资源的时候原所属工号减1/////////
				if($model->ids && !$flag){
					$reduce = explode(',', $model->ids);
					$reduceArr = array();
					foreach ($reduce as $k2=>$v2){
						$result = Customerass::model()->findByPk($v2);
						$beEno = $result->getAttribute('eno');
						if($result){
							$reduceArr[] = "update {{users}} set cust_num=cust_num-1 where eno='$beEno'";
						}
					}
				}
				///////////////////////////////////////////////////
				///////////分配资源成功的同时向临时表中写入数据用于弹窗提醒用户///////////
				if($model->ids){
					$sArr = explode(',', $model->ids);
					$sql3 = "insert into {{tip_info}} value ";
					$sqlstr = '';
					foreach ($sArr as $k5 => $v5){
						$sqlstr .= '('."$v5".','."'$eno'".')'.',';
					}
					$sqlstr = trim($sqlstr, ',');
					$sql5 = $sql3.$sqlstr;	
				}

				////////////////////////////////////////////////////////////////////
				$transaction = Yii::app()->db->beginTransaction();
				try {
					$res = Yii::app()->db->createCommand($sql)->execute();
					$res2 = Yii::app()->db->createCommand($sql2)->execute();
					if(isset($del_black)){
						$res3 = Yii::app()->db->createCommand($del_black)->execute();
					}
					if(isset($reduceArr)){
						foreach ($reduceArr as $k3=>$v3){
							Yii::app()->db->createCommand($v3)->execute();
						}
					}
					Yii::app()->db->createCommand($sql5)->execute();/////新分资源弹窗提示用户
					Yii::app()->db->createCommand($noteinfo_sql)->execute();/////公海资源领取时向note_info_p表中插入一条记录
					$transaction->commit();
					
					exit("<script>alert(\"恭喜你, 成功分配了".$assCount."个资源。\");javascript:history.go(-1);</script>");	
				} catch (Exception $exc) {
					$transaction->rollBack();//事务回滚
					exit("<script>alert(\"对不起, 由于未知的错误, 本次操作失败, 请重新操作。\");javascript:history.go(-1);</script>");
				}
			}
		}
		$this->renderPartial('assign_form',array(
			'model'=>$model,
			'deptArr'=>$deptArr,
			'category'=>$category,
		));
	}

	public function actionGetGroup(){
		$deptid = yii::app()->request->getparam('deptid');
		$deptinfo = Userinfo::getGroupById($deptid);
		echo json_encode($deptinfo);
	}

	public function actiongetUsers()
	{
		$gid = Yii::app()->request->getparam('gid');
                $deptid = Yii::app()->request->getparam('deptid');
		$userinfo = Userinfo::getUserbygid($gid, $deptid);
		echo json_encode($userinfo);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CustomerAss');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$aPageSize = isset($_SESSION['uPageSize']) ? $_SESSION['uPageSize'] : 10;
		$model=new CustomerAss('search');
		$model->unsetAttributes();  // clear any default values
		$custtype = Userinfo::genCustTypeArray();
		
		if(isset($_GET['CustomerAss']))
			$model->attributes=$_GET['CustomerAss'];
		
		//部门组别人员三级联动
		$uInfo = Userinfo::secondlevel();
		
		$out = Yii::app()->request->getParam('out');
		if($out){
			$category_arr = Userinfo::getCategory();
			$dataProvider = $model->search(); 
			$dataProvider->pagination->pageVar = 'page';
			$dataProvider->pagination->pageSize = $aPageSize;
			$data = $dataProvider->getData();
			/**********************/
			$objPHPExcel = new PHPExcel();
			$name = '资源分配';
			$objPHPExcel->setActiveSheetIndex(0)
						//Excel的第A列，uid是你查出数组的键值，下面以此类推
						->setCellValue('A1', '客户名称')    
						->setCellValue('B1', '公司名称')
						->setCellValue('C1', '店铺名称')
						->setCellValue('D1', '店铺地址')
						->setCellValue('E1', '电话')
						->setCellValue('F1', 'QQ')
						->setCellValue('G1', '所属类目')
						->setCellValue('H1', '邮箱')
						->setCellValue('I1', '客户分类')
						->setCellValue('J1', '分配给')
						->setCellValue('K1', '分配人')
						->setCellValue('L1', '分配时间');
							
			$num=2;
			foreach($data as $k => $v){
				$objPHPExcel->setActiveSheetIndex(0)
							 //Excel的第A列，uid是你查出数组的键值，下面以此类推 
							  ->setCellValue('A'.$num, $v['cust_name'])    
							  ->setCellValue('B'.$num, $v['corp_name'])
							  ->setCellValue('C'.$num, $v['shop_name'])
							  ->setCellValue('D'.$num, $v['shop_addr'])
							  ->setCellValue('E'.$num, $v['phone'])
							  ->setCellValue('F'.$num, $v['qq'])
							  ->setCellValue('G'.$num, $category_arr[$v['category']])
							  ->setCellValue('H'.$num, $v['mail'])
							  ->setCellValue('I'.$num, $v['cust_type'].'类')
							  ->setCellValue('J'.$num, Userinfo::getNameByEno($v['eno']))
							  ->setCellValue('K'.$num, Userinfo::getNameByEno($v['assign_eno']))
							  ->setCellValue('L'.$num, date('Y-m-d H:i:s',$v['assign_time']));
				$num++;
			}

			$objPHPExcel->getActiveSheet()->setTitle('User');
			$objPHPExcel->setActiveSheetIndex(0);
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$name.'.xls"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;	
		}
		else{
			$this->render('admin',array(
				'model'=>$model,	
				'custtype'=>$custtype,
				'deptArr'=>$uInfo['deptArr'],
				'groupArr'=>$uInfo['groupArr'],
				'infoArr'=>$uInfo['infoArr'],
				'user_info'=>$uInfo['user_info'],
				'aPageSize' => $aPageSize,
			));
		}
	}
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CustomerAss the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CustomerAss::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CustomerAss $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customerass-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * 	将时间戳格式化成日期格式
	 */ 	
	public function formatDate($data){
		return $data->assign_eno ? date("Y-m-d H:i:s",$data->assign_time) : '未分配';
	}
	/**
	 * 	根据工号查用户名 
	 */
	public function get_assign_text($data){
		$val = $data->assign_eno;
		$assignArr = $this->getAssignArr($val);
		$res = isset($assignArr[$val]) ? $assignArr[$val] : $val;
		return $res;
	}
	
	public function get_eno_text($data){
		$val = $data->eno;
		$assignArr = $this->getAssignArr($val);
		$res = isset($assignArr[$val]) ? $assignArr[$val] : $val;
		return $res;
	}
	
	public function getAssignArr($assign){
		return Chtml::listData(Users::model()->findAll('eno=:eno', array(':eno'=>$assign)), 'eno', 'name');
	}
	
	public function get_category_text($data){
		$val = $data->category;
		$categoryArr = $this->getCategory();
		$res = isset($categoryArr[$val]) ? $categoryArr[$val] : $val;
		return $res;
	}
	
	public function getCategory(){
		return Userinfo::getCategory();
	}
}
