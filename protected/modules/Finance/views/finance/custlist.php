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

        

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/ace-rtl.min.css" />

        
         <!--[if !IE]> -->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery/jquery-2.1.1.min.js"></script>
            <!-- <![endif]-->

            <!--[if IE]>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery/jquery-1.11.1.min.js"></script>
            <![endif]--> 
            <base target="_self">
    </head>
<h1>选择客户</h1>
<script type="text/javascript">
    function getList(url){  
        $.ajax({  
        url:url,  
        success:function(html){  
            $('#search_list').html(html);  
        }  
        });  
        return false; 
    }
    
    
</script>
 
 
<div class="search-form" style="display:">
<?php $this->renderPartial('_search_cust',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div id="search_list"> 
    <?php $this->renderPartial('_custlist',array(
	'model'=>$model,
)); 
?>  
</div> <!-- search_list-->  
 
<script type="text/javascript">
 
$('.search-form form').submit(function(){
      var url = $(this).attr('action');
      url=url+"&isajax=1"; 
      $.ajax(url,{   
        data:$(this).serialize(),
        success:function(html){   
            $('#search_list').html(html);  
            }  
        });
	return false;
});

    function selectone(){ 
       var oselected = $("input[type=checkbox]:checked");
       if(!oselected||oselected.length==0){
           alert("请选择一条记录");
           return false;
       }
       if(oselected&&oselected.length>1){
           alert("只能选择一条记录");
           return false;
       }
       var selval = oselected.val(); 
        if(window.showModalDialog){ 
             window.returnValue = selval; 
             window.close(); 
        }else{
            var values = selval.split(",");
            window.opener.document.getElementById("Finance_cust_id").value=values[0];
            window.opener.document.getElementById("Finance_cust_name").value=values[1];
            
            window.close(); 
        } 
    }
 </script>
 
     </body>
    </html>
