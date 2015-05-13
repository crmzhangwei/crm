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
		),
    ),
   
    'Chance' => array(
        'label' => '机会管理', 'icon' => 'menu-icon fa fa-stack-exchange','url' => array('/Chance/'),
         'items' => array(
			array('label' => '安排联系机会', 'url' => array('/Chance/customerinfo/admin')),
			array('label' => '我的机会', 'url' => array('/site/page', 'view' => 'about')),
			array('label' => '未联系机会', 'url' => array('/site/contact')),
           ),
    ),
  

    
     'Report' => array(
        'label' => '报表分析','icon' => 'menu-icon fa fa-table', 'url' => array('/Report/'),
        'items' => array(
			array('label' => '业绩报表', 'url' => array('/site/index')),
			array('label' => '联系量统计', 'url' => array('/site/page', 'view' => 'about')),
			array('label' => '话务员工作统计', 'url' => array('/site/contact')),
			array('label' => '安排时间分布', 'url' => array('/site/contact')),
			array('label' => '开3, 4类跟踪分析', 'url' => array('/site/contact')),
			array('label' => '新分资源跟踪分析', 'url' => array('/site/contact')),
			array('label' => '成交师开14，15，17类跟踪分析', 'url' => array('/site/contact')),
			array('label' => '资源录入统计', 'url' => array('/site/contact')),
			array('label' => '售后-联系量统计', 'url' => array('/site/contact')),
			array('label' => '售后-新分资源跟踪分析', 'url' => array('/site/contact')),
			array('label' => '售后-续费会员分析', 'url' => array('/site/contact')),
            ),
    ),
    
     'User' => array(
        'label' => '权限管理','icon' => 'menu-icon fa fa-key', 'url' => array('/User/'),
        'items' => array(
			array('label' => '用户管理', 'url' => array('/User/users/admin')),
			array('label' => '部门管理', 'url' => array('/User/deptinfo/admin' )),
			array('label' => '组别管理', 'url' => array('/User/groupinfo/admin')),
			array('label' => '部门组别管理', 'url' => array('/User/deptgroup/admin')),
			array('label' => '人员角色管理', 'url' => array('/User/userrole/admin')),
			array('label' => '角色管理', 'url' => array('/User/roleinfo/admin')),
                        array('label' => '菜单资源管理', 'url' => array('/User/menuinfo/admin')),
			array('label' => '权限配置', 'url' => array('/User/privilege/admin')),
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
            array('label' => '新分客户', 'url' => array('/Service/service/newList')),
            array('label' => '今日联系', 'url' => array('/Service/service/todayList')),
            array('label' => '遗留数据', 'url' => array('/Service/service/oldList')),
            array('label' => '查询分配', 'url' => array('/Service/service/admin')),
        ),
    ),
      'baseinfo' => array(
        'label' => '基础数据管理', 'icon' => 'menu-icon  fa fa-user-md','url' => array('/Service/'),
         'items' => array(
            array('label' => '客户分类', 'url' => array('/Custtype/custtype/admin')),
            array('label' => '字典数据', 'url' => array('/Dictionary/dic/admin')),
        ),
    ),
);
