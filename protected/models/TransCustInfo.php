<?php

/**
 * This is the model class for table "{{trans_cust_info}}".
 *
 * The followings are the available columns in table '{{trans_cust_info}}':
 * @property string $id
 * @property integer $cust_id
 * @property integer $cust_type
 * @property string $eno
 * @property string $assign_eno
 * @property integer $assign_time
 * @property integer $next_time
 * @property string $memo
 * @property integer $creator
 * @property integer $create_time
 */
class TransCustInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{trans_cust_info}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cust_id', 'required'),
			array('cust_id, cust_type, assign_time, next_time, creator, create_time', 'numerical', 'integerOnly'=>true),
			array('eno, assign_eno', 'length', 'max'=>10),
			array('memo', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cust_id, cust_type, eno, assign_eno, assign_time, next_time, memo, creator, create_time', 'safe', 'on'=>'search'),
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
			'cust_type' => '客户分类',
			'eno' => '所属工号',
			'assign_eno' => '分配人',
			'assign_time' => '分配时间',
			'next_time' => '下次联系时间',
			'memo' => '备注',
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
		$criteria->compare('cust_type',$this->cust_type);
		$criteria->compare('eno',$this->eno,true);
		$criteria->compare('assign_eno',$this->assign_eno,true);
		$criteria->compare('assign_time',$this->assign_time);
		$criteria->compare('next_time',$this->next_time);
		$criteria->compare('memo',$this->memo,true);
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
	 * @return TransCustInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
