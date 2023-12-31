<?php
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
    header("Location:login.php");
} else {

    require 'header.php';

    if ($_SESSION['administrador'] == 1) {
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>ASIGNACION COMPUTADORES</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-tooltip="tooltip" title="Operaciones" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cog"></i></a>
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
                            <div id="listadoasignacion" class="x_content">

                                <table id="tblasignacion" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>EMPLEADO</th>
                                            <th>COMPUTADOR</th>
                                            <th>IP</th>                                           
                                            <th>USUARIO</th>
                                            <th>CONTRASEÑA</th>                                           
                                            <th>FECHA</th>
                                            <th>ENTREGA</th>
                                            <th>DEVOLUCION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div id="formularioasignacion" class="x_content">
                                <br />

                                <div class="col-md-12 center-margin">
                                    <form class="form-horizontal form-label-left" id="formulario" name="formulario">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <label>COMPUTADOR</label>
                                            <input type="hidden" id="idasigcompu" name="idasigcompu" class="form-control">
                                            <select class="form-control selectpicker" data-live-search="true" id="idcomputador" name="idcomputador" required="required">
                                            </select>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                            <label>EMPLEADO</label>
                                            <select class="form-control selectpicker" data-live-search="true" id="idempleado" name="idempleado" required="required">
                                            </select>   
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                            <label>NOMBRE DEL EQUIPO</label>
                                            <input type="text" class="form-control" name="nomequipo" id="nomequipo">
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                            <label>DIRECCION IP ASIGNADA</label>
                                            <input type="text" class="form-control" name="ip" id="ip" data-inputmask="'mask' : '999.999.999.999'" >
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                            <label>USUARIO</label>
                                            <input type="text" class="form-control" name="usuario" id="usuario" required>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                            <label>CONTRASEÑA</label>
                                            <input type="text" class="form-control" name="pass" id="pass" required>
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

        <?php
    } else {
        require 'nopermiso.php';
    }
    require 'footer.php';
    ?>
    <script src="../public/build/js/jspdf.min.js"></script>
    <script src="../public/build/js/jspdf.plugin.autotable.js"></script>
    <script src="../public/build/js/jsPDFcenter.js"></script>


    <script type="text/javascript" src="scripts/asigcomputador.js"></script>
    <?php
}
ob_end_flush();
?>