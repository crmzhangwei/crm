<?php
	$this->breadcrumbs = array(
		'报表分析' => array('month'),
		'月份明细',
	);
?>

<div class="row">
		<table class="table table-bordered table-hover table-striped table-projects">
			<thead>
				<tr>
					<th style="width: 80px;">排名</th>
					<th>月份</th>
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
