
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
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/jquery-ui.min.css" />

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
            
           <?php include('top.php');?>

            <div class="main-container" id="main-container">
                <script type="text/javascript">
                    try {
                        ace.settings.check('main-container', 'fixed')
                    } catch (e) {
                    }
                </script>

              <?php include('left.php');?>

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
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-ui.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.ui.touch-punch.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.easypiechart.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.sparkline.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/flot/jquery.flot.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/flot/jquery.flot.pie.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/flot/jquery.flot.resize.min.js"></script>

            <!-- ace scripts -->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/ace-elements.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/ace.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/common.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/DatePicker/WdatePicker.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootbox.min.js"></script>

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
