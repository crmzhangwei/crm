<?php
	$this->breadcrumbs = array(
		'报表分析' ,
		'话务员工作统计',
	);
?>

<div class="row">
    <div class="col-xs-12">     
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'method' => 'post',
            'action' => $this->createUrl('trace/workanalyse'),
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
		<?php echo CHtml::dropDownList( 'search[group]', $search['group'], $this->getGroupArr($search['dept']), array('id'=>'groupinfo')); ?>
            </div>
            <div class="form-group">
				&nbsp;&nbsp;拨打时间段: 
                <input type="text" class="form-control" name="search[stime]" value="<?php echo $search['stime'];?>" placeholder="" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})">
		to  
                <input type="text" class="form-control" name="search[etime]" value="<?php echo $search['etime'];?>" placeholder="" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})">
            </div>
			<div class="form-group">
				&nbsp;&nbsp;通话时长: 
                <input type="text" class="form-control" size="7px"  name="search[mintimes]" value="<?php echo $search['mintimes'];?>" placeholder="" >
		至  
				<input type="text" class="form-control" size="7px"  name="search[maxtimes]" value="<?php echo $search['maxtimes'];?>" placeholder="" >
            </div>
            <div class="form-group"> 
                <button type="button" class="btn btn-info form-control" onclick="sub();">
                    <i class="icon-search"></i>
                    查询
                </button>
            </div> 
            <div class="form-group" style="padding-left: 10px; padding-top: 10px;"> 
                <a href="<?php echo $this->createUrl('workanalyse'); ?>">
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
                    <th>日期</th>
                    <th>工号</th>
                    <th>姓名</th> 
                    <th>呼出次数</th> 
                    <th>呼出时长</th> 
                    <th>首次通话时间</th>  
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)):
                    foreach ($list as $k => $v):
                        ?>
                        <tr>
                            <td><?php echo $k+1; ?></td>
                            <td><?php echo $v['dial_time']; ?></td>
                            <td><?php echo $v['eno']; ?></td>
                            <td><?php echo $v['name']; ?></td> 
                            <td><?php echo $v['dial_num']; ?></td> 
                            <td><?php echo gmstrftime('%H:%M:%S',$v['dial_long']); ?></td> 
                            <td><?php echo $v['min_time']; ?></td>  
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