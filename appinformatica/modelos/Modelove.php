<?php 

require "../config/conexion.php";

	Class Modelove{
		//Constructor para instancias
		public function __construct(){

		}

		public function selectmodelove($idmarca){
			$sql="SELECT * FROM modelove WHERE idmarca = '$idmarca'"; 
			return ejecutarConsulta($sql);
		}


	}
?>