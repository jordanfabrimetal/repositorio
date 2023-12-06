<?php 
session_start();

require_once "../modelos/AsignacionVehiculoHist.php";
require_once "../modelos/Vehiculo.php";
require_once "../modelos/Revision.php";
require_once "../modelos/GestionVehiculo.php";

$asignacion = new AsignacionVehiculo();
$vehiculo = new Vehiculo();
$revision = new Revision();
$gestionVehiculo = new GestionVehiculo();

$idasigvehi=isset($_POST["idasigvehi"])?limpiarCadena($_POST["idasigvehi"]):"";
$fecha=isset($_POST["fecha"])?limpiarCadena($_POST["fecha"]):"";
$idvehiculo=isset($_POST["idvehiculo"])?limpiarCadena($_POST["idvehiculo"]):"";
$idempleado=isset($_POST["idempleado"])?limpiarCadena($_POST["idempleado"]):"";
$kilometraje=isset($_POST["kilometraje"])?limpiarCadena($_POST["kilometraje"]):"";
$observaciones=isset($_POST["observaciones"])?limpiarCadena($_POST["observaciones"]):"";
$gestion=isset($_POST["gestion"])?limpiarCadena($_POST["gestion"]):"";

switch ($_GET["op"]) {

    case 'selectempleado':
		$rspta = $asignacion->selectempleado();
		echo '<option value="0" selected>TODOS</option>';
		while($reg = $rspta->fetch_object()){
			echo '<option value='.$reg->idempleado.'>'.$reg->nombre. ' '.$reg->apellido.'</option>';
		}
   break;

   case 'selectpatente':
    $rspta = $asignacion->selectpatente();
    echo '<option value="0" selected>TODAS</option>';
    while($reg = $rspta->fetch_object()){
        echo '<option value='.$reg->idvehiculo.'>'.$reg->patente.'</option>';
    }
break;

	
        
	case 'listar':
        $idempl = isset($_REQUEST['idempl']) ? $_REQUEST['idempl'] : 0; 
        $idveh = isset($_REQUEST['pat']) ? $_REQUEST['pat'] : 0; 

		$rspta=$asignacion->listar($idempl, $idveh);
		$data = Array();
		while ($reg = $rspta->fetch_object()){                       

                $data[] = array(             
					"0"=>$reg->nombre.' '.$reg->apellido,
					"1"=>$reg->num_documento,
					"2"=>$reg->marca.' '.$reg->modelo,
					"3"=>$reg->patente,
					"4"=>$reg->fecha,
                    "5"=>$reg->fecha_dev                                    
				);
		}
		$results = array(
				"sEcho"=>1,
				"iTotalRecords"=>count($data),
				"iTotalDisplayRecords"=>count($data), 
				"aaData"=>$data
			);

		echo json_encode($results);
		break;
          
        

}

 ?>