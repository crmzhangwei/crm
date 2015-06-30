<?php
/* @var $this NoteInfoController */
/* @var $model NoteInfo */
/* @var $form CActiveForm */

if(empty($playurl)){
    echo "录音路径不存在!";
}else{
?>  
<div class="form">  
    <iframe src="<?php echo $playurl;?>" width="500px" height="100px">
    </iframe>
</div><!-- form -->
<?php } ?>