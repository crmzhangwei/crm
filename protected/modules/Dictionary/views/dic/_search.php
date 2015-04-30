<?php
/* @var $this DicController */
/* @var $model Dic */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<table class="table table-bordered" style="width:50%;">
        <tr>
            <td width="5%" nowrap="nowrap"><?php echo $form->label($model,'code'); ?></td>
            <td width="5%" nowrap="nowrap">
                <?php echo $form->textField($model,'code',array('size'=>10,'maxlength'=>10)); ?>
            </td>
            <td width="5%" nowrap="nowrap"><?php echo $form->label($model,'name'); ?></td>
            <td width="5%" nowrap="nowrap">
               <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
            </td>
            <td width="5%" nowrap="nowrap"><?php echo $form->label($model,'ctype'); ?></td>
            <td width="5%" nowrap="nowrap">
                <?php echo $form->textField($model,'ctype',array('size'=>20,'maxlength'=>20)); ?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <a href="/index.php?r=Dictionary/dic/create" id ='create_dictionary'  class="btn btn-sm btn-primary" > 
                                <i class="icon-plus"></i>新建字典数据
                            </a>  
                            <a href="javascript:void(0)" id ='search_dictionary'  class="btn btn-sm btn-primary" > 
                                <i class="icon-plus"></i>搜索
                            </a>
            </td>
        </tr>
        </table> 

<?php $this->endWidget(); ?>

</div><!-- search-form -->