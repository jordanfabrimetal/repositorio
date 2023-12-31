<?php 

require "../config/conexion.php";

	Class Monitoreo{
		//Constructor para instancias
		public function __construct(){

		}

		public function insertar($codigo, $alerta, $idascensor){
			$sql="INSERT INTO monitoreo (idascensor, codigo, alerta, estado) VALUES ('$idascensor','$codigo','$alerta',0)";
			return ejecutarConsulta($sql);
		}
        
        public function estado($codigo){
			$sql="UPDATE monitoreo SET estado=1 WHERE codigo='$codigo'";
			return ejecutarConsulta($sql);
		}
        
        public function error($codigo,$error){
			$sql="INSERT INTO error (idascensor,codigo, error) VALUES (1,'$codigo', '$error' )";
			return ejecutarConsulta($sql);
		}

		public function listar(){
		    $sql="SELECT m.created_time, m.idascensor, m.idmonitoreo, m.codigo, m.alerta, a.lat, a.lon, m.estado, e.nombre, e.calle, e.numero, r.nombre as region, r.numero as nregion, c.nombre as ciudad, o.nombre as comuna, l.rut, l.razon_social, t.nombre as segmento FROM monitoreo m INNER JOIN ascensor a ON m.idascensor=a.idascensor INNER JOIN edificio e ON a.id_edificio=e.idedificio INNER JOIN region r ON r.idregion=e.id_region  INNER JOIN ciudad c ON c.idciudad=e.id_ciudad INNER JOIN comuna o ON o.idcomuna=e.id_comuna INNER JOIN cliente l ON l.idcliente=e.idcliente INNER JOIN tipo_segmento t ON t.idtipo_segmento=e.id_tipo_segmento Where m.idmonitoreo In( Select Max(idmonitoreo) From monitoreo Group By idascensor ) GROUP BY m.idascensor";
		    //$sql="SELECT m.idmonitoreo, m.codigo, m.alerta, a.lat, a.lon, m.estado FROM monitoreo m INNER JOIN ascensor a ON m.idascensor=a.idascensor Where created_time In( Select Max(created_time) From monitoreo Group By idascensor ) GROUP BY m.idascensor";
			//$sql="SELECT m.idmonitoreo, m.codigo, m.alerta, a.lat, a.lon FROM monitoreo m INNER JOIN ascensor a ON m.idascensor=a.idascensor GROUP BY m.idascensor ORDER BY m.created_time DESC"; 
			return ejecutarConsulta($sql);
		}

		public function verificarultimo($codigo){
			$sql="SELECT alerta FROM monitoreo WHERE codigo='$codigo' ORDER BY created_time DESC LIMIT 1";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function id_ascensor($codigo){
			$sql="SELECT idascensor FROM ascensor WHERE codigo='$codigo'";
			return ejecutarConsultaSimpleFila($sql);
		}
        
		public function indatos($idascensor,$recorrido, $movimientos){
		    $sql="INSERT INTO datos (idascensor, recorrido, movimientos) VALUES ('$idascensor','$recorrido','$movimientos')";
		    return ejecutarConsulta($sql);
		}
		
		public function datos($codigo){
		    $sql="SELECT a.idascensor, a.codigo, e.nombre, e.calle, e.numero, r.nombre as region, c.nombre as ciudad, o.nombre as comuna, l.rut, l.razon_social, t.nombre as segmento FROM ascensor a INNER JOIN edificio e ON a.id_edificio=e.idedificio INNER JOIN region r ON r.idregion=e.id_region INNER JOIN ciudad c ON c.idciudad=e.id_ciudad INNER JOIN comuna o ON o.idcomuna=e.id_comuna INNER JOIN cliente l ON l.idcliente=e.idcliente INNER JOIN tipo_segmento t ON t.idtipo_segmento=e.id_tipo_segmento WHERE a.codigo = '$codigo'";
		    //$sql="SELECT m.idmonitoreo, m.codigo, m.alerta, a.lat, a.lon FROM monitoreo m INNER JOIN ascensor a ON m.idascensor=a.idascensor GROUP BY m.idascensor ORDER BY m.created_time DESC";
		    return ejecutarConsultaSimpleFila($sql);;
		}
		
	}
?>