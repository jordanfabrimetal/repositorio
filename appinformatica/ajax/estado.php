<?php 
session_start();
require_once "../modelos/Estado.php";


$estado = new Estado();

switch ($_GET["op"]) {
        
        case 'ContarMoviles':
            
        $rspta=$estado->contarmoviles();
        $data = Array();
        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                            "cantidad"=>$reg->cantidad,
                            "disponible"=>$reg->disponible
                        );
        }
        
        $results = array(
                "aaData"=>$data
            );
        
        echo json_encode($results);
        
        break;
        
         case 'contarMovilesGestion':
            
        $rspta=$estado->contarMovilesGestion();
             
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                            "cantidad"=>$reg->cantidad,
                            "condicion"=>$reg->condicion
                        );
        }
        
        $results = array(
                "aaData"=>$data
            );
        
        echo json_encode($results);
        
        break;
        
    case 'ContarSim':
        
        $rspta=$estado->ContarSim();
        
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            
            $data[] = array(
                    "cantidad"=>$reg->cantidad,
                    "disponible"=>$reg->disponible
                        );
        }
        
        $results = array(
                "aaData"=>$data
            );
        
        echo json_encode($results);
        
        break;
        
        case 'ContarSimGestion':
        
        $rspta=$estado->ContarSimGestion();
        
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            
            $data[] = array(
                    "cantidad"=>$reg->cantidad,
                    "condicion"=>$reg->condicion
                        );
        }
        
        $results = array(
                "aaData"=>$data
            );
        
        echo json_encode($results);
        
        break;
        
        case 'contarEquipos':
            
        $rspta=$estado->contarEquipos();
            
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                    "cantidad"=>$reg->cantidad,
                    "disponible"=>$reg->disponible
                        );
        }
        
        $results = array(
                "aaData"=>$data
            );
        
        echo json_encode($results);
        
        break;
        
        case 'contarEquiposGestion':
            
        $rspta=$estado->contarEquiposGestion();
            
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                    "cantidad"=>$reg->cantidad,
                    "condicion"=>$reg->condicion
                        );
        }
        
        $results = array(
                "aaData"=>$data
            );
        
        echo json_encode($results);
        
        break;
        
        case 'contarTiposEquipo':
            
        $rspta=$estado->contarTiposEquipo();
            
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            
          $data[] = array(
                        "tcomputador"=>$reg->tcomputador,
                        "tipo_computador"=>$reg->tipo_computador,
                        "cantidad"=>$reg->cantidad
                        );
        }
        
        $results = array(
                "aaData"=>$data
            );
        
        echo json_encode($results);
        
        break;
        
        case 'ContarVehiculos':
            
        $rspta=$estado->contarvehiculo();
            
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                    "0"=>$reg->vehiculo,
                    "1"=>$reg->disponible
                        );
        }
        
        $results = array(
                "aaData"=>$data
            );
        
        echo json_encode($results);
        
        break;
        
          case 'contarVehiculoGestion':
            
        $rspta=$estado->contarVehiculoGestion();
            
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array("cant_vehiculos"=>$reg->cant_vehiculos,
                            "gestion"=>$reg->gestion);
        }
        
        $results = array(
                "aaData"=>$data
            );
        
        echo json_encode($results);
        
        break;
        
        case 'contarTarjetas':
            
        $rspta=$estado->contarTarjetas();
            
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array(
                        "cantidad"=>$reg->cantidad,
                        "disponible"=>$reg->disponible
                        );
        }
        
        $results = array(
                "aaData"=>$data
            );
        
        echo json_encode($results);
        
        break;
        
        case 'contarNivelesTarjeta':
            
        $rspta=$estado->contarNivelesTarjeta();
            
        $data = Array();
        
        while ($reg = $rspta->fetch_object()){
            $data[] = array("idnivel"=>$reg->idnivel,
                            "nombre_nivel"=>$reg->nombre_nivel,
                            "cantidad"=>$reg->cantidad);
        }

        $results = array(
                "aaData"=>$data
            );

        echo json_encode($results);
        
        break;
        
}

 ?>