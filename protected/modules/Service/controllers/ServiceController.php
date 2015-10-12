<?php

class ServiceController extends GController {

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
            Yii::app()->db->createCommand()->update('{{aftermarket_cust_info}}', array('next_time' => $next_time), "cust_id in({$ids})");
            $model = new CustomerInfo();
            $model->addError("next_time", "操作成功!");
            $this->render("result", array(
                'model' => $model,
            ));
            return;
        }
        if (!isset($_POST['select'])) {
            //没有选择记录的情况
            $this->redirect($this->createUrl("service/admin"));
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
        $this->render('assign_nexttime', array('model' => $model, 'custlist' => $list));
    }

    /**
     * 售后客户分配-多选情况
     * @param type $id 客户id
     */
    public function actionAssignMulti() {

        if (isset($_POST['cust_id'])) {
            /**
             * 在分配页面点击保存按钮
             * 1.更新所属工号
             * 2.所属工号的已分配资源数+1
             */
            $cust_ids = $_POST['cust_id'];
            if (!empty($cust_ids)) {
                $model = new AftermarketCustInfo();
                $model->attributes = $_POST['AftermarketCustInfo'];
                $user_id = $model->eno;
                $user = Users::model()->findByPk($user_id);
                $enoNum = $user ? $user->cust_num : 0; //该用户已分配的资源数  
                $ids = implode(",", $cust_ids);
                $assCount = count($cust_ids); //待分配的资源个数
                if (($assCount + $enoNum) > 300) {//每个用户的分配资源数不能超过300个  
                    $model->addError("eno", "对不起, 您当前已分配了" . $enoNum . "个资源, 每个用户最多只能分配300个资源, 本次操作失败。");
                    $this->render("result", array(
                        'model' => $model,
                    ));
                } else {
                    $cust_list = AftermarketCustInfo::model()->findAll("cust_id in({$ids})");
                    if ($cust_list) {
                        foreach ($cust_list as $tmp) {
                            if ($tmp->eno) {
                                Yii::app()->db->createCommand()->update('{{Users}}', array('cust_num' => new CDbExpression("ABS(cust_num-1)")), "eno='$tmp->eno'");
                            }
                        }
                    }
                    $assign_eno = Yii::app()->session["user"]['eno'];
                    Yii::app()->db->createCommand()->update('{{aftermarket_cust_info}}', array('eno' => $user->eno, 'assign_eno' => $assign_eno, 'assign_time' => time()), "cust_id in({$ids})");
                    Yii::app()->db->createCommand()->update('{{Users}}', array('cust_num' => new CDbExpression("cust_num+$assCount")), "id=$user_id");

                    $model->addError("eno", "成功分配了" . $assCount . "个资源。");
                    $this->render("result", array(
                        'model' => $model,
                    ));
                }
            }
            return;
        }
        if (!isset($_POST['select'])) {
            //没有选择记录的情况
            $model = new AftermarketCustInfo('search');
            $model->unsetAttributes();  // clear any default values 
            $this->render('admin', array(
                'model' => $model,
            ));
            return;
        }
        //选择了记录，跳转到分配页面
        $ids = $_POST['select'];
        $model = AftermarketCustInfo::model();
        $sql = "";
        if (is_array($ids)) {
            $sql = "select id,cust_name from {{customer_info}} where id in (" . implode(",", $ids) . ")";
        } else {
            $sql = "select id,cust_name from {{customer_info}} where id=" . $ids;
        }
        $list = $model->findAllBySql($sql);
        $this->render('assign', array('model' => $model, 'custlist' => $list));
    }

    /**
     * 查询分配
     */
    public function actionAdmin() {
        $model = new AftermarketCustInfo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AftermarketCustInfo'])) {
            $model->attributes = $_GET['AftermarketCustInfo'];
            $model->createtime_start = $_GET['AftermarketCustInfo']['createtime_start'];
            $model->createtime_end = $_GET['AftermarketCustInfo']['createtime_end'];
            $model->searchtype = $_GET['AftermarketCustInfo']['searchtype'];
            $model->keyword = $_GET['AftermarketCustInfo']['keyword'];
        }
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

    /**
     * 获取类目数组
     * @return type
     */
    public function getCategoryArr() {
        $sql = "select code,name from {{dic}} where ctype='cust_category'";
        $category = Dic::model()->findAllBySql($sql);
        $empty = array('code' => '0', 'name' => '请选择类目');
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
    public function actionDial($cust_id, $seq) {
        $result = UnCall::dial($cust_id, $seq);
        echo json_encode($result);
    }

    public function actionDialUid($dial_id) {
        $result = array('uid' => '');
        $dialdetail = DialDetail::model()->findByPk($dial_id);
        $uid = UnCall::getUid2($dialdetail);
        $result['uid'] = $uid;
        echo json_encode($result);
    }

    /**
     * 发短信
     * @param type $cust_id
     */
    public function actionMessage($cust_id, $seq) {
        $model = new AftermarketCustInfo();
        $model->cust_id = $cust_id;
        if (isset($_POST['AftermarketCustInfo'])) {
            $model->attributes = $_POST['AftermarketCustInfo'];
            $model->message = $_POST['AftermarketCustInfo']['message'];
            $message = Utils::sendMessageByCust($model->cust_id, $seq, $model->message, 'post');
            //Utils::showMsg(1, $message->memo, $message->attributes);
            $out = array('code' => 1, 'msg' => $message->memo, 'id' => $message->id);
            echo json_encode($out);
            exit();
        }
        $temparr = NoteTemplate::model()->findAll();
        if (!empty($temparr)) {
            $model->message = $temparr[0]->content;
        }
        $titles = CHtml::listData($temparr, 'id', 'tname');
        $this->renderPartial('message', array(
            'model' => $model,
            'seq' => $seq,
            'titles' => $titles,
            'contents' => $temparr
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

    /**
     * 播放
     * @param type $dial_id
     */
    public function actionPlay($id) {
        $noteinfo = NoteInfo::model()->findByPk($id);
        if ($noteinfo->dial_id > 0) {
            $dialdetail = DialDetail::model()->findByPk($noteinfo->dial_id);
            $this->renderPartial("playmp3", array('model' => $dialdetail));
        } else {
            $noteinfo->addError("memo", "该小记不存在电话联系信息");
            $this->renderPartial("error", array('model' => $noteinfo));
        }
    }

    /**
     * 下载
     * @param type $dial_id 
     */
    public function actionDownload($dial_id) {
        $dialdetail = DialDetail::model()->findByPk($dial_id);
        if (!empty($dialdetail->record_path)) {
            $file = "";
            if (strpos($dialdetail->record_path, '192.168.1.200')) {
                $file = $dialdetail->record_path;
            } else {
                $file = Yii::app()->request->hostInfo . $dialdetail->record_path;
            }
            header("Content-Type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            header("Content-Disposition: attachment; filename=" . basename($file));
            readfile($file);
        }
    }

    /**
     * 播放下载
     * @param type $id
     */
    public function actionPlay2($id) {
        $noteinfo = NoteInfo::model()->findByPk($id);
        $playurl = '';
        if ($noteinfo->dial_id > 0) {
            $dialdetail = DialDetail::model()->findByPk($noteinfo->dial_id);
            if (!empty($dialdetail->record_path)) {
                $uncall = Yii::app()->params['UNCALL'];
                $playurl = $uncall["playurl"] . $dialdetail->record_path;
            }
        }
        $this->renderPartial("play2", array('playurl' => $playurl));
    }

    /**
     * 播放下载
     * @param type $id
     */
    public function actionPlay3($id) {
        $playurl = '';
        if ($id > 0) {
            $dialdetail = DialDetail::model()->findByPk($id);
            if (!empty($dialdetail->record_path)) {
                $uncall = Yii::app()->params['UNCALL'];
                $playurl = $uncall["playurl"] . $dialdetail->record_path;
            }
        }
        $this->renderPartial("play2", array('playurl' => $playurl));
    }

    /**
     * 播放下载
     * @param type $id
     */
    public function actionPlay4($id) {
        $playurl = '';
        if ($id > 0) {
            $result = Yii::app()->db->createCommand("select record_path from {{dial_detail_p}} where uid=:uid")->queryRow(TRUE, array(":uid" => $id));
            if ($result && is_array($result)) {
                $uncall = Yii::app()->params['UNCALL'];
                $playurl = $uncall["playurl"] . $result['record_path'];
            } 
        }
        $this->renderPartial("play2", array('playurl' => $playurl));
    }

    /**
     * 查看小记
     * @param type $dial_id 
     */
    public function actionViewNote($id) {
        $noteinfo = NoteInfoP::model()->findBySql("select id,cust_id,isvalid,iskey,next_contact,dial_id,message_id,userid,lib_type,create_time,cust_type,memo from {{note_info_p}} where id=:id",array(":id"=>$id));
        $this->renderPartial("noteinfo", array('model' => $noteinfo));
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

    public function get_after_type_text($data) {
        $val = $data->cust_type;
        $lib_type = 3;
        $typeArr = $this->gettypeArr($val, $lib_type);
        $res = isset($typeArr[$val]) ? "【" . $val . "类】" . $typeArr[$val] : $val;
        return $res;
    }

    public function gettypeArr($type_no, $lib_type) {
        return CHtml::listData(CustType::model()->findAll('lib_type=:lib_type and type_no=:type_no', array(':type_no' => $type_no, 'lib_type' => $lib_type)), 'type_no', 'type_name');
    }

    /**
     * 合并客户
     */
    public function actionMerge() {
        if (isset($_POST['CustomerInfo'])) {
            //合并
            $cust_ids = $_POST['cust_id'];
            $model = $this->loadModel($_POST['CustomerInfo']['id']);
            $model->attributes = $_POST['CustomerInfo'];
            $id = $model->id;
            $transaction = Yii::app()->db->beginTransaction();
            $loginuser = Users::model()->findByPk(Yii::app()->user->id);
            foreach ($cust_ids as $cust_id) {
                if ($cust_id != $model->id) {
                    //删除客户
                    $sql = "delete from {{customer_info}} where id=$cust_id";
                    Yii::app()->db->createCommand($sql)->execute();
                    //删除成交师库
                    $sql = "delete from {{trans_cust_info}} where cust_id=$cust_id";
                    Yii::app()->db->createCommand($sql)->execute();
                    //删除售后库
                    $sql = "delete from {{aftermarket_cust_info}} where cust_id=$cust_id";
                    Yii::app()->db->createCommand($sql)->execute();
                    //删除合同信息表
                    $sql = "delete from {{contract_info}} where cust_id=$cust_id";
                    Yii::app()->db->createCommand($sql)->execute();
                    //删除转换明细
                    $sql = "delete from {{cust_convt_detail}} where cust_id=$cust_id";
                    Yii::app()->db->createCommand($sql)->execute();
                    //合并小记
                    $sql = "update {{note_info}} set cust_id=$id where cust_id=$cust_id";
                    Yii::app()->db->createCommand($sql)->execute();
                    //合并电放拔打记录
                    $sql = "update {{dial_detail}} set cust_id=$id where cust_id=$cust_id";
                    Yii::app()->db->createCommand($sql)->execute();
                    //合并短信记录
                    $sql = "update {{message}} set cust_id=$id where cust_id=$cust_id";
                    Yii::app()->db->createCommand($sql)->execute();
                    //合并财务记录
                    $sql = "update {{finance}} set cust_id=$id where cust_id=$cust_id";
                    Yii::app()->db->createCommand($sql)->execute();
                }
            }
            $model->eno = $loginuser->eno;
            $model->create_time = time();
            $model->next_time = strtotime($model->next_time);
            $model->last_time = strtotime($model->last_time);
            $model->creator = Yii::app()->user->id;
            $model->save();
            Yii::app()->db->createCommand()->update('{{aftermarket_cust_info}}', array('eno' => $loginuser->eno,
                'assign_eno' => $loginuser->eno,
                'assign_time' => time(),
                'next_time' => $model->next_time,
                'creator' => $loginuser->id,
                'create_time' => time()
                    ), "cust_id =$id");
            if ($model->hasErrors()) {
                $transaction->rollback();
                $this->render("error", array("model" => $model));
                return;
            } else {
                $transaction->commit();
                $this->render("result", array("model" => $model));
                return;
            }
        }
        if (!isset($_POST['select'])) {
            //没有选择记录的情况
            $this->redirect($this->createUrl("customerinfo/admin"));
            return;
        }
        //跳转到合并页面
        $ids = $_POST['select'];
        $model = CustomerInfo::model();
        $sql = "";
        if (is_array($ids)) {
            $sql = "select c.id,c.cust_name,c.shop_name,c.corp_name,c.shop_url,c.shop_addr,c.phone,c.phone2,c.phone3,c.phone4,c.phone5,"
                    . "    c.qq,c.mail,c.datafrom,c.category,t.cust_type,c.eno,c.iskey,c.visit_date,c.abandon_reason,c.assign_eno,c.assign_time,"
                    . "    c.next_time,c.last_time,c.memo,c.status,c.create_time,c.creator,t.webchat,t.ww "
                    . " from {{customer_info}} c,{{aftermarket_cust_info}} t where c.id=t.cust_id and c.id in (" . implode(",", $ids) . ")";
        } else {
            $this->redirect($this->createUrl("customerinfo/admin"));
            return;
        }
        $list = $model->findAllBySql($sql);
        $cust_name = CHtml::listData($list, "id", "cust_name");
        $shop_name = CHtml::listData($list, "shop_name", "shop_name");
        $corp_name = CHtml::listData($list, "corp_name", "corp_name");
        $shop_url = CHtml::listData($list, "shop_url", "shop_url");
        $shop_addr = CHtml::listData($list, "shop_addr", "shop_addr");
        $phone = CHtml::listData($list, "phone", "phone");
        $phone2 = CHtml::listData($list, "phone2", "phone2");
        $phone3 = CHtml::listData($list, "phone3", "phone3");
        $phone4 = CHtml::listData($list, "phone4", "phone4");
        $phone5 = CHtml::listData($list, "phone5", "phone5");
        $qq = CHtml::listData($list, "qq", "qq");
        $mail = CHtml::listData($list, "mail", "mail");
        $datafrom = CHtml::listData($list, "datafrom", "datafrom");
        $category = CHtml::listData($list, "category", "category");
        $cust_type = CHtml::listData($list, "cust_type", "cust_type");
        $abandon_reason = CHtml::listData($list, "abandon_reason", "abandon_reason");
        $memo = CHtml::listData($list, "memo", "memo");

        $this->render('merge', array('model' => $model,
            'cust_name' => $cust_name,
            'shop_name' => $shop_name,
            'corp_name' => $corp_name,
            'shop_url' => $shop_url,
            'shop_addr' => $shop_addr,
            'phone' => $phone,
            'phone2' => $phone2,
            'phone3' => $phone3,
            'phone4' => $phone4,
            'phone5' => $phone5,
            'qq' => $qq,
            'mail' => $mail,
            'datafrom' => $datafrom,
            'category' => $category,
            'cust_type' => $cust_type,
            'abandon_reason' => $abandon_reason,
            'memo' => $memo,
            'custlist' => $list)
        );
    }

}
