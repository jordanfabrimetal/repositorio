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
                      <h2>Gesti&oacute;n de Veh&iacute;culos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <button type="button" id="boton_regresar" onclick="mostrarform(false);" class="btn btn-primary">Regresar</button>               
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div id="listadovehiculosgestion" class="x_content">
                    <table id="tblvehiculosgestion" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Opciones</th>
                          <th>Tipo de Gesti&oacute;n</th>
                          <th>Veh&iacute;culo</th>                         
                          <th>Año</th>
                          <th>Patente</th>
                          <th>Serial Motor</th>
                          <th>Ultima Gesti&oacute;n</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>

                    
        <div class="row" id="verGestion" >
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                    <h2>Detalles de la Gesti&oacute;n</h2>
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">

                    <!-- start project-detail sidebar -->
                  <div class="col-md-3 col-sm-3 col-xs-12">

                    <section class="panel">

                      <div class="x_title">
                          <h3>Datos del Veh&iacute;culo</h3>
                        <div class="clearfix"></div>
                      </div>
                      <div class="panel-body">

                        <div class="project_detail">
                          <p class="title">Veh&iacute;culo</p>
                          <p id="vehiculo"></p>
                          <p class="title">Tipo</p>
                          <p id="tipo"></p>
                          <p class="title">Año</p>
                          <p id="anio"></p>
                          <p class="title">Patente</p>
                          <p id="patente"></p>
                          <p class="title">Kilometraje</p>
                          <p id="kilometraje"></p>
                          <p class="title">Disponible</p>
                          <p id="disponible"></p>
                          <p class="title">Estado</p>
                          <p id="estado"></p>
                          <p class="title">Condici&oacute;n</p>
                          <p id="condicion"></p>
                        </div>
                        <br />
                      </div>
                    </section>

                  </div>
                  <!-- end project-detail sidebar -->
                  
                  <div class="col-md-9 col-sm-9 col-xs-12">
                      
                          <ul class="stats-overview">
                      <li>
                          <span class="name"> Tipo de Gesti&oacute;n </span>
                          <span class="value text-success" id="tipo_gestion">  </span>
                      </li>
                      <li>
                          <span class="name"> Fecha de Creaci&oacute;n </span>
                          <span class="value text-success" id="fecha_creacion_gestion">  </span>
                      </li>
                      <li class="hidden-phone">
                          <span class="name"> &nbsp; </span>
                        <span class="value text-success">  </span>
                      </li>
                    </ul>
                    <br />
                    
                    <div>
                        <h4>&nbsp;</h4>
                      <!-- end of user messages -->
                      <ul class="messages" id="listaGestion"> </ul>
                      <!-- end of user messages -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        
        <!-- Modal -->
<div class="modal fade" id="modalGestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="">Realizar Gesti&oacute;n</h4>
        </div>
        <form id="formGestion" name="formGestion">
            <input type="hidden" name="idgestion_ve" id="idgestion_ve" value="">
            <input type="hidden" name="idvehiculo" id="idvehiculo" value="">
            <div class="modal-body">
              <div class="form-group">
                  <label for="titulo">Estado de la gesti&oacute;n</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" style="text-transform: uppercase;"  placeholder="Ingrese el estado de la gestión" required="required" maxlength="100">          
              </div>
              <div class="form-group">
                  <label for="descripcion">Descripci&oacute;n</label>          
                  <textarea id="descripcion" name="descripcion" class="form-control" style="text-transform: uppercase;" placeholder="Ingrese la descripción" required="required"></textarea>
              </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="check_finGestion" name="check_finGestion">
                    <label class="form-check-label" for="check_finGestion">Finalizar la Gesti&oacute;n</label>
              </div>
                <div class="form-group" style="display: none" id="div_estado_final">
                    <label for="estado_final">Estado Final del Veh&iacute;culo despues de esta Gesti&oacute;n</label>          
                    <select class="form-control" id="estado_final" name="estado_final">
                        <option value=""><--Seleccione--></option>
                        <option value="0">Vehículo Normalizado</option>
                        <option value="1">Mantención</option>
                        <option value="2">Reparación</option>
                        <option value="3">Siniestro</option>
                        <option value="4">Robo</option>
                  </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
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
<script type="text/javascript" src="scripts/gestionvehiculo.js"></script>
<?php 
}
ob_end_flush();
?>