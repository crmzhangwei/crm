<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs = array(
	'权限管理' => array('index'),
	'查看用户',
);

$this->menu = array(
	array('label' => '用户例表', 'url' => array('index')),
	array('label' => '创建用户', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "

$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
		));
?>
<div class="form-group">
	<div class="btn-group">
		<a href="javascript:void(0)" id ='create_user'  class="btn btn-sm btn-primary" > 
			<i class="icon-plus"></i>新建用户
		</a>
	</div>        
	<?php echo $form->label($model, 'eno'); ?>
	<?php echo $form->textField($model, 'eno', array('size' => 10, 'maxlength' => 10)); ?>
	<?php echo $form->dropDownList($model, 'searchtype', Users::getsearchArr(), array('style' => "height:34px;")); ?>
	<?php echo $form->textField($model, 'keyword', array('size' => 30, 'maxlength' => 30)); ?>

	<button class="btn btn-sm btn-primary" type="submit">
		<i class="icon-search"></i>
		搜 索
	</button>
</div>

<?php $this->endWidget(); ?>

<?php
$dataProvider = $model->search();
$this->widget('GGridView', array(
	'id' => 'users-grid',
	'dataProvider' => $dataProvider,
	'columns' => array(
		array('class' => 'CCheckBoxColumn',
			'name' => 'id',
			'id' => 'select',
			'selectableRows' => 2,
			'headerTemplate' => '{item}',
			'htmlOptions' => array(
				'width' => '20',
			),
		),
		'id',
		'eno',
		'name',
		'username',
		'tel',
		'qq',
		array(
			'name' => 'dept_id',
			'value' => array($this, 'get_dept_text'),
		),
		array(
			'name' => 'group_id',
			'value' => array($this, 'get_group_text'),
		),
		//'dept_id'
		array(
			'name' => 'ismaster',
			'value' => array($this, 'get_ismaster_text'),
		),
		//'group_id',
		//'ismaster',
		//'status',
		array(
			'name' => 'status',
			'value' => array($this, 'get_status_text'),
		),
		array(
			'class' => 'CButtonColumn',
			'htmlOptions' => array(
				'width' => '100',
				'style' => 'text-align:center',
			),
		),
	),
));
?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?= $dataProvider->totalItemCount ?></span>条记录
        <a href="javascript:void(0);" js_type="publish" class="btn  btn-minier btn-sm btn-success publish"><i class=" icon-ok icon-large"></i>设置精英</a> <a href="javascript:void(0);" js_type="cancel_publish"  class="btn  btn-minier btn-sm btn-warning publish"> <i class="icon-lock icon-large"></i>取消精英</a> 
    </div>
    <div class="col-sm-6 no-padding-right">
		<?php
		$dataProvider->pagination->pageVar = 'page';
		$this->widget('GLinkPager', array('pages' => $dataProvider->pagination,));
		?>
    </div>
</div>  		

<script>
    $(function ()
    {
        $('#create_user').click(function ()
        {
            public.dialog('增加用户', '<?= Yii::app()->createUrl('User/users/create') ?>', {}, 900);
        })
    })
</script>