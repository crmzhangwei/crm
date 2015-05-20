<?php

/**
 * This is the model class for table "{{dial_detail}}".
 *
 * The followings are the available columns in table '{{dial_detail}}':
 * @property string $id
 * @property string $eno
 * @property integer $dial_time
 * @property double $dial_long
 * @property integer $dial_num
 * @property string $record_path
 * @property integer $isok
 */
class DialDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{dial_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dial_time, dial_num, isok', 'numerical', 'integerOnly'=>true),
			array('dial_long', 'numerical'),
			array('eno', 'length', 'max'=>10),
			array('record_path', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, eno, dial_time, dial_long, dial_num, record_path, isok', 'safe', 'on'=>'search'),
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
			'eno' => '工号',
			'dial_time' => '拔打时间',
			'dial_long' => '拔打时长',
			'dial_num' => '拔打次数',
			'record_path' => '录音路径',
			'isok' => '是否成功',
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
		$criteria->compare('eno',$this->eno,true);
		$criteria->compare('dial_time',$this->dial_time);
		$criteria->compare('dial_long',$this->dial_long);
		$criteria->compare('dial_num',$this->dial_num);
		$criteria->compare('record_path',$this->record_path,true);
		$criteria->compare('isok',$this->isok);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DialDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
