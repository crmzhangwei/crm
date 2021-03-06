<?php

/**
 * This is the model class for table "{{customer_info}}".
 *
 * The followings are the available columns in table '{{customer_info}}':
 * @property string $id
 * @property string $cust_name
 * @property string $shop_name
 * @property string $corp_name
 * @property string $shop_url
 * @property string $shop_addr
 * @property string $phone
 * @property string $phone2
 * @property string $phone3
 * @property string $phone4
 * @property string $phone5
 * @property string $qq
 * @property string $mail
 * @property string $datafrom
 * @property integer $category
 * @property integer $cust_type
 * @property string $eno
 * @property integer $iskey
 * @property string $assign_eno
 * @property integer $assign_time
 * @property integer $next_time
 * @property integer $last_time
 * @property string $memo
 * @property string $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $creator
 */
class CustomerInfo extends CActiveRecord {

    public $cust_type_from;
    public $cust_type_to;
    public $contact_7_day;
    public $searchtype;
    public $keyword;
    public $begintime;
    public $endtime;
    public $trans_user;
    public $next_time_from;
    public $next_time_to;
    public $search_dept;
    public $search_group;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{customer_info}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cust_name', 'required'),
            array('mail', 'email'),
            array('category, cust_type, iskey, status, creator', 'numerical', 'integerOnly' => true),
            array('cust_name, shop_name, corp_name, shop_url, shop_addr, datafrom, memo', 'length', 'max' => 100),
            array('phone,phone2,phone3,phone4,phone5, qq', 'length', 'max' => 20),
            array('visit_date, assign_time, next_time,last_time, create_time', 'safe'),
            array('mail', 'length', 'max' => 50),
            array('eno, assign_eno', 'length', 'max' => 10),
            array('abandon_reason', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, cust_name, shop_name, corp_name, shop_url, shop_addr, phone, qq, mail, datafrom, category, cust_type, eno, iskey, visit_date, abandon_reason, assign_eno, assign_time, next_time, memo, status, create_time, creator,searchtype,keyword,begintime,endtime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'contract' => array(self::HAS_ONE, 'ContractInfo', 'cust_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => '主键',
            'cust_name' => '客户名称',
            'shop_name' => '店铺名称',
            'corp_name' => '公司名称',
            'shop_url' => '店铺网址',
            'shop_addr' => '店铺地址',
            'phone' => '电话',
            'phone2' => '电话2',
            'phone3' => '电话3',
            'phone4' => '电话4',
            'phone5' => '电话5',
            'qq' => 'QQ',
            'mail' => '邮箱',
            'datafrom' => '数据来源',
            'category' => '所属类目',
            'cust_type' => '客户分类',
            'eno' => '所属工号',
            'iskey' => '是否重点',
            'assign_eno' => '分配人',
            'assign_time' => '分配时间',
            'next_time' => '下次联系时间',
            'last_time'=>'最后联系时间',
            'memo' => '备注',
            'create_time' => '创建时间',
            'update_time' => '保存时间',
            'creator' => '创建人',
            'visit_date' => '到访时间',
            'abandon_reason' => '放弃原因',
            'contact_7_day' => '七天内联系过',
            'trans_user' => '成交师',
            'contract[service_limit]' => '服务期限',
            'contract[total_money]' => '合同总金额',
            'contract[pay_type]' => '支付方式',
            'contract[pay_time]' => '支付时间',
            'contract[promise]' => '合同承诺',
            'contract[first_pay]' => '第一次支付金额',
            'contract[second_pay]' => '第二次支付金额',
            'contract[third_pay]' => '第三次支付金额',
            'contract[fourth_pay]' => '第四次支付金额',
            'contract[comm_royalty]' => '佣金提成',
            'contract[comm_pay_time]' => '佣金支付时间',
            'contract[creator]' => '创建人',
            'contract[create_time]' => '创建时间',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $type = intval(Yii::app()->request->getParam('type'));
        $criteria = new CDbCriteria;  
        $criteria->join="join {{trans_cust_info}} tci ";
        $criteria->addInCondition("tci.cust_type", array(10,11,12,13,14,15,16)); 
        $criteria->addCondition("t.status=0");
        $criteria->select="t.id,tci.eno,t.cust_name,t.shop_name,t.corp_name,t.category,t.update_time,t.last_time,t.iskey,t.shop_addr,tci.cust_type,tci.assign_time,tci.assign_eno,tci.next_time";
        $criteria->addCondition("t.id=tci.cust_id"); 
        //只看到自己的客户,及下属客户
        $user_arr = Userinfo::getAllChildUsersId(Yii::app()->user->id);
        $user_arr[]=Yii::app()->user->id;
        if(!empty($user_arr)&&count($user_arr)>0){
            $wherestr = Utils::genUserCondition($user_arr);
            if(!empty($wherestr)){
               $criteria->addCondition(" exists (select 1 from {{users}} where eno=tci.eno and $wherestr)") ; 
            } 
        }
        if ($this->phone) {
            $criteria->compare('phone', $this->phone, true);
        }
        if($this->search_dept){
            $criteria->addCondition(" exists (select 1 from {{users}} where eno=tci.eno and dept_id=$this->search_dept)") ; 
        }
        if($this->search_group){
            $criteria->addCondition(" exists (select 1 from {{users}} where eno=tci.eno and group_id=$this->search_group)") ; 
        }
        if ($this->eno) {
            $criteria->compare('tci.eno', $this->eno, true);
        }
        if ($this->cust_type_from>0 && $this->cust_type_to>0) {
            $criteria->addBetweenCondition('tci.cust_type', intval($this->cust_type_from), intval($this->cust_type_to));
        }
        if ($this->contact_7_day) {
            $itime = time();
            $itime = $itime - 86400*7;
            $criteria->addCondition("last_time>=$itime");
        }
        if ($this->iskey>-1) {
            $criteria->compare('iskey', $this->iskey);
        }
        if ($this->next_time_from) {
            $starttime = $this->next_time_from." 00:00:00";
            $istartTime = strtotime($starttime); 
            $criteria->addCondition("tci.next_time>=$istartTime"); 
        }
        if($this->next_time_to){ 
            $endtime = $this->next_time_to." 23:59:59";
            $iendTime = strtotime($endtime); 
            $criteria->addCondition("tci.next_time<=$iendTime"); 
        }
        $sort = new CSort();
        $sort->attributes=array(
            'id' => array('asc' => 't.id asc', 'desc' => 't.id desc','default'=>'desc'),
            'eno' => array('asc' => 'tci.eno asc', 'desc' => 'tci.eno desc'),
            'cust_type' => array('asc' => 'tci.cust_type asc', 'desc' => 'tci.cust_type desc'),
            'cust_name' => array('asc' => 't.cust_name asc', 'desc' => 't.cust_name desc'),
            'shop_name' => array('asc' => 't.shop_name asc', 'desc' => 't.shop_name desc'),
            'corp_name' => array('asc' => 't.corp_name asc', 'desc' => 't.corp_name desc'),
            'category' => array('asc' => 't.category asc', 'desc' => 't.category desc'),
            'assign_time' => array('asc' => 'tci.assign_time asc', 'desc' => 'tci.assign_time desc','default'=>'desc'),
            'next_time' => array('asc' => 'tci.next_time asc', 'desc' => 'tci.next_time desc','default'=>'asc'),
            'last_time' => array('asc' => 't.last_time asc', 'desc' => 't.last_time desc','default'=>'desc'),
            'update_time' => array('asc' => 't.update_time asc', 'desc' => 't.update_time desc','default'=>'desc'),
            'shop_addr' => array('asc' => 't.shop_addr asc', 'desc' => 't.shop_addr desc'),
        );
        $sort->defaultOrder=array("next_time"=>CSort::SORT_ASC);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>$sort,
        ));
    }

    /**
     * 查找我的联系机会
     */
    public function searchMyList() {
        $type = intval(Yii::app()->request->getParam('type'));
        $criteria = new CDbCriteria;
        $criteria->join="join {{trans_cust_info}} tci "; 
        $criteria->addInCondition("tci.cust_type", array(10,11,12,13,14,15,16));
        $criteria->addCondition("t.status=0");
        $criteria->select="t.id,tci.eno,t.cust_name,t.shop_name,t.corp_name,t.iskey,t.category,t.last_time,t.update_time,t.shop_addr,tci.cust_type,tci.assign_time,tci.assign_eno,tci.next_time";
        $criteria->addCondition("t.id=tci.cust_id"); 
        //只看到自己的客户,及下属客户
        $user_arr = Userinfo::getAllChildUsersId(Yii::app()->user->id);
        $user_arr[]=Yii::app()->user->id;
        if(!empty($user_arr)&&count($user_arr)>0){
            $wherestr = Utils::genUserCondition($user_arr);
            if(!empty($wherestr)){
               $criteria->addCondition(" exists (select 1 from {{users}} where eno=tci.eno and $wherestr)") ; 
            } 
        }
        if ($this->phone) {
            $phones = explode(",", $this->phone);
            $ic=count($phones);
            if($ic>1){
                $condi = "";
                for($i=0;$i<$ic;$i++){
                    if($i==0){
                        $condi=" ( phone like '%".$phones[$i]."%'";
                    }else if($i==($ic-1)){
                        $condi=$condi."  or phone like '%".$phones[$i]."%')";
                    }else{
                        $condi=$condi." or phone like '%".$phones[$i]."%'";
                    } 
                }
            
                $criteria->addCondition($condi); 
            }else{
                $criteria->compare('phone', $this->phone, true);
            } 
        }
        if ($this->cust_name) {
            $names = explode(",", $this->cust_name);
            $ic=count($names);
            if($ic>1){
                $condi = "";
                for($i=0;$i<$ic;$i++){
                    if($i==0){
                        $condi=" ( cust_name like '%".$names[$i]."%'";
                    }else if($i==($ic-1)){
                        $condi=$condi."  or cust_name like '%".$names[$i]."%')";
                    }else{
                        $condi=$condi." or cust_name like '%".$names[$i]."%'";
                    } 
                }
            
                $criteria->addCondition($condi); 
            }else{
                $criteria->compare('cust_name', $this->cust_name, true);
            } 
        }
        if($this->assign_eno){
            $criteria->addCondition(" exists (select 1 from {{users}} where eno=tci.assign_eno and name like '%".$this->assign_eno."%')") ; 
        }
        if ($this->qq) {
            $criteria->compare('qq', $this->qq, true);
        }
        if($this->search_dept){
            $criteria->addCondition(" exists (select 1 from {{users}} where eno=tci.eno and dept_id=$this->search_dept)") ; 
        }
        if($this->search_group){
            $criteria->addCondition(" exists (select 1 from {{users}} where eno=tci.eno and group_id=$this->search_group)") ; 
        }
        if ($this->eno) {
            $criteria->compare('tci.eno', $this->eno, true);
        }
        if ($this->cust_type_from>0 && $this->cust_type_to>0) {
            $criteria->addBetweenCondition('tci.cust_type', intval($this->cust_type_from), intval($this->cust_type_to));
        }
        if ($this->contact_7_day) {
            $itime = time();
            $itime = $itime - 86400*7;
            $criteria->addCondition("last_time>=$itime");
        } 
        if ($this->iskey>-1) {
            $criteria->compare('iskey', $this->iskey);
        }
        $sort = new CSort();
        $sort->attributes=array(
            'id' => array('asc' => 't.id asc', 'desc' => 't.id desc','default'=>'desc'),
            'eno' => array('asc' => 'tci.eno asc', 'desc' => 'tci.eno desc'),
            'cust_type' => array('asc' => 'tci.cust_type asc', 'desc' => 'tci.cust_type desc'),
            'cust_name' => array('asc' => 't.cust_name asc', 'desc' => 't.cust_name desc'),
            'shop_name' => array('asc' => 't.shop_name asc', 'desc' => 't.shop_name desc'),
            'corp_name' => array('asc' => 't.corp_name asc', 'desc' => 't.corp_name desc'),
            'category' => array('asc' => 't.category asc', 'desc' => 't.category desc'),
            'assign_time' => array('asc' => 'tci.assign_time asc', 'desc' => 'tci.assign_time desc','default'=>'desc'),
            'next_time' => array('asc' => 'tci.next_time asc', 'desc' => 'tci.next_time desc','default'=>'asc'),
            'last_time' => array('asc' => 't.last_time asc', 'desc' => 't.last_time desc','default'=>'desc'),
            'update_time' => array('asc' => 't.update_time asc', 'desc' => 't.update_time desc','default'=>'desc'),
            'shop_addr' => array('asc' => 't.shop_addr asc', 'desc' => 't.shop_addr desc'),
        );
        $sort->defaultOrder=array("next_time"=>CSort::SORT_ASC);    
        // $criteria->addCondition("eno = '".Yii::app()->user->identity->eno."'");
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>$sort,
        ));
    }

    /**
     * 查找我的未联系机会
     */
    public function searchOldList() {
        $type = intval(Yii::app()->request->getParam('type'));
        $criteria = new CDbCriteria;
        $criteria->join="join {{trans_cust_info}} tci ";
        $criteria->addInCondition("tci.cust_type", array(10,11,12,13,14,15,16));
        $criteria->addCondition("t.status=0");
        $criteria->select="t.id,tci.eno,t.cust_name,t.shop_name,t.corp_name,t.last_time,t.update_time,t.iskey,t.category,t.shop_addr,tci.cust_type,tci.assign_time,tci.assign_eno,tci.next_time";
        $criteria->addCondition("t.id=tci.cust_id"); 
        //只看到自己的客户,及下属客户
        $user_arr = Userinfo::getAllChildUsersId(Yii::app()->user->id);
        $user_arr[]=Yii::app()->user->id;
        if(!empty($user_arr)&&count($user_arr)>0){
            $wherestr = Utils::genUserCondition($user_arr);
            if(!empty($wherestr)){
               $criteria->addCondition(" exists (select 1 from {{users}} where eno=tci.eno and $wherestr)") ; 
            } 
        }
        if ($this->phone) {
            $criteria->compare('phone', $this->phone, true);
        }
        if ($this->cust_type_from>0 && $this->cust_type_to>0) {
            $criteria->addBetweenCondition('tci.cust_type', intval($this->cust_type_from), intval($this->cust_type_to));
        }
        if ($this->contact_7_day) {
            $itime = time();
            $itime = $itime - 86400*7;
            $criteria->addCondition("last_time>=$itime");
        }
        if($this->search_dept){
            $criteria->addCondition(" exists (select 1 from {{users}} where eno=tci.eno and dept_id=$this->search_dept)") ; 
        }
        if($this->search_group){
            $criteria->addCondition(" exists (select 1 from {{users}} where eno=tci.eno and group_id=$this->search_group)") ; 
        }
        if ($this->eno) {
            $criteria->compare('tci.eno', $this->eno, true);
        }
        if ($this->iskey>-1) {
            $criteria->compare('iskey', $this->iskey);
        } 
        $curDate = date("Y-m-d", time());
        $iDate = strtotime($curDate);
        $iDate = $iDate+86400;
        $criteria->addCondition("tci.next_time<" . $iDate);
        // $criteria->addCondition("eno = '".Yii::app()->user->identity->eno."'");
        $sort = new CSort();
        $sort->attributes=array(
            'id' => array('asc' => 't.id asc', 'desc' => 't.id desc','default'=>'desc'),
            'eno' => array('asc' => 'tci.eno asc', 'desc' => 'tci.eno desc'),
            'cust_type' => array('asc' => 'tci.cust_type asc', 'desc' => 'tci.cust_type desc'),
            'cust_name' => array('asc' => 't.cust_name asc', 'desc' => 't.cust_name desc'),
            'shop_name' => array('asc' => 't.shop_name asc', 'desc' => 't.shop_name desc'),
            'corp_name' => array('asc' => 't.corp_name asc', 'desc' => 't.corp_name desc'),
            'category' => array('asc' => 't.category asc', 'desc' => 't.category desc'),
            'assign_time' => array('asc' => 'tci.assign_time asc', 'desc' => 'tci.assign_time desc','default'=>'desc'),
            'next_time' => array('asc' => 'tci.next_time asc', 'desc' => 'tci.next_time desc','default'=>'asc'),
            'last_time' => array('asc' => 't.last_time asc', 'desc' => 't.last_time desc','default'=>'desc'),
            'update_time' => array('asc' => 't.update_time asc', 'desc' => 't.update_time desc','default'=>'desc'),
            'shop_addr' => array('asc' => 't.shop_addr asc', 'desc' => 't.shop_addr desc'),
        );
        $sort->defaultOrder=array("next_time"=>CSort::SORT_ASC);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>$sort,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CustomerInfo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function searchForPoplist() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        switch ($this->searchtype) {
            case 1:$criteria->compare('cust_name', $this->keyword, true);
                break;
            case 2:$criteria->compare('qq', $this->keyword, true);
                break;
            case 3:$criteria->compare('phone', $this->keyword, true);
                break;
            default:break;
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function toTimestamp() {
        if ($this->next_time && !is_numeric($this->next_time)) {
            $this->next_time = strtotime($this->next_time);
        }
        if ($this->visit_date && !is_numeric($this->visit_date)) {
            $this->visit_date = strtotime($this->visit_date);
        }
    }

    public function toDate() {
        if ($this->next_time > 0) {
            $this->next_time = date('Y-m-d H:i:s', $this->next_time);
        }
        if ($this->visit_date > 0) {
            $this->visit_date = date('Y-m-d H:i:s', $this->visit_date);
        }
    }

}
