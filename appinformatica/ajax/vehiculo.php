<?php 
session_start();

require_once "../modelos/Vehiculo.php";

$vehiculo = new Vehiculo();

$idvehiculo=isset($_POST["idvehiculo"])?limpiarCadena($_POST["idvehiculo"]):"";
$idmarca=isset($_POST["idmarca"])?limpiarCadena($_POST["idmarca"]):"";
$idmodelo=isset($_POST["idmodelo"])?limpiarCadena($_POST["idmodelo"]):"";
$kilometraje=isset($_POST["kilometraje"])?limpiarCadena($_POST["kilometraje"]):"";
$ano=isset($_POST["ano"])?limpiarCadena($_POST["ano"]):"";
$patente=isset($_POST["patente"])?limpiarCadena($_POST["patente"]):"";
$serialmotor=isset($_POST["serialmotor"])?limpiarCadena($_POST["serialmotor"]):"";
$serialcarroceria=isset($_POST["serialcarroceria"])?limpiarCadena($_POST["serialcarroceria"]):"";
$gases=isset($_POST["gases"])?limpiarCadena($_POST["gases"]):"";
$tecnica=isset($_POST["tecnica"])?limpiarCadena($_POST["tecnica"]):"";
$circulacion=isset($_POST["circulacion"])?limpiarCadena($_POST["circulacion"]):"";
$tvehiculo=isset($_POST["tvehiculo"])?limpiarCadena($_POST["tvehiculo"]):"";
$observaciones=isset($_POST["observaciones"])?limpiarCadena($_POST["observaciones"]):"";
$estado=isset($_POST["estado"])?limpiarCadena($_POST["estado"]):"";
$id_vehiculo=isset($_POST["id_vehiculo"])?limpiarCadena($_POST["id_vehiculo"]):"";
$doc_gases=isset($_POST["doc_gases"])?limpiarCadena($_POST["doc_gases"]):"";
$doc_tecnica=isset($_POST["doc_tecnica"])?limpiarCadena($_POST["doc_tecnica"]):"";
$doc_circulacion=isset($_POST["doc_circulacion"])?limpiarCadena($_POST["doc_circulacion"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		$iduser=$_SESSION['iduser'];
		if(empty($idvehiculo)){
			$rspta=$vehiculo->insertar($idmarca, $idmodelo, $ano, $kilometraje, $patente, $serialmotor, $serialcarroceria,$gases,$tecnica,$circulacion, $tvehiculo, $observaciones, $estado);
			echo $rspta ? 'Vehiculo registrado patente '.$patente.'' : "Vehiculo no pudo ser registrado";
		}
		else{
			$rspta=$vehiculo->editar($idvehiculo, $idmarca,$idmodelo, $ano, $kilometraje, $patente, $serialmotor, $serialcarroceria,$gases,$tecnica,$circulacion, $tvehiculo, $observaciones, $estado);
			echo $rspta ? "Vehiculo editado" : "Vehiculo no pudo ser editado";
		}
		break;

	case 'activar':
                echo $idvehiculo;
		$rspta=$vehiculo->activar($idvehiculo);
			echo $rspta ? "Vehiculo habilitar" : "Vehiculo no se pudo habilitar";
		break;

	case 'desactivar':
                echo $idvehiculo;
		$rspta=$vehiculo->desactivar($idvehiculo);
			echo $rspta ? "Vehiculo inhabilitado" : "Vehiculo no se pudo inhabilitar";
		break;
            
        case 'asignar':
		$rspta=$vehiculo->asignar($idvehiculo);
			echo $rspta ? "Vehiculo Asginado" : "Vehiculo no pudo ser asignado";
		break;
        
        case 'liberar':
		$rspta=$vehiculo->liberar($idvehiculo);
			echo $rspta ? "Vehiculo liberado" : "Vehiculo no pudo ser liberado";
		break;

	case 'mostar':
              
		$rspta=$vehiculo->mostrar($idvehiculo);
			echo json_encode($rspta);
		break;
			
	case 'listar':
		$rspta=$vehiculo->listar();
		$data = Array();
		while ($reg = $rspta->fetch_object()){
                    $boton='';
                    if(is_null($reg->gases) || is_null($reg->tecnica) || is_null($reg->circulacion) ){
                        $boton ='<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalDocumentos" data-idvehiculo="'.$reg->idvehiculo.'" title="registrar" ><i class="fa fa-newspaper-o"></i></button>';                        
                    }
                    $disp="";
                    if($reg->disponible==0){
                        $disp='<span class="label bg-red">ASIGNADO</span>';
                    }elseif ($reg->disponible==1) {
                        $disp='<span class="label bg-green">SIN ASIGNAR</span>';
                    } elseif ($reg->disponible==2) {
                        $disp='<span class="label bg-orange">NO DISPONIBLE</span>';
                    }

                    $data[] = array(
					"0"=>($reg->condicion)?
					'<button class="btn btn-warning btn-xs" data-toggle="tooltip" title="mostrar" onclick="mostar('.$reg->idvehiculo.')"><i class="fa fa-pencil"></i></button>'.
					'<button class="btn btn-danger btn-xs"  data-toggle="tooltip" title="desactivar" onclick="desactivar('.$reg->idvehiculo.')"><i class="fa fa-close"></i></button>'.$boton:
					'<button class="btn btn-warning btn-xs" data-toggle="tooltip" title="mostrar" onclick="mostar('.$reg->idvehiculo.')"><i class="fa fa-pencil"></i></button>'.
					'<button class="btn btn-primary btn-xs" data-toggle="tooltip" title="activar" onclick="activar('.$reg->idvehiculo.')"><i class="fa fa-check"></i></button>'.$boton,
					"1"=>$reg->marca.' '.$reg->modelo,
					"2"=>$reg->tipo,
					"3"=>$reg->ano,
                                        "4"=>$reg->patente,
                                        "5"=>$reg->kilometraje,
					"6"=>$disp,
					"7"=>($reg->estado)?'<span class="label bg-green">NUEVO</span>':'<span class="label bg-red">USADO</span>',
					"8"=>($reg->condicion)?'<span class="label bg-green">HABILITADO</span>':'<span class="label bg-red">INHABILITADO</span>'
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

		case 'selectvehiculo':

                $rspta = $vehiculo->selectvehiculo();
                echo '<option value="" selected disabled>SELECCIONE VEHICULO</option>';
                while($reg = $rspta->fetch_object()){
                   
                    if($reg->tiene_fecha_gases==1 
                       && $reg->tiene_fecha_tecnica==1 
                       && $reg->tiene_fecha_circulacion==1 
                       && $reg->cantidad_dias_gases > 0 
                       && $reg->cantidad_dias_tecnica > 0 
                       && $reg->cantidad_dias_circulacion > 0 ){                        
                        echo '<option value='.$reg->idvehiculo.'>'.$reg->marca.' '.$reg->modelo.' / '.$reg->patente.'</option>';                        
                       }
                }
		break;
                
                case 'guardarPlazoDocumentosVehiculo':
                    
                $rspta=$vehiculo->actualizarPlazoDocumentosVehiculo($id_vehiculo,$doc_gases,$doc_tecnica,$doc_circulacion);
                    
                echo $rspta ? "Fechas de Documentos del Vehiculo actualizado" : "Fechas de Documentos del Vehiculo no pudo ser actualizado";                
                    
                break;   
            
            case 'listarVehiculosDocumentacionCompleta':
                
		$rspta=$vehiculo->listarVehiculosDocumentacionCompleta();
		$data = Array();
                $fecha30dias = new DateTime("now");
                $fecha30dias->modify('+1 month');
                $date_actual = new DateTime("now"); 
                
		while ($reg = $rspta->fetch_object()){
                        
                        $date_gases = new DateTime($reg->gases);                     

                        $dif = $date_actual->diff($date_gases);
                        
                        if($dif->invert == 1){
                             $clase_gases="label label-danger";
                             $texto_gases="VENCIDA";
                        }else{ 
                            
                            $dif = $fecha30dias->diff($date_gases);//COMPARO CON LA FECHA ACTUAL +3 DIAS.
                            
                            if($dif->invert == 1){
                                $clase_gases="label label-warning";
                                $texto_gases="POR VENCER < 30 dias";
                            } else{
                                $clase_gases="label label-success";
                                $texto_gases="VIGENTE > 30 dias";   
                            }                                          
                        }

                        $notificacion_gases='<span class="'.$clase_gases.'">'.$texto_gases.'</span>';

                        /* -------------------------------------------------------------------------*/
                        $date_tecnica = new DateTime($reg->tecnica);                     

                        $dif = $date_actual->diff($date_tecnica);
                        
                        if($dif->invert == 1){
                             $clase_tecnica="label label-danger";
                             $texto_tecnica="VENCIDA";
                        }else{ 
                            
                            $dif = $fecha30dias->diff($date_tecnica);//COMPARO CON LA FECHA ACTUAL +3 DIAS.
                            
                            if($dif->invert == 1){
                                $clase_tecnica="label label-warning";
                                $texto_tecnica="POR VENCER < 30 dias";
                            } else{
                                $clase_tecnica="label label-success";
                                $texto_tecnica="VIGENTE > 30 dias";   
                            }                                          
                        }

                        $notificacion_tecnica='<span class="'.$clase_tecnica.'">'.$texto_tecnica.'</span>';
                        
                        /* -------------------------------------------------------------------------*/
                        $date_circulacion = new DateTime($reg->circulacion);                     

                        $dif = $date_actual->diff($date_circulacion);
                        
                        if($dif->invert == 1){
                             $clase_circulacion="label label-danger";
                             $texto_circulacion="VENCIDA";
                        }else{ 
                            
                            $dif = $fecha30dias->diff($date_circulacion);//COMPARO CON LA FECHA ACTUAL +3 DIAS.
                            
                            if($dif->invert == 1){
                                $clase_circulacion="label label-warning";
                                $texto_circulacion="POR VENCER < 30 dias";
                            } else{
                                $clase_circulacion="label label-success";
                                $texto_circulacion="VIGENTE > 30 dias";   
                            }                                          
                        }

                        $notificacion_circulacion='<span class="'.$clase_circulacion.'">'.$texto_circulacion.'</span>';
                        
                        $data[] = array(
					"0"=>$reg->marca.' '.$reg->modelo,
					"1"=>$reg->tipo,
                                        "2"=>$reg->patente,
					"3"=>($reg->disponible)?'<span class="label bg-green">SIN ASIGNAR</span>':'<span class="label bg-red">ASIGNADO</span>',
					"4"=>$reg->gases.' '.$notificacion_gases,
					"5"=>$reg->tecnica.' '.$notificacion_tecnica,
                                        "6"=>$reg->circulacion.' '.$notificacion_circulacion,
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