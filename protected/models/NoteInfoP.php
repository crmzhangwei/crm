<?php

/**
 * This is the model class for table "{{note_info_p}}".
 *
 * The followings are the available columns in table '{{note_info_p}}':
 * @property integer $id
 * @property integer $cust_id
 * @property integer $isvalid
 * @property integer $iskey
 * @property integer $next_contact
 * @property integer $dial_id
 * @property integer $message_id
 * @property integer $userid
 * @property string $cust_type
 * @property integer $lib_type
 * @property integer $create_time
 * @property string $memo
 */
class NoteInfoP extends CActiveRecord
{
        public $uid;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{note_info_p}}';
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
			array('id, cust_id, isvalid, iskey, next_contact, dial_id, message_id, userid, lib_type, create_time', 'numerical', 'integerOnly'=>true),
			array('cust_type', 'length', 'max'=>5),
			array('memo', 'length', 'max'=>2000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cust_id, isvalid, iskey, next_contact, dial_id, message_id, userid, cust_type, lib_type, create_time, memo', 'safe', 'on'=>'search'),
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
			'isvalid' => '是否有效',
			'iskey' => '是否重点',
			'next_contact' => '下次联系时间',
			'dial_id' => '电话拔打记录',
			'message_id' => 'Message',
			'userid' => '用户id',
			'cust_type' => '客户分类',
			'lib_type' => '库类型',
			'create_time' => '创建时间',
			'memo' => '备注',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('cust_id',$this->cust_id);
		$criteria->compare('isvalid',$this->isvalid);
		$criteria->compare('iskey',$this->iskey);
		$criteria->compare('next_contact',$this->next_contact);
		$criteria->compare('dial_id',$this->dial_id);
		$criteria->compare('message_id',$this->message_id);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('cust_type',$this->cust_type,true);
		$criteria->compare('lib_type',$this->lib_type);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('memo',$this->memo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
         /**
         * 查找共享小记
         */
        public function searchSharedNote($custid){
            $criteria=new CDbCriteria;
            $criteria->addCondition("t.cust_id=$custid"); 
            $criteria->compare('memo',$this->memo,true); 
            $uid = Yii::app()->user->id;
            $criteria->addCondition("t.userid<>$uid"); 
            $sort = new CSort(); 
            $sort->defaultOrder=array("create_time"=>CSORT::SORT_DESC);
            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
        }
        /**
         * 查找历史小记
         */
        public function searchHistoryNote($custid){
            $criteria=new CDbCriteria;
            $criteria->addCondition("cust_id=$custid");
            $criteria->compare('memo',$this->memo,true); 
            $uid = Yii::app()->user->id;
	    $criteria->addCondition("userid=$uid"); 
            $sort = new CSort(); 
            $sort->defaultOrder=array("create_time"=>CSORT::SORT_DESC);
            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>$sort,
		));
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NoteInfoP the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
