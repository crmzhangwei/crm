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
            <?php echo CHtml::dropDownList('search[dept]', $search['dept'], $this->getDeptArr(), array('onchange' => 'listgroup(this)')); ?>
        </div>
        <div class="form-group"> 
            <?php echo CHtml::dropDownList('search[group]', $search['group'], $this->getGroupArr($search['dept']), array('id' => 'groupinfo','onchange' => 'listuser(this)')); ?>
        </div>
        <div class="form-group"> 
            <?php echo CHtml::dropDownList('search[user]', $search['user'], $this->getUserArr($search['dept'],$search['group']), array('id' => 'userinfo')); ?>
        </div>
        <div class="form-group">
            &nbsp;&nbsp;时间段:
            <input type="text" class="form-control" name="search[stime]" value="<?php echo $search['stime']; ?>" placeholder="" onClick="WdatePicker()">
            to  
            <input type="text" class="form-control" name="search[etime]" value="<?php echo $search['etime']; ?>" placeholder="" onClick="WdatePicker()">
        </div>
        <input type="hidden" name="isexcel" value="0" id="isexcel"/>
        <div class="form-group"> 
            <button type="submit" class="btn btn-info form-control" onclick="sub()">
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
        <a href="<?php echo Yii::app()->createUrl('/Statistics/Count/Month'); ?>">查看月份明细</a>&nbsp;&nbsp;
        <a href="<?php echo Yii::app()->createUrl('/Statistics/Count/Everyday'); ?>">查看每日明细</a>
        <?php if ($search['dept'] && $search['group'] && $search['user']): ?>
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
                    if (!empty($list)):
                        $i = 0;
                        foreach ($list as $k => $v):
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $v['dept_name']; ?></td>
                                <td><?php echo $v['group_name']; ?></td>
                                <td><?php echo $v['user_name']; ?></td>
                                <td><?php echo $v['acct_amount']; ?></td>
                                <td><?php echo $v['acct_number']; ?></td>
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
                        <th style="width: 80px;">排名</th>
                        <th>部门</th>
                        <th>组别</th>
                        <th>金额</th>
                        <th>到单数</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($list)):
                        $i = 0;
                        foreach ($list as $k => $v):
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $v['dept_name']; ?></td>
                                <td><?php echo $v['group_name']; ?></td>
                                <td><?php echo $v['acct_amount']; ?></td>
                                <td><?php echo $v['acct_number']; ?></td>
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
                        <th style="width: 80px;">排名</th>
                        <th>部门</th> 
                        <th>金额</th>
                        <th>到单数</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($list)):
                        $i = 0;
                        foreach ($list as $k => $v):
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $v['dept_name']; ?></td> 
                                <td><?php echo $v['acct_amount']; ?></td>
                                <td><?php echo $v['acct_number']; ?></td>
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
