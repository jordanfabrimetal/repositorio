<?php 

require "../config/conexion.php";

	Class Estado{
            
		//Constructor para instancias
		public function __construct(){
                }

		public function contarmoviles(){
                    $sql="SELECT COUNT(idequipo) as cantidad, disponible 
                          FROM equipo
                          WHERE condicion <> 0
                          GROUP BY disponible";
                    return ejecutarConsulta($sql);
		}
                
                public function contarMovilesGestion(){
                    $sql="SELECT COUNT(idequipo) as cantidad, condicion 
                          FROM equipo
                          WHERE disponible=1
                          GROUP BY condicion";
                    return ejecutarConsulta($sql);
		}
                
                public function ContarSim(){
                    $sql="SELECT COUNT(idchip) as cantidad, disponible 
                        FROM chip
                        WHERE condicion = 1
                        GROUP BY disponible";
                    return ejecutarConsulta($sql);
		}
                
                public function ContarSimGestion(){
                    $sql="SELECT COUNT(idchip) as cantidad, condicion 
                        FROM chip
                        WHERE disponible=0
                        GROUP BY condicion";
                    return ejecutarConsulta($sql);
		}
                
                public function contarEquipos(){
			$sql="SELECT count(idcomputador) as cantidad, disponible 
                              FROM computador 
                              WHERE condicion <> 0
                              GROUP BY disponible";
			return ejecutarConsulta($sql);
		}
                
                public function contarEquiposGestion(){
			$sql="SELECT count(idcomputador) as cantidad, condicion 
                              FROM computador 
                              WHERE disponible=0
                              GROUP BY condicion";
			return ejecutarConsulta($sql);
		}
                
                 public function contarTiposEquipo(){
			$sql="SELECT a.tcomputador, b.nombre as tipo_computador,
                              COUNT(a.idcomputador) as cantidad 
                              FROM `computador` as a
                              INNER JOIN tcomputador as b on a.tcomputador = b.idtcomputador
                              WHERE a.condicion=1
                              GROUP BY a.tcomputador";
			return ejecutarConsulta($sql);
		}
                
                public function contarVehiculo(){
			$sql="SELECT COUNT(idvehiculo) AS vehiculo, disponible 
                              FROM vehiculo 
                              WHERE condicion=1 
                              GROUP BY disponible";
			return ejecutarConsulta($sql);
		}

                public function contarVehiculoGestion(){
                    $sql="SELECT COUNT(idvehiculo) AS cant_vehiculos, gestion 
                          FROM vehiculo 
                          WHERE condicion=1
                          AND gestion <> 0
                          GROUP BY gestion";
                    return ejecutarConsulta($sql);
		}
                
                public function contarTarjetas(){
			$sql="SELECT COUNT(idtarjeta) AS cantidad, disponible 
                              FROM tarjeta 
                              WHERE condicion=1 
                              GROUP BY disponible";
			return ejecutarConsulta($sql);
		}
                
                public function contarNivelesTarjeta(){
                     
                    $sql="SELECT a.idnivel, b.nombre as nombre_nivel,
                          COUNT(a.idtarjeta) as cantidad 
                          FROM `tarjeta` as a
                          INNER JOIN nivel as b on a.idnivel = b.idnivel
                          WHERE a.condicion=1
                          GROUP BY a.idnivel";

                    return ejecutarConsulta($sql);                
		}
                
	}
?>