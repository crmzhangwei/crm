<?php

/**
 * This is the model class for table "{{customer_info}}".
 *
 * The followings are the available columns in table '{{customer_info}}':
 * @property string $id
 * @property string $cust_no
 * @property string $cust_name
 * @property string $shop_name
 * @property string $corp_name
 * @property string $shop_url
 * @property string $shop_addr
 * @property string $phone
 * @property string $qq
 * @property string $mail
 * @property string $datafrom
 * @property integer $category
 * @property integer $cust_type
 * @property string $eno
 * @property string $assign_eno
 * @property integer $assign_time
 * @property integer $next_time
 * @property string $memo
 * @property integer $create_time
 * @property integer $creator
 */
class CustomerInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{customer_info}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_time, creator', 'required'),
			array('category, cust_type, assign_time, next_time, create_time, creator', 'numerical', 'integerOnly'=>true),
			array('cust_no, eno, assign_eno', 'length', 'max'=>10),
			array('cust_name, shop_name, corp_name, shop_url, shop_addr, datafrom, memo', 'length', 'max'=>100),
			array('phone, qq', 'length', 'max'=>20),
			array('mail', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cust_no, cust_name, shop_name, corp_name, shop_url, shop_addr, phone, qq, mail, datafrom, category, cust_type, eno, assign_eno, assign_time, next_time, memo, create_time, creator', 'safe', 'on'=>'search'),
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
			'cust_no' => 'Cust No',
			'cust_name' => 'Cust Name',
			'shop_name' => 'Shop Name',
			'corp_name' => 'Corp Name',
			'shop_url' => 'Shop Url',
			'shop_addr' => 'Shop Addr',
			'phone' => 'Phone',
			'qq' => 'Qq',
			'mail' => 'Mail',
			'datafrom' => 'Datafrom',
			'category' => 'Category',
			'cust_type' => 'Cust Type',
			'eno' => 'Eno',
			'assign_eno' => 'Assign Eno',
			'assign_time' => 'Assign Time',
			'next_time' => 'Next Time',
			'memo' => 'Memo',
			'create_time' => 'Create Time',
			'creator' => 'Creator',
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
		$criteria->compare('cust_no',$this->cust_no,true);
		$criteria->compare('cust_name',$this->cust_name,true);
		$criteria->compare('shop_name',$this->shop_name,true);
		$criteria->compare('corp_name',$this->corp_name,true);
		$criteria->compare('shop_url',$this->shop_url,true);
		$criteria->compare('shop_addr',$this->shop_addr,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('datafrom',$this->datafrom,true);
		$criteria->compare('category',$this->category);
		$criteria->compare('cust_type',$this->cust_type);
		$criteria->compare('eno',$this->eno,true);
		$criteria->compare('assign_eno',$this->assign_eno,true);
		$criteria->compare('assign_time',$this->assign_time);
		$criteria->compare('next_time',$this->next_time);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('creator',$this->creator);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
