<?php

/**
 * This is the model class for table "{{contract_info}}".
 *
 * The followings are the available columns in table '{{contract_info}}':
 * @property string $id
 * @property integer $cust_id
 * @property string $service_limit
 * @property integer $total_money
 * @property integer $pay_type
 * @property integer $pay_time
 * @property string $promise
 * @property string $first_pay
 * @property string $second_pay
 * @property string $third_pay
 * @property integer $fourth_pay
 * @property integer $comm_royalty
 * @property integer $comm_pay_time
 * @property integer $creator
 * @property integer $create_time
 */
class ContractInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{contract_info}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cust_id, service_limit, total_money, pay_type, pay_time, promise, first_pay, second_pay, third_pay, fourth_pay, comm_royalty, comm_pay_time, creator, create_time', 'required'),
			array('cust_id, total_money, pay_type, pay_time, fourth_pay, comm_royalty, comm_pay_time, creator, create_time', 'numerical', 'integerOnly'=>true),
			array('service_limit, first_pay, second_pay, third_pay', 'length', 'max'=>10),
			array('promise', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cust_id, service_limit, total_money, pay_type, pay_time, promise, first_pay, second_pay, third_pay, fourth_pay, comm_royalty, comm_pay_time, creator, create_time', 'safe', 'on'=>'search'),
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
			'cust_id' => 'Cust',
			'service_limit' => 'Service Limit',
			'total_money' => 'Total Money',
			'pay_type' => '֧',
			'pay_time' => '֧',
			'promise' => 'Promise',
			'first_pay' => 'First Pay',
			'second_pay' => 'Second Pay',
			'third_pay' => 'Third Pay',
			'fourth_pay' => 'Fourth Pay',
			'comm_royalty' => 'Ӷ',
			'comm_pay_time' => 'Ӷ',
			'creator' => 'Creator',
			'create_time' => 'Create Time',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('cust_id',$this->cust_id);
		$criteria->compare('service_limit',$this->service_limit,true);
		$criteria->compare('total_money',$this->total_money);
		$criteria->compare('pay_type',$this->pay_type);
		$criteria->compare('pay_time',$this->pay_time);
		$criteria->compare('promise',$this->promise,true);
		$criteria->compare('first_pay',$this->first_pay,true);
		$criteria->compare('second_pay',$this->second_pay,true);
		$criteria->compare('third_pay',$this->third_pay,true);
		$criteria->compare('fourth_pay',$this->fourth_pay);
		$criteria->compare('comm_royalty',$this->comm_royalty);
		$criteria->compare('comm_pay_time',$this->comm_pay_time);
		$criteria->compare('creator',$this->creator);
		$criteria->compare('create_time',$this->create_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContractInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
