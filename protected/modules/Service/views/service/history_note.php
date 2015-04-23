<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
 

Yii::app()->clientScript->registerScript('search2', "
$('#history_search_btn').click(function(){
	$('#history_search_form').toggle();
	return false;
});
 
");
?> 

<h1>录史小记</h1>  
<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button','id'=>'history_search_btn')); ?>
<div class="search-form" style="display:none" id="history_search_form">
 <?php $this->renderPartial('_search_note',array('model'=>$model)); ?>
</div><!-- search-form -->
<div id="search_history_list"> 
    <?php $this->renderPartial('_history_note_list',array(
	'model'=>$model,
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
    $('#history_search_form form').submit(function(){
     var url = $(this).attr('action');
     url=url+"&isajax=1"; 
      $.ajax(url,{   
        data:$(this).serialize(),
        success:function(html){  
            $('#history_search_form').toggle();
            $('#search_history_list').html(html);  
            }  
        });
	return false;
    });
    
</script>