<?php 

require_once "../modelos/Tcomputador.php";

$tcomputador = new Tcomputador();

switch ($_GET["op"]) {

		case 'selecttcomputador':
			$rspta = $tcomputador->selecttcomputador();
                        echo '<option value="" selected disabled>SELECCIONE TIPO</option>';
			while($reg = $rspta->fetch_object()){
				echo '<option value='.$reg->idtcomputador.'>'.$reg->nombre.'</option>';
			}
			break;
}

 ?>