<?php
	$this->breadcrumbs = array(
		'报表分析' => array('month'),
		'重复分机号',
	);
?>

<div class="row">
		<table class="table table-bordered table-hover table-striped table-projects">
			<thead>
				<tr> 
                                        <th>姓名</th>
					<th>分机号</th> 
				</tr>
			</thead>
			<tbody>
				<?php
				if (!empty($result)):
					foreach ($result as $k => $v):
						?>
						<tr> 
                                                        <td><?php echo $v['name']; ?></td>
							<td><?php echo $v['extend_no']; ?></td> 
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
