<?php
	$this->breadcrumbs = array(
		'报表分析' ,
		'安排时间分布',
	);
?>

<div class="row">
    <div class="col-xs-12">     
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'method' => 'post',
            'action' => $this->createUrl('trace/timeanalyse'),
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
                <a href="<?php echo $this->createUrl('timeanalyse'); ?>">
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
                    <th>下次联系时间</th> 
                    <th>0类</th> 
                    <th>1类</th> 
                    <th>2类</th> 
                    <th>3类</th> 
                    <th>4类</th> 
                    <th>5类</th> 
                    <th>6类</th> 
                    <th>7类</th>
                    <th>8类</th>
                    <th>9类</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)):
                    foreach ($list as $k => $v):
                       if($v['next_time']=='各成熟度资源占比'):
                           echo "<tr>";
                               echo "<td>".($k+1)."</td>";
                               echo "<td>".$v['next_time']."</td>";
                               echo "<td>".  number_format($v['total']==0?'0':100*$v['a0']/$v['total'],2)."%</td>";
                               echo "<td>".number_format($v['total']==0?'0':100*$v['a1']/$v['total'],2)."%</td>";
                               echo "<td>".number_format($v['total']==0?'0':100*$v['a2']/$v['total'],2)."%</td>";
                               echo "<td>".number_format($v['total']==0?'0':100*$v['a3']/$v['total'],2)."%</td>";
                               echo "<td>".number_format($v['total']==0?'0':100*$v['a4']/$v['total'],2)."%</td>";
                               echo "<td>".number_format($v['total']==0?'0':100*$v['a5']/$v['total'],2)."%</td>";
                               echo "<td>".number_format($v['total']==0?'0':100*$v['a6']/$v['total'],2)."%</td>";
                               echo "<td>".number_format($v['total']==0?'0':100*$v['a7']/$v['total'],2)."%</td>";
                               echo "<td>".number_format($v['total']==0?'0':100*$v['a8']/$v['total'],2)."%</td>";
                               echo "<td>".number_format($v['total']==0?'0':100*$v['a9']/$v['total'],2)."%</td>";
                            echo "</tr>"; 
                        elseif($v['next_time']=='各成熟度人均库存'):
                            echo "<tr>";
                               echo "<td>".($k+1)."</td>";
                               echo "<td>".$v['next_time']."</td>";
                               echo "<td>".number_format($days==0?"0":$v['a0']/$days,2)."</td>";
                               echo "<td>".number_format($days==0?"0":$v['a1']/$days,2)."</td>";
                               echo "<td>".number_format($days==0?"0":$v['a2']/$days,2)."</td>";
                               echo "<td>".number_format($days==0?"0":$v['a3']/$days,2)."</td>";
                               echo "<td>".number_format($days==0?"0":$v['a4']/$days,2)."</td>";
                               echo "<td>".number_format($days==0?"0":$v['a5']/$days,2)."</td>";
                               echo "<td>".number_format($days==0?"0":$v['a6']/$days,2)."</td>";
                               echo "<td>".number_format($days==0?"0":$v['a7']/$days,2)."</td>";
                               echo "<td>".number_format($days==0?"0":$v['a8']/$days,2)."</td>";
                               echo "<td>".number_format($days==0?"0":$v['a9']/$days,2)."</td>";
                            echo "</tr>"; 
                        else:
                ?>
                        <tr>
                            <td><?php echo $k+1; ?></td>
                            <td><?php echo $v['next_time']; ?></td>
                            <td><?php echo $v['a0']; ?></td> 
                            <td><?php echo $v['a1']; ?></td> 
                            <td><?php echo $v['a2']; ?></td> 
                            <td><?php echo $v['a3']; ?></td>  
                            <td><?php echo $v['a4']; ?></td> 
                            <td><?php echo $v['a5']; ?></td> 
                            <td><?php echo $v['a6']; ?></td>  
                            <td><?php echo $v['a7']; ?></td> 
                            <td><?php echo $v['a8']; ?></td> 
                            <td><?php echo $v['a9']; ?></td> 
                        </tr>
                        <?php
                       endif; 
                    endforeach;
                endif;
                ?>
            </tbody>
        </table> 
    </div>

</div> <!-- .row -->
<div class="space-20"></div>
 
 <script src="/static/js/secondlevel.js"></script>