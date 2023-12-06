<?php 

require_once "../modelos/Marcacom.php";

$marcacom = new Marcacom();

switch ($_GET["op"]) {

		case 'selectmarcacom':
			$rspta = $marcacom->selectmarcacom();
                        echo '<option value="" selected disabled>SELECCIONE MARCA</option>';
			while($reg = $rspta->fetch_object()){
				echo '<option value='.$reg->idmarcacom.'>'.$reg->nombre.'</option>';
			}
			break;
}

 ?>