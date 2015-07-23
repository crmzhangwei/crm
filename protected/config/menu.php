<?php
/**
 * 配置显示的所有的模块
 */
return array(

    'Custom' => array(
        'label' => '客户管理', 'icon' => 'menu-icon fa fa-group', 'url' => array('/Custom/'),
        'items' => array(
			array('label' => '查询分配', 'url' => array('/Customer/customerinfo/admin')),
			array('label' => '客户资源分配', 'url' => array('/Customer/customerass/admin')),
			array('label' => '公海资源', 'url' => array('/Customer/customerblack/admin')),
			array('label' => '联系记录', 'url' => array('/Customer/customerinfo/contact')),
		),
    ),
   
    'Chance' => array(
        'label' => '机会管理', 'icon' => 'menu-icon fa fa-stack-exchange','url' => array('/Chance/'),
         'items' => array(
			array('label' => '安排联系机会', 'url' => array('/Chance/customerInfo/admin')),
			array('label' => '我的机会', 'url' => array('/Chance/customerInfo/todaylist')),
			array('label' => '未联系机会', 'url' => array('/Chance/customerInfo/oldList')),
           ),
    ),
    'TransChance' => array(
        'label' => '成交师-机会管理', 'icon' => 'menu-icon fa fa-stack-exchange','url' => array('/TransChance/'),
         'items' => array(
			array('label' => '安排联系机会', 'url' => array('/TransChance/customerInfo/admin')),
			array('label' => '我的机会', 'url' => array('/TransChance/customerInfo/todaylist')),
			array('label' => '未联系机会', 'url' => array('/TransChance/customerInfo/oldList')),
           ),
    ),

    
     'Statistics' => array(
        'label' => '报表分析','icon' => 'menu-icon fa fa-table', 'url' => array('/Statistics/'),
        'items' => array(
			array('label' => '业绩报表', 'url' => array('/Statistics/count/yeji')),
			array('label' => '联系量统计', 'url' => array('/Statistics/count/contact')),
			array('label' => '话务员工作统计', 'url' => array('/Statistics/trace/workanalyse')),
			array('label' => '安排时间分布', 'url' => array('/Statistics/trace/Timeanalyse')),
			array('label' => '开3, 4类跟踪分析', 'url' => array('/Statistics/trace/cat34')),
			array('label' => '新分资源跟踪分析', 'url' => array('/Statistics/trace/newResource')),
			array('label' => '成交师开14，15，17类跟踪分析', 'url' => array('/Statistics/trace/trans')),
			array('label' => '资源录入统计', 'url' => array('/Statistics/resource/input')),
			array('label' => '资源录入明细', 'url' => array('/Statistics/resource/detail')),
			array('label' => '售后-联系量统计', 'url' => array('/Statistics/after/yeji')),
			array('label' => '售后-新分资源跟踪分析', 'url' => array('/Statistics/after/newResource')),
			array('label' => '售后-续费会员分析', 'url' => array('/Statistics/after/renewals')),
            ),
    ),
    
     'User' => array(
        'label' => '权限管理','icon' => 'menu-icon fa fa-key', 'url' => array('/User/'),
        'items' => array(
			array('label' => '用户管理', 'url' => array('/User/users/admin')),
			array('label' => '部门管理', 'url' => array('/User/deptInfo/admin' )),
			array('label' => '组别管理', 'url' => array('/User/groupInfo/admin')),
            array('label' => '角色管理', 'url' => array('/User/roleInfo/admin')),
			array('label' => '部门组别管理', 'url' => array('/User/deptGroup/admin')),
			array('label' => '人员角色管理', 'url' => array('/User/userRole/admin')),
            array('label' => '菜单资源管理', 'url' => array('/User/menuInfo/admin')),
			array('label' => '角色权限分配', 'url' => array('/User/privilege/admin')),
			array('label' => '分机号管理', 'url' => array('/User/extNumber/admin')),
			array('label' => '短信模板管理', 'url' => array('/User/noteTemplate/admin')),
		),
    ),
    
     'Finance' => array(
        'label' => '财务数据', 'icon' => 'menu-icon fa fa-list-alt','url' => array('/Finance/'),
         'items' => array(
            array('label' => '财务数据录入', 'url' => array('/Finance/finance/create')),
            array('label' => '财务数据查询', 'url' => array('/Finance/finance/admin')),
        ),
    ),
   
      'Service' => array(
        'label' => '售后管理', 'icon' => 'menu-icon  fa fa-user-md','url' => array('/Service/'),
         'items' => array(
            array('label' => '新分客户', 'url' => array('/Service/new/list')),
            array('label' => '今日联系', 'url' => array('/Service/today/list')),
            array('label' => '遗留数据', 'url' => array('/Service/old/list')),
            array('label' => '查询分配', 'url' => array('/Service/service/admin')),
        ),
    ),
      'baseinfo' => array(
        'label' => '基础数据管理', 'icon' => 'menu-icon  fa fa-user-md','url' => array('/Custtype/'),
         'items' => array(
            array('label' => '客户分类', 'url' => array('/Custtype/custtype/admin')),
            array('label' => '字典数据', 'url' => array('/Dictionary/dic/admin')),
        ),
    ),
);
