<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */ 
Yii::app()->clientScript->registerScript('search1', "
  
");
?> 
<div class="search-form" style="display:" id="share_search_form">
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
            $('#search_shared_list').html(html);  
            }  
        });
	return false;
});
    
</script>