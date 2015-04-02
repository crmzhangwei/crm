<?php

/**
 * This is the model class for table "{{cust_type}}".
 *
 * The followings are the available columns in table '{{cust_type}}':
 * @property string $id
 * @property integer $lib_type
 * @property string $type_no
 * @property string $type_name
 */
class CustType extends CActiveRecord {

    public $lib_type_name;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{cust_type}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('lib_type, type_no, type_name', 'required'),
            array('lib_type', 'numerical', 'integerOnly' => true),
            array('type_no', 'length', 'max' => 5),
            array('type_name', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, lib_type, type_no, type_name', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'lib_type' => '库类型',
            'type_no' => '类型编号',
            'type_name' => '类型名称',
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
        $criteria->compare('lib_type', $this->lib_type);
        $criteria->compare('type_no', $this->type_no, true);
        $criteria->compare('type_name', $this->type_name, true);
        $criteria->select="t.id,t.lib_type,t.type_no,t.type_name,d.name as lib_type_name";
        $criteria->join=" left join {{dic}} d on t.lib_type=d.code and d.ctype='lib_type'";
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CustType the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function findByType($type) {
        return CustType::model()->findAll('lib_type=:lib_type', array(":lib_type" => $type));
    }

}
