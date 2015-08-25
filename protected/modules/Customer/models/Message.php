<?php

/**
 * This is the model class for table "{{message}}".
 *
 * The followings are the available columns in table '{{message}}':
 * @property string $id
 * @property integer $cust_id
 * @property string $phone
 * @property string $content
 * @property integer $status
 * @property string $memo
 * @property integer $create_time
 * @property integer $creator
 */
class Message extends CActiveRecord {

    public $keyword;
    public $searchtype;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{message}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cust_id, status, create_time, creator', 'numerical', 'integerOnly' => true),
            array('phone', 'length', 'max' => 20),
            array('content, memo', 'length', 'max' => 200),
            array('searchtype,keyword', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, cust_id, phone, content, status, memo, create_time, creator', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => '主键',
            'cust_id' => '客户id',
            'phone' => '电话号码',
            'content' => '短信内容',
            'status' => '发送状态',
            'memo' => '结果描述',
            'create_time' => '发送时间',
            'creator' => '发送人',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('cust_id', $this->cust_id);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('memo', $this->memo, true);
        $criteria->compare('create_time', $this->create_time);
        $criteria->compare('creator', $this->creator);
        //只看到自己的客户,及下属客户
        $user_arr = Userinfo::getAllChildUsersId(Yii::app()->user->id);
        $user_arr[] = Yii::app()->user->id;
        $idStr = '';
        foreach ($user_arr as $k => $v) {
            $idStr .= $v . ',';
        }
        $idStr = trim($idStr, ',');
        $criteria->addCondition("creator in($idStr)");

        if ($this->keyword) {
            switch ($this->searchtype) {
                case 1:
                    $criteria->addCondition("phone like :keyword");
                    $criteria->params[':keyword'] = "%{$this->keyword}%";
                    break;
                case 2:
                    $criteria->addCondition("content like :keyword");
                    $criteria->params[':keyword'] = "%{$this->keyword}%";
                    break;
                case 3:
                    $userinfo = Userinfo::getIdByName($this->keyword);
                    $idstr = '';
                    if ($userinfo) {
                        foreach ($userinfo as $k => $v) {
                            $idstr .= "'" . $v['id'] . "',";
                        }
                        $idstr = trim($idstr, ',');
                    } else {
                        $idstr = -111; //搜索不到结果
                    }
                    $criteria->addCondition("creator in($idstr)");
                    break;
            }
        } 
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
           
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Message the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getSearchArr() {
        return array(
            1 => '电话号码',
            2 => '短信内容',
            3 => '发送人',
        );
    }

}
