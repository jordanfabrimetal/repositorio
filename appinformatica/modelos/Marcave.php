<?php 

require "../config/conexion.php";

	Class Marcave{
		//Constructor para instancias
		public function __construct(){

		}

		public function selectmarcave(){
			$sql="SELECT * FROM marcave"; 
			return ejecutarConsulta($sql);
		}

	}
?>