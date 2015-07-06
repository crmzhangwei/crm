 
<?php
$dataProvider = $model->searchSharedNote($model->cust_id);
$this->widget('GGridView', array(
    'id' => 'sharenote-grid',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'columns' => array(
        array('class' => 'CCheckBoxColumn',
            'name' => 'id',
            'id' => 'select',
            'selectableRows' => 0,
            'headerTemplate' => '{item}',
            'htmlOptions' => array('width' => '20'),
        ),
        array('name' => 'cust_type',  'value'=>array($this, 'get_type_text')),
        'cust_info',
        'requirement',
        'service',
        'dissent',
        'next_followup',
        'memo',
        array('name' => 'next_contact', 'value' => 'date("Y-m-d",$data->next_contact)'),
        array('name' => 'create_time', 'value' => 'date("Y-m-d",$data->create_time)'),
        array('name' => 'eno', 'value' => array($this,'get_user_text')),
        array(
            'class' => 'CButtonColumn',
            'template' => '{play} {view}',
            'header' => '操作',
            'buttons' => array(
                'play' => array(
                    'label' => '播放和下载',
                    'url' => '',
                    'imageUrl' => '',
                    'options' => array('class' => 'btn btn-info btn-minier tooltip-info', 'onclick'=>'playAndDown(this)'),
                ), 
                'view' => array(
                    'label' => '查看',
                    'url' => '',
                    'imageUrl' => '',
                    'options' => array('class' => 'btn btn-info btn-minier tooltip-info', 'onclick'=>'viewit(this)'),
                ),
            ),
            'htmlOptions' => array(
                'width' => '200',
            )
        ),
    ),
));
?>

<div class="table-page"> 
    <div class="col-sm-6">
        共<span class="orange"><?= $dataProvider->totalItemCount ?></span>条记录 
    </div>
    <div class="col-sm-6 no-padding-right">
        <?php
        $pg = $dataProvider->getPagination();
        $pg->route = "today/sharedNoteList";
        $pg->params = array('cust_id' => $model->cust_id);
        $this->widget('GLinkPager', array('pages' => $pg, 'isajax' => 1));
        ?>
    </div>
</div>
<script>
    function playit(obj)
    { 
        var trindex = $(obj).parents('tr').index();
        var note_id = $('#select_' + trindex).val();
        var url;
        <?php $a = Yii::app()->createurl('Service/service/play');
        echo 'url=' . "'$a'";
        ?> 
        public.dialog('播放录音', url + '&id=' + note_id);
    }
    function playAndDown(obj)
    { 
        var trindex = $(obj).parents('tr').index();
        var note_id = $('#select_' + trindex).val();
        var url;
        <?php $a = Yii::app()->createurl('Service/service/play2');
        echo 'url=' . "'$a'";
        ?> 
        public.dialog('播放和下载录音', url + '&id=' + note_id);
    }
     function viewit(obj)
    { 
        var trindex = $(obj).parents('tr').index();
        var note_id = $('#select_' + trindex).val();
        var url;
        <?php $a = Yii::app()->createurl('Service/service/viewNote');
        echo 'url=' . "'$a'";
        ?> 
        public.dialog('查看小记', url + '&id=' + note_id,{},900);
    }
</script>

