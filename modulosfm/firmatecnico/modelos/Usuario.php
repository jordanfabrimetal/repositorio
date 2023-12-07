<?php
require "../config/conexion.php";

class Usuario
{
    //Constructor para instancias
    public function __construct()
    {

    }

    public function getFirma($iduser)
    {
        $sql = "SELECT nombre, apellido, num_documento, firma FROM user WHERE iduser=$iduser";
        return ejecutarConsultaSimpleFila($sql);
    }

    // public function setFirma($iduser, $firma)
    public function setFirma($iduser, $firma, $filefirmapng)
    {
        // $sql = "UPDATE user SET firma='$firma' WHERE iduser='$iduser'";
        $sql="UPDATE user SET firma='$firma', filefir='$filefirmapng' WHERE iduser='$iduser'";
        return ejecutarConsulta($sql);
    }
}
