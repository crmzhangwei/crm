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
     *  
     *  
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate2($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $noteinfo = new NoteInfoP();
        $nextcontact = '';
        if (isset($_POST['CustomerInfo'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $model->attributes = $_POST['CustomerInfo'];
            $model->toTimestamp();
            $newCustType = $_POST['CustomerInfo']['cust_type'];
            if (Utils::isNeedSaveNoteInfo($_POST['NoteInfoP'], $newCustType)) {
                $noteinfo->attributes = $_POST['NoteInfoP'];
                $nextcontact = $noteinfo->next_contact;
                if ($model->iskey != $noteinfo->iskey) {
                    $model->iskey = $noteinfo->iskey;
                }
                //$noteinfo->last_time=$model->last_time;//仅用于比较
                $noteinfo->next_contact = strtotime($noteinfo->next_contact);
                $model->next_time = $noteinfo->next_contact;
                $noteinfo->cust_type = $model->cust_type;
                $noteinfo->lib_type = "1";
                $model->last_time = time(); //最后联系时间等于今天
                $noteinfo->setAttribute("userid", Yii::app()->user->id);
                $noteinfo->setAttribute("create_time", time());
                Yii::app()->db->createCommand("update {{seq_note_id}} set seq=seq+1 where 1=1")->execute();
                $seqnoteid = SeqNoteId::model()->findBySql("select seq from {{seq_note_id}} where 1=1 limit 1");
                $noteinfo->id = $seqnoteid->seq;
                $noteinfo->memo = Utils::parseText($noteinfo->memo);
                $noteinfo->save();
                //更新电话拔打记录
                /*
                  if ($noteinfo->dial_id > 0) {
                  $dialdetail = DialDetail::model()->findByPk($noteinfo->dial_id);
                  //获取通知录音路径，通知时长
                  $uid = $dialdetail->uid;
                  if ($uid == null || empty(trim($uid))) {
                  $uid = UnCall::getUid2($dialdetail);
                  $dialdetail->uid = $uid;
                  //$noteinfo->addError("dial_id", "请获取通话时长!");
                  }
                  $dial_long = UnCall::getDialLength($uid);
                  $record_path = UnCall::getRecord($uid);
                  $dialdetail->isok = 1;
                  $dialdetail->dial_long = $dial_long;
                  $dialdetail->record_path = $record_path;
                  $dialdetail->save();
                  } */
            }
            //$model->update_time=time();
            $model->save();
            if ($noteinfo->hasErrors() || $model->hasErrors()) {
                $transaction->rollback();
            } else {
                $transaction->commit();
                Yii::app()->user->setFlash('success', "保存成功!");
                $this->redirect($this->createUrl("edit", array('id' => $id)));
                return;
            }
            if (!empty($nextcontact)) {
                $noteinfo->setAttribute("next_contact", $nextcontact);
            }
            $model->setAttribute("create_time", date("Y-m-d H:i:s", intval($model->getAttribute("create_time"))));
            $model->setAttribute("assign_time", date("Y-m-d H:i:s", intval($model->getAttribute("assign_time"))));
            if (intval($model->next_time) < 100) {
                $model->setAttribute("next_time", '无');
            } else {
                $model->setAttribute("next_time", date("Y-m-d H:i:s", intval($model->getAttribute("next_time"))));
            }
            if (intval($model->last_time) < 100) {
                $model->setAttribute("last_time", '无');
            } else {
                $model->setAttribute("last_time", date("Y-m-d H:i:s", intval($model->getAttribute("last_time"))));
            }
            if ($model->visit_date == 0) {
                $model->setAttribute("visit_date", date("Y-m-d H:i:s", time()));
            } else {
                $model->setAttribute("visit_date", date("Y-m-d H:i:s", intval($model->getAttribute("visit_date"))));
            }
            $sharedNote = NoteInfoP::model();
            $sharedNote->setAttribute("cust_id", $model->id);
            $historyNote = NoteInfoP::model();
            $historyNote->setAttribute("cust_id", $model->id);
            $user = Users::model()->findByPk($model->creator);
            $this->render("view", array(
                'model' => $model,
                'sharedNote' => $sharedNote,
                'historyNote' => $historyNote,
                'noteinfo' => $noteinfo,
                'user' => $user,));
        }
    }

    private function validCustomerInfo($model) {
        $custtype = $model->cust_type;
        $ret = true;
        if ($custtype == 6) {
            //到店
            if ($model->visit_date == '') {
                $model->addError("visit_date", "客户分类为6类，到访时间不能为空!");
                $ret = false;
            }
            if ($model->trans_user == '') {
                $model->addError("trans_user", "客户分类为6类，成交师不能为空!");
                $ret = false;
            }
        }

        if ($custtype == 9) {
            //放入公海
            if ($model->abandon_reason == '') {
                $model->addError("abandon_reason", "客户分类为9类，放弃原因不能为空!");
                $ret = false;
            }
        }
        return $ret;
    }

    public function actionEdit($id) {
        $noteinfo = new NoteInfoP();
        $noteinfo->setAttribute("isvalid", 1);
        $noteinfo->setAttribute("dial_id", 0);
        $noteinfo->setAttribute("uid", '');
        $noteinfo->setAttribute("message_id", 0);
        $noteinfo->setAttribute("next_contact", '');
        $noteinfo->cust_id = $id;
        $model = $this->loadModel($id);
        if ($model->cust_type == 9) {
            //公海资源
            Yii::app()->user->setFlash('success', '不能打开公海资源!');
            $this->render("result");
            return;
        }
        $noteinfo->setAttribute("iskey", $model->iskey);
        $oldcusttype = $model->cust_type;
        $loginuser = Users::model()->findByPk(Yii::app()->user->id);
        $model->setAttribute("create_time", date("Y-m-d H:i:s", intval($model->getAttribute("create_time"))));
        $model->setAttribute("assign_time", date("Y-m-d H:i:s", intval($model->getAttribute("assign_time"))));
        if (intval($model->next_time) < 100) {
            $model->setAttribute("next_time", '无');
        } else {
            $model->setAttribute("next_time", date("Y-m-d H:i:s", intval($model->getAttribute("next_time"))));
        }
        if (intval($model->last_time) < 100) {
            $model->setAttribute("last_time", '无');
        } else {
            $model->setAttribute("last_time", date("Y-m-d H:i:s", intval($model->getAttribute("last_time"))));
        }
        if ($model->visit_date == 0) {
            $model->setAttribute("visit_date", date("Y-m-d H:i:s", time()));
        } else {
            $model->setAttribute("visit_date", date("Y-m-d H:i:s", intval($model->getAttribute("visit_date"))));
        }
        $sharedNote = NoteInfoP::model();
        $sharedNote->setAttribute("cust_id", $model->id);
        $historyNote = NoteInfoP::model();
        $historyNote->setAttribute("cust_id", $model->id);
        $user = Users::model()->findByPk($model->creator);
        if ($oldcusttype == "6") {
            if (empty($model->trans_user)) {
                $sql = "select * from {{trans_cust_info}} where cust_id=:cust_id";
                $transmodel = TransCustInfo::model()->findBySql($sql, array(':cust_id' => $id));
                if (!empty($transmodel)) {
                    $model->trans_user = Userinfo::getNameByEno($transmodel->eno);
                }
            }
            //电销查看6类，进入只读页面
            $this->render('view', array(
                'model' => $model,
                'sharedNote' => $sharedNote,
                'historyNote' => $historyNote,
                'noteinfo' => $noteinfo,
                'user' => $user,
            ));
        } else {
            $this->render('update', array(
                'model' => $model,
                'sharedNote' => $sharedNote,
                'historyNote' => $historyNote,
                'noteinfo' => $noteinfo,
                'user' => $user,
            ));
        }
    }

    public function actionUpdate($id) {
        $noteinfo = new NoteInfoP();
        $noteinfo->setAttribute("isvalid", 1);
        $noteinfo->setAttribute("dial_id", 0);
        $noteinfo->setAttribute("uid", '');
        $noteinfo->setAttribute("message_id", 0);
        $noteinfo->setAttribute("next_contact", '');
        $noteinfo->cust_id = $id;
        $model = $this->loadModel($id);
        $noteinfo->setAttribute("iskey", $model->iskey);
        $oldcusttype = $model->cust_type;
        $loginuser = Users::model()->findByPk(Yii::app()->user->id);
        $nextcontact = '';
        if (isset($_POST['CustomerInfo'])) {
            $nextcontact = $_POST['NoteInfoP']['next_contact'];
            //保存  
            // $sql = "select * from {{aftermarket_cust_info}} where cust_id=:cust_id";
            //$aftermodel = AftermarketCustInfo::model()->findBySql($sql, array(':cust_id' => $id));  
            $newCustType = $_POST['CustomerInfo']['cust_type'];
            $oldCustType = $model->getAttribute("cust_type");
            $model->attributes = $_POST['CustomerInfo'];
            $model->trans_user = $_POST['CustomerInfo']['trans_user'];
            $noteinfo->attributes = $_POST['NoteInfoP'];
            $transaction = Yii::app()->db->beginTransaction();
            if ($this->validCustomerInfo($model)) {
                if ($oldCustType != $newCustType) {
                    //客户分类调整，生成转换明细数据
                    $model->update_time = time();
                    $convt = new CustConvtDetail();
                    $convt->setAttribute('lib_type', 1);
                    $convt->setAttribute('cust_id', $id);
                    $convt->setAttribute('cust_type_1', $oldCustType);
                    $convt->setAttribute('cust_type_2', $newCustType);
                    $convt->setAttribute('convt_time', time());
                    $convt->setAttribute('user_id', Yii::app()->user->id);
                    $convt->save();
                }
                if ($oldCustType != $newCustType && $newCustType == 6) {
                    //到店 生成成交师库
                    $temp = TransCustInfo::model()->findBySql("select * from {{trans_cust_info}} where cust_id=$id");
                    if (empty($temp)) {
                        $tran = new TransCustInfo();
                        $tranuser = Users::model()->findByPk($model->trans_user);
                        $tran->eno = $tranuser->eno;
                        $tran->cust_id = $id;
                        $tran->cust_type = 10;
                        $tran->assign_eno = $loginuser->eno;
                        $tran->assign_time = time();
                        $tran->creator = $loginuser->id;
                        $tran->create_time = time();
                        if (isset($_POST['NoteInfoP']) && !empty($noteinfo->next_contact)) {
                            $tran->next_time = strtotime($noteinfo->next_contact);
                        }
                        $tran->save();
                    } else {
                        Yii::app()->db->createCommand()->update('{{trans_cust_info}}', array('eno' => $loginuser->eno,
                            'assign_eno' => $loginuser->eno,
                            'assign_time' => time(),
                            'next_time' => (isset($_POST['NoteInfoP']) && !empty($noteinfo->next_contact)) ? strtotime($noteinfo->next_contact) : 0,
                            'creator' => $loginuser->id,
                            'create_time' => time()
                                ), "cust_id =$id");
                    }


                    //业务员已分配资源数减1
                    $sql = "update {{users}} set cust_num=cust_num-1 where id={$loginuser->id}";
                    Yii::app()->db->createCommand($sql)->execute();
                    //成交师已分配资源数加1
                    $sql = "update {{users}} set cust_num=cust_num+1 where eno='{$tran->eno}'";
                    Yii::app()->db->createCommand($sql)->execute();
                }

                if ($newCustType == 9) {
                    //客户分类转成9（公海），生成公海资源数据
                    $temp = BlackInfo::model()->findBySql("select * from {{black_info}} where cust_id=$id");
                    if (empty($temp)) {
                        $blackinfo = new BlackInfo();
                        $blackinfo->setAttribute("cust_id", $id);
                        $blackinfo->setAttribute('lib_type', 1);
                        $blackinfo->setAttribute('old_cust_type', $oldCustType);
                        $blackinfo->setAttribute('create_time', time());
                        $blackinfo->setAttribute('creator', Yii::app()->user->id);
                        $blackinfo->save();
                    } else {
                        Yii::app()->db->createCommand()->update('{{black_info}}', array('lib_type' => 1,
                            'old_cust_type' => $oldCustType,
                            'create_time' => time(),
                            'creator' => Yii::app()->user->id
                                ), "cust_id=$id");
                    }
                    $noteinfo1 = new NoteInfoP(); 
                    $noteinfo1->setAttribute("cust_id", $id);
                    $noteinfo1->setAttribute("note_type", NoteInfoP::$NOTE_TYPE_PUT_PUBLIC); 
                    Utils::addNoteInfo($noteinfo1);
                    $model->status = "1"; //将客户状态改为1(无效）
                    //成交师已分配资源数减1
                    $sql = "update {{users}} set cust_num=cust_num-1 where eno='{$model->eno}'";
                    Yii::app()->db->createCommand($sql)->execute();
                }
                if (Utils::isNeedSaveNoteInfo($_POST['NoteInfoP'], $newCustType)) {
                    //保存小记  
                    if ($model->iskey != $noteinfo->iskey) {
                        $model->iskey = $noteinfo->iskey;
                    }
                    //$noteinfo->last_time=$model->last_time;//仅用于比较
                    $noteinfo->next_contact = strtotime($noteinfo->next_contact);
                    $noteinfo->memo = Utils::parseText($noteinfo->memo);
                    $noteinfo->cust_type = $newCustType;
                    $noteinfo->lib_type = "1";
                    $noteinfo->setAttribute("userid", Yii::app()->user->id);
                    $noteinfo->setAttribute("create_time", time());
                    Yii::app()->db->createCommand("update {{seq_note_id}} set seq=seq+1 where 1=1")->execute();
                    $seqnoteid = SeqNoteId::model()->findBySql("select seq from {{seq_note_id}} where 1=1 limit 1");
                    $noteinfo->id = $seqnoteid->seq;
                    if ($noteinfo->save()) {
                        //保存销售库
                        $model->next_time = $noteinfo->next_contact;
                    } else {
                        $noteinfo->addError("memo", "请录入小记信息");
                    }
                    $model->last_time = time(); //最后联系时间等于今天
                }
                if ($newCustType == 6) {
                    $model->visit_date = strtotime($model->visit_date);
                } else {
                    $model->visit_date = 0;
                }
                $model->save();
                //更新电话拔打记录
                /*
                  if ($noteinfo->dial_id > 0) {
                  $dialdetail = DialDetail::model()->findByPk($noteinfo->dial_id);
                  //获取通知录音路径，通知时长
                  $uid = $dialdetail->uid;
                  if ($uid == null || empty(trim($uid))) {
                  $uid = UnCall::getUid2($dialdetail);
                  if (!empty($uid)) {
                  $dialdetail->uid = $uid;
                  } else {
                  //$noteinfo->addError("dial_id", "请获取通话时长!");
                  }
                  }
                  if (!$noteinfo->hasErrors()) {
                  $dial_long = UnCall::getDialLength($uid);
                  $record_path = UnCall::getRecord($uid);
                  $dialdetail->isok = 1;
                  $dialdetail->dial_long = $dial_long;
                  $dialdetail->record_path = $record_path;
                  $dialdetail->save();
                  }
                  } */
            }
            //加载页面数据
            if (!$noteinfo->hasErrors() && !$model->hasErrors()) {
                //提交事务
                $transaction->commit();
                //保存成功
                if ($newCustType == 9) {
                    //公海保存成功，跳转到成功页面 
                    Yii::app()->user->setFlash('success', "成功放入公海!");
                    $this->redirect($this->createUrl("result"));
                } else {
                    Yii::app()->user->setFlash('success', "保存成功!");
                    $this->redirect($this->createUrl("edit", array("id" => $model->id)));
                }
            } else {
                //回滚事务
                $transaction->rollback();
                if (!empty($nextcontact)) {
                    $noteinfo->setAttribute("next_contact", $nextcontact);
                }
            }
        }
        $model->setAttribute("create_time", date("Y-m-d H:i:s", intval($model->getAttribute("create_time"))));
        $model->setAttribute("assign_time", date("Y-m-d H:i:s", intval($model->getAttribute("assign_time"))));
        if (intval($model->next_time) < 100) {
            $model->setAttribute("next_time", '无');
        } else {
            $model->setAttribute("next_time", date("Y-m-d H:i:s", intval($model->getAttribute("next_time"))));
        }
        if (intval($model->last_time) < 100) {
            $model->setAttribute("last_time", '无');
        } else {
            $model->setAttribute("last_time", date("Y-m-d H:i:s", intval($model->getAttribute("last_time"))));
        }
        if ($model->visit_date == 0) {
            $model->setAttribute("visit_date", date("Y-m-d H:i:s", time()));
        } else {
            $model->setAttribute("visit_date", date("Y-m-d H:i:s", intval($model->getAttribute("visit_date"))));
        }
        $sharedNote = NoteInfoP::model();
        $sharedNote->setAttribute("cust_id", $model->id);
        $historyNote = NoteInfoP::model();
        $historyNote->setAttribute("cust_id", $model->id);
        $user = Users::model()->findByPk($model->creator);
        if ($oldcusttype == "6") {
            if (empty($model->trans_user)) {
                $sql = "select * from {{trans_cust_info}} where cust_id=:cust_id";
                $transmodel = TransCustInfo::model()->findBySql($sql, array(':cust_id' => $id));
                if (!empty($transmodel)) {
                    $model->trans_user = Userinfo::getNameByEno($transmodel->eno);
                }
            }
            //电销查看6类，进入只读页面
            $this->render('view', array(
                'model' => $model,
                'sharedNote' => $sharedNote,
                'historyNote' => $historyNote,
                'noteinfo' => $noteinfo,
                'user' => $user,
            ));
        } else {
            $this->render('update', array(
                'model' => $model,
                'sharedNote' => $sharedNote,
                'historyNote' => $historyNote,
                'noteinfo' => $noteinfo,
                'user' => $user,
            ));
        }
    }

    public function actionResult() {
        $this->render("result");
    }

    public function actionNoteInfo($id) {
        $model = $this->loadModel($id);
        $noteinfo = new NoteInfo();
        $user = Users::model()->findByPk($model->creator);
        if (isset($_POST['NoteInfoP'])) {
            //保存小记
            $noteinfo->unsetAttributes();
            $noteinfo->attributes = $_POST['NoteInfoP'];
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
        $noteinfo->next_contact = date('Y-m-d H:i:s', time());
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
        $model = new NoteInfoP('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['NoteInfoP']))
            $model->attributes = $_GET['NoteInfoP'];
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
        $model = new NoteInfoP('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['NoteInfoP']))
            $model->attributes = $_GET['NoteInfoP'];

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
        $userid = Yii::app()->user->id;
        if (isset($_GET['CustomerInfo'])) {
            $model->attributes = $_GET['CustomerInfo'];
            $model->cust_type_from = $_GET['CustomerInfo']['cust_type_from'];
            $model->cust_type_to = $_GET['CustomerInfo']['cust_type_to'];
            $model->contact_7_day = $_GET['CustomerInfo']['contact_7_day'];
            $model->next_time_from = $_GET['CustomerInfo']['next_time_from'];
            $model->next_time_to = $_GET['CustomerInfo']['next_time_to'];
            $model->search_dept = $_GET['search']['dept'];
            $model->search_group = $_GET['search']['group'];
            if (isset($_SESSION['_chance_search_condi_' . $userid])) {
                unset($_SESSION['_chance_search_condi_' . $userid]);
            }
            $_SESSION['_chance_search_condi_' . $userid] = $model;
        } else {
            if (isset($_SESSION['_chance_search_condi_' . $userid])) {
                $model = $_SESSION['_chance_search_condi_' . $userid];
            }
        }

        //部门组别人员三级联动
        $info = array();
        if (isset($_SESSION['_chance_search_condi_level_' . $userid])) {
            $info = $_SESSION['_chance_search_condi_level_' . $userid];
        }
        $uInfo = Userinfo::secondlevel($info);
        $info = $uInfo['infoArr'];
        if (!empty($info['dept']) || !empty($info['group']) || !empty($info['users'])) {
            unset($_SESSION['_chance_search_condi_level_' . $userid]);
            $_SESSION['_chance_search_condi_level_' . $userid] = $info;
        }
        $this->render('admin', array(
            'model' => $model,
            'deptArr' => $uInfo['deptArr'],
            'groupArr' => $uInfo['groupArr'],
            'infoArr' => $uInfo['infoArr'],
            'user_info' => $uInfo['user_info'],
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
        $userid = Yii::app()->user->id;
        if (isset($_GET['CustomerInfo'])) {
            $model->attributes = $_GET['CustomerInfo'];
            $model->cust_type_from = $_GET['CustomerInfo']['cust_type_from'];
            $model->cust_type_to = $_GET['CustomerInfo']['cust_type_to'];
            $model->contact_7_day = $_GET['CustomerInfo']['contact_7_day'];
            $model->search_dept = $_GET['search']['dept'];
            $model->search_group = $_GET['search']['group'];
            if (isset($_SESSION['_chance_search_mylist_condi_' . $userid])) {
                unset($_SESSION['_chance_search_mylist_condi_' . $userid]);
            }
            $_SESSION['_chance_search_mylist_condi_' . $userid] = $model;
        } else {
            if (isset($_SESSION['_chance_search_mylist_condi_' . $userid])) {
                $model = $_SESSION['_chance_search_mylist_condi_' . $userid];
            }
        }
        //部门组别人员三级联动
        $info = array();
        if (isset($_SESSION['_chance_search_mylist_condi_level_' . $userid])) {
            $info = $_SESSION['_chance_search_mylist_condi_level_' . $userid];
        }
        $uInfo = Userinfo::secondlevel($info);
        $info = $uInfo['infoArr'];
        if (!empty($info['dept']) || !empty($info['group']) || !empty($info['users'])) {
            unset($_SESSION['_chance_search_mylist_condi_level_' . $userid]);
            $_SESSION['_chance_search_mylist_condi_level_' . $userid] = $info;
        }
        $this->render('mylist', array(
            'model' => $model,
            'deptArr' => $uInfo['deptArr'],
            'groupArr' => $uInfo['groupArr'],
            'infoArr' => $uInfo['infoArr'],
            'user_info' => $uInfo['user_info'],
        ));
    }

    /**
     * 未联系机会
     */
    public function actionOldList() {

        $model = new CustomerInfo('search');
        $model->unsetAttributes();  // clear any default values
        $userid = Yii::app()->user->id;
        if (isset($_GET['CustomerInfo'])) {
            $model->attributes = $_GET['CustomerInfo'];
            $model->cust_type_from = $_GET['CustomerInfo']['cust_type_from'];
            $model->cust_type_to = $_GET['CustomerInfo']['cust_type_to'];
            $model->contact_7_day = $_GET['CustomerInfo']['contact_7_day'];
            $model->search_dept = $_GET['search']['dept'];
            $model->search_group = $_GET['search']['group'];
            if (isset($_SESSION['_chance_search_oldlist_condi_' . $userid])) {
                unset($_SESSION['_chance_search_oldlist_condi_' . $userid]);
            }
            $_SESSION['_chance_search_oldlist_condi_' . $userid] = $model;
        } else {
            if (isset($_SESSION['_chance_search_oldlist_condi_' . $userid])) {
                $model = $_SESSION['_chance_search_oldlist_condi_' . $userid];
            }
        }
        //部门组别人员三级联动
        $info = array();
        if (isset($_SESSION['_chance_search_oldlist_condi_level_' . $userid])) {
            $info = $_SESSION['_chance_search_oldlist_condi_level_' . $userid];
        }
        $uInfo = Userinfo::secondlevel($info);
        $info = $uInfo['infoArr'];
        if (!empty($info['dept']) || !empty($info['group']) || !empty($info['users'])) {
            unset($_SESSION['_chance_search_oldlist_condi_level_' . $userid]);
            $_SESSION['_chance_search_oldlist_condi_level_' . $userid] = $info;
        }
        $this->render('oldlist', array(
            'model' => $model,
            'deptArr' => $uInfo['deptArr'],
            'groupArr' => $uInfo['groupArr'],
            'infoArr' => $uInfo['infoArr'],
            'user_info' => $uInfo['user_info'],
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
        ksort($custTypeArr);
        $addKey[''] = '--请选择--';
        $cust_array = $addKey + $custTypeArr;
        return $cust_array;
    }

    protected function getTranUsers() {
        $loginid = Yii::app()->user->id;
        $user = Users::model()->findByPk($loginid);
        $sql = "select u.id,u.name from {{users}} u "
                . "left join {{user_role}} ur on u.id=ur.user_id "
                . "left join {{role_info}} ri on ur.role_id=ri.id "
                . "where u.dept_id=:dept_id and ri.name='成交师'";
        $users = Users::model()->findAllBySql($sql, array(':dept_id' => $user->dept_id));
        $empty = new Users();
        $empty->id = '';
        $empty->name = "请选择成交师";
        $users = array_merge(array($empty), $users);
        return CHtml::listData($users, 'id', 'name');
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

    /**
     * 合并客户
     */
    public function actionMerge() {
        if (isset($_POST['CustomerInfo'])) {
            //合并
            $cust_ids = $_POST['cust_id'];
            $model = $this->loadModel($_POST['CustomerInfo']['id']);
            $model->attributes = $_POST['CustomerInfo'];
            $model->trans_user = $_POST['CustomerInfo']['trans_user'];
            $id = $model->id;
            $transaction = Yii::app()->db->beginTransaction();
            $tran = new TransCustInfo();
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
            if ($model->cust_type == "6") {
                //生成成交师记录  
                $temp = TransCustInfo::model()->findBySql("select * from {{trans_cust_info}} where cust_id=$id");
                if (empty($temp)) {
                    $tranuser = Users::model()->findByPk($model->trans_user);
                    $tran->eno = $tranuser->eno;
                    $tran->cust_id = $id;
                    $tran->cust_type = 10;
                    $tran->assign_eno = $loginuser->eno;
                    $tran->assign_time = time();
                    $tran->creator = $loginuser->id;
                    $tran->create_time = time();
                    $tran->next_time = time();
                    $tran->save();
                }
                $model->visit_date = strtotime($model->visit_date);
            }
            $model->eno = $loginuser->eno;
            $model->create_time = time();
            $model->next_time = strtotime($model->next_time);
            $model->last_time = strtotime($model->last_time);
            $model->creator = Yii::app()->user->id;
            $model->save();
            //Yii::app()->db->createCommand()->update('{{customer_info}}', array('eno' => $loginuser->eno, 'assign_eno' => $loginuser->eno, 'assign_time' => time()), "id =$id");
            if ($tran->hasErrors() || $model->hasErrors()) {
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
            $this->redirect($this->createUrl("customerInfo/todaylist"));
            return;
        }
        //跳转到合并页面
        $ids = $_POST['select'];
        $model = CustomerInfo::model();
        $sql = "";
        if (is_array($ids)) {
            $sql = "select * from {{customer_info}} where id in (" . implode(",", $ids) . ")";
        } else {
            $this->redirect($this->createUrl("customerInfo/todaylist"));
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

    public function get_user_text($data) {
        $val = $data->eno;
        $enoArr = $this->getUserArr($val);
        $res = isset($enoArr[$val]) ? $enoArr[$val] : $val;
        return $res;
    }

    public function getUserArr($id) {
        return CHtml::listData(Users::model()->findAll('id=:id', array(':id' => $id)), 'id', 'name');
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

    public function get_sale_type_text($data) {
        $val = $data->cust_type;
        $lib_type = 1;
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

    public function get_assign_time($data) {
        return $data->assign_time ? date("Y-m-d H:i:s", $data->assign_time) : '';
    }

    public function get_next_time($data) {
        return $data->next_time ? date("Y-m-d H:i:s", $data->next_time) : '';
    }

    public function get_last_time($data) {
        return $data->last_time ? date("Y-m-d H:i:s", $data->last_time) : '';
    }

    public function actionClearcondi() {
        $userid = Yii::app()->user->id;
        unset($_SESSION['_chance_search_condi_' . $userid]);
        unset($_SESSION['_chance_search_condi_level_' . $userid]);
        return $this->redirect($this->createAbsoluteUrl("admin"));
    }

    public function actionClearcondiForMyList() {
        $userid = Yii::app()->user->id;
        unset($_SESSION['_chance_search_mylist_condi_' . $userid]);
        unset($_SESSION['_chance_search_mylist_condi_level_' . $userid]);
        return $this->redirect($this->createAbsoluteUrl("todayList"));
    }

    public function actionClearcondiForOldList() {
        $userid = Yii::app()->user->id;
        unset($_SESSION['_chance_search_oldlist_condi_' . $userid]);
        unset($_SESSION['_chance_search_oldlist_condi_level_' . $userid]);
        return $this->redirect($this->createAbsoluteUrl("oldList"));
    }

    public function genNoteRecordInfo($data) {
        return Utils::genNoteDisplayRecord($data);
    }

    /**
     * 批量放入公海
     */
    public function actionBatchBlack() {
        if (!isset($_POST['select'])) {
            //没有选择记录的情况
            Yii::app()->user->setFlash('success', '请选择客户!');
            $this->redirect($this->createUrl("customerInfo/todaylist"));
            return;
        } else {
            $ids = $_POST['select'];
            foreach ($ids as $k => $v) {
                $model = CustomerInfo::model()->findByPk($v);
                $temp = BlackInfo::model()->findBySql("select * from {{black_info}} where cust_id=$v");
                if (empty($temp)) {
                    $blackinfo = new BlackInfo();
                    $blackinfo->setAttribute("cust_id", $v);
                    $blackinfo->setAttribute('lib_type', 1);
                    $blackinfo->setAttribute('old_cust_type', $model->cust_type);
                    $blackinfo->setAttribute('create_time', time());
                    $blackinfo->setAttribute('creator', Yii::app()->user->id);
                    $blackinfo->save();
                } else {
                    Yii::app()->db->createCommand()->update('{{black_info}}', array('lib_type' => 1,
                        'old_cust_type' => $model->cust_type,
                        'create_time' => time(),
                        'creator' => Yii::app()->user->id
                            ), "cust_id=$v");
                }
                $model->status = 1;
                $model->cust_type = 9;
                $model->update_time = time();
                $model->save();
                //已分配资源数减1
                $sql = "update {{users}} set cust_num=cust_num-1 where eno='{$model->eno}'";
                Yii::app()->db->createCommand($sql)->execute();
                //删除成交师库和售后库
                $sql = "delete from {{trans_cust_info}} where cust_id=$v";
                Yii::app()->db->createCommand($sql)->execute();
                $sql = "delete from {{aftermarket_cust_info}} where cust_id=$v";
                Yii::app()->db->createCommand($sql)->execute();
                $sql = "delete from {{contract_info}} where cust_id=$v";
                Yii::app()->db->createCommand($sql)->execute();
                $noteinfo = new NoteInfoP(); 
                $noteinfo->setAttribute("cust_id", $v);
                $noteinfo->setAttribute("note_type", NoteInfoP::$NOTE_TYPE_PUT_PUBLIC);
                $noteinfo->setAttribute("memo", $model->cust_name);
                Utils::addNoteInfo($noteinfo);
            }
            Yii::app()->user->setFlash('success', '成功放入公海!');
            $this->redirect($this->createUrl("customerInfo/todaylist"));
        }
    }

}
