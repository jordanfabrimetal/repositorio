<?php 

require "../config/conexion.php";

	Class Revision{
		//Constructor para instancias
		public function __construct(){

		}

		public function insertar($idasigvehi, $tipo, $fecha, $kilometraje, $padron, $permiso, $revision, $seguro, $combustible, $selloverde, $tag, $radio, $parasoles, $gata, $rerueda, $luces, $frenos, $odometro, $velocimetro, $indicombus, $cambios, $tapaestan, $direccion, $fremano, $intermitente, $limparabrisas, $asientos, $pisos, $niveles, $parabrisas, $luneta, $puertas, $alzavidrios, $cenicero, $jaula, $motor, $observaciones){
                        //$sql="INSERT INTO revision (idasigvehi, tipo, fecha, kilometraje, padron, permiso, revision, seguro, combustible, selloverde, tag, radio, parasoles, gata, rerueda, luces, frenos, odometro, velocimetro, indicombus, cambios, tapaestan, direccion, fremano, intermitente, limparabrisas, asientos, pisos, niveles, parabrisas, luneta, puertas, alzavidrios, cenicero, jaula, motor, observaciones) VALUES ('$idasigvehi', '$tipo', '$fecha', '$kilometraje', '$padron', '$permiso', '$revision', '$seguro', '$combustible', '$selloverde', '$tag', '$radio', '$parasoles', '$gata', '$rerueda', '$luces', '$frenos', '$odometro', '$velocimetro', '$indicombus', '$cambios', '$tapaestan', '$direccion', '$fremano', '$intermitente', '$limparabrisas', '$asientos', '$pisos', '$niveles', '$parabrisas', '$luneta', '$puertas', '$alzavidrios', '$cenicero', '$jaula', '$motor', '$observaciones')";
                        $sql="INSERT INTO revision (idasigvehi, tipo, fecha, kilometraje, padron, permiso, revision, seguro, combustible, selloverde, tag, radio, parasoles, gata, rerueda, luces, frenos, odometro, velocimetro, indicombus, cambios, tapaestan, direccion, fremano, intermitente, limparabrisas, asientos, pisos, niveles, parabrisas, luneta, puertas, alzavidrios, cenicero, jaula, motor, observaciones) VALUES ('$idasigvehi', '$tipo', '$fecha', '$kilometraje', '$padron', '$permiso', '$revision', '$seguro', '$combustible', '$selloverde', '$tag', '$radio', '$parasoles', '$gata', '$rerueda', '$luces', '$frenos', '$odometro', '$velocimetro', '$indicombus', '$cambios', '$tapaestan', '$direccion', '$fremano', '$intermitente', '$limparabrisas', '$asientos', '$pisos', '$niveles', '$parabrisas', '$luneta', '$puertas', '$alzavidrios', '$cenicero', '$jaula', '$motor', '$observaciones')";
			return ejecutarConsulta($sql);
		}


	}
?>