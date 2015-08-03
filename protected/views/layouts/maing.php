
<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/font-awesome/4.1.0/css/font-awesome.min.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace.min.css" id="main-ace-style" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/jquery-ui.min.css" /> 
        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-ie.min.css" />
        <![endif]-->
        <!-- ace settings handler -->
        <style type="text/css">
			#winpop { width:200px; height:100px; position:fixed; right:0; bottom:0; border:1px solid #666; margin:0;  overflow:hidden; display:none}
			#winpop .title { width:100%; height:25px; line-height:20px; background:#FFCC00; font-weight:bold; text-align:center; font-size:12px;}
			#winpop .con { width:100%; height:75px; line-height:80px; background:#F6F8FC; font-weight:bold; font-size:12px; color:#FF0000; text-align:center}
			.close { position:absolute; right:4px; top:-1px; color:#053603; cursor:pointer}
		</style>
        <script type="text/javascript">
            window.jQuery || document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.min.js">'+'<'+"/script>");
        </script>
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
                                <span class="blue bolder">客户关系管理系统</span>
                                 &copy; <?php echo date('Y年m月d日',time()); ?>
                            </span>
                            &nbsp; &nbsp;
                        </div>
                    </div>
					<div id="winpop">
						<div class="title">您有新的短消息！<span class="close" onclick="close_pop()">×</span></div>
						<div class="con" id="winpop_con">
						</div>
					</div>
                </div>

                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
                </a>
            </div><!-- /.main-container -->


            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/3.2.0/js/bootstrap.min.js"></script>

            <!-- page specific plugin scripts -->

            <!--[if lte IE 8]>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/excanvas.min.js"></script>
            <![endif]-->

                 <!-- ace scripts -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/ace.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/ace-elements.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/DatePicker/WdatePicker.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/bootbox.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.validate.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/common.js"></script>
   
        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/html5shiv.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/respond.min.js"></script>
        <![endif]--> 

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery-ui.min.js"></script>
		<script type="text/javascript">
			customerIds = "<?php echo Userinfo::newResource(Yii::app()->session["user"]['eno']) ;?>";
			window.setInterval(up_winpop, 60000); 
			function up_winpop(){
				if(customerIds){
					var idArr = new Array(); //定义一数组 
					idArr = customerIds.split(","); //字符分割 
					var idLeng = idArr.length;
					if(idLeng){
						document.getElementById("winpop").style.display = "block";
						document.getElementById("winpop_con").innerHTML = "你有"+idLeng+"个新分资源, 点击 <a onclick='close_pop(1)' target='_blank' href='./index.php?r=Customer/customerinfo/admin&customerId="+customerIds+"'>查看</a>";
					}
				}
			}
			
			function close_pop(obj){
				if(!obj){
					$("#winpop").css("display","none");
				}
				
				if(customerIds){
					$.ajax({ 
						type: 'GET', 
						url: './index.php?r=Customer/customerinfo/DelTipInfo&custId='+customerIds, 
						success: function(data){

						} 
					});
				}
				customerIds = undefined;
				return true;
			}
		</script>
        </body>
    </html>
