<?php 

require "../config/conexion.php";

	Class AsignacionVehiculo{
		//Constructor para instancias
		public function __construct(){

		}

        public function selectempleado(){
			$sql="SELECT idempleado, nombre, apellido FROM empleado order by 2 asc;";
			return ejecutarConsulta($sql);
		}

        public function selectpatente(){
			$sql="SELECT idvehiculo, patente FROM fabrimetalcl_informatica.vehiculo order by 2 asc;";
			return ejecutarConsulta($sql);
		}		

		public function listar($idempl, $pat){
			$sql="SELECT a.condicion, a.entregado, a.idasigvehi, a.idvehiculo,DATE(a.created_time) as fecha, 
                            DATE(a.close_time) as fecha_dev,
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
                              WHERE (a.idempleado = $idempl or $idempl = 0)
                              AND (a.idvehiculo = $pat or $pat = 0);";
			return ejecutarConsulta($sql);
		}
		
         
                
	}
?>