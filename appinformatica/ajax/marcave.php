<?php 

require_once "../modelos/Marcave.php";

$marcave = new Marcave();

switch ($_GET["op"]) {

		case 'selectmarcave':
			$rspta = $marcave->selectmarcave();
                        echo '<option value="" selected disabled>SELECCIONE MARCA</option>';
			while($reg = $rspta->fetch_object()){
				echo '<option value='.$reg->idmarca.'>'.$reg->nombre.'</option>';
			}
			break;
}

 ?>