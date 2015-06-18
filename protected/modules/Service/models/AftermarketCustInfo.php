<?php

/**
 * This is the model class for table "{{aftermarket_cust_info}}".
 *
 * The followings are the available columns in table '{{aftermarket_cust_info}}':
 * @property string $id
 * @property integer $cust_id
 * @property integer $cust_type
 * @property string $webchat
 * @property string $ww
 * @property string $eno
 * @property string $assign_eno
 * @property integer $assign_time
 * @property integer $next_time
 * @property integer $memo
 * @property integer $creator
 * @property integer $create_time
 */
class AftermarketCustInfo extends CActiveRecord
{
        public $dept;           //部门
        public $group;          //组别
        public $cust_name;
        public $category_name; 
        public $cust_type_name;
        public $category;
        public $qq;
        public $service_limit;  
        public $createtime_start;
        public $createtime_end;
        public $total_money;  
        public $message;
        public $searchtype;
        public $keyword;
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{aftermarket_cust_info}}';
	} 
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cust_type', 'required'), 
                        array('eno','required','on'=>'assign'),
                        array('eno,dept,group','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cust_id, cust_type, webchat, ww, eno, assign_eno, assign_time, next_time, memo, dept,group,category,searchtype,keyword', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    // 'cust'=>array(self::BELONGS_TO, 'CustomerInfo', 'cust_id'),  
//                    'cust_type'=>array(self::HAS_ONE, 'CustType', 'id'), 
//                    'service_limit'=>array(self::HAS_ONE, 'ContractInfo', 'cust_id'), 
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'dept'=>'部门',
                        'group'=>'组别',
			'cust_id' => '客户',
			'cust_name' => '客户', 
			'cust_type' => '客户分类',
			'webchat' => '微信',
                        'qq' =>'QQ',
			'ww' => '旺旺', 
                        'category' => '类目',
                        'service_limit'=>'服务期限',
			'eno' => '所属工号',
			'assign_eno' => '分配工号',
			'assign_time' => '分配时间',
			'next_time' => '下次联系时间',
			'memo' => '备注',
			'creator' => '创建人',
			'create_time' => '创建时间',
                        'total_money'=>'金额',
                        'cust[cust_name]' => '客户名称',
			'cust[shop_name]' => '店铺名称',
                        'cust[corp_name]' => '公司名称',
                        'cust[shop_url]' => '店铺网址',
                        'cust[shop_addr]' => '店铺地址',
                        'cust[category]' =>'类目',
                        'cust[phone]' => '电话',
                        'cust[qq]' => 'QQ',
                        'cust[mail]' => '邮箱',
                        'cust[datafrom]' => '数据来源',
                        'cust[iskey]' => '是否重点',
                        'begin_end_time'=>'起止时间'
                        
		);
	}

	/** 
	 * 新分客户
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function searchNewList()
	{  
		$criteria=new CDbCriteria;   
                switch($this->searchtype){
                    case 1:$criteria->compare('c.cust_name',$this->keyword,true);  break;
                    case 2:$criteria->compare('c.qq',$this->keyword,true);  break;
                    case 3:$criteria->compare('ww',$this->keyword,true);  break;
                    case 4:$criteria->compare('webchat',$this->keyword,true);  break;
                    default:break;
                }
                if($this->dept>0){
                    $criteria->compare('u.dept_id',$this->dept); 
                }
		if($this->group>0){
                    $criteria->compare('u.group_id',$this->group);
                }  
		$criteria->compare('c.category',$this->category);
                $criteria->select="c.id,c.cust_name,t.cust_type,ct.type_name as cust_type_name,c.category,d.name as category_name,c.qq,t.webchat,t.ww,ci.service_limit,t.eno,t.assign_eno,t.assign_time,t.next_time ";
                 
                $criteria->join=" left join {{customer_info}} c on t.cust_id = c.id ".
                                " left join {{users}} u on t.eno=u.eno ".
                                " left join {{cust_type}} ct on ct.type_no=t.cust_type and ct.lib_type=3 ".
                                " left join {{dic}} d on c.category=d.code and d.ctype='cust_category' ".
                                " left join {{contract_info}} ci on t.cust_id=ci.cust_id ";
                $criteria->addCondition(" t.cust_type=0");
                $criteria->addInCondition("t.status", array(0,3));
                $login_user_eno =Yii::app()->session["user"]['eno'];
                $criteria->addCondition(" t.eno='$login_user_eno'");    
                    
                $sort = new CSort();
                $sort->attributes=array(
                    'defaultOrder'=>'c.id desc',
                    'id'=>array('asc'=>'c.id asc','desc'=>'c.id desc'),
                    'cust_id'=>array('asc'=>'c.cust_name asc','desc'=>'c.cust_name desc'),
                    'cust_type'=>array('asc'=>'ct.type_name asc','desc'=>'ct.type_name desc'),
                    'qq',
                    'webchat',
                    'ww',
                    'category'=>array('asc'=>'d.name asc','desc'=>'d.name desc'),
                    'service_limit'=>array('asc'=>'ci.service_limit asc','desc'=>'ci.service_limit desc'), 
                    'eno'=>array('asc'=>'t.eno asc','desc'=>'t.eno desc'),
                    'assign_eno'=>array('asc'=>'t.assign_eno asc','desc'=>'t.assign_eno desc'),
                    'assign_time'=>array('asc'=>'t.assign_time asc','desc'=>'t.assign_time desc'),
                );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
	}
        /** 
	 * 遗留数据
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function searchOldList()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;   
		$criteria->compare('ct.type_no',$this->cust_type);   
		$criteria->compare('u.dept_id',$this->dept); 
		$criteria->compare('u.group_id',$this->group);
                $criteria->compare('c.category',$this->category);
                switch($this->searchtype){
                    case 1:$criteria->compare('c.cust_name',$this->keyword,true);  break;
                    case 2:$criteria->compare('c.qq',$this->keyword,true);  break;
                    case 3:$criteria->compare('ww',$this->keyword,true);  break;
                    case 4:$criteria->compare('webchat',$this->keyword,true);  break;
                    default:break;
                }
                $criteria->select="c.id,c.cust_name,t.cust_type,ct.type_name as cust_type_name,c.category,d.name as category_name,c.qq,t.webchat,t.ww,ci.service_limit,t.eno,t.assign_eno,t.assign_time,t.next_time ";
                $criteria->join=" left join {{customer_info}} c on t.cust_id = c.id ".
                                " left join {{users}} u on t.eno=u.eno ".
                                " left join {{cust_type}} ct on ct.type_no=t.cust_type and ct.lib_type=3 ".
                                " left join {{dic}} d on c.category=d.code and d.ctype='cust_category' ".
                                " left join {{contract_info}} ci on t.cust_id=ci.cust_id ";
                $curDate = date("Y-m-d",time());
                $iDate = strtotime($curDate);
                $criteria->addCondition("t.next_time<".$iDate);
                $criteria->addInCondition("t.status", array(0,3));
                $sort = new CSort();
                $sort->attributes=array(
                    'defaultOrder'=>'id desc',
                    'id'=>array('asc'=>'c.id asc','desc'=>'c.id desc'),
                    'cust_id'=>array('asc'=>'c.cust_name asc','desc'=>'c.cust_name desc'),
                    'cust_type'=>array('asc'=>'ct.type_name asc','desc'=>'ct.type_name desc'),
                    'qq',
                    'webchat',
                    'ww',
                    'category'=>array('asc'=>'d.name asc','desc'=>'d.name desc'),
                    'service_limit'=>array('asc'=>'ci.service_limit asc','desc'=>'ci.service_limit desc'),
                    'eno'=>array('asc'=>'t.eno asc','desc'=>'t.eno desc'),
                    'assign_eno'=>array('asc'=>'t.assign_eno asc','desc'=>'t.assign_eno desc'),
                    'assign_time'=>array('asc'=>'t.assign_time asc','desc'=>'t.assign_time desc'),
                    'next_time'=>array('asc'=>'t.next_time asc','desc'=>'t.next_time desc'),
                );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
	}
        /** 
	 * 今日联系
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function searchTodayList()
	{ 
		$criteria=new CDbCriteria;   
		$criteria->compare('ct.type_no',$this->cust_type); 
		$criteria->compare('u.dept_id',$this->dept); 
		$criteria->compare('u.group_id',$this->group);
                $criteria->compare('c.category',$this->category);
                switch($this->searchtype){
                    case 1:$criteria->compare('c.cust_name',$this->keyword,true);  break;
                    case 2:$criteria->compare('c.qq',$this->keyword,true);  break;
                    case 3:$criteria->compare('ww',$this->keyword,true);  break;
                    case 4:$criteria->compare('webchat',$this->keyword,true);  break;
                    default:break;
                }
                $criteria->select="c.id,c.cust_name,t.cust_type,ct.type_name as cust_type_name,c.category,d.name as category_name,c.qq,t.webchat,t.ww,ci.service_limit,t.eno,t.assign_eno,t.assign_time,t.next_time ";
                $criteria->join=" left join {{customer_info}} c on t.cust_id = c.id ".
                                " left join {{users}} u on t.eno=u.eno ".
                                " left join {{cust_type}} ct on ct.type_no=t.cust_type and ct.lib_type=3 ".
                                " left join {{dic}} d on c.category=d.code and d.ctype='cust_category' ".
                                " left join {{contract_info}} ci on t.cust_id=ci.cust_id ";
                $curDate = date("Y-m-d",time());
                $iDate = strtotime($curDate);
                $criteria->addCondition(" t.next_time=".$iDate);
                $criteria->addInCondition("t.status", array(0,3));
                $sort = new CSort();
                $sort->attributes=array(
                    'defaultOrder'=>'id desc',
                    'id'=>array('asc'=>'c.id asc','desc'=>'c.id desc'),
                    'cust_id'=>array('asc'=>'c.cust_name asc','desc'=>'c.cust_name desc'),
                    'cust_type'=>array('asc'=>'ct.type_name asc','desc'=>'ct.type_name desc'),
                    'qq',
                    'webchat',
                    'ww',
                    'category'=>array('asc'=>'d.name asc','desc'=>'d.name desc'),
                    'service_limit'=>array('asc'=>'ci.service_limit asc','desc'=>'ci.service_limit desc'),
                    'eno'=>array('asc'=>'t.eno asc','desc'=>'t.eno desc'),
                    'assign_eno'=>array('asc'=>'t.assign_eno asc','desc'=>'t.assign_eno desc'),
                    'assign_time'=>array('asc'=>'t.assign_time asc','desc'=>'t.assign_time desc'),
                    'next_time'=>array('asc'=>'t.next_time asc','desc'=>'t.next_time desc'),
                );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
	}
        public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;  
		$criteria->compare('c.cust_name',$this->cust_name,true); 
		$criteria->compare('t.ww',$this->ww,true);
		$criteria->compare('ci.total_money',$this->total_money);  
                switch($this->searchtype){
                    case 1:$criteria->compare('c.cust_name',$this->keyword,true);  break;
                    case 2:$criteria->compare('ci.total_money',$this->keyword,true);  break;
                    case 3:$criteria->compare('ww',$this->keyword,true);  break;
                    case 4:$criteria->compare('webchat',$this->keyword,true);  break;
                    default:break;
                }
		if($this->createtime_start){
                    $sTime = strtotime($this->createtime_start);
                    $criteria->addCondition(" t.create_time>=$sTime");
                }
                if($this->createtime_end){
                    $eTime = strtotime($this->createtime_end);
                    $criteria->addCondition(" t.create_time<=$eTime");
                } 
                $criteria->select="t.id,t.cust_id,c.cust_name,t.cust_type,ct.type_name as cust_type_name,c.category,d.name as category_name,c.qq,t.webchat,t.ww,ci.service_limit,t.eno,t.assign_eno,t.assign_time,t.next_time ";
                $criteria->join=" left join {{customer_info}} c on t.cust_id = c.id ".
                                " left join {{users}} u on t.eno=u.eno ".
                                " left join {{cust_type}} ct on ct.type_no=t.cust_type and ct.lib_type=3 ".
                                " left join {{dic}} d on c.category=d.code and d.ctype='cust_category' ".
                                " left join {{contract_info}} ci on t.cust_id=ci.cust_id ";
                //$criteria->addCondition("t.eno =''");
                $sort = new CSort();
                $sort->attributes=array(
                    'defaultOrder'=>'id desc',
                    'cust_id'=>array('asc'=>'c.cust_name asc','desc'=>'c.cust_name desc'),
                    'cust_type'=>array('asc'=>'ct.type_name asc','desc'=>'ct.type_name desc'),
                    'qq',
                    'webchat',
                    'ww',
                    'category'=>array('asc'=>'d.name asc','desc'=>'d.name desc'),
                    'service_limit'=>array('asc'=>'ci.service_limit asc','desc'=>'ci.service_limit desc'),
                    'eno'=>array('asc'=>'t.eno asc','desc'=>'t.eno desc'),
                    'assign_eno'=>array('asc'=>'t.assign_eno asc','desc'=>'t.assign_eno desc'),
                    'assign_time'=>array('asc'=>'t.assign_time asc','desc'=>'t.assign_time desc'),
                    'next_time'=>array('asc'=>'t.next_time asc','desc'=>'t.next_time desc'),
                );
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
	}
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AftermarketCustInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
