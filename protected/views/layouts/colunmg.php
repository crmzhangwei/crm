<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html >
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/font-awesome/4.1.0/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->

        <!-- text fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace.min.css" id="main-ace-style" />

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/ace-extra.min.js"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/html5shiv.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

        <body class="no-skin">
            <div id="navbar" class="navbar navbar-default">
                <script type="text/javascript">
                    try {
                        ace.settings.check('navbar', 'fixed')
                    } catch (e) {
                    }
                </script>

                <div class="navbar-container" id="navbar-container">
                    <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
                        <span class="sr-only">Toggle sidebar</span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>
                    </button>

                    <div class="navbar-header pull-left">
                        <a href="#" class="navbar-brand">
                            <small>
                                <i class="fa fa-leaf"></i>
                                <?php echo CHtml::encode(Yii::app()->name); ?>
                            </small>
                        </a>
                    </div>

                    <div class="navbar-buttons navbar-header pull-right" role="navigation">
                        <ul class="nav ace-nav">
                            <li class="grey">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="ace-icon fa fa-tasks"></i>
                                    <span class="badge badge-grey">4</span>
                                </a>

                                <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                    <li class="dropdown-header">
                                        <i class="ace-icon fa fa-check"></i>
                                        4 Tasks to complete
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">Software Update</span>
                                                <span class="pull-right">65%</span>
                                            </div>

                                            <div class="progress progress-mini">
                                                <div style="width:65%" class="progress-bar"></div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">Hardware Upgrade</span>
                                                <span class="pull-right">35%</span>
                                            </div>

                                            <div class="progress progress-mini">
                                                <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">Unit Testing</span>
                                                <span class="pull-right">15%</span>
                                            </div>

                                            <div class="progress progress-mini">
                                                <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">Bug Fixes</span>
                                                <span class="pull-right">90%</span>
                                            </div>

                                            <div class="progress progress-mini progress-striped active">
                                                <div style="width:90%" class="progress-bar progress-bar-success"></div>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="dropdown-footer">
                                        <a href="#">
                                            See tasks with details
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="purple">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                                    <span class="badge badge-important">8</span>
                                </a>

                                <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                                    <li class="dropdown-header">
                                        <i class="ace-icon fa fa-exclamation-triangle"></i>
                                        8 Notifications
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
                                                    New Comments
                                                </span>
                                                <span class="pull-right badge badge-info">+12</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="btn btn-xs btn-primary fa fa-user"></i>
                                            Bob just signed up as an editor ...
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                                                    New Orders
                                                </span>
                                                <span class="pull-right badge badge-success">+8</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <div class="clearfix">
                                                <span class="pull-left">
                                                    <i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
                                                    Followers
                                                </span>
                                                <span class="pull-right badge badge-info">+11</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="dropdown-footer">
                                        <a href="#">
                                            See all notifications
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="green">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                                    <span class="badge badge-success">5</span>
                                </a>

                                <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                    <li class="dropdown-header">
                                        <i class="ace-icon fa fa-envelope-o"></i>
                                        5 Messages
                                    </li>

                                    <li class="dropdown-content">
                                        <ul class="dropdown-menu dropdown-navbar">
                                            <li>
                                                <a href="#">
                                                    <img src="assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                                                    <span class="msg-body">
                                                        <span class="msg-title">
                                                            <span class="blue">Alex:</span>
                                                            Ciao sociis natoque penatibus et auctor ...
                                                        </span>

                                                        <span class="msg-time">
                                                            <i class="ace-icon fa fa-clock-o"></i>
                                                            <span>a moment ago</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <img src="assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                                    <span class="msg-body">
                                                        <span class="msg-title">
                                                            <span class="blue">Susan:</span>
                                                            Vestibulum id ligula porta felis euismod ...
                                                        </span>

                                                        <span class="msg-time">
                                                            <i class="ace-icon fa fa-clock-o"></i>
                                                            <span>20 minutes ago</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <img src="assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                                                    <span class="msg-body">
                                                        <span class="msg-title">
                                                            <span class="blue">Bob:</span>
                                                            Nullam quis risus eget urna mollis ornare ...
                                                        </span>

                                                        <span class="msg-time">
                                                            <i class="ace-icon fa fa-clock-o"></i>
                                                            <span>3:15 pm</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <img src="assets/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
                                                    <span class="msg-body">
                                                        <span class="msg-title">
                                                            <span class="blue">Kate:</span>
                                                            Ciao sociis natoque eget urna mollis ornare ...
                                                        </span>

                                                        <span class="msg-time">
                                                            <i class="ace-icon fa fa-clock-o"></i>
                                                            <span>1:33 pm</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <img src="assets/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
                                                    <span class="msg-body">
                                                        <span class="msg-title">
                                                            <span class="blue">Fred:</span>
                                                            Vestibulum id penatibus et auctor  ...
                                                        </span>

                                                        <span class="msg-time">
                                                            <i class="ace-icon fa fa-clock-o"></i>
                                                            <span>10:09 am</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="dropdown-footer">
                                        <a href="inbox.html">
                                            See all messages
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="light-blue">
                                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                    <img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
                                    <span class="user-info">
                                        <small>Welcome,</small>
                                        Jason
                                    </span>

                                    <i class="ace-icon fa fa-caret-down"></i>
                                </a>

                                <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-cog"></i>
                                            Settings
                                        </a>
                                    </li>

                                    <li>
                                        <a href="profile.html">
                                            <i class="ace-icon fa fa-user"></i>
                                            个人信息
                                        </a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">
                                            <i class="ace-icon fa fa-power-off"></i>
                                            退出账号
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div><!-- /.navbar-container -->
            </div>

            <div class="main-container" id="main-container">
                <script type="text/javascript">
                    try {
                        ace.settings.check('main-container', 'fixed')
                    } catch (e) {
                    }
                </script>

                <div id="sidebar" class="sidebar                  responsive">
                    <script type="text/javascript">
                        try {
                            ace.settings.check('sidebar', 'fixed')
                        } catch (e) {
                        }
                    </script>

                    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                            <button class="btn btn-success">
                                <i class="ace-icon fa fa-signal"></i>
                            </button>

                            <button class="btn btn-info">
                                <i class="ace-icon fa fa-pencil"></i>
                            </button>

                            <button class="btn btn-warning">
                                <i class="ace-icon fa fa-users"></i>
                            </button>

                            <button class="btn btn-danger">
                                <i class="ace-icon fa fa-cogs"></i>
                            </button>
                        </div>

                        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                            <span class="btn btn-success"></span>

                            <span class="btn btn-info"></span>

                            <span class="btn btn-warning"></span>

                            <span class="btn btn-danger"></span>
                        </div>
                    </div><!-- /.sidebar-shortcuts -->

                    <ul class="nav nav-list">
                        <li class="active">
                            <a href="index.html">
                                <i class="menu-icon fa fa-tachometer"></i>
                                <span class="menu-text"> Dashboard </span>
                            </a>
                            <b class="arrow"></b>
                        </li>


                        
                        <li class="hsub">
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-group"></i>
                                <span class="menu-text"> 客户管理 </span>

                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <?php $this->widget('zii.widgets.CMenu',array(
                                'items'=>array(
                                    array('label'=>'查询分配', 'url'=>array('/Customer/customer_Info/customerList')),
                                    array('label'=>'客户资源分配', 'url'=>array('/site/page', 'view'=>'about')),
                                    array('label'=>'公海资源', 'url'=>array('/site/contact')),
                                    ),
                                'htmlOptions'=>array('class'=>'submenu nav-hide'),
                            )); ?>                      
                        </li>                       


                        <li class="hsub">
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-stack-exchange"></i>
                                <span class="menu-text"> 机会管理 </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <?php $this->widget('zii.widgets.CMenu',array(
                                'items'=>array(
                                    array('label'=>'安排联系机会', 'url'=>array('/site/index')),
                                    array('label'=>'我的机会', 'url'=>array('/site/page', 'view'=>'about')),
                                    array('label'=>'未联系机会', 'url'=>array('/site/contact')),
                                    ),
                                'htmlOptions'=>array('class'=>'submenu nav-hide'),
                            )); ?>                      
                        </li>


                        <li class="hsub">
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-table"></i>
                                <span class="menu-text"> 报表分析 </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <?php $this->widget('zii.widgets.CMenu',array(
                                'items'=>array(
                                    array('label'=>'业绩报表', 'url'=>array('/site/index')),
                                    array('label'=>'联系量统计', 'url'=>array('/site/page', 'view'=>'about')),
                                    array('label'=>'话务员工作统计', 'url'=>array('/site/contact')),
                                    array('label'=>'安排时间分布', 'url'=>array('/site/contact')),
                                    array('label'=>'开3, 4类跟踪分析', 'url'=>array('/site/contact')),
                                    array('label'=>'新分资源跟踪分析', 'url'=>array('/site/contact')),
                                    array('label'=>'成交师开14，15，17类跟踪分析', 'url'=>array('/site/contact')),
                                    array('label'=>'资源录入统计', 'url'=>array('/site/contact')),
                                    array('label'=>'售后-联系量统计', 'url'=>array('/site/contact')),
                                    array('label'=>'售后-新分资源跟踪分析', 'url'=>array('/site/contact')),
                                    array('label'=>'售后-续费会员分析', 'url'=>array('/site/contact')),
                                    ),
                                'htmlOptions'=>array('class'=>'submenu nav-hide'),
                            )); ?>                      
                        </li>


                        <li class="hsub">
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-key"></i>
                                <span class="menu-text"> 权限管理 </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <?php $this->widget('zii.widgets.CMenu',array(
                                'items'=>array(
                                    array('label'=>'用户管理', 'url'=>array('/site/index')),
                                    array('label'=>'部门管理', 'url'=>array('/site/page', 'view'=>'about')),
                                    array('label'=>'组别管理', 'url'=>array('/site/contact')),
                                    array('label'=>'部门组别管理', 'url'=>array('/site/contact')),
                                    array('label'=>'菜单资源管理', 'url'=>array('/site/contact')),
                                    array('label'=>'角色管理', 'url'=>array('/site/contact')),
                                    array('label'=>'权限配置', 'url'=>array('/site/contact')),
                                    ),
                                'htmlOptions'=>array('class'=>'submenu nav-hide'),
                            )); ?>                      
                        </li>
                        

                        <li class="hsub">
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-list-alt"></i>
                                <span class="menu-text"> 财务数据 </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <?php $this->widget('zii.widgets.CMenu',array(
                                'items'=>array(
                                    array('label'=>'财务数据录入', 'url'=>array('/site/index')),
                                    array('label'=>'财务数据查询', 'url'=>array('/site/page', 'view'=>'about')),
                                    ),
                                'htmlOptions'=>array('class'=>'submenu nav-hide'),
                            )); ?>                      
                        </li>


                        <li class="hsub">
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-user-md"></i>
                                <span class="menu-text"> 售后管理 </span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>
                            <?php $this->widget('zii.widgets.CMenu',array(
                                'items'=>array(
                                    array('label'=>'新分客户', 'url'=>array('/site/index')),
                                    array('label'=>'今日联系', 'url'=>array('/site/page', 'view'=>'about')),
                                    array('label'=>'遗留数据', 'url'=>array('/site/page', 'view'=>'about')),
                                    array('label'=>'查询分配', 'url'=>array('/site/page', 'view'=>'about')),
                                    ),
                                'htmlOptions'=>array('class'=>'submenu nav-hide'),
                            )); ?>                      
                        </li>

                    </ul><!-- /.nav-list -->

                    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                    </div>

                    <script type="text/javascript">
                        try {
                            ace.settings.check('sidebar', 'collapsed')
                        } catch (e) {
                        }
                    </script>
                </div>

                <div class="main-content">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try {
                                ace.settings.check('breadcrumbs', 'fixed')
                            } catch (e) {
                            }
                        </script>
                        <!-- /.breadcrumb -->
                        <?php if (isset($this->breadcrumbs)): ?>
                            <?php
                            $this->widget('GBreadcrumbs', array(
                                'links' => $this->breadcrumbs,
                            ));
                            ?><!-- breadcrumbs -->
                        <?php endif ?>
                        <div class="nav-search" id="nav-search">
                            <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div><!-- /.nav-search -->
                    </div>

                    <div class="page-content">
                        <div class="page-content-area">

                            <div class="row">
                                <div class="col-xs-12">

                                    <?php echo $content; ?>	

                                    <!-- PAGE CONTENT ENDS -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.page-content-area -->
                    </div><!-- /.page-content -->
                </div><!-- /.main-content -->

                <div class="footer">
                    <div class="footer-inner">
                        <div class="footer-content">
                            <span class="bigger-120">
                                <span class="blue bolder"><?php echo Yii::powered(); ?></span>
                                Application &copy; 2013-<?php echo date('Y'); ?>
                            </span>
                            &nbsp; &nbsp;
                        </div>
                    </div>
                </div>

                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
                </a>
            </div><!-- /.main-container -->

            <!-- basic scripts -->

            <!--[if !IE]> -->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery/jquery-2.1.1.min.js"></script>
            <!-- <![endif]-->

            <!--[if IE]>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery/jquery-1.11.1.min.js"></script>
            <![endif]-->

            <!--[if !IE]> -->
            <script type="text/javascript">
                                        window.jQuery || document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.min.js'>" + "<" + "/script>");
            </script>
            <!-- <![endif]-->

            <!--[if IE]>
            <script type="text/javascript">
             window.jQuery || document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery1x.min.js'>"+"<"+"/script>");
            </script>
            <![endif]-->

            <script type="text/javascript">
                if ('ontouchstart' in document.documentElement)
                    document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
            </script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/3.2.0/js/bootstrap.min.js"></script>

            <!-- page specific plugin scripts -->

            <!--[if lte IE 8]>
            <script src="assets/js/excanvas.min.js"></script>
            <![endif]-->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-ui.custom.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.ui.touch-punch.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.easypiechart.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.sparkline.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/flot/jquery.flot.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/flot/jquery.flot.pie.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/flot/jquery.flot.resize.min.js"></script>

            <!-- ace scripts -->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/ace-elements.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/ace.min.js"></script>

            <!-- inline scripts related to this page -->
            <script type="text/javascript">
               

                    $('.sparkline').each(function() {
                        var $box = $(this).closest('.infobox');
                        var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
                        $(this).sparkline('html',
                                {
                                    tagValuesAttribute: 'data-values',
                                    type: 'bar',
                                    barColor: barColor,
                                    chartRangeMin: $(this).data('min') || 0
                                });
                    });


                    //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
                    //but sometimes it brings up errors with normal resize event handlers
                    $.resize.throttleWindow = false;

               


                    //pie chart tooltip example
                    var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
                    var previousPoint = null;

                    placeholder.on('plothover', function(event, pos, item) {
                        if (item) {
                            if (previousPoint != item.seriesIndex) {
                                previousPoint = item.seriesIndex;
                                var tip = item.series['label'] + " : " + item.series['percent'] + '%';
                                $tooltip.show().children(0).text(tip);
                            }
                            $tooltip.css({top: pos.pageY + 10, left: pos.pageX + 10});
                        } else {
                            $tooltip.hide();
                            previousPoint = null;
                        }

                    });






                    var d1 = [];
                    for (var i = 0; i < Math.PI * 2; i += 0.5) {
                        d1.push([i, Math.sin(i)]);
                    }

                    var d2 = [];
                    for (var i = 0; i < Math.PI * 2; i += 0.5) {
                        d2.push([i, Math.cos(i)]);
                    }

                    var d3 = [];
                    for (var i = 0; i < Math.PI * 2; i += 0.2) {
                        d3.push([i, Math.tan(i)]);
                    }


                    var sales_charts = $('#sales-charts').css({'width': '100%', 'height': '220px'});
                    $.plot("#sales-charts", [
                        {label: "Domains", data: d1},
                        {label: "Hosting", data: d2},
                        {label: "Services", data: d3}
                    ], {
                        hoverable: true,
                        shadowSize: 0,
                        series: {
                            lines: {show: true},
                            points: {show: true}
                        },
                        xaxis: {
                            tickLength: 0
                        },
                        yaxis: {
                            ticks: 10,
                            min: -2,
                            max: 2,
                            tickDecimals: 3
                        },
                        grid: {
                            backgroundColor: {colors: ["#fff", "#fff"]},
                            borderWidth: 1,
                            borderColor: '#555'
                        }
                    });


                    $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                    function tooltip_placement(context, source) {
                        var $source = $(source);
                        var $parent = $source.closest('.tab-content')
                        var off1 = $parent.offset();
                        var w1 = $parent.width();

                        var off2 = $source.offset();
                        //var w2 = $source.width();

                        if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                            return 'right';
                        return 'left';
                    }


                    $('.dialogs,.comments').ace_scroll({
                        size: 300
                    });


                    //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
                    //so disable dragging when clicking on label
                    var agent = navigator.userAgent.toLowerCase();
                    if ("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
                        $('#tasks').on('touchstart', function(e) {
                            var li = $(e.target).closest('#tasks li');
                            if (li.length == 0)
                                return;
                            var label = li.find('label.inline').get(0);
                            if (label == e.target || $.contains(label, e.target))
                                e.stopImmediatePropagation();
                        });

                    $('#tasks').sortable({
                        opacity: 0.8,
                        revert: true,
                        forceHelperSize: true,
                        placeholder: 'draggable-placeholder',
                        forcePlaceholderSize: true,
                        tolerance: 'pointer',
                        stop: function(event, ui) {
                            //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                            $(ui.item).css('z-index', 'auto');
                        }
                    }
                    );
                    $('#tasks').disableSelection();
                    $('#tasks input:checkbox').removeAttr('checked').on('click', function() {
                        if (this.checked)
                            $(this).closest('li').addClass('selected');
                        else
                            $(this).closest('li').removeClass('selected');
                    });


                    //show the dropdowns on top or bottom depending on window height and menu position
                    $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
                        var offset = $(this).offset();

                        var $w = $(window)
                        if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
                            $(this).addClass('dropup');
                        else
                            $(this).removeClass('dropup');
                    });

            </script>
        </body>
    </html>
