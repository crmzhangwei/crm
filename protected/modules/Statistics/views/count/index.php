<?php
/* @var $this DefaultController */
$this->pageTitle='联系量统计';
$this->breadcrumbs=array(
	'联系量统计',
);
?>
<div class="page-header">
    <h1>
        联系量统计
    </h1>
</div>
<div class="row">
    <div class="col-xs-12">     
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'method' => 'get',
            'action' => $this->createUrl('count/index'),
            'htmlOptions' => array(
                'class' => 'form-inline',
                'role' => 'form'
            ),
        ));
        ?>
            <div class="form-group"> 
                
            </div>
            <div class="form-group"> 
               
            </div>
            <div class="form-group"> 
                <input type="text" class="form-control" name="" value="" placeholder="写上相关查询条件">
            </div>

        
            <div class="form-group"> 
                <button type="submit" class="btn btn-info form-control">
                    <i class="icon-search"></i>
                    查询
                </button>
            </div> 
            <div class="form-group" style="padding-left: 10px; padding-top: 10px;"> 
                <a href="<?php echo $this->createUrl('index'); ?>">
                    <i class="icon-undo"></i>
                    取消筛选
                </a>
            </div> 
        <?php $this->endWidget(); ?>
        <div class="space-10"></div>
    </div>
    <div class="col-xs-12">
        <table class="table table-bordered table-hover table-striped table-projects">
            <thead>
                <tr>
                    <th style="width: 80px;"></th>
                    <th>时间</th>
                    <th>时长</th>
                    <th>合计</th>
                    <th>9-10</th>
                    <th>10-11</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($crmlist)):
                    foreach ($crmlist as $k => $v):
                        ?>
                        <tr>
                            <td><?php echo $v['id']; ?></td>
                            <td><?php echo $v['d']; ?></td>
                            <td><?php echo $v['l']; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                         
                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
        <!-- .pagination -->
        <div class="row table-page">
            <div class="col-sm-6"> 
                共<span class="orange"><?php echo $total; ?></span>条记录
            </div>
            <div class="col-sm-6 no-padding-right"> 
                <?php
                $this->widget('GLinkPager', array(
                    'pages' => $pages,
                        )
                );
                ?> 
            </div>
        </div>
    </div>

</div> <!-- .row -->
<div class="space-20"></div>
