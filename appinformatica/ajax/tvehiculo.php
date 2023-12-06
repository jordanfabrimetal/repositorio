<?php 

require_once "../modelos/Tvehiculo.php";

$tvehiculo = new Tvehiculo();

switch ($_GET["op"]) {

		case 'selecttvehiculo':
			$rspta = $tvehiculo->selecttvehiculo();
                        echo '<option value="" selected disabled>SELECCIONE TIPO</option>';
			while($reg = $rspta->fetch_object()){
				echo '<option value='.$reg->idtvehiculo.'>'.$reg->nombre.'</option>';
			}
			break;
}

 ?>