<?php
ob_start();
session_name('SESS_GSAP');
session_start();

// $_SESSION['iduser'] = 7;

if (!isset($_SESSION["nombre"])) {
    echo 'DEBE HACER LOGIN EN SISTEMA GSERVICIOSAP O APPFABRIMETALSAP';
    exit();
} else {
    // require 'header.php';
?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../public/build/css/alert.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
  .tabla {
    /*font-family: verdana, sans-serif;*/
  }
  .input {
    /*font-family: 'verdana', 'sans-serif';*/
    border: none; /* Remove borders */
    color: #FFFFFF; /* Add a text color */
    background-color: #000000;
    padding: 5px 10px; /* Add some padding */
    cursor: pointer;
  }
  .btnLimpiar { background-color: #a3c2c2; }
  .btnLimpiar:hover { background-color: #75a3a3; }
  .btnActualizar { background-color: #04AA6D; }
  .btnActualizar:hover { background-color: #46a049; }
  .btnResetear { background-color: #2196F3; }
  .btnResetear:hover { background-color: #0b7dda; }
</style>
<table width="100%" class="tabla">
  <tr>
    <td colspan="2"><h3>FIRMA DIGITAL DE DOCUMENTOS</h3></td>
  </tr>
  <tr id="blqInfo">
    <td colspan="2"><h5 style="color: grey">Registre por favor su firma para poder firmar las guías, checklist, entre otros.</h5><br></td>
  </tr>
  <tr id="blqNombre">
    <td width="25%"><strong>Nombre:</strong></td>
    <td><span id="fmaNombre"></span></td>
  </tr>
  <tr id="blqApellido">
    <td width="25%"><strong>Apellido:</strong></td>
    <td><span id="fmaApellido"></span></td>
  </tr>
  <tr>
    <td width="25%"><strong>Status:</strong></td>
    <td><strong><span id="fmaStatus" style="color:#2196F3"></span></strong></td>
  </tr>
  <tr>
    <td colspan="2">
      <form class="form-horizontal form-label-left" id="formulariofirmadigital" name="formulariofirmadigital">
        <input type="hidden" name="firma" id="firma">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group" id="firmapad" name="firmapad" >
            <canvas id="firmafi" id="firmafi" class="firmafi" style="border: 2px dashed #888; width: 100%;"></canvas>
            </div>
            <button type="button" id="btnCancelar" class="input" data-dismiss="modal" onclick="window.parent.$('#modalFirma').modal('hide');">Cancelar</button>
            <!-- <button class="input" type="button" id="btnCancelar" onclick="cancelarform()">Cancelar</button> -->
            <button class="input btnLimpiar" type="button" id="btnLimpiar" onclick="borrarfirma()">Limpiar</button>
            <button class="input btnResetear" type="button" id="btnResetear" onclick="resetearfirma()">Resetear</button>
            <button class="input btnActualizar btnAlert" type="submit" id="btnGuardar">Actualizar</button>
      </form>
    </td>
  </tr>
  <tr></tr>
</table>
<script src="../public/build/js/jquery.min.js"></script>
<script src="../public/build/js/signature_pad.min.js"></script>
<script src="../public/build/js/bootbox.min.js"></script>
<script src="../public/build/js/alert.js"></script>

<!-- Script no refresca a veces los cambios en los dispositivos moviles. Se cambia la forma de cargar por uno random -->
<script id="myScript" context="<?=@$_GET['context'] . ''?>"></script>
<script>
  var url = 'scripts/digitalsignature.js';
  var extra = '?t=';
  var randomNum = String((Math.floor(Math.random() * 20000000000)));
  document.getElementById('myScript').src = url + extra + randomNum;
</script>
<?php
}
ob_end_flush();
?>