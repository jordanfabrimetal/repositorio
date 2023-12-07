<?php
session_name('SESS_GSAP');
session_start();

require_once "../modelos/Usuario.php";

$usuario = new Usuario();

$iduser         = isset($_POST["iduser"]) ? limpiarCadena($_POST["iduser"]) : "";
$idrole         = isset($_POST["idrole"]) ? limpiarCadena($_POST["idrole"]) : "";
$username       = isset($_POST["username"]) ? limpiarCadena($_POST["username"]) : "";
$password       = isset($_POST["password"]) ? limpiarCadena($_POST["password"]) : "";
$nombre         = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$apellido       = isset($_POST["apellido"]) ? limpiarCadena($_POST["apellido"]) : "";
$tipo_documento = isset($_POST["tipo_documento"]) ? limpiarCadena($_POST["tipo_documento"]) : "";
$num_documento  = isset($_POST["num_documento"]) ? limpiarCadena($_POST["num_documento"]) : "";
$fecha_nac      = isset($_POST["fecha_nac"]) ? limpiarCadena($_POST["fecha_nac"]) : "";
$direccion      = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
$telefono       = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$email          = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";

switch ($_GET["op"]) {
    case 'getFirma':
        require_once "../modelos/Usuario.php";
        $rspta   = $usuario->getFirma($_SESSION['iduser']);
        echo json_encode($rspta);
        break;

    case 'setFirma':
        $firma = isset($_POST["firma"]) ? limpiarCadena($_POST["firma"]) : '';
        if ($firma) {
            $encoded_image = explode(",", $firma)[1];
            $decoded_image = base64_decode($encoded_image);
            $imgfirma      = round(microtime(true)) . ".png";
            $patchfir      = "../../../appfabrimetalsap/files/usuarios/firmas/" . $imgfirma;
            file_put_contents($patchfir, $decoded_image);
            $rspta = $usuario->setFirma($_SESSION['iduser'], $firma, $imgfirma);
            // $rspta = $usuario->setFirma($_SESSION['iduser'], $firma);
            echo $rspta;
        } else {
            echo 0;
        }

        break;
}
