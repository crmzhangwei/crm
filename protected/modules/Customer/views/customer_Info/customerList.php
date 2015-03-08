<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>
    </head>
    <body>
    <?php $form=$this->beginWidget('CActiveForm');?>
		<table>
			<tr>
				<td><b>查询条件：</b></td>
			</tr>
			<tr>
				<td><?php echo $form->label($customer_model, 'cust_name');?></td>
				<td><?php echo $form->textField($customer_model, 'cust_name');?></td>&nbsp;&nbsp;
				<td><?php echo $form->label($customer_model, 'shop_name');?></td>
				<td><?php echo $form->textField($customer_model, 'shop_name');?></td>&nbsp;&nbsp;
				<td><?php echo $form->label($customer_model, 'phone');?></td>
				<td><?php echo $form->textField($customer_model, 'phone');?></td>&nbsp;&nbsp;
				<td><?php echo $form->label($customer_model, 'qq');?></td>
				<td><?php echo $form->textField($customer_model, 'qq');?></td>
				<td><input type="submit" value="查询"></td>
			</tr>

		</table>
    <?php $this->endWidget();?>
    <table border="1" width="600px">
    	<tr >
    		<td>工号</td><td>姓名</td><td>联系电话</td><td>QQ</td><td>店铺名称</td><td>公司名称</td>
    		<td>分配时间</td><td>安排联系时间</td><td>邮箱</td>
    	</tr>
    </table>
    </body>
</html>