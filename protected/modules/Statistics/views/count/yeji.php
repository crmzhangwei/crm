<?php
	$this->breadcrumbs = array(
		'报表分析' => array('yeji'),
		'业绩报表',
	);
?>

<div class="row">
    <div class="col-xs-12">     
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'method' => 'get',
            'action' => $this->createUrl('count/yeji'),
            'htmlOptions' => array(
                'class' => 'form-inline',
                'role' => 'form'
            ),
        ));
        ?>
       
			<div class="form-group"> 
                <?php echo CHtml::dropDownList( 'search[dept]', '', $deptArr, array('onchange'=>'listgroup(this)')); ?>
            </div>
			<div class="form-group"> 
				<select id="groupinfo" name="search[group]">
					<option value ="0">--请选择组--</option>
				</select>
            </div>
			<div class="form-group">
				&nbsp;&nbsp;时间段:
				<input type="text" class="form-control" name="search[stime]" value="" placeholder="" onClick="WdatePicker()">
				to  
				<input type="text" class="form-control" name="search[ftime]" value="" placeholder="" onClick="WdatePicker()">
			</div>
            <div class="form-group"> 
                <button type="submit" class="btn btn-info form-control">
                    <i class="icon-search"></i>
                    查询
                </button>
            </div> 
            <div class="form-group" style="padding-left: 10px; padding-top: 10px;"> 
                <a href="<?php echo $this->createUrl('yeji'); ?>">
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
                    <th style="width: 80px;">排名</th>
                    <th>部门</th>
                    <th>组别</th>
                    <th>金额</th>
                    <th>到单数</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($resArr)):
                    foreach ($resArr as $k => $v):
                        ?>
                        <tr>
                            <td><?php echo $k+1; ?></td>
                            <td><?php echo $v['dname']; ?></td>
                            <td><?php echo $v['gname']; ?></td>
                            <td><?php echo $v['amount']; ?></td>
                            <td><?php echo $v['number']; ?></td>
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
                
            </div>
        </div>
    </div>

</div> <!-- .row -->
<div class="space-20"></div>

<script src="/static/js/secondlevel.js"></script>
