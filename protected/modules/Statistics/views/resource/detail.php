<?php
	$this->breadcrumbs = array(
		'报表分析',
		'资源录入明细',
	);
?>

<div class="row">
    <div class="col-xs-12">     
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'method' => 'post',
            'action' => $this->createUrl('resource/detail'),
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
				&nbsp;&nbsp;电话: 
                <input type="text" class="form-control" name="search[phone]" value="<?php echo $search['phone'];?>" placeholder="" >
	    </div>
            <div class="form-group">
				&nbsp;&nbsp;qq: 
                <input type="text" class="form-control" name="search[qq]" value="<?php echo $search['qq'];?>" placeholder="" >
	    </div>
            <div class="form-group">
				&nbsp;&nbsp;创建人: 
                <input type="text" class="form-control" name="search[creator]" value="<?php echo $search['creator'];?>" placeholder="" >
	    </div>
            <div class="form-group"> 
                <button type="submit" class="btn btn-info form-control">
                    <i class="icon-search"></i>
                    查询
                </button>
            </div> 
            <div class="form-group" style="padding-left: 10px; padding-top: 10px;"> 
                <a href="<?php echo $this->createUrl('detail'); ?>">
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
                    <th>客户名称</th>
                    <th>店铺名称</th> 
                    <th>店铺网址</th> 
                    <th>店铺地称</th> 
                    <th>电话</th> 
                    <th>QQ</th>  
                    <th>客户类目</th>  
                    <th>邮箱</th>  
                    <th>创建人</th> 
                    <th>创建时间</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)):
                    foreach ($list as $k => $v):
                        ?>
                        <tr>
                            <td><?php echo $k+1; ?></td>
                            <td><?php echo $v['cust_name']; ?></td>
                            <td><?php echo $v['shop_name']; ?></td> 
                            <td><?php echo $v['shop_url']; ?></td>
                            <td><?php echo $v['shop_addr']; ?></td>
                            <td><?php echo Utils::hidePhone($v['phone']) ; ?></td>
                            <td><?php echo $v['qq']; ?></td>
                            <td><?php echo $v['category']; ?></td>
                            <td><?php echo $v['mail']; ?></td>
                            <td><?php echo $v['username']; ?></td>
                            <td><?php echo $v['create_time']; ?></td>
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
 
