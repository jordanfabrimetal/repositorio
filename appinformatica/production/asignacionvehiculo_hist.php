<?php
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
    header("Location:login.php");
} else {

    require 'header.php';

    if ($_SESSION['administrador'] == 1 || $_SESSION['vehiculos'] == 1) {
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Asignaciones de vehiculos - Historico</h2>                                
                                <div class="clearfix"></div>
                            </div>
                            <div id="filtro" class="x_content">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>EMPLEADO</label>
                                        <select id="selempleado" name="selempleado" data-live-search="true" class="selectpicker form-control"></select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>PATENTE</label>
                                        <select id="selpatente" name="selpatente" data-live-search="true" class="selectpicker form-control"></select>
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <button type="button" class="btn btn-info" onclick="listar2();">BUSCAR</button>
                                    </div>
                                </div>
                            </div>
                            <div id="listadoasigvehiculo" class="x_content">

                                <table id="tblasigvehiculo" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>                       
                                            <th>COLABORADOR</th>
                                            <th>RUT</th>    
                                            <th>VEHICULO</th>
                                            <th>PATENTE</th>
                                            <th>FECHA ASIG</th>
                                            <th>FECHA DEV</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

  <!-- Modal -->  
            
        
        <?php
    } else {
        require 'nopermiso.php';
    }
    require 'footer.php';
    ?>
    <script src="../public/build/js/jspdf.min.js"></script>
    <script src="../public/build/js/jspdf.plugin.autotable.js"></script>
    <script src="../public/build/js/jsPDFcenter.js"></script>
    <script type="text/javascript" src="scripts/asignacionvehiculo_hist.js"></script>
    <?php
}
ob_end_flush();
?>