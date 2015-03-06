<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class GActiveRecord extends CActiveRecord {
 
    /**
     * Prepares create_time, create_user_id, update_time and
     * update_user_ id attributes before performing validation.
     */
    protected function beforeValidate() {
 
        if ($this->isNewRecord) {
            // set the create date, last updated date
            // and the user doing the creating
            $this->create_time = $this->update_time = new CDbExpression('NOW()');
 
            $this->create_user_id = $this->update_user_id = Yii::app()->user->id;
        } else {
            //not a new record, so just set the last updated time
            //and last updated user id
            $this->update_time = new CDbExpression('NOW()');
            $this->update_user_id = Yii::app()->user->id;
 
        }
        return parent::beforeValidate();
    }
 
}
