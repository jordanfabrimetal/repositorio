<?php 
ob_start();
session_start();

if(!isset($_SESSION["nombre"])){
  header("Location:login.php");
}else{

require 'header.php';

if( $_SESSION['administrador']==1 || $_SESSION['vehiculos']==1)
{

 ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>VEHICULOS</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-tooltip="tooltip" title="Operaciones" role="button" aria-expanded="false"><i class="fa fa-cog"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a id="op_agregar" onclick="mostarform(true)">AGREGAR</a>
                          </li>
                          <li><a id="op_listar" onclick="mostarform(false)">LISTAR</a>
                          </li>
                        </ul>
                      </li>                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div id="listadovehiculos" class="x_content">

                    <table id="tblvehiculos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th></th>
                          <th>VEHICULO</th>                         
                          <th>TIPO</th>
                          <th>AÑO</th>
                          <th>PATENTE</th>                          
                          <th>KILOMETRAJE</th>
                          <th>DISPONIBLE</th>
                          <th>ESTADO</th>
                          <th>CONDICION</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>

                  <div id="formulariovehiculos" class="x_content">
                    <br />

                    <div class="col-md-12 center-margin">
	                  <form class="form-horizontal form-label-left" id="formulario" name="formulario">
	                    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label>TIPO</label><span class="required">*</span>
                                <input type="hidden" id="idvehiculo" name="idvehiculo" class="form-control">
                                <select class="form-control selectpicker" data-live-search="true" id="tvehiculo" name="tvehiculo" required="required">
                                </select>
	                    </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label>MARCA</label><span class="required">*</span>
                                <select class="form-control selectpicker" data-live-search="true" id="idmarca" name="idmarca" required="required">
                                </select>
	                    </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label>MODELO</label><span class="required">*</span>
                                <select class="form-control selectpicker" data-live-search="true" id="idmodelo" name="idmodelo" required="required">
                                </select>
	                    </div>
                            <div class="col-md-1 col-sm-12 col-xs-12 form-group">
	                    	<label>AÑO</label><span class="required">*</span>
	                      	<input type="text" class="form-control" name="ano" id="ano" required="required">
                            </div>
	                    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
	                    	<label>KILOMETRAJE</label><span class="required">*</span>
	                      	<input type="text" class="form-control" name="kilometraje" id="kilometraje" required="required">
                            </div>	                   
	                    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
	                    	<label>PATENTE</label><span class="required">*</span>
	                      	<input type="text" class="form-control" name="patente" id="patente" required="required">
                            </div>	
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
	                    	<label>SERIAL MOTOR</label>
	                      	<input type="text" class="form-control" name="serialmotor" id="serialmotor">
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
	                    	<label>SERIAL CARROCERIA</label>
	                      	<input type="text" class="form-control" name="serialcarroceria" id="serialcarroceria">
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
	                      <label>ESTADO</label><span class="required">*</span>
	                      <select class="form-control selectpicker" data-live-search="true" id="estado" name="estado" required="required">
	                      		<option value="" selected disabled>SELECCIONE ESTADO</option>
	                      		<option value="1">NUEVO</option>
                                        <option value="0">USADO</option>
                                </select>
	                    </div>
                     <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                         <label>FECHA DE REVISION DE GASES</label>
                        <div class='input-group date form_datetime'>                            
                            <input type='text' id="gases" name="gases" class="form-control" placeholder="" />
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                        <label>FECHA DE REVISION TECNICA</label>
                        <div class='input-group date form_datetime'>                           
                            <input type='text' id="tecnica" name="tecnica" class="form-control" placeholder=""  />
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                        <label>FECHA PERMISO DE CIRCULACION</label>
                        <div class='input-group date form_datetime'>
                            <input type='text' id="circulacion" name="circulacion" class="form-control" placeholder=""  />
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label for="nedificios">OBSERVACIONES</label>
                                <textarea type="text" id="observaciones" name="observaciones" class="resizable_textarea form-control"></textarea>
                            </div>
                    	<div class="clearfix"></div>
                    	<div class="ln_solid"></div> 

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <button class="btn btn-primary" type="button" id="btnCancelar" onclick="cancelarform()">Cancelar</button>
                              <button class="btn btn-primary" type="reset" id="btnLimpiar" onclick="limpiar()">Limpiar</button>
                              <button class="btn btn-success" type="submit" id="btnGuardar">Agregar</button>
                            </div>
                        </div>
	                  </form>
	                </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

 
<!-- Modal -->
<div class="modal fade" id="modalDocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="">Registro de Documentos</h4>
        </div>
        <form id="formPlazoDocumentosVehiculo" name="formPlazoDocumentosVehiculo">
            <input type="hidden" name="id_vehiculo" id="id_vehiculo">
            <div class="modal-body">
              <div class="form-group">
                        <label>FECHA DE REVISION DE GASES</label>
                        <div class='input-group date form_datetime'>                           
                            <input type='text' id="doc_gases" name="doc_gases" class="form-control" placeholder=""  />
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
              </div>
                 <div class="form-group">
                        <label>FECHA DE REVISION TECNICA</label>
                        <div class='input-group date form_datetime'>                           
                            <input type='text' id="doc_tecnica" name="doc_tecnica" class="form-control" placeholder=""  />
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
              </div>
                 <div class="form-group">
                        <label>FECHA DE PERMISO DE CIRCULACION</label>
                        <div class='input-group date form_datetime'>                           
                            <input type='text' id="doc_circulacion" name="doc_circulacion" class="form-control" placeholder=""  />
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" id="btnGuardarModal">Guardar</button>
            </div>                        
        </form>
    </div>
  </div>
</div>   
        
        
<?php 
}else{
  require 'nopermiso.php';
}
require 'footer.php';
?>
<script>
    $('.form_datetime').datetimepicker({
        format: 'YYYY-MM-DD'
    });
</script>
<script type="text/javascript" src="scripts/vehiculo.js"></script>
<?php 
}
ob_end_flush();
?>