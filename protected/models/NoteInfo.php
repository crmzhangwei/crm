<?php

/**
 * This is the model class for table "{{note_info}}".
 *
 * The followings are the available columns in table '{{note_info}}':
 * @property string $id
 * @property integer $cust_id
 * @property string $cust_info
 * @property string $requirement
 * @property string $service
 * @property string $dissent
 * @property string $next_followup
 * @property string $memo
 * @property integer $isvalid
 * @property integer $iskey
 * @property integer $next_contact
 * @property integer $dial_id
 * @property integer $message_id
 * @property integer $eno
 * @property integer $create_time
 */
class NoteInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{note_info}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cust_id, eno, create_time,next_contact', 'required'),
			array('cust_id, isvalid, iskey, next_contact, dial_id, eno, create_time', 'numerical', 'integerOnly'=>true),
			array('cust_info, requirement, service, dissent, next_followup, memo', 'length', 'max'=>200), 
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cust_id, cust_info, requirement, service, dissent, next_followup, memo, isvalid, iskey, next_contact, dial_id, eno, create_time', 'safe', 'on'=>'search'),
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
                    'dial'=>array(self::BELONGS_TO,'DialDetail','dial_id'), 
                    'eno'=>array(self::BELONGS_TO,'Users','eno'),
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
			'cust_info' => '客户情况',
			'requirement' => '挖需求',
			'service' => '介绍服务',
			'dissent' => '异议处理',
			'next_followup' => '下次跟进处理',
			'memo' => '备注',
			'isvalid' => '是否有效',
			'iskey' => '是否重点',
			'next_contact' => '下次联系时间',
			'dial_id' => '电话拔打记录',
			'message_id' => '短信发送记录',
			'eno' => '工号',
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
		$criteria->compare('cust_info',$this->cust_info,true);
		$criteria->compare('requirement',$this->requirement,true);
		$criteria->compare('service',$this->service,true);
		$criteria->compare('dissent',$this->dissent,true);
		$criteria->compare('next_followup',$this->next_followup,true);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('isvalid',$this->isvalid);
		$criteria->compare('iskey',$this->iskey);
		$criteria->compare('next_contact',$this->next_contact);
		$criteria->compare('dial_id',$this->dial_id);
		$criteria->compare('eno',$this->eno);
		$criteria->compare('create_time',$this->create_time);

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
            $criteria->compare('t.cust_info',$this->cust_info,true);
	    $criteria->compare('t.requirement',$this->requirement,true);
	    $criteria->compare('t.service',$this->service,true);
            $criteria->select="t.id,t.cust_info,t.requirement,t.service,t.next_contact,t.create_time,u.eno";
            $criteria->join=" left join {{users}} u on t.eno=u.id ";
            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }
        /**
         * 查找历史小记
         */
        public function searchHistoryNote($custid){
            $criteria=new CDbCriteria;
            $criteria->addCondition("cust_id=$custid");
            $criteria->compare('cust_info',$this->cust_info,true);
	    $criteria->compare('requirement',$this->requirement,true);
	    $criteria->compare('service',$this->service,true);
            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NoteInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
