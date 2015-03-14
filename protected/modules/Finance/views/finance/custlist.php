<html >
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
<!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/font-awesome/4.1.0/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->

        <!-- text fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

        

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-rtl.min.css" />

        
         <!--[if !IE]> -->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery/jquery-2.1.1.min.js"></script>
            <!-- <![endif]-->

            <!--[if IE]>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery/jquery-1.11.1.min.js"></script>
            <![endif]--> 
            <base target="_self">
    </head>
<h1>财务数据</h1>

<p>
你可以在输入框的开始处输入 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>)，用以指定查询条件.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
 
<?php 
 $dataProvider = $model->search(); 
$this->widget('GGridView', array(
	'id'=>'finance-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>null, 
	'columns'=>array(
            array('class' => 'CCheckBoxColumn',
                    'name' => 'id',
                    'id' => 'select',
                    'selectableRows' => 1,
                    'headerTemplate' => '{item}',
                    'htmlOptions' => array(
                        'width' => '20',
                    ),
                ),
		'id',
		'cust_id',
		'sale_user',
		'trans_user',
		'acct_number',
		'acct_amount',
                array('name'=>'acct_time',  
                    'value'=>'date("Y-m-d",$data->acct_time)',//格式化日期  
                ),  
		/*
		'acct_time',
		'creator',
		'create_time',
		*/
		 
	),
)); ?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?=$dataProvider->totalItemCount ?></span>条记录 
    </div>
    <div class="col-sm-6 no-padding-right">
        <?php 
        $this->widget('GLinkPager', array('pages' => $dataProvider->getPagination(),));
        ?>
    </div>
</div> 
<script type="text/javascript">
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#finance-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
 </script>
 
     </body>
    </html>
