<?php 

require_once "../modelos/Tdispositivo.php";

$tdispositivo = new Tdispositivo();

switch ($_GET["op"]) {

		case 'selecttdispositivo':
                    
			$rspta = $tdispositivo->selecttdispositivo();
                        echo '<option value="" selected disabled>SELECCIONE TIPO</option>';
			while($reg = $rspta->fetch_object()){
				echo '<option value='.$reg->idtdispositivo.'>'.$reg->nombre.'</option>';
			}
                        
			break;
}

 ?>