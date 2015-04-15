 

<?php 
$dataProvider = $model->searchHistoryNote($model->cust_id);
$this->widget('GGridView', array(
	'id'=>'historynote-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>null,
	'columns'=>array(
		'id',    
		'cust_info',
		'requirement',
                'service', 
                'next_contact', 
		array(
			'class'=>'CButtonColumn',
                        'template'=>'',  
		),
	),
)); ?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?=$dataProvider->totalItemCount ?></span>条记录 
    </div>
    <div class="col-sm-6 no-padding-right">
        <?php 
         
        $pg = $dataProvider->getPagination();
        $pg->route="service/historyNoteList"; 
        $pg->params=array('cust_id'=>$model->cust_id);
        $this->widget('GLinkPager', array('pages' => $pg,'isajax'=>1));
        ?>
    </div>
</div>
