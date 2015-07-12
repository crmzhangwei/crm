<?php
	$this->breadcrumbs = array(
		'报表分析' ,
		'查看每日明细',
	);
?>

<div class="row">
    <div class="col-xs-12">     
		<?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'everyday-form',
            'method' => 'post',
            //'action' => $this->createUrl('trace/cat34'),
            'htmlOptions' => array(
                'class' => 'form-inline',
                'role' => 'form'
            ),
        ));
        ?>
        <div class="form-group">
			选择月份: 
			<input type="text" class="form-control" name="search[stime]" value="<?php echo $search['stime'];?>" placeholder="" onClick="WdatePicker({dateFmt:'yyyy-MM'})">
		</div>
            <div class="form-group"> 
                <button type="submit" class="btn btn-info form-control">
                    <i class="icon-search"></i>
                    查询
                </button>
            </div> 
		<?php $this->endWidget(); ?>
        <div class="space-10"></div>
    </div>
    <div class="col-xs-12">
		<table class="table table-bordered table-hover table-striped table-projects">
			<thead>
				<tr>
					<th style="width: 80px;">排名</th>
					<th>日期</th>
					<th>金额</th>
					<td>到单数</td>
				</tr>
			</thead>
			<tbody>
				<?php
				if (!empty($result)):
					foreach ($result as $k => $v):
						?>
						<tr>
							<td><?php echo $k+1; ?></td>
							<td><?php echo $v['acct_time']; ?></td>
							<td><?php echo $v['amount']; ?></td>
							<td><?php echo $v['number']; ?></td>
						</tr>
						<?php
					endforeach;
				endif;
				?>
			</tbody>
		</table>
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
 