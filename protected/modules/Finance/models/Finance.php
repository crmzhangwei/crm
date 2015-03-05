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
			array('cust_id, sale_user, trans_user, acct_number, acct_time, creator, create_time', 'numerical', 'integerOnly'=>true),
			array('acct_amount', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cust_id, sale_user, trans_user, acct_number, acct_amount, acct_time, creator, create_time', 'safe', 'on'=>'search'),
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
			'cust_id' => '客户id',
			'sale_user' => '销售人员',
			'trans_user' => '谈单师',
			'acct_number' => '到账单数',
			'acct_amount' => '到账金额',
			'acct_time' => '到账时间',
			'creator' => '创建人',
			'create_time' => '创建时间',
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
		$criteria->compare('sale_user',$this->sale_user);
		$criteria->compare('trans_user',$this->trans_user);
		$criteria->compare('acct_number',$this->acct_number);
		$criteria->compare('acct_amount',$this->acct_amount);
		$criteria->compare('acct_time',$this->acct_time);
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
	 * @return Finance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
