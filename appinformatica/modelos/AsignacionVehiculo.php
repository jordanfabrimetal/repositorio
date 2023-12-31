<?php 

require "../config/conexion.php";

	Class AsignacionVehiculo{
		//Constructor para instancias
		public function __construct(){

		}

		public function insertar($idvehiculo,$idempleado, $iduser){
			$sql="INSERT INTO asigvehi (idvehiculo, idempleado, created_user, condicion) VALUES ('$idvehiculo', '$idempleado', '$iduser',1)";
			return ejecutarConsulta_retornarID($sql);
		}

		public function devolucion($idasigvehi,$iduser){
			$sql="UPDATE asigvehi SET entregado='1', close_user='$iduser', close_time=CURRENT_TIMESTAMP WHERE idasigvehi='$idasigvehi'";
			return ejecutarConsulta($sql);
		}

                public function desactivar($idasigvehi){
			$sql="UPDATE asigvehi SET condicion='0' WHERE idasigvehi='$idasigvehi'";
			return ejecutarConsulta($sql);
		}
                
		public function datosdev($idasigvehi){
			$sql="SELECT a.*, e.nombre, e.apellido, e.num_documento, v.patente, m.nombre AS marca, n.nombre AS modelo FROM asigvehi a INNER JOIN vehiculo v ON a.idvehiculo=v.idvehiculo INNER JOIN marcave m ON v.idmarca = m.idmarca INNER JOIN modelove n ON v.idmodelo=n.idmodelove INNER JOIN empleado e ON a.idempleado = e.idempleado  WHERE a.idasigvehi='$idasigvehi'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function listar(){
			$sql="SELECT a.condicion, a.entregado, a.idasigvehi, a.idvehiculo,DATE(a.created_time) as fecha, 
                              v.patente, m.nombre as modelo, n.nombre as marca, e.nombre, e.apellido, e.tipo_documento, 
                              e.num_documento, c.nombre as cargo ,
                              IFNULL((SELECT CONCAT(emp.nombre, ' ', emp.apellido) 
                              FROM empleado as emp 
                              INNER JOIN prestamo as pre ON pre.idempleado = emp.idempleado
                              WHERE  pre.idasigvehi = a.idasigvehi
                              AND pre.condicion=1
                              ),'NO HA SIDO PRESTADO')  as empleado_prestamo,
                              (SELECT idprestamo FROM prestamo where idasigvehi=a.idasigvehi and condicion=1 ) as idprestamo
                              FROM asigvehi a 
                              INNER JOIN vehiculo v ON a.idvehiculo=v.idvehiculo 
                              INNER JOIN marcave n ON v.idmarca=n.idmarca 
                              INNER JOIN modelove m ON v.idmodelo=m.idmodelove 
                              INNER JOIN empleado e ON a.idempleado = e.idempleado 
                              INNER JOIN cargos c ON e.idcargo=c.idcargos         
                              WHERE a.condicion = 1";
			return ejecutarConsulta($sql);
		}
		
                public function pdf($idasigvehi, $tipo){
			$sql="SELECT a.idasigvehi, r.*, DAY(r.fecha) AS dia, MONTH(r.fecha) AS mes, YEAR(r.fecha) AS año, TIME_FORMAT(CURRENT_TIME(), '%H:%i:%s') AS hora, v.ano, v.patente, m.nombre as modelo, n.nombre as marca, e.nombre, e.apellido, e.num_documento, c.nombre AS cargo, d.nombre AS departamento, u.nombre AS nomuser, u.apellido AS apeuser, u.num_documento AS numuser FROM asigvehi a INNER JOIN vehiculo v ON a.idvehiculo=v.idvehiculo INNER JOIN marcave n ON v.idmarca=n.idmarca INNER JOIN modelove m ON v.idmodelo=m.idmodelove INNER JOIN empleado e ON a.idempleado = e.idempleado INNER JOIN cargos c ON e.idcargo=c.idcargos INNER JOIN departamento d ON c.iddepartamento=d.iddepartamento INNER JOIN user u ON a.created_user = u.iduser INNER JOIN revision r ON r.idasigvehi=a.idasigvehi WHERE r.tipo='$tipo' AND a.idasigvehi='$idasigvehi'";
			return ejecutarConsultaSimpleFila($sql);
		}
                
                public function CantidadAsignaciones($idempleado) {
                    $sql="SELECT `idasigvehi` FROM `asigvehi` WHERE idempleado=$idempleado AND condicion=1";
                    return Filas($sql);
                }
                
                public function mostrarAsignaciones($idempleado) {
                    $sql="SELECT a.idasigvehi , v.patente, m.nombre as modelo, n.nombre as marca,
                        a.created_time,a.close_time,
                        ( CASE 
                          WHEN a.condicion = 0 THEN 'VEHICULO DEVUELTO'
                          WHEN a.condicion = 1 THEN 'VEHICULO ASIGNADO'
                          END ) 
                          as condicion_asignacion
                        FROM asigvehi a 
                        INNER JOIN vehiculo v ON a.idvehiculo=v.idvehiculo 
                        INNER JOIN marcave n ON v.idmarca=n.idmarca 
                        INNER JOIN modelove m ON v.idmodelo=m.idmodelove 
                        WHERE a.idempleado=$idempleado
                        ORDER BY a.created_time DESC";
                    return ejecutarConsulta($sql);
                }
                
	}
?>