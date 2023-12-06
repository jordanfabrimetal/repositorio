<?php 

require_once "../modelos/Modelove.php";

$modelove = new Modelove();


switch ($_GET["op"]) {

		case 'selectmodelove':
			$idmarca=$_GET["id"];
			$rspta = $modelove->selectmodelove($idmarca);
                        echo '<option value="" selected disabled>SELECCIONE MODELO</option>';
			while($reg = $rspta->fetch_object()){
				echo '<option value='.$reg->idmodelove.'>'.$reg->nombre.'</option>';
			}                        
		break;
}

 ?>