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
 * @property integer $iskey
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
			array('category, cust_type, iskey, assign_time, next_time, create_time, creator', 'numerical', 'integerOnly'=>true),
			array('cust_no, eno, assign_eno', 'length', 'max'=>10),
			array('cust_name, shop_name, corp_name, shop_url, shop_addr, datafrom, memo', 'length', 'max'=>100),
			array('phone, qq', 'length', 'max'=>20),
			array('mail', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cust_no, cust_name, shop_name, corp_name, shop_url, shop_addr, phone, qq, mail, datafrom, category, cust_type, eno, iskey, assign_eno, assign_time, next_time, memo, create_time, creator', 'safe', 'on'=>'search'),
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
			'id' => '主键',
			'cust_no' => '客户编号',
			'cust_name' => '客户名称',
			'shop_name' => '店铺名称',
			'corp_name' => '公司名称',
			'shop_url' => '店铺网址',
			'shop_addr' => '店铺地称',
			'phone' => '电话',
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
			'memo' => '备注',
			'create_time' => '创建时间',
			'creator' => '创建人',
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
		$criteria->compare('iskey',$this->iskey);
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
