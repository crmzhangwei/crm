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
       
			<?php echo CHtml::dropDownList('search[dept]', $infoArr['dept'], $deptArr, array('onchange' => 'listgroup(this)')); ?>
			<?php if(!$user_info['group_arr']):?>
			<select id="groupinfo" name="search[group]" onchange="listuser(this)">
				<option value ="0">--请选择组--</option>
			</select>
			<?php else:
				echo CHtml::dropDownList('search[group]', intval($infoArr['group']), $user_info['group_arr'], array('onchange'=>"listuser(this)",'id'=>'groupinfo'));
			endif;?>

			<?php if(!$user_info['user_arr']):?>
			<select id='userinfo' name="search[users]" onchange="enoval(this)">	
				<option value ="0">---请选择人员---</option>
			</select>
			<?php else:
				echo   CHtml::dropDownList('search[users]', $infoArr['users'], $user_info['user_arr'], array('id'=>"userinfo",'onchange'=>"enoval(this)"));
			endif;?>
			
			<div class="form-group">
				&nbsp;&nbsp;时间段:
				<input type="text" class="form-control" name="search[stime]" value="<?php echo $search['stime'];?>" placeholder="" onClick="WdatePicker()">
				to  
				<input type="text" class="form-control" name="search[ftime]" value="<?php echo $search['ftime'];?>" placeholder="" onClick="WdatePicker()">
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
		<a href="<?php echo Yii::app()->createUrl('/Statistics/Count/Month');?>">查看月份明细</a>&nbsp;&nbsp;
		<a href="<?php echo Yii::app()->createUrl('/Statistics/Count/Everyday');?>">查看每日明细</a>
		<?php if($search['dept'] && $search['group'] && $search['users']):?>
			<table class="table table-bordered table-hover table-striped table-projects">
				<thead>
					<tr>
						<th style="width: 80px;">排名</th>
						<th>部门</th>
						<th>组别</th>
						<td>工号</td>
						<th>金额</th>
						<th>到单数</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($resArr)):
						$i = 0;
						foreach ($resArr as $k => $v):
							$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $v['dname']; ?></td>
								<td><?php echo $v['gname']; ?></td>
								<td><?php echo $v['uname']; ?></td>
								<td><?php echo $v['amount']; ?></td>
								<td><?php echo $v['number']; ?></td>
							</tr>
							<?php
						endforeach;
					endif;
					?>
				</tbody>
			</table>
		<?php elseif($search['dept'] && $search['group']):?>
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
						$i=0;
						foreach ($resArr as $k => $v):
							$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
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
		<?php else:?>
			<table class="table table-bordered table-hover table-striped table-projects">
				<thead>
					<tr>
						<th style="width: 80px;">排名</th>
						<th>部门</th>
						<td>组别</td>
						<th>金额</th>
						<th>到单数</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($resArr)):
						$i=0;
						foreach ($resArr as $k => $v):
							$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
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
		<?php endif;?>
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
