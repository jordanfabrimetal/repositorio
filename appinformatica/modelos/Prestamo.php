<?php 

require "../config/conexion.php";

	Class Prestamo{
		//Constructor para instancias
		public function __construct(){

		}

		public function insertar($idasigvehi,$idempleado,$closed_time,$created_user,$closed_user,$condicion){
			$sql="INSERT INTO `prestamo`(`idasigvehi`, `idempleado`,`closed_time`, `created_user`, `closed_user`, `condicion`) VALUES ($idasigvehi,$idempleado,'$closed_time',$created_user,'$closed_user',$condicion)";
			return ejecutarConsulta($sql);
		}

                public function desactivar($idprestamo,$closed_user){
			$sql="UPDATE prestamo SET condicion='0',closed_time=now(),closed_user='$closed_user' WHERE idprestamo='$idprestamo'";
			return ejecutarConsulta($sql);
		}
 
                
	}
?>