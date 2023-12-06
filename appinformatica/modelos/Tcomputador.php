<?php 

require "../config/conexion.php";

	Class Tcomputador{
		//Constructor para instancias
		public function __construct(){

		}

		public function selecttcomputador(){
			$sql="SELECT * FROM tcomputador WHERE condicion = 1"; 
			return ejecutarConsulta($sql);
		}

	}
?>