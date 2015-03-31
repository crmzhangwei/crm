	<form name="frmBatchSettle" action="./index.php/?r=Customer/customerinfo/batchCustomer" method="post" enctype="multipart/form-data">
        请选择包含批量IP称的EXCEL文件
        <input type="file" name="batchFile" value="">
        <input type="submit" value="上传">
    </form> 

   <!--  <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'product-form', 
    	'htmlOptions'=>array('enctype'=>'multipart/form-data')));?> 
	<?php echo $form->labelEx($model,'请选择包含批量IP称的EXCEL文件');?>
	<?php echo $form->fileField($model,'batchFile');?> 
	<?php $this->endWidget();?>-->