<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $extension
 * @property string $password
 * @property string $name
 * @property string $voicemail
 * @property integer $ringtimer
 * @property string $noanswer
 * @property string $recording
 * @property string $outboundcid
 * @property string $sipname
 * @property string $noanswer_cid
 * @property string $busy_cid
 * @property string $chanunavail_cid
 * @property string $noanswer_dest
 * @property string $busy_dest
 * @property string $chanunavail_dest
 * @property string $mohclass
 * @property string $status
 * @property string $dnd
 * @property string $update_times
 */
class ExtNumber extends CActiveRecord
{
	public $keyword;
	public $searchtype;
	public $uname;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ringtimer', 'numerical', 'integerOnly'=>true),
			array('extension, password, noanswer_cid, busy_cid, chanunavail_cid, status, dnd', 'length', 'max'=>20),
			array('name, voicemail, recording, outboundcid, sipname', 'length', 'max'=>50),
			array('noanswer', 'length', 'max'=>100),
			array('noanswer_dest, busy_dest, chanunavail_dest', 'length', 'max'=>255),
			array('mohclass', 'length', 'max'=>80),
			array('update_times,searchtype,keyword,uname', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('extension, password, name, voicemail, ringtimer, noanswer, recording, outboundcid, sipname, noanswer_cid, busy_cid, chanunavail_cid, noanswer_dest, busy_dest, chanunavail_dest, mohclass, status, dnd, update_times', 'safe', 'on'=>'search'),
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
			'extension' => '分机号',
			'password' => 'Password',
			'name' => 'Name',
			'voicemail' => 'Voicemail',
			'ringtimer' => 'Ringtimer',
			'noanswer' => 'Noanswer',
			'recording' => 'Recording',
			'outboundcid' => 'Outboundcid',
			'sipname' => 'Sipname',
			'noanswer_cid' => 'Noanswer Cid',
			'busy_cid' => 'Busy Cid',
			'chanunavail_cid' => 'Chanunavail Cid',
			'noanswer_dest' => 'Noanswer Dest',
			'busy_dest' => 'Busy Dest',
			'chanunavail_dest' => 'Chanunavail Dest',
			'mohclass' => 'Mohclass',
			'status' => '分机状态',
			'dnd' => '是否示忙',
			'update_times' => 'CURRENT_TIMESTAMP',
			'uname' => '姓名',
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
		
		$criteria->compare('extension',$this->extension,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('voicemail',$this->voicemail,true);
		$criteria->compare('ringtimer',$this->ringtimer);
		$criteria->compare('noanswer',$this->noanswer,true);
		$criteria->compare('recording',$this->recording,true);
		$criteria->compare('outboundcid',$this->outboundcid,true);
		$criteria->compare('sipname',$this->sipname,true);
		$criteria->compare('noanswer_cid',$this->noanswer_cid,true);
		$criteria->compare('busy_cid',$this->busy_cid,true);
		$criteria->compare('chanunavail_cid',$this->chanunavail_cid,true);
		$criteria->compare('noanswer_dest',$this->noanswer_dest,true);
		$criteria->compare('busy_dest',$this->busy_dest,true);
		$criteria->compare('chanunavail_dest',$this->chanunavail_dest,true);
		$criteria->compare('mohclass',$this->mohclass,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('dnd',$this->dnd,true);
		$criteria->compare('update_times',$this->update_times,true);
		
		if ($this->keyword) {
			switch ($this->searchtype) {
				case 1:
					$criteria->compare('extension', $this->keyword, true);
					break;
				case 2:
					$criteria->compare('status', $this->keyword, true);
					break;
				case 3:
					$uInfo = Users::model()->findAll('username=:username', array(':username'=>$this->keyword));
					if($uInfo){
						$criteria->addCondition("extension='{$uInfo[0]['extend_no']}'");
					}
					else{
						$criteria->addCondition("extension='-1'");
					}
					break;
			}
		}
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db2;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExtNumber the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getSearchArr()
    {
        return array(
            1=>'分机号',
            2=>'分机状态',
			3=>'姓名',
        );
    }
}
