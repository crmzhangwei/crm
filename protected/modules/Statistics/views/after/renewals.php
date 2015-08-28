<?php
	$this->breadcrumbs = array(
		'报表分析',
		'售后-续费会员分析',
	);
?>

<div class="row">
    <div class="col-xs-12">     
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'method' => 'post',
            'action' => $this->createUrl('after/renewals'),
            'htmlOptions' => array(
                'class' => 'form-inline',
                'role' => 'form'
            ),
        ));
        ?> 
            <input type="hidden" name="isexcel" value="0" id="isexcel"/>
             <div class="form-group"> 
                <?php echo CHtml::dropDownList( 'search[dept]', $search['dept'], $this->getDeptArr(), array('onchange'=>'listgroup(this)')); ?>
            </div>
	    <div class="form-group">  
                <?php echo CHtml::dropDownList( 'search[group]', $search['group'], $this->getGroupArr($search['dept']), array('onchange'=>'listgroup(this)','id'=>'groupinfo')); ?>
            </div>
            <div class="form-group"> 
                <button type="button" class="btn btn-info form-control" onclick="sub();">
                    <i class="icon-search"></i>
                    查询
                </button>
            </div> 
            <div class="form-group" style="padding-left: 10px; padding-top: 10px;"> 
                <a href="<?php echo $this->createUrl('renewals'); ?>">
                    <i class="icon-undo"></i>
                    取消筛选
                </a>
            </div> 
            <div class="form-group" style="float:right;"> 
                <button type="button" class="btn btn-info form-control" onclick="exportToExcel()">
                    <i class="icon-search"></i>
                    导出excel
                </button>
            </div>
        <?php $this->endWidget(); ?>
        <div class="space-10"></div>
    </div>
    <div class="col-xs-12">
        <table class="table table-bordered table-hover table-striped table-projects">
            <thead>
                <tr> 
                    <th>序号</th>
                    <th>客户名称</th>
                    <th>转换时间</th>
                    <th>金额</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)):
                    foreach ($list as $k => $v):
                        ?>
                        <tr>
                            <td><?php echo $k+1; ?></td>
                            <td><?php echo $v['cust_name']; ?></td>
                            <td><?php echo $v['convt_time']; ?></td>
                            <td><?php echo $v['total_money']; ?></td> 
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
            $this->widget('GLinkPager', array('pages' => $pages,));
            ?>
            </div>
        </div>
    </div>

</div> <!-- .row -->
<div class="space-20"></div>
 <script src="/static/js/secondlevel.js"></script>
