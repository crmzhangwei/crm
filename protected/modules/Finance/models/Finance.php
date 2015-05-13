<?php

/**
 * This is the model class for table "{{finance}}".
 *
 * The followings are the available columns in table '{{finance}}':
 * @property string $id
 * @property integer $cust_id
 * @property integer $sale_user
 * @property integer $trans_user
 * @property integer $acct_number
 * @property double $acct_amount
 * @property integer $acct_time
 * @property integer $creator
 * @property integer $create_time
 */
class Finance extends CActiveRecord
{ 
       
        public $cust_name;  
        public $sale_user_name;
        public $trans_user_name;
        public $dept;
        public $group;
        public $acct_time_start;
        public $acct_time_end;
        public $shopname;
        public $phone;
        public $keyword;
        public $searchtype;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{finance}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cust_id, sale_user, trans_user, acct_number, acct_amount, acct_time, creator, create_time', 'required'),
			array('cust_id, sale_user, trans_user, acct_number, acct_time, creator,', 'numerical', 'integerOnly'=>true),
			array('acct_amount', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sale_user, trans_user, acct_number, acct_amount, acct_time_start,acct_time_end, keyword, searchtype', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cust_id' => '客户',
			'sale_user' => '销售人员',
			'trans_user' => '谈单师',
			'acct_number' => '到账单数',
			'acct_amount' => '到账金额',
			'acct_time' => '到账时间',
			'creator' => '创建人',
			'create_time' => '创建时间', 
			'cust_name' => '客户名称',
			'sale_user_name' => '销售人员',
			'trans_user_name' => '谈单师',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched. 
		$criteria=new CDbCriteria;  
               
		if($this->acct_time_start){
                    $sTime = strtotime($this->acct_time_start);
                    $criteria->addCondition(" f.acct_time>=$sTime");
                }
                if($this->acct_time_end){
                    $eTime = strtotime($this->acct_time_end);
                    $criteria->addCondition(" f.acct_time<=$eTime");
                } 
                if($this->dept){
                    $criteria->addCondition(" u1.dept_id=".$this->dept);
                }
                if($this->group){
                    $criteria->addCondition(" u1.group_id=".$this->group);
                }
                if($this->sale_user){
                    $criteria->addCondition(" f.sale_user=".$this->sale_user);
                }
                switch($this->searchtype){
                    case 1:$criteria->compare('cust.cust_name',$this->keyword,true);  break;
                    case 2:$criteria->compare('cust.shop_name',$this->keyword,true);  break;
                    case 3:$criteria->compare('cust.phone',$this->keyword,true);  break;
                    default:break;
                }
                    
                $criteria->select="f.id,f.cust_id,f.sale_user,f.trans_user,f.acct_number,f.acct_amount,f.acct_time,f.creator,f.create_time,cust.cust_name,u1.username as sale_user_name,u2.username as trans_user_name";
                $criteria->alias="f";
                $criteria->join=" left join c_customer_info cust on f.cust_id=cust.id left join c_users u1 on f.sale_user=u1.id left join c_users u2 on f.trans_user=u2.id";
 		$dataProvider = new CActiveDataProvider($this, array(
			'criteria'=>$criteria, 
		)); 
                
                return $dataProvider;
                
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Finance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
