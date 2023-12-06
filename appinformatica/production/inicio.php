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
          <div class="">
            <div class="page-title">
              <div class="title">
                 <h3><b>APP SERVICIOS E INFORMATICA</b></h3>
                <h3>CONTROL DE GESTION</h3>
                <h3>DPTO. SERVICIOS E INFORMATICA</h3>
              </div>
            </div>

            <div class="clearfix"></div>

          </div>
        </div>
        <!-- /Fin Contenido -->

<?php 
require 'footer.php';
?>

<?php
}
ob_end_flush();
?>
