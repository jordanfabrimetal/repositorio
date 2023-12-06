<?php 
session_start();

require_once "../modelos/Prestamo.php";

$prestamo = new Prestamo();

$idprestamo=isset($_POST["idprestamo"])?limpiarCadena($_POST["idprestamo"]):"";
$id_asigvehi=isset($_POST["id_asigvehi"])?limpiarCadena($_POST["id_asigvehi"]):"";
$id_empleado=isset($_POST["id_empleado"])?limpiarCadena($_POST["id_empleado"]):"";

switch ($_GET["op"]) {
    
    case 'guardaryeditar':
        
		if(empty($idprestamo)){                    
                        $closed_time="";
                        $created_user=$_SESSION['iduser'];
                        $closed_user="";
                        $condicion=1;
			$rspta=$prestamo->insertar($id_asigvehi,$id_empleado,$closed_time,$created_user,$closed_user,$condicion);
			echo $rspta ? "Préstamo de vehículo registrado" : "Préstamo de vehículo no se registro";
		}

		break;
                
                case 'desactivar_prestamo':
                
                    $closed_user=$_SESSION['iduser'];    
                    $rspta=$prestamo->desactivar($idprestamo,$closed_user);
                    echo $rspta ? "préstamo inhabilitado" : "préstamo no se pudo inhabilitar";    

                break;    
}

 ?>