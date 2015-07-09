<?php
	$this->breadcrumbs = array(
		'报表分析' ,
		'成交师开14、15、17类跟踪分析',
	);
?>

<div class="row">
    <div class="col-xs-12">     
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'method' => 'post',
            'action' => $this->createUrl('trace/trans'),
            'htmlOptions' => array(
                'class' => 'form-inline',
                'role' => 'form'
            ),
        ));
        ?> <div class="form-group">
            开14<input type="radio" name="search[ctype]" value="14" <?php echo $search['ctype']==14?'checked':'';?>/>
            开15<input type="radio" name="search[ctype]" value="15" <?php echo $search['ctype']==15?'checked':'';?>/>
            开17<input type="radio" name="search[ctype]" value="17" <?php echo $search['ctype']==17?'checked':'';?>/>
            </div>
	    <div class="form-group"> 
                <?php echo CHtml::dropDownList( 'search[dept]', '', $this->getDeptArr(), array('onchange'=>'listgroup(this)')); ?>
            </div>
	    <div class="form-group"> 
		<select id="groupinfo" name="search[group]">
			<option value ="0">--请选择组--</option>
		</select>
            </div>
            <div class="form-group">
				&nbsp;&nbsp;时间段: 
                                <input type="text" class="form-control" name="search[stime]" value="<?php echo $search['stime'];?>" placeholder="" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})">
		to  
                <input type="text" class="form-control" name="search[etime]" value="<?php echo $search['etime'];?>" placeholder="" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})">
            </div>
            <div class="form-group"> 
                <button type="submit" class="btn btn-info form-control">
                    <i class="icon-search"></i>
                    查询
                </button>
            </div> 
            <div class="form-group" style="padding-left: 10px; padding-top: 10px;"> 
                <a href="<?php echo $this->createUrl('trans'); ?>">
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
                    <th>序号</th>
                    <th>成交师</th>
                    <th>合计</th>
                    <th>10类</th> 
                    <th>11类</th> 
                    <th>12类</th> 
                    <th>13类</th> 
                    <th>14类</th> 
                    <th>15类</th> 
                    <th>16类</th> 
                    <th>17类</th> 
                    <th>17类%</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)):
                    foreach ($list as $k => $v):
                        ?>
                        <tr>
                            <td><?php echo $k+1; ?></td>
                            <td><?php echo $v['name']; ?></td>
                            <td><?php echo $v['total']; ?></td>
                            <td><?php echo $v['a10']; ?></td> 
                            <td><?php echo $v['a11']; ?></td> 
                            <td><?php echo $v['a12']; ?></td> 
                            <td><?php echo $v['a13']; ?></td>  
                            <td><?php echo $v['a14']; ?></td> 
                            <td><?php echo $v['a15']; ?></td> 
                            <td><?php echo $v['a16']; ?></td> 
                            <td><?php echo $v['a17']; ?></td>
                            <td><?php echo $v['total17']==0?'0%':number_format(100*$v['a17']/$v['total17'],2).'%'; ?></td> 
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