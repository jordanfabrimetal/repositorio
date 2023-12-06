<?php 
session_start();

require_once "../modelos/AsignacionHist.php";
require_once "../modelos/Equipo.php";
require_once "../modelos/Chip.php";

$asignacion = new Asignacion();
$equipo = new Equipo();
$chip = new Chip();

$idasignacion=isset($_POST["idasignacion"])?limpiarCadena($_POST["idasignacion"]):"";
$fecha=isset($_POST["fecha"])?limpiarCadena($_POST["fecha"]):"";
$idequipo=isset($_POST["idequipo"])?limpiarCadena($_POST["idequipo"]):"";
$idempleado=isset($_POST["idempleado"])?limpiarCadena($_POST["idempleado"]):"";
$idchip=isset($_POST["idchip"])?limpiarCadena($_POST["idchip"]):"";
$tasignacion=isset($_POST["tasignacion"])?limpiarCadena($_POST["tasignacion"]):"";
$condicion=isset($_POST["condicion"])?limpiarCadena($_POST["condicion"]):"";
$fromdate = date("Y-m-d", strtotime($fecha)); 
$detalle = mb_strtoupper(isset($_POST['detalle']) ? limpiarCadena($_POST['detalle']) : "");

switch ($_GET["op"]) {

	case 'selectempleado':
		$rspta = $asignacion->selectempleado();
		echo '<option selected disabled>SELECIONE</option>';
		while($reg = $rspta->fetch_object()){
			echo '<option value='.$reg->idempleado.'>'.$reg->nombre. ' '.$reg->apellido.'</option>';
		}
   break;
	
	case 'mostar':
		$rspta=$asignacion->mostrar($idasignacion);
			echo json_encode($rspta);
		break;            
        			
	case 'listar':
		$idempl = isset($_REQUEST['idempl']) ? $_REQUEST['idempl'] : 0; 

		$rspta=$asignacion->listar($idempl);

		$data = Array();
		while ($reg = $rspta->fetch_object()){                    
                                                                    
			$data[] = array(
					"0"=>$reg->nombre.' '.$reg->apellido,
					"1"=>$reg->num_documento,
					"2"=>$reg->marca.' '.$reg->equipo,
					"3"=>$reg->imei,
                    "4"=>$reg->numero,
					"5"=>$reg->created_time,
                    "6"=>$reg->tasignacion
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
                
        case 'listartelf':
		$rspta=$asignacion->listartelf();
		$data = Array();
		while ($reg = $rspta->fetch_object()){                    
			$data[] = array(		
					"0"=>$reg->nombre.' '.$reg->apellido,
					"1"=>$reg->num_documento,
                                        "2"=>$reg->num_documento,
					"3"=>$reg->marca.' '.$reg->equipo,
					"4"=>$reg->imei,
                                        "5"=>$reg->numero,
                                        "6"=>$reg->operador,
					"7"=>$reg->created_time,
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