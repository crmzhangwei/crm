<?php

	class uploadExcel{
		public static function upExcel($file){

			$PHPExcel = new PHPExcel();
	        $PHPReader = new PHPExcel_Reader_Excel2007();
	        //$file = $_FILES[$batchFile]['tmp_name'];
	        if(!$PHPReader->canRead($file)){
	           	$PHPReader = new PHPExcel_Reader_Excel5();
	          	if(!$PHPReader->canRead($file)){
	             	return false;
	           }
	        }
	        
	        $PHPExcel = $PHPReader->load($file);
	        $currentSheet = $PHPExcel->getSheet(0);//读取第一个工作表
	        $allColumn = $currentSheet->getHighestColumn();//取得最大的列号
	        $allRow = $currentSheet->getHighestRow();//取得一共有多少行
	        /**从第二行开始输出，因为excel表中第一行为列名*/
	        $arr=array();
	        for($currentRow = 2;$currentRow <= $allRow;$currentRow++){
	            /**从第A列开始输出*/
	            for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
	                $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue(); /*ord()将字符转为十进制数*/

	                /**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/
	                //$arr[$currentRow][]=  iconv('utf-8','gb2312', $val)."＼t";
	                $arr[$currentRow][]=  trim($val);
	            }
	        }
	        //删除全部为空的行
	        foreach ($arr as $key=>$vals){
	            $tmp = '';
	            foreach($vals as $v){
	                $tmp .= $v;
	            }
	            if(!$tmp) unset($arr[$key]);
	        }
	        return $arr;
		}
	}
	




?>