<?php
	$this->breadcrumbs = array(
		'报表分析' => array('contact'),
		'联系量统计',
	);
?>

<div class="row">
    <div class="col-xs-12">     
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'method' => 'get',
            'action' => $this->createUrl('count/contact'),
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
                <a href="<?php echo $this->createUrl('contact'); ?>">
                    <i class="icon-undo"></i>
                    取消筛选
                </a>
            </div> 
        <?php $this->endWidget(); ?>
        <div class="space-10"></div>
    </div>
    <div class="col-xs-12">
		<?php if($search['dept'] && $search['group'] && $search['users']):?>
			<table class="table table-bordered table-hover table-striped table-projects">
				<thead>
					<tr>
						<th>部门</th>
						<th>组别</th>
						<td>工号</td>
						<th>9-10</th>
						<th>10-11</th>
						<th>11-12</th>
						<th>12-13</th>
						<th>13-14</th>
						<th>14-15</th>
						<th>15-16</th>
						<th>16-17</th>
						<th>17-18</th>
						<th>18-19</th>
						<th>19-20</th>
						<th>20-21</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($resArr)):
						foreach ($resArr as $k => $v):
							?>
							<tr>
								<td><?php echo $v['dname']; ?></td>
								<td><?php echo $v['gname']; ?></td>
								<td><?php echo $v['uname']; ?></td>
								<td><?php echo $v['09']['num'].'|'.$v['09']['longs']; ?></td>
								<td><?php echo $v['10']['num'].'|'.$v['10']['longs']; ?></td>
								<td><?php echo $v['11']['num'].'|'.$v['11']['longs']; ?></td>
								<td><?php echo $v['12']['num'].'|'.$v['12']['longs']; ?></td>
								<td><?php echo $v['13']['num'].'|'.$v['13']['longs']; ?></td>
								<td><?php echo $v['14']['num'].'|'.$v['14']['longs']; ?></td>
								<td><?php echo $v['15']['num'].'|'.$v['15']['longs']; ?></td>
								<td><?php echo $v['16']['num'].'|'.$v['16']['longs']; ?></td>
								<td><?php echo $v['17']['num'].'|'.$v['17']['longs']; ?></td>
								<td><?php echo $v['18']['num'].'|'.$v['18']['longs']; ?></td>
								<td><?php echo $v['19']['num'].'|'.$v['19']['longs']; ?></td>
								<td><?php echo $v['20']['num'].'|'.$v['20']['longs']; ?></td>
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
						<th>部门</th>
						<th>组别</th>
						<th>9-10</th>
						<th>10-11</th>
						<th>11-12</th>
						<th>12-13</th>
						<th>13-14</th>
						<th>14-15</th>
						<th>15-16</th>
						<th>16-17</th>
						<th>17-18</th>
						<th>18-19</th>
						<th>19-20</th>
						<th>20-21</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($resArr)):
						foreach ($resArr as $k => $v):
							?>
							<tr>
								<td><?php echo $v['dname']; ?></td>
								<td><?php echo $v['gname']; ?></td>
								<td><?php echo $v['09']['num'].'|'.$v['09']['longs']; ?></td>
								<td><?php echo $v['10']['num'].'|'.$v['10']['longs']; ?></td>
								<td><?php echo $v['11']['num'].'|'.$v['11']['longs']; ?></td>
								<td><?php echo $v['12']['num'].'|'.$v['12']['longs']; ?></td>
								<td><?php echo $v['13']['num'].'|'.$v['13']['longs']; ?></td>
								<td><?php echo $v['14']['num'].'|'.$v['14']['longs']; ?></td>
								<td><?php echo $v['15']['num'].'|'.$v['15']['longs']; ?></td>
								<td><?php echo $v['16']['num'].'|'.$v['16']['longs']; ?></td>
								<td><?php echo $v['17']['num'].'|'.$v['17']['longs']; ?></td>
								<td><?php echo $v['18']['num'].'|'.$v['18']['longs']; ?></td>
								<td><?php echo $v['19']['num'].'|'.$v['19']['longs']; ?></td>
								<td><?php echo $v['20']['num'].'|'.$v['20']['longs']; ?></td>
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
						<th>部门</th>
						<th>9-10</th>
						<th>10-11</th>
						<th>11-12</th>
						<th>12-13</th>
						<th>13-14</th>
						<th>14-15</th>
						<th>15-16</th>
						<th>16-17</th>
						<th>17-18</th>
						<th>18-19</th>
						<th>19-20</th>
						<th>20-21</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($resArr)):
						foreach ($resArr as $k => $v):
							?>
							<tr>
								<td><?php echo $v['dname']; ?></td>
								<td><?php echo $v['09']['num'].'|'.$v['09']['longs']; ?></td>
								<td><?php echo $v['10']['num'].'|'.$v['10']['longs']; ?></td>
								<td><?php echo $v['11']['num'].'|'.$v['11']['longs']; ?></td>
								<td><?php echo $v['12']['num'].'|'.$v['12']['longs']; ?></td>
								<td><?php echo $v['13']['num'].'|'.$v['13']['longs']; ?></td>
								<td><?php echo $v['14']['num'].'|'.$v['14']['longs']; ?></td>
								<td><?php echo $v['15']['num'].'|'.$v['15']['longs']; ?></td>
								<td><?php echo $v['16']['num'].'|'.$v['16']['longs']; ?></td>
								<td><?php echo $v['17']['num'].'|'.$v['17']['longs']; ?></td>
								<td><?php echo $v['18']['num'].'|'.$v['18']['longs']; ?></td>
								<td><?php echo $v['19']['num'].'|'.$v['19']['longs']; ?></td>
								<td><?php echo $v['20']['num'].'|'.$v['20']['longs']; ?></td>
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
