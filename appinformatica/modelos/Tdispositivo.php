<?php 

require "../config/conexion.php";

	Class Tdispositivo{
		//Constructor para instancias
		public function __construct(){

		}

		public function selecttdispositivo(){
			$sql="SELECT * FROM tdispositivo WHERE condicion = 1"; 
			return ejecutarConsulta($sql);
		}

	}
?>