
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

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-ie.min.css" />
        <![endif]-->
        <!-- ace settings handler -->
        
        <script type="text/javascript">
            window.jQuery || document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.min.js">'+'<'+"/script>");
        </script>
    
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
    </head>
        <body class="no-skin">
			<div id="content">
				<?php echo $content; ?>
			</div><!-- content -->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        </body>
    </html>
