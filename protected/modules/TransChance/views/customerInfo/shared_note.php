<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */ 
Yii::app()->clientScript->registerScript('search1', "
  
");
?> 
<div class="search-form" style="display:" id="share_search_form">
 <?php $this->renderPartial('_search_shared_note',array('model'=>$model,'custmodel'=>$custmodel)); ?>
</div>
<!-- search-form -->
 <div id="search_shared_list"> 
    <?php $this->renderPartial('_shared_note_list',array(
	'model'=>$model,
        'custmodel'=>$custmodel
)); 
?>  
</div>
<script type="text/javascript">
    function getList(url){
        $.ajax({  
        url:url,  
        success:function(html){
            if(url.indexOf('history')!=-1){
                $('#search_history_list').html(html); 
            }else{
                $('#search_shared_list').html(html); 
            }
        }  
        });  
        return false; 
    }
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