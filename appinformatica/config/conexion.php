<?php 

require_once "global.php";

$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');
mysqli_query($conexion, 'SET lc_time_names="'.DB_NAMES.'"');

if(mysqli_connect_errno()){
	printf("Fallo la conexion con la BD: %s \n", mysqli_connect_error());
	exit();
}

if(!function_exists('ejecutarConsulta')){
	function ejecutarConsulta($sql){
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}

	function ejecutarConsultaSimpleFila($sql){
		global $conexion;
		$query = $conexion->query($sql);
		$row = $query->fetch_assoc();
		return $row;
	}

	function ejecutarConsulta_retornarID($sql){
		global $conexion;
		$query = $conexion->query($sql);
		return $conexion->insert_id;
	}

	function limpiarCadena($str){
		global $conexion;
		$str = mysqli_real_escape_string($conexion, trim($str));
		return htmlspecialchars($str);
	}
        
        function NumeroFilas($sql){
		global $conexion;
		$query = $conexion->query($sql);
                return $conexion->affected_rows;
	}
        
        function Filas($sql){
		global $conexion;
		$query = $conexion->query($sql);
                return $query->num_rows;
	}

}


?>