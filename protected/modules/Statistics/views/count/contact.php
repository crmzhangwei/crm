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
        <input type="hidden" name="isexcel" value="0" id="isexcel"/>
        <div class="form-group"> 
            <?php echo CHtml::dropDownList('search[dept]', $search['dept'], $this->getDeptArr(), array('onchange' => 'listgroup(this)')); ?>
        </div>
        <div class="form-group"> 
            <?php echo CHtml::dropDownList('search[group]', $search['group'], $this->getGroupArr($search['dept']), array('id' => 'groupinfo', 'onchange' => 'listuser(this)')); ?>
        </div>
        <div class="form-group"> 
            <?php echo CHtml::dropDownList('search[user]', $search['user'], $this->getUserArr($search['dept'], $search['group']), array('id' => 'userinfo')); ?>
        </div>
        
        <div class="form-group">
            &nbsp;&nbsp;时间段:
            <input type="text" class="form-control" name="search[stime]" value="<?php echo $search['stime']; ?>" placeholder="" onClick="WdatePicker()">
            to  
            <input type="text" class="form-control" name="search[etime]" value="<?php echo $search['etime']; ?>" placeholder="" onClick="WdatePicker()">
        </div>
        <div class="form-group"> 
            <button type="submit" class="btn btn-info form-control" onclick="sub()">
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
        <?php if ($search['dept'] && $search['group'] && $search['user']): ?>
            <table class="table table-bordered table-hover table-striped table-projects">
                <thead>
                    <tr>
                        <th>部门</th>
                        <th>组别</th>
                        <th>工号</th>
                        <th>合计</th>
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
                                <td><?php echo $v['dept_name']; ?></td>
                                <td><?php echo $v['group_name']; ?></td>
                                <td><?php echo $v['user_name']; ?></td>
                                <td><?php echo $v['dial_num'] . '|' . $v['dial_long']; ?></td> 
                                <td><?php echo $v['a9'] . '|' . $v['b9']; ?></td>
                                <td><?php echo $v['a10'] . '|' . $v['b10']; ?></td>
                                <td><?php echo $v['a11'] . '|' . $v['b11']; ?></td>
                                <td><?php echo $v['a12'] . '|' . $v['b12']; ?></td>
                                <td><?php echo $v['a13'] . '|' . $v['b13']; ?></td>
                                <td><?php echo $v['a14'] . '|' . $v['b14']; ?></td>
                                <td><?php echo $v['a15'] . '|' . $v['b15']; ?></td>
                                <td><?php echo $v['a16'] . '|' . $v['b16']; ?></td>
                                <td><?php echo $v['a17'] . '|' . $v['b17']; ?></td>
                                <td><?php echo $v['a18'] . '|' . $v['b18']; ?></td>
                                <td><?php echo $v['a19'] . '|' . $v['b19']; ?></td>
                                <td><?php echo $v['a20'] . '|' . $v['b20']; ?></td>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        <?php elseif ($search['dept'] && $search['group']): ?>
            <table class="table table-bordered table-hover table-striped table-projects">
                <thead>
                    <tr>
                        <th>部门</th>
                        <th>组别</th>
                        <th>合计</th>
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
                                <td><?php echo $v['dept_name']; ?></td>
                                <td><?php echo $v['group_name']; ?></td>
                                <td><?php echo $v['dial_num'] . '|' . $v['dial_long']; ?></td> 
                                <td><?php echo $v['a9'] . '|' . $v['b9']; ?></td>
                                <td><?php echo $v['a10'] . '|' . $v['b10']; ?></td>
                                <td><?php echo $v['a11'] . '|' . $v['b11']; ?></td>
                                <td><?php echo $v['a12'] . '|' . $v['b12']; ?></td>
                                <td><?php echo $v['a13'] . '|' . $v['b13']; ?></td>
                                <td><?php echo $v['a14'] . '|' . $v['b14']; ?></td>
                                <td><?php echo $v['a15'] . '|' . $v['b15']; ?></td>
                                <td><?php echo $v['a16'] . '|' . $v['b16']; ?></td>
                                <td><?php echo $v['a17'] . '|' . $v['b17']; ?></td>
                                <td><?php echo $v['a18'] . '|' . $v['b18']; ?></td>
                                <td><?php echo $v['a19'] . '|' . $v['b19']; ?></td>
                                <td><?php echo $v['a20'] . '|' . $v['b20']; ?></td>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <table class="table table-bordered table-hover table-striped table-projects">
                <thead>
                    <tr>
                        <th>部门</th>
                        <th>合计</th>
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
                                <td><?php echo $v['dept_name']; ?></td>
                                <td><?php echo $v['dial_num'] . '|' . $v['dial_long']; ?></td> 
                                <td><?php echo $v['a9'] . '|' . $v['b9']; ?></td>
                                <td><?php echo $v['a10'] . '|' . $v['b10']; ?></td>
                                <td><?php echo $v['a11'] . '|' . $v['b11']; ?></td>
                                <td><?php echo $v['a12'] . '|' . $v['b12']; ?></td>
                                <td><?php echo $v['a13'] . '|' . $v['b13']; ?></td>
                                <td><?php echo $v['a14'] . '|' . $v['b14']; ?></td>
                                <td><?php echo $v['a15'] . '|' . $v['b15']; ?></td>
                                <td><?php echo $v['a16'] . '|' . $v['b16']; ?></td>
                                <td><?php echo $v['a17'] . '|' . $v['b17']; ?></td>
                                <td><?php echo $v['a18'] . '|' . $v['b18']; ?></td>
                                <td><?php echo $v['a19'] . '|' . $v['b19']; ?></td>
                                <td><?php echo $v['a20'] . '|' . $v['b20']; ?></td>
                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
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
