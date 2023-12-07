<?php
/*
UploadiFive
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
*/

include '../public/build/lib/fabrimetal/functions.php';
require_once "../config/conexionSap.php";

if(isset($_GET['op'])){
	switch ($_GET['op']) {
		case 'interno':
			$countfiles = count($_FILES['file']['name']);
			$archivos = array();
			for($i=0;$i<$countfiles;$i++){
				$filename = $_FILES['file']['name'][$i];
				move_uploaded_file($_FILES['file']['tmp_name'][$i],'../files/img_presupuesto/'.$filename);
				$archivos['archivo'.$i] = $filename;
			}
			$archivos['count'] = $countfiles;
			echo json_encode($archivos);
		break;
	}
}else{
	if (!empty($_FILES)) {
		$files = rearrange_array_attachments($_FILES);
		$rspta = UploadFile($files, true);//true: renombrar archivo y agregar timestamp
		$rspta = json_decode($rspta);
		if (isset($rspta->AbsoluteEntry)){
			echo json_encode(array('id'=>$rspta->AbsoluteEntry));
		}else{
			echo json_encode(array('id'=>0));
		}
	}
}
?>