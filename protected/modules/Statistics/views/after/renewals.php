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
            'method' => 'post',
            'action' => $this->createUrl('after/yeji'),
            'htmlOptions' => array(
                'class' => 'form-inline',
                'role' => 'form'
            ),
        ));
        ?> 
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
                    <th>序号</th>
                    <th>日期</th>
                    <th>工号</th>
                    <th>姓名</th>
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
                if (!empty($list)):
                    foreach ($list as $k => $v):
                        ?>
                        <tr>
                            <td><?php echo $k+1; ?></td>
                            <td><?php echo $v['dial_time']; ?></td>
                            <td><?php echo $v['eno']; ?></td>
                            <td><?php echo $v['name']; ?></td>
                            <td><?php echo $v['a9']; ?></td>
                            <td><?php echo $v['a10']; ?></td>
                            <td><?php echo $v['a11']; ?></td>
                            <td><?php echo $v['a12']; ?></td>
                            <td><?php echo $v['a13']; ?></td>
                            <td><?php echo $v['a14']; ?></td>
                            <td><?php echo $v['a15']; ?></td>
                            <td><?php echo $v['a16']; ?></td>
                            <td><?php echo $v['a17']; ?></td>
                            <td><?php echo $v['a18']; ?></td>
                            <td><?php echo $v['a19']; ?></td>
                            <td><?php echo $v['a20']; ?></td> 
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
 
