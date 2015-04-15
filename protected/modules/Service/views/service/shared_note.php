<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */ 
Yii::app()->clientScript->registerScript('search1', "
$('#share_search_btn').click(function(){
	$('#share_search_form').toggle();
	return false;
});  
");
?>

<h1>共享小记</h1> 

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button','id'=>'share_search_btn')); ?>
<div class="search-form" style="display:none" id="share_search_form">
 <?php $this->renderPartial('_search_shared_note',array('model'=>$model)); ?>
</div>
<!-- search-form -->
 <div id="search_shared_list"> 
    <?php $this->renderPartial('_shared_note_list',array(
	'model'=>$model,
)); 
?>  
</div>
<script type="text/javascript">
    
    $('#share_search_form form').submit(function(){
     var url = $(this).attr('action');
     url=url+"&isajax=1"; 
      $.ajax(url,{   
        data:$(this).serialize(),
        success:function(html){  
            $('#share_search_form').toggle();
            $('#search_shared_list').html(html);  
            }  
        });
	return false;
});
    
</script>