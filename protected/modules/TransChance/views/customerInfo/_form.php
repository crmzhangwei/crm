<?php
/* @var $this CustomerInfoController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<?php
/* @var $this ServiceController */
/* @var $model CustomerInfo */
/* @var $form CActiveForm */
?>

<div class="form">


<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
        <li class="ui-state-default ui-corner-top <?php if($this->actionName =='update'){ echo 'ui-tabs-active ui-state-active';}else{}?>" role="tab" tabindex="0" aria-controls="tabs-1" aria-labelledby="ui-id-29" <?php if($this->actionName =='update'){ echo 'aria-selected="true" aria-expanded="true"';}else{echo 'aria-selected="false" aria-expanded="false"';}?>>
            <a href="<?php echo $this->createUrl('update', array('id'=>$model->id))?>" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-29">基本信息</a>
        </li> 
        <li class="ui-state-default ui-corner-top <?php if($this->actionName =='noteinfo'){ echo 'ui-tabs-active ui-state-active';}else{}?>" role="tab" tabindex="-1" aria-controls="tabs-2" aria-labelledby="ui-id-31"  <?php if($this->actionName =='noteinfo'){ echo 'aria-selected="true" aria-expanded="true"';}else{echo 'aria-selected="false" aria-expanded="false"';}?>>
            <a href="<?php echo $this->createUrl('noteinfo', array('id'=>$model->id))?>" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-31">小记录入</a>
        </li>
        <li class="ui-state-default ui-corner-top  <?php if($this->actionName =='historynote'){ echo 'ui-tabs-active ui-state-active';}else{}?>" role="tab" tabindex="-1" aria-controls="tabs-3" aria-labelledby="ui-id-32" <?php if($this->actionName =='historynote'){ echo 'aria-selected="true" aria-expanded="true"';}else{echo 'aria-selected="false" aria-expanded="false"';}?>>
            <a href="<?php echo $this->createUrl('historynote', array('id'=>$model->id))?>" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-32">历史小记</a>
        </li>
        <li class="ui-state-default ui-corner-top <?php if($this->actionName =='sharednote'){ echo 'ui-tabs-active ui-state-active';}else{}?>" role="tab" tabindex="-1" aria-controls="tabs-4" aria-labelledby="ui-id-33" <?php if($this->actionName =='sharednote'){ echo 'aria-selected="true" aria-expanded="true"';}else{echo 'aria-selected="false" aria-expanded="false"';}?>>
            <a href="<?php echo $this->createUrl('sharednote', array('id'=>$model->id))?>" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-33">共享小记</a>
        </li>  
    </ul> 

    <div id="tabs-1" aria-labelledby="ui-id-29" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="false" style="display: block;">

      <?php    
         switch($this->actionName) {
         case 'update':
            $this->renderPartial('_baseinfo', array('model'=>$model,'user'=>$user));
         break;
         case 'noteinfo':
           $this->renderPartial('_noteinfo_form', array('model'=>$noteinfo,'custmodel'=>$model));
           break;
       
         case 'historynote':
             $this->renderPartial('history_note', array('model'=>$historyNote,'custmodel'=>$model)); 
          break; 
        case 'sharednote':
             $this->renderPartial('shared_note', array('model'=>$sharedNote,'custmodel'=>$model)); 
             break;
         default:
            break;
         }
         ?>
    </div> 
    </div>


</div><!-- form -->
 


<script>
	
	$(function(){
		$("#cust_type").change(function(){
			var value = $(this).val();
			if(value == 6){
				$("#visit_date_tr").show();
			}else{
				$("#visit_date_tr").hide();
			}

			if(value == 8){
				$("#abandon_reason_tr").show();
			}else{
				$("#abandon_reason_tr").hide();
			}
		});
	});
</script>