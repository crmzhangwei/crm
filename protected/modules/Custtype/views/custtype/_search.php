<?php
/* @var $this CusttypeController */
/* @var $model CustType */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    <table class="table table-bordered" style="width:50%;">
        <tr>
            <td width="5%" nowrap="nowrap"><?php echo $form->label($model,'lib_type'); ?></td>
            <td width="5%" nowrap="nowrap">
                <?php echo  $form->dropDownList($model, "lib_type", $this->getLibArr()) ?> 
            </td>
            <td width="5%" nowrap="nowrap"><?php echo $form->label($model,'type_no'); ?></td>
            <td width="5%" nowrap="nowrap">
                <?php echo $form->textField($model,'type_no',array('size'=>5,'maxlength'=>5)); ?>
            </td>
            <td width="5%" nowrap="nowrap"><?php echo $form->label($model,'type_name'); ?></td>
            <td width="5%" nowrap="nowrap">
                <?php echo $form->textField($model,'type_name',array('size'=>35,'maxlength'=>60)); ?>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <a href="<?php echo Yii::app()->createUrl('Custtype/custtype/create')?>" id ='create_cust_type'  class="btn btn-sm btn-primary" > 
                                <i class="icon-plus"></i>新建客户分类
                            </a>  
                            <a href="javascript:void(0)" id ='search_cust_type'  class="btn btn-sm btn-primary" > 
                                <i class="icon-plus"></i>搜索
                            </a>
            </td>
        </tr>
    </table>  
	

<?php $this->endWidget(); ?>

</div><!-- search-form -->