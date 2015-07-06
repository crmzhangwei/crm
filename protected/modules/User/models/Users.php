<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property string $id
 * @property string $eno
 * @property string $pass
 * @property string $name
 * @property string $username
 * @property string $birth
 * @property integer $sex
 * @property string $tel
 * @property string $qq
 * @property integer $dept
 * @property integer $group
 * @property integer $ismaster
 * @property integer $manager_id
 * @property integer $status
 * @property integer $cust_num
 * @property integer $extend_no
 */
class Users extends CActiveRecord
{
    
    
        public $pass_repeat;   //验证密码再次输入
        public $login_time;
        public $searchtype;
        public $keyword;
        public $id;
        public $name;
        public $newpass;
                       
        
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pass, username, tel, dept_id', 'required'),
			array('sex, dept_id, group_id, ismaster, status,extend_no,tel,manager_id', 'numerical', 'integerOnly'=>true),
			//array('eno', 'length', 'max'=>10),
			array('pass', 'length', 'max'=>32,'min'=>6),
			array('name', 'length', 'max'=>12),
                        array('tel','length','is'=>11),
			array('username', 'length', 'max'=>30),
			array('qq', 'length', 'max'=>15),
                        array('extend_no','length','max'=>10),
			array('birth, pass_repeat, create_time, login_time,searchtype,keyword', 'safe'),
                        array('pass','compare','on'=>'login'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('extend_no,id, eno, pass, name, username, birth, sex, tel, qq, dept_id, group_id, ismaster, status,manager_id', 'safe', 'on'=>'search'),
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
			'eno' => '工号',
			'pass' => '密码',
			'name' => '姓名',
			'username' => '用户名',
			'birth' => '生日',
			'sex' => '性别',
			'tel' => '手机',
			'qq' => 'QQ',
			'dept_id' => '部门',
			'group_id' => '组别',
                        'extend_no'=>'分机号',
			'ismaster' => '是否精英',
			'manager_id' => '上级',
			'status' => '状态',
                        'pass_repeat'=>'重复密码',
                        'login_time'=>'最后登录时间',
                        'newpass'=>'新密码',
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
		//$criteria->compare('name',$this->name,true);
		//$criteria->compare('username',$this->username,true);
		//$criteria->compare('birth',$this->birth,true);
		//$criteria->compare('tel',$this->tel,true);
		//$criteria->compare('qq',$this->qq,true);
		$criteria->compare('dept_id',$this->dept_id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('ismaster',$this->ismaster);
		$criteria->compare('status',$this->status);
                
                if($this->keyword)
                {
                    switch ($this->searchtype)
                   {
                       case 1:
                           $criteria->addCondition("name like :keyword");
                           $criteria->params[':keyword'] = "%{$this->keyword}%";
                           break;
                       case 2:
                           $criteria->addCondition("username like :keyword");
                           $criteria->params[':keyword'] = "%{$this->keyword}%";
                           break;
                       case 3:
                           $criteria->compare('tel', $this->keyword, true);
                           break;
                       case 4:
                           $criteria->compare('qq', $this->keyword, true);
                           break;
                   }
                }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
   
        public function beforeSave() {
            if(parent::beforeSave())
            {
                if ($this->isNewRecord) {
                    $this->pass = $this->encrypt($this->pass);
                }
                 return true;
            } else {
                return false;
            }
       }

    public function encrypt($value) {
            return md5(trim($value));
        }
        
        static function getSearchArr()
        {
            return array(
                1=>'姓名',
                2=>'用户名',
                3=>'电话',
                4=>'QQ',
            );
        }
}
