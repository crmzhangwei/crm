<?php

/**
 * This is the model class for table "{{cust_convt_detail}}".
 *
 * The followings are the available columns in table '{{cust_convt_detail}}':
 * @property string $id
 * @property integer $lib_type
 * @property integer $cust_id
 * @property integer $cust_type_1
 * @property integer $cust_type_2
 * @property integer $convt_time
 * @property integer $user_id
 */
class CustConvtDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{cust_convt_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lib_type, cust_id, cust_type_1, cust_type_2, convt_time, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lib_type, cust_id, cust_type_1, cust_type_2, convt_time, user_id', 'safe', 'on'=>'search'),
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
			'lib_type' => '库类型',
			'cust_id' => '客户id',
			'cust_type_1' => '原始类别',
			'cust_type_2' => '转换类别',
			'convt_time' => '转换时间',
			'user_id' => '操作人',
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
		$criteria->compare('lib_type',$this->lib_type);
		$criteria->compare('cust_id',$this->cust_id);
		$criteria->compare('cust_type_1',$this->cust_type_1);
		$criteria->compare('cust_type_2',$this->cust_type_2);
		$criteria->compare('convt_time',$this->convt_time);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustConvtDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
