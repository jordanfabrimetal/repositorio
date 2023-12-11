<?php 

require_once "../config/conexion.php";
require_once "../config/conexionSap.php";

	Class Servicio{
		//Constructor para instancias
		public function __construct(){

		}

		public function existepresupuesto($idactividad){
			$sql="SELECT * FROM presupuesto_sap WHERE actividadID = $idactividad ORDER BY presupuestosapID DESC LIMIT 1";
		    return ejecutarConsulta($sql);
		}

		public function iniciar($idtservicio, $iduser, $idtecnico, $idascensor, $estadoini, $observacionini, $latini, $lonini){
			$sql="INSERT INTO servicio (idtservicio, iduser, idtecnico, idascensor, estadoini, observacionini, latini, lonini) VALUES ('$idtservicio','$iduser','$idtecnico', '$idascensor', '$estadoini','$observacionini','$latini','$lonini')";
			return ejecutarConsulta($sql);
		}

		public function finalizar($idservicio,$estadofin, $observacionfin, $nrodocumento, $nombre, $apellido, $rut, $cargo, $firma, $latfin, $lonfin){
                        if(is_null($nombre) && is_null($apellido) && is_null($rut) && is_null($cargo) && is_null($firma)){
                            $sql="UPDATE servicio SET estadofin='$estadofin', observacionfin='$observacionfin', nrodocumento='$nrodocumento', closed_time=CURRENT_TIMESTAMP, latfin='$latfin', lonfin='$lonfin'  WHERE idservicio='$idservicio'";
                        }else{
                            $sql="UPDATE servicio SET estadofin='$estadofin', observacionfin='$observacionfin', nrodocumento='$nrodocumento', nombre='$nombre', apellidos='$apellido', rut='$rut', firma='$firma', closed_time=CURRENT_TIMESTAMP, latfin='$latfin', lonfin='$lonfin'  WHERE idservicio='$idservicio'";
                        }
			return ejecutarConsulta($sql);
		}
                
                public function firmar($idservicio, $nombre, $apellido, $rut, $cargo, $firma){
			$sql="UPDATE servicio SET nombre='$nombre', apellidos='$apellido', rut='$rut', firma='$firma'  WHERE idservicio='$idservicio'";
			return ejecutarConsulta($sql);
		}
                
                public function datosservicio($iduser){
		    $sql="SELECT s.idservicio, DATE(s.created_time) AS fecha, TIME(s.created_time) AS hora, s.estadoini, s.observacionini, w.nombre as tiposer, a.codigo, x.nombre AS tipo, m.nombre AS marca, n.nombre AS modelo, o.nombre as cargotec, t.nombre, t.apellidos, t.rut, e.nombre as edificio, e.calle, e.numero, a.idascensor FROM servicio s INNER JOIN ascensor a ON s.idascensor=a.idascensor INNER JOIN tascensor x ON a.idtascensor=x.idtascensor INNER JOIN marca m ON a.marca=m.idmarca INNER JOIN modelo n ON a.modelo=n.idmodelo INNER JOIN tecnico t ON s.idtecnico=t.idtecnico INNER JOIN tservicio w ON s.idtservicio=w.idtservicio INNER JOIN edificio e ON a.idedificio=e.idedificio INNER JOIN cargotec o ON t.idcargotec=o.idcargotec WHERE s.iduser='$iduser' AND s.estadofin IS NULL";
		    return ejecutarConsulta($sql);
		}
                
                public function verificarservicio($iduser){
		    $sql="SELECT idservicio FROM servicio WHERE iduser='$iduser' AND estadofin IS NULL";
		    return NumeroFilas($sql);
		}
                
                public function nofirma($idservicio){
		    $sql="UPDATE servicio SET reqfirma=0 WHERE idservicio='$idservicio'";
		    return ejecutarConsulta($sql);
		}
                
                public function infoguia($idservicio){
		    $sql="SELECT s.idservicio, DATE(s.created_time) AS fecha, TIME(s.created_time) AS hora, z.nombre AS estado , s.observacionini, w.nombre as tiposer, a.codigo, x.nombre AS tipo, m.nombre AS marca, n.nombre AS modelo, o.nombre as cargotec, t.nombre, t.apellidos, t.rut, e.nombre as edificio, e.calle, e.numero, a.idascensor, s.idtservicio FROM servicio s INNER JOIN ascensor a ON s.idascensor=a.idascensor INNER JOIN tascensor x ON a.idtascensor=x.idtascensor INNER JOIN marca m ON a.marca=m.idmarca INNER JOIN modelo n ON a.modelo=n.idmodelo INNER JOIN tecnico t ON s.idtecnico=t.idtecnico INNER JOIN tservicio w ON s.idtservicio=w.idtservicio INNER JOIN edificio e ON a.idedificio=e.idedificio INNER JOIN cargotec o ON t.idcargotec=o.idcargotec INNER JOIN testado z ON s.estadoini = z.id WHERE s.idservicio='$idservicio'";
		    return ejecutarConsultaSimpleFila($sql);
		}
                
                public function LSF($iduser){
		    $sql="SELECT s.idservicio, DATE(s.created_time) AS fecha, TIME(s.created_time) AS inicio, TIME(s.closed_time) AS fin, a.codigo, e.nombre as edificio FROM servicio s INNER JOIN ascensor a ON s.idascensor=a.idascensor INNER JOIN edificio e ON a.idedificio=e.idedificio WHERE s.iduser='$iduser' AND s.reqfirma = 1 AND s.firma IS NULL AND s.estadofin IS NOT NULL AND MONTH(s.created_time)  IN (MONTH(NOW()), MONTH(NOW())-1)";
		    return ejecutarConsulta($sql);
		}
                
                public function formfirma($idservicio){
		    $sql="SELECT s.idservicio, DATE(s.created_time) AS fechaini, TIME(s.created_time) AS horaini, DATE(s.closed_time) AS fechafin, TIME(s.closed_time) AS horafin, z.nombre AS estadoini, s.observacionini, p.nombre AS estadofn, s.observacionfin, w.nombre as tiposer, a.codigo, x.nombre AS tipo, m.nombre AS marca, n.nombre AS modelo, o.nombre as cargotec, t.nombre, t.apellidos, t.rut, e.nombre as edificio, e.calle, e.numero FROM servicio s INNER JOIN ascensor a ON s.idascensor=a.idascensor INNER JOIN tascensor x ON a.idtascensor=x.idtascensor INNER JOIN marca m ON a.marca=m.idmarca INNER JOIN modelo n ON a.modelo=n.idmodelo INNER JOIN tecnico t ON s.idtecnico=t.idtecnico INNER JOIN tservicio w ON s.idtservicio=w.idtservicio INNER JOIN edificio e ON a.idedificio=e.idedificio INNER JOIN cargotec o ON t.idcargotec=o.idcargotec INNER JOIN testado z ON s.estadoini = z.id INNER JOIN testado p ON s.estadofin=p.id WHERE s.idservicio='$idservicio'";
		    return ejecutarConsultaSimpleFila($sql);
		}
                
                public function email($idservicio){
			$sql="SELECT s.idservicio, u.nombre AS esini, s.observacionini, i.nombre AS esfin, s.observacionfin, s.created_time AS ini, s.closed_time AS fin, a.codigo, a.codigocli, a.ubicacion, q.nombre AS tascen, m.nombre AS marca, n.nombre AS modelo, t.nombre AS tser, e.nombre AS edi, e.calle, e.numero, r.region_nombre AS region, c.comuna_nombre AS comuna, w.nombre AS segmen, p.nombre AS nomtec, p.apellidos AS apetec, p.rut AS ruttec, o.nombre AS cartec, s.file, s.filefir, s.nombre AS nomvali, s.apellidos AS apevali, s.rut AS rutvali, s.firma, s.reqfirma FROM servicio s INNER JOIN ascensor a ON s.idascensor = a.idascensor INNER JOIN edificio e ON a.idedificio = e.idedificio INNER JOIN tascensor q ON a.idtascensor = q.idtascensor INNER JOIN marca m ON a.marca=m.idmarca INNER JOIN modelo n ON a.modelo = n.idmodelo INNER JOIN tsegmento w ON e.idtsegmento = w.idtsegmento INNER JOIN regiones r ON e.idregiones = r.region_id INNER JOIN comunas c ON e.idcomunas = c.comuna_id INNER JOIN tservicio t ON s.idtservicio = t.idtservicio INNER JOIN testado u ON s.estadoini = u.id INNER JOIN testado i ON s.estadofin = i.id INNER JOIN tecnico p ON s.idtecnico = p.idtecnico INNER JOIN cargotec o ON p.idcargotec = o.idcargotec WHERE s.idservicio = '$idservicio'";
			return ejecutarConsultaSimpleFila($sql);
		}
                
                public function pdf($idservicio){
			$sql="SELECT s.idservicio, u.nombre AS esini, s.observacionini, i.nombre AS esfin, s.observacionfin, s.nombre AS nomvali, s.apellidos AS apevali, s.rut AS rutvali, s.firma, s.filefir, s.created_time AS ini, s.reqfirma, a.codigo, a.codigocli, a.ubicacion, q.nombre AS tascen, m.nombre AS marca, n.nombre AS modelo, t.nombre AS tser, e.nombre AS edi, e.calle, e.numero, r.region_nombre AS region, c.comuna_nombre AS comuna, p.nombre AS nomtec, p.apellidos AS apetec, p.rut AS ruttec FROM servicio s INNER JOIN ascensor a ON s.idascensor = a.idascensor INNER JOIN edificio e ON a.idedificio = e.idedificio INNER JOIN tascensor q ON a.idtascensor = q.idtascensor INNER JOIN marca m ON a.marca=m.idmarca INNER JOIN modelo n ON a.modelo = n.idmodelo INNER JOIN tsegmento w ON e.idtsegmento = w.idtsegmento INNER JOIN regiones r ON e.idregiones = r.region_id INNER JOIN comunas c ON e.idcomunas = c.comuna_id INNER JOIN tservicio t ON s.idtservicio = t.idtservicio INNER JOIN testado u ON s.estadoini = u.id INNER JOIN testado i ON s.estadofin = i.id INNER JOIN tecnico p ON s.idtecnico = p.idtecnico INNER JOIN cargotec o ON p.idcargotec = o.idcargotec WHERE s.idservicio = '$idservicio'";
			return ejecutarConsultaSimpleFila($sql);
		}
                
                public function UpFile($archivo, $idservicio){
                    $sql="UPDATE servicio SET file='$archivo'WHERE idservicio='$idservicio'";
			return ejecutarConsulta($sql);
                }
                
                public function UpFirma($archivo, $idservicio){
                    $sql="UPDATE servicio SET filefir='$archivo'WHERE idservicio='$idservicio'";
			return ejecutarConsulta($sql);
                }
                
                public function SolPre($idservicio, $idascensor, $idsupervisor, $idtecnico, $descripcion){
                    $sql="INSERT INTO presupuesto (idservicio, idascensor, idsupervisor, idtecnico, descripcion) VALUES ('$idservicio','$idascensor','$idsupervisor','$idtecnico','$descripcion')";
			return ejecutarConsulta($sql);
                }

                public function SolPreWithImg($idservicio, $idascensor, $idsupervisor, $idtecnico, $descripcion, $imgs, $dTime){
                    $sql="INSERT INTO presupuesto (idservicio, idascensor, idsupervisor, idtecnico, descripcion) VALUES ('$idservicio','$idascensor','$idsupervisor','$idtecnico','$descripcion')";
					$result = ejecutarConsu_retornarID($sql);
					if ($result)
					{
						//$imgs es array
						foreach ($imgs as $imgname) {
							if ($imgname)
							{
								$i++;
								$extension = end(explode(".", $imgname));
								$imgname = $imgname . '___' . $dTime . '.TMP';
								$newImgName = 'presupuesto-' . $result . '-' . $i . '-' . date('YmdHis') . '.' . $extension;
								rename("../../appfabrimetal/files/docsasociados/$imgname", "../../appfabrimetal/files/docsasociados/$newImgName");
								
								/*
								$path_parts = pathinfo('/www/htdocs/index.html');
								echo $path_parts['dirname'], "\n";
								echo $path_parts['basename'], "\n";
								echo $path_parts['extension'], "\n";
								echo $path_parts['filename'], "\n"; // since PHP 5.2.0*/

								/*$filename=$_FILES["picture"]["tmp_name"];
								$extension=end(explode(".", $filename));
								$newfilename="$_POST[lastname]" . '&#95;' . "$_POST[firstname]".".".$extension;
								move_uploaded_file($filename, "peopleimages/" .$newfilename);*/

								$sql="INSERT INTO docsasociados (tabla, datoid, documento) VALUES ('presupuesto','$result','$newImgName')";

								ejecutarConsulta($sql);
							}
						}

					}
					return 1;
                }
                
                public function camfirma($idservicio){
			$sql="SELECT firma FROM servicio WHERE idservicio = '$idservicio' ";
			return ejecutarConsultaSimpleFila($sql);
		}
                
                public function Idsts($idservicio){
			$sql="SELECT ser.idtecnico, tec.idsupervisor FROM servicio ser INNER JOIN tecnico tec ON ser.idtecnico = tec.idtecnico WHERE ser.idservicio = '$idservicio'";
			return ejecutarConsultaSimpleFila($sql);
		}

		public function verificarservicioSAP(){
			$sql = 'ServiceCalls/$count?$filter=Status eq 4 and TechnicianCode eq '.$_SESSION['idSAP'];
		    return Query($sql);
		}

		public function datosserviciosap(){
			$entity = 'ServiceCalls';
			$select = '*';
			$filter = 'Status eq 4 and TechnicianCode eq '.$_SESSION['idSAP'];
			return json_decode(ConsultaEntity($entity,$select,$filter), true);
		}
         
        public function selectestadosap(){
        	$entity = 'U_NX_ESTADOS_FM';
			$select = 'Code,Name';
			$filter = "U_Mostrar eq 'Y'";
			return json_decode(ConsultaEntity($entity,$select,$filter), true);
        }

        public function infoActividadSAP($idactividad){
			/* Inicio ServicaCalls */
			$QueryPath = '$crossjoin(Activities,ServiceCalls,ServiceCallTypes,CustomerEquipmentCards,Items,Manufacturers,EmployeesInfo,EmployeePosition,ItemGroups)';
			$QueryOption = '$expand=ServiceCalls($select=ServiceCallID,CallType,ItemCode,InternalSerialNum,Subject,CreationDate,CustomerCode),ServiceCallTypes($select=Name),CustomerEquipmentCards($select=InternalSerialNum,BuildingFloorRoom,Street,StreetNo,InstallLocation,ItemDescription),Items($select=Manufacturer,ItemCode,ItemName,U_NX_TIPEQUIPO,U_NX_MODELO),Manufacturers($select=ManufacturerName),Activities($select=ActivityDate,ActivityTime,ActivityCode),EmployeesInfo($select=FirstName,MiddleName,LastName,PassportNumber,Position),EmployeePosition($select=Description),ItemGroups($select=Number,GroupName)&$filter=ServiceCalls/CallType eq ServiceCallTypes/CallTypeID and ServiceCalls/InternalSerialNum eq CustomerEquipmentCards/InternalSerialNum and ServiceCalls/ItemCode eq Items/ItemCode and Items/Manufacturer eq Manufacturers/Code and CustomerEquipmentCards/ItemCode eq Items/ItemCode and Activities/ParentObjectId eq ServiceCalls/ServiceCallID and ServiceCalls/TechnicianCode eq EmployeesInfo/EmployeeID and EmployeesInfo/Position eq EmployeePosition/PositionID and Items/ItemsGroupCode eq ItemGroups/Number and Activities/ActivityCode eq ' . $idactividad;
			$rspta = postQuery($QueryPath, $QueryOption);

			$rsptaJson = json_decode($rspta);
			$data = $rsptaJson->value[0];

			return json_encode(array(
				"eqCodigo"      => $data->ServiceCalls->InternalSerialNum . '',
				"eqTipo"        => $data->Items->U_NX_TIPEQUIPO . '',
			    "eqFabricante"  => $data->Manufacturers->ManufacturerName . '',
			    "eqModelo"      => $data->Items->U_NX_MODELO . '',
			    "tcCargo"       => $data->EmployeePosition->Description . '',
			    "tcNombres"     => $data->EmployeesInfo->FirstName . ' ' . $data->EmployeesInfo->MiddleName,
			    "tcApellido"    => $data->EmployeesInfo->LastName . '',
			    "tcRut"         => $data->EmployeesInfo->PassportNumber . '',
			    "edNombre"      => $data->CustomerEquipmentCards->InstallLocation . '',
			    "edDireccion"   => $data->CustomerEquipmentCards->Street.' '.$data->CustomerEquipmentCards->StreetNo,
			    "srNumServ"    => $data->ServiceCalls->ServiceCallID . '',
			    "srTipo"        => $data->ServiceCallTypes->Name . '',
			    "srFecIni"      => $data->Activities->ActivityDate . '',
			    "srHoraIni"     => $data->Activities->ActivityTime . '',
			    "srObsIni"      => $data->ServiceCalls->Subject . '',
			    "activityCode"      => $data->Activities->ActivityCode . ''
			));
		}

        public function MostrarInformacion($id,$idactividad){
        	// echo "<br>select $id<br>";
        	$entity = 'ServiceCalls';
        	$select = 'ServiceCallID,ItemCode,InternalSerialNum,CallType,Subject,CustomerCode,ServiceCallActivities';
        	$servcall = json_decode(ConsultaIDNum($entity,$id,$select), true);
			$customerCode = $servcall['CustomerCode'];
        	if(!empty($servcall['CallType'])){
				$CallType = '';
				$entity = 'ServiceCallTypes';
				$id = $servcall["CallType"];
				$select = 'Name';
				$tipo = json_decode(ConsultaIDNum($entity,$id,$select), true);
			}

			$entity = 'Activities';
			$id = $idactividad;
			$select = 'StartDate,StartTime,U_EstadoInicio';
			$actividad = json_decode(ConsultaIDNum($entity,$id,$select), true);
			
			$crossjoin = '$crossjoin(CustomerEquipmentCards,U_NX_ESTADOS_FM,Items,ItemGroups,Manufacturers)?$expand=U_NX_ESTADOS_FM($select=Name),CustomerEquipmentCards($select=U_NX_SUPERVISOR,U_NX_NOMENCLATURACL,EquipmentCardNum,InternalSerialNum,ItemDescription,InstallLocation,Street,StreetNo),Items($select=ItemName,U_NX_TIPEQUIPO,U_NX_MODELO),ItemGroups($select=GroupName),Manufacturers($select=ManufacturerName)&$filter=CustomerEquipmentCards/U_NX_ESTADOFM eq U_NX_ESTADOS_FM/Code and CustomerEquipmentCards/ItemCode eq Items/ItemCode and Items/ItemsGroupCode eq ItemGroups/Number and Items/Manufacturer eq Manufacturers/Code and CustomerEquipmentCards/InternalSerialNum eq \''.$servcall['InternalSerialNum'].'\' and CustomerEquipmentCards/ItemCode eq \''.$servcall['ItemCode'].'\'';

			$rspta = json_decode(Query($crossjoin), true);
			$conteo = count($servcall['ServiceCallActivities']);
            $actividadID = $servcall['ServiceCallActivities'][$conteo-1]['ActivityCode'];
            $rspta= $rspta['value'][0];

			$data = array(
        			"CustomerCode"=>$customerCode,
        			"ServiceCallID"=>$servcall["ServiceCallID"],
        			"activityID"=>$idactividad,
        			"modelo"=>$rspta["Items"]['U_NX_MODELO'],
        			"tipoequipo"=>$rspta["Items"]['U_NX_TIPEQUIPO'],
        			"ItemCode"=>$servcall['ItemCode'],
        			"Manufacturer"=>$rspta['Manufacturers']['ManufacturerName'],
        			"ItemName"=>$rspta['Items']['ItemName'],
        			"codigo"=>$servcall['InternalSerialNum'],
        			"edificio"=>$rspta['CustomerEquipmentCards']['InstallLocation'],
        			"direccion"=>$rspta['CustomerEquipmentCards']['Street'].' '.$rspta['CustomerEquipmentCards']['StreetNo'],
        			"fecha"=>$actividad['StartDate'],
        			"hora"=>$actividad['StartTime'],
        			"CallType"=>$tipo['Name'],
        			"status"=>$actividad['U_EstadoInicio'],
        			"Subject"=>$servcall['Subject'],
        			"idtservicio"=>$servcall['CallType'],
        			"idascensor"=>$rspta["CustomerEquipmentCards"]["EquipmentCardNum"],
        			"nomenclatura"=>$rspta["CustomerEquipmentCards"]["U_NX_NOMENCLATURACL"],
        			"supervisorID"=>$rspta['CustomerEquipmentCards']['U_NX_SUPERVISOR']
        		);
            /*if (!empty($rspta['CustomerEquipmentCards']['U_NX_SUPERVISOR'])) {
	            $entity = 'U_NX_SUPERVISOR';
				$select = 'U_EmpleadoID';
				$filter = "Code eq '".$rspta['CustomerEquipmentCards']['U_NX_SUPERVISOR']."'";
				$supervisor = json_decode(ConsultaEntity($entity,$select, $filter), true);
				$data["supervisorID"] = $supervisor['value'][0]['U_EmpleadoID'];
            }*/

        	return json_encode($data);
        }

        public function finalizarActividad($data){
        	$data = json_decode($data);
        	if(isset($data->estadofintext)){
			    $estadofintext = $data->estadofintext;
			}else{
			    $estadofintext = $data->estadoascensor;
			}
        	if(isset($data->terceros) && $data->terceros == "true"){
        		$terceros = 'Si';
        	}else{
        		$terceros = 'No';
        	}
        	if($data->oppre == 1){
        		/*$presupuesto = json_encode(array("U_NX_AREA"=>"VTA_PPTO","OpportunityName"=>"GSE - ".$data->servicecallIDfi." - ".$data->actividadIDfi,"Remarks"=>$data->descripcion,"CardCode"=>$data->customercodefi,"U_NX_CODIGOFM"=>$data->codigofmfi,"AttachmentEntry"=>$data->attachments,"SalesOpportunitiesLines"=>array(array("MaxLocalTotal"=>"1.0"))));
        		$entity = 'SalesOpportunities';
        		$rsptapre = InsertarDatos($entity,$presupuesto);
        		$datosOpportunidad = json_decode($rsptapre);

        		$comercial = json_encode(array("DataOwnershipfield"=>$data->comercialID));
        		$id = $datosOpportunidad->SequentialNo;
        		$estexto = false;
        		Editardatos($entity,$id,$comercial,$estexto);*/
        		$datapresupuesto = json_encode($data,JSON_UNESCAPED_UNICODE);
        		$sql="INSERT INTO presupuesto_sap (actividadID, supervisorID, informacion) VALUES ('$data->actividadIDfi','$data->supervisorID','$datapresupuesto')";
				ejecutarConsulta($sql);
        		$entity = 'Activities';
        		$id = $data->actividadIDfi;
        		if($data->opfirma == 2){
        			$firma = 'Y';
        			$status = 5;
        		}else{
        			$firma = 'N';
        			$status = ((isset($data->terminado) && $data->terminado == 'y') ? 1 : '-3');
        		}
        		if(isset($data->guiafimada)){
        			//$actividad = array("HandledByEmployee"=>$_SESSION['idSAP'],"Closed"=>"Y","U_PorFirmar"=>$firma,"EndDueDate"=>date("Y-m-d"),"EndTime"=>date("H:i:s"),"AttachmentEntry"=>$data->guiafimada,"U_NX_OPP"=>$datosOpportunidad->SequentialNo,"Notes"=>$data->txtObsFin,"U_EstadoFin"=>$data->estadoascensor,"U_GPSFin"=>$data->latitudfi.','.$data->longitudfi,"U_OBSINTERNA"=>$data->observacionint);
        			$actividad = array("HandledByEmployee"=>$_SESSION['idSAP'],"Closed"=>"Y","U_PorFirmar"=>$firma,"EndDueDate"=>date("Y-m-d"),"EndTime"=>date("H:i:s"),"AttachmentEntry"=>$data->guiafimada,"Notes"=>$data->observacionfi,"U_EstadoFin"=>$estadofintext,"U_GPSFin"=>$data->latitudfi.','.$data->longitudfi,"U_OBSINTERNA"=>$data->observacionint);
        			if($data->opayu == 'S'){
        					$actividad["U_TieneAyudante"] = $data->opayu;
        				if(isset($data->idayud1) && !empty($data->idayud1)){
							$actividad["U_AYUDANTE1"] = $data->idayud1;
						}
						if(isset($data->idayud2) && !empty($data->idayud2)){
							$actividad["U_AYUDANTE2"] = $data->idayud2;
						}
        			}
        			$actividad = json_encode($actividad);
        		}else{

        			$actividad = array("HandledByEmployee"=>$_SESSION['idSAP'],"Closed"=>"Y","U_PorFirmar"=>$firma,"EndDueDate"=>date("Y-m-d"),"EndTime"=>date("H:i:s"),"U_NX_OPP"=>$datosOpportunidad->SequentialNo,"Notes"=>$data->observacionfi,"U_EstadoFin"=>$estadofintext,"U_GPSFin"=>$data->latitudfi.','.$data->longitudfi,"U_OBSINTERNA"=>$data->observacionint);
        			if($data->opayu == 'S'){
        					$actividad["U_TieneAyudante"] = $data->opayu;
        				if(isset($data->idayud1) && !empty($data->idayud1)){
							$actividad["U_AYUDANTE1"] = $data->idayud1;
						}
						if(isset($data->idayud2) && !empty($data->idayud2)){
							$actividad["U_AYUDANTE2"] = $data->idayud2;
						}
        			}
        			$actividad = json_encode($actividad);
        		}
        		$rsptaactv = EditardatosNum($entity,$id,$actividad);
                
                $sql="INSERT INTO logactividad (actividadID,data) VALUES ('$data->actividadIDfi','$actividad')";
				ejecutarConsulta($sql);
				
        		$entity = 'CustomerEquipmentCards';
        		$id = $data->ascensorIDfi;
        		$servicecall = json_encode(array("U_NX_ESTADOFM"=>$data->idestadofi));
        		$rsptaservcall = EditardatosNum($entity,$id,$servicecall);

        		$entity = 'ServiceCalls';
        		$id = $data->servicecallIDfi;
        		$servicecall = json_encode(array("Status"=>$status,"U_FallaTercero"=>$terceros));
        		$rsptaservcall = EditardatosNum($entity,$id,$servicecall);

        	}else{
        	    if(isset($data->estadofintext)){
				    $estadofintext = $data->estadofintext;
				}else{
				    $estadofintext = $data->estadoascensor;
				}
        		$entity = 'Activities';
        		$id = $data->actividadIDfi;
        		if($data->opfirma == 2){
        			$firma = 'Y';
        			$status = 5;
        		}else{
        			$firma = 'N';
        			$status = ((isset($data->terminado) && $data->terminado == 'y') ? 1 : '-3');
        		}
        		if(isset($data->guiafimada)){
					//$mifecha= date('Y-m-d H:i:s'); 
					//$NuevaFecha = strtotime ( '-4 hour' , strtotime ($mifecha) ) ; 

        			$actividad = array("HandledByEmployee"=>$_SESSION['idSAP'],"Closed"=>"Y","U_PorFirmar"=>$firma,"EndDueDate"=>date("Y-m-d"),"EndTime"=>date("H:i:s"),"AttachmentEntry"=>$data->guiafimada,"Notes"=>$data->observacionfi,"U_EstadoFin"=>$estadofintext,"U_GPSFin"=>$data->latitudfi.','.$data->longitudfi,"U_OBSINTERNA"=>$data->observacionint);
        			if($data->opayu == 'S'){
        					$actividad["U_TieneAyudante"] = $data->opayu;
        				if(isset($data->idayud1) && !empty($data->idayud1)){
							$actividad["U_AYUDANTE1"] = $data->idayud1;
						}
						if(isset($data->idayud2) && !empty($data->idayud2)){
							$actividad["U_AYUDANTE2"] = $data->idayud2;
						}
        			}
        			$actividad = json_encode($actividad);
        		}else{
					//$mifecha= date('Y-m-d H:i:s'); 
					//$NuevaFecha = strtotime ( '-4 hour' , strtotime ($mifecha) ) ; 
					
        			$actividad = array("HandledByEmployee"=>$_SESSION['idSAP'],"Closed"=>"Y","U_PorFirmar"=>$firma,"EndDueDate"=>date("Y-m-d"),"EndTime"=>date("H:i:s"),"Notes"=>$data->observacionfi,"U_EstadoFin"=>$estadofintext,"U_GPSFin"=>$data->latitudfi.','.$data->longitudfi,"U_OBSINTERNA"=>$data->observacionint);
        			if($data->opayu == 'S'){
        					$actividad["U_TieneAyudante"] = $data->opayu;
        				if(isset($data->idayud1) && !empty($data->idayud1)){
							$actividad["U_AYUDANTE1"] = $data->idayud1;
						}
						if(isset($data->idayud2) && !empty($data->idayud2)){
							$actividad["U_AYUDANTE2"] = $data->idayud2;
						}
        			}
        			$actividad = json_encode($actividad);
        		}
        		//echo '<pre>';print_r($actividad);echo '</pre><br><br>'.$terceros;die;
        		$rsptaactv = EditardatosNum($entity,$id,$actividad);
        		
        		$sql="INSERT INTO logactividad (actividadID,data) VALUES ('$data->actividadIDfi','$actividad')";
				ejecutarConsulta($sql);

        		$entity = 'CustomerEquipmentCards';
        		$id = $data->ascensorIDfi;
        		$servicecall = json_encode(array("U_NX_ESTADOFM"=>$data->idestadofi));
        		$rsptaservcall = EditardatosNum($entity,$id,$servicecall);

        		$entity = 'ServiceCalls';
        		$id = $data->servicecallIDfi;
        		$servicecall = json_encode(array("Status"=>$status,"U_FallaTercero"=>$terceros));
        		$rsptaservcall = EditardatosNum($entity,$id,$servicecall);
        	}
        	return true;
        }

		public function SelectTecnico(){
			$query = '$crossjoin(EmployeesInfo, EmployeesInfo/EmployeeRolesInfoLines, EmployeeRolesSetup)?$expand=EmployeesInfo($select=EmployeeID,FirstName,LastName)&$filter=EmployeesInfo/EmployeeID eq EmployeesInfo/EmployeeRolesInfoLines/EmployeeID and EmployeesInfo/EmployeeRolesInfoLines/RoleID eq EmployeeRolesSetup/TypeID and EmployeeRolesSetup/TypeID eq -2';
			return json_decode(Query($query),true);
		}

        public function LSFSAP(){
        	$sql = "sml.svc/LISTA_ACTIVIDADES?\$select=srvCodigo,actCodigo,srvTipoLlamada,equSnInterno,equEdificio,actFecha,actFechaIni,actHoraIni,actFechaFin,actHoraFin&\$filter=actPorFirmar eq 'Y' and actEmplAsistId eq ".$_SESSION['idSAP'];
		    return json_decode(Query($sql), true);
		}

		public function LSPPTOPEND($fm){
        	$entity = 'SalesOpportunities';
			$select = '*';
			$filter = 'ClosingPercentage ne 100.0 and U_NX_CODIGOFM eq \''.$fm .'\'';
			return json_decode(ConsultaEntity($entity,$select,$filter), true);
		}

		 public function finalizarActividadPorFirmar($data){
        	$data = json_decode($data);
        	//echo '<pre>';print_r($data);echo '</pre>';die;
        	
    		$entity = 'Activities';
    		$id = $data->idactividad;
    		$firma = 'N';
    		$status = 1;

    		if(isset($data->guiafimada)){
    			$actividad = json_encode(array("Closed"=>"Y","U_PorFirmar"=>$firma,"AttachmentEntry"=>$data->guiafimada));
    		}
    		else {
    			$actividad = json_encode(array("Closed"=>"Y","U_PorFirmar"=>$firma));
    		}

    		$abrir = json_encode(array("Closed"=>"N"));
    		EditardatosNum($entity,$id,$abrir);
    		$rsptaactv = EditardatosNum($entity,$id,$actividad);

    		$entity = 'ServiceCalls';
    		$id = $data->idserfirma;
    		$servicecall = json_encode(array("Status"=>$status));
    		$rsptaservcall = EditardatosNum($entity,$id,$servicecall);
        	return true;
        }

		public function listarobservacionfin(){
			$sql = "SELECT idobservaciones_cierre_gse, UPPER(descripcion) descripcion FROM observaciones_cierre_gse WHERE condicion = 1;";
		    return ejecutarConsulta($sql);
		}

		public function formfirmasap($idactividad){
			$sql = "sml.svc/LISTA_ACTIVIDADES?\$select=srvCodigo,actCodigo,equSnInterno,artTipoEquipo,artFabricante,artModelo,equEdificio,equCalle,equCalleNro,actFechaIni,actHoraIni,srvTipoLlamada,actEstEquiIni,srvAsunto,actFechaFin,actHoraFin,actEstEquiFin,actComentario,equSupId&\$filter=actCodigo eq ".$idactividad;
		    return json_decode(Query($sql), true);
		}

		public function subirArchivosSap($files, $timestamp = false) {
        	return UploadFile($files, $timestamp);
        }

        public function Actividad($actividadID){
        	$sql = "sml.svc/LISTA_ACTIVIDADES?\$filter=actCodigo eq ".$actividadID;
		    return json_decode(Query($sql), true);

			var_dump($sql);
            die();die;

        }

        public function SelectCliente(){
			$entity = 'BusinessPartners';
			$select = 'CardCode,CardName';
			$filter = "startswith(CardCode,'C')";
			return json_decode(ConsultaEntity($entity,$select,$filter), true);
        }

        public function SelectEdificio($cliente){
        	$entity = 'CustomerEquipmentCards';
			$select = 'InternalSerialNum,InstallLocation';
			$filter = "startswith(CustomerCode,'C".$cliente."')";
			return json_decode(ConsultaEntity($entity,$select,$filter), true);
		}

		public function CrearLlamada($data){
			/*insertar nueva llamada de servicio*/
			$entity = 'ServiceCalls';
			$data = json_encode(
				array(
					"Subject"=>$data['subject'], 
					"CustomerCode"=>$data['customercode'], 
					"InternalSerialNum"=>$data['fm'],
					"ItemCode"=>$data['itemcode'],
					"Priority"=>"M",
					"CallType"=>"4",
					"Origin"=>"-3",
					"Status"=>4
				)
			);

        	return InsertarDatos($entity,$data);
		}

		public function guiaPorCerrar($idactividad) {//0 = no se puede cerrar, 1 = se puede cerrar
			$sql = "sml.svc/LISTA_ACTIVIDADES?\$filter=actCodigo eq ".$idactividad;
		    return json_decode(Query($sql), true);

			/*$sql = "SELECT (CASE WHEN (RES.tipoequipo='ASCENSOR' AND RES.tiposervicio='MANTENCION') THEN CASE WHEN RES.fechaactual>=date_add(RES.fechacreacion,INTERVAL RES.minutosespera MINUTE) THEN 1 ELSE 0 END ELSE 1 END) AS cerrarguia,date_add(RES.fechacreacion,INTERVAL RES.minutosespera MINUTE) AS fechamincierre FROM (SELECT A.paradas*{$minutosXparada} AS minutosespera,TA.nombre AS tipoequipo,TS.nombre AS tiposervicio,S.created_time AS fechacreacion,CURRENT_TIMESTAMP () AS fechaactual FROM ascensor AS A INNER JOIN servicio AS S ON A.idascensor=S.idascensor INNER JOIN tascensor AS TA ON A.idtascensor=TA.idtascensor INNER JOIN tservicio AS TS ON S.idtservicio=TS.idtservicio WHERE S.idservicio={$idservicio}) AS RES";
			return ejecutarConsultaSimpleFila($sql);*/
		}
	}
?>