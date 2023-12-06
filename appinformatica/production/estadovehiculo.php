<?php
ob_start();
session_start();

if(!isset($_SESSION["nombre"])){
  header("Location:login.php");
}else{

require 'header.php';


 ?>
        <!-- Contenido -->
        <div class="right_col" role="main">
               
          <div class="row tile_count">
              <h3>Estado de los Veh&iacute;culos</h3>
            
            <div class="col-md-2 col-sm-2 col-xs-2 tile_stats_count">
              <span class="count_top"><i class="fa fa-car"></i> Total Flota&nbsp; </span>
              <div class="count"><a href="#" id="vehiculos"></a></div>              
            </div>
            
            <div class="col-md-2 col-sm-2 col-xs-2 tile_stats_count">
                <span class="count_top"><i class="fa fa-car"></i> Veh&iacute;culos Asignados&nbsp;</span>
              <div class="count"><a href="#" id="vehi_asig"></a></div>              
            </div>
            
            <div class="col-md-2 col-sm-2 col-xs-2 tile_stats_count">
              <span class="count_top"><i class="fa fa-car"></i> Veh&iacute;culos Sin Asignaci&oacute;n&nbsp;</span>
              <div class="count green"><a href="#" id="vehi_libres"></a></div>
            </div>  
            
            <div class="col-md-2 col-sm-2 col-xs-2 tile_stats_count">
                <span class="count_top"><i class="fa fa-car"></i> Veh&iacute;culos en Mantenci&oacute;n </span>
              <div class="count green"><a href="#" id="vehi_mant"></a></div>
            </div>
            
            <div class="col-md-2 col-sm-2 col-xs-2 tile_stats_count">
                <span class="count_top"><i class="fa fa-car"></i> Veh&iacute;culos en Reparaci&oacute;n </span>
              <div class="count green"><a href="#" id="vehi_rep"></a></div>
            </div>
            
            <div class="col-md-2 col-sm-2 col-xs-2 tile_stats_count">
              <span class="count_top"><i class="fa fa-car"></i> Veh&iacute;culos con Siniestro </span>
              <div class="count green"><a href="#" id="vehi_sin"></a></div>
            </div>
            
            <!--<div class="col-md-2 col-sm-2 col-xs-2 tile_stats_count">
              <span class="count_top"><i class="fa fa-car"></i> Veh&iacute;culos<br>Robado </span>
              <div class="count green"><a href="#" id="vehi_rob"></a></div> -->
            </div>
            
          </div>
        </div>
        <!-- /Fin Contenido -->

<?php 
require 'footer.php';
?>
<script type="text/javascript" src="scripts/estadovehiculo.js"></script>

<?php
}
ob_end_flush();
?>
