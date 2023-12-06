<?php 

require "../config/conexion.php";

	Class Marcacom{
		//Constructor para instancias
		public function __construct(){

		}

		public function selectmarcacom(){
			$sql="SELECT * FROM marcacom WHERE condicion=1"; 
			return ejecutarConsulta($sql);
		}

	}
?>