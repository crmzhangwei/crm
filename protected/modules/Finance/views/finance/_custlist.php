<?php 
 $dataProvider = $model->searchForPoplist(); 
$this->widget('GGridView', array(
	'id'=>'finance-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>null, 
	'columns'=>array(
            array('class' => 'CCheckBoxColumn',
                    'name' => 'id',
                    'value'=>'$data->id.",".$data->cust_name',
                    'id' => 'select',
                    'selectableRows' => 1,
                    'headerTemplate' => '{item}',
                    'htmlOptions' => array(
                        'width' => '20', 
                    ), 
                ),
		'id',
		'cust_name', 
		'phone',
		'qq',  
		 
	),
)); ?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?=$dataProvider->totalItemCount ?></span>条记录 
    </div>
    <div>
        <?php echo CHtml::button("选择", array('onclick'=>'selectone();')) ?> 
    </div>
    <div class="col-sm-6 no-padding-right">
        <?php 
        $this->widget('GLinkPager', array('pages' => $dataProvider->getPagination(),'isajax'=>1));
        ?>
    </div>
</div> 