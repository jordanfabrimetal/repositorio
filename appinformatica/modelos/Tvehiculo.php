<?php 

require "../config/conexion.php";

	Class Tvehiculo{
		//Constructor para instancias
		public function __construct(){

		}

		public function selecttvehiculo(){
			$sql="SELECT * FROM `tvehiculo` WHERE 1"; 
			return ejecutarConsulta($sql);
		}

	}
?>