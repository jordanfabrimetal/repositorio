<?php
if (strlen(session_id()) < 1) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Servicios e Informatica</title>

        <link rel="icon" href="../public/favicon.ico" type="image/x-icon" />

        <!-- Bootstrap -->
        <link href="../public/build/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../public/build/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../public/build/css/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../public/build/css/green.css" rel="stylesheet">

        <!-- Datatables -->
        <link href="../public/build/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../public/build/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../public/build/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../public/build/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../public/build/css/scroller.bootstrap.min.css" rel="stylesheet">

        <!-- PNotify -->
        <link href="../public/build/css/pnotify.css" rel="stylesheet">
        <link href="../public/build/css/pnotify.buttons.css" rel="stylesheet">
        <link href="../public/build/css/pnotify.nonblock.css" rel="stylesheet">

        <!-- FORMS -->
        <link href="../public/build/css/prettify.min.css" rel="stylesheet">
        <link href="../public/build/css/select2.min.css" rel="stylesheet">
        <link href="../public/build/css/switchery.min.css" rel="stylesheet">
        <link href="../public/build/css/starrr.css" rel="stylesheet">

        <!-- bootstrap-file-imput -->
        <link href="../public/build/css/fileinput.min.css" rel="stylesheet">

        <!-- bootstrap-select -->
        <link href="../public/build/css/bootstrap-select.min.css" rel="stylesheet">

        <!-- bootstrap-daterangepicker -->
        <link href="../public/build/css/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="../public/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- Ion.RangeSlider -->
        <link href="../public/build/css/normalize.css" rel="stylesheet">
        <link href="../public/build/css/ion.rangeSlider.css" rel="stylesheet">
        <link href="../public/build/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
        <!-- Bootstrap Colorpicker -->
        <link href="../public/build/css/bootstrap-colorpicker.min.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="../public/build/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="../public/build/css/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="../public/build/css/daterangepicker.css" rel="stylesheet">

        <!-- FullCalendar -->
        <link href="../public/build/css/fullcalendar.min.css" rel="stylesheet">
        <link href="../public/build/css/fullcalendar.print.css" rel="stylesheet" media="print">

        <!-- Custom Theme Style -->
        <link href="../public/build/css/custom.css" rel="stylesheet">
                
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="estado.php" class="site_title"><i class="fa fa-building-o"></i> <span>Fabrimetal</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="../files/usuarios/<?php echo $_SESSION['imagen'] ?>" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Bienvenido,</span>
                                <h2><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>Fabrimetal</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i>INICIO<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="inicio.php">INICIO</a></li>
                                        </ul>
                                    </li>
                                    <?php
                                    if ($_SESSION['administrador'] == 1) {
                                        ?>
                                        <li><a><i class="fa fa-home"></i>ESTADISTICAS<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><a href="estadomoviles.php">MOVILES</a></li>
                                                <li><a href="estadovehiculo.php">VEHICULOS</a></li>
                                                <li><a href="estadoequipo.php">COMPUTADORES</a></li>
                                                <li><a href="estadotarjeta.php">TARJETAS ID</a></li>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    if ($_SESSION['administrador'] == 1) {
                                        ?>
                                        <li><a><i class="fa fa-map-marker"></i>OFICINA<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><a href="empleado.php">EMPLEADOS</a></li>  
                                                <li><a href="docempleado.php">DOCUMENTOS DEL EMPLEADO</a></li>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                        
                                    <?php
                                    if ($_SESSION['administrador'] == 1) {
                                        ?>
                                        <li><a><i class="fa fa-map-marker"></i>MOVILES<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><a href="asignacion.php">ASIGNACIONES</a></li>
                                                <li><a href="asignacion_hist.php">ASIGNACIONES HISTORICO</a></li>
                                                <li><a href="equipo.php">MOVILES</a></li>
                                                <li><a href="chip.php">TARJETA SIM</a></li>
                                                <li><a href="gestionchip.php">TARJETA SIM ROBADA</a></li>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if ($_SESSION['administrador'] == 1) {
                                        ?>
                                        <li><a><i class="fa fa-map-marker"></i>COMPUTADORES<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><a href="asigcomputador.php">ASIGNACIONES</a></li>    
                                                <li><a href="computador.php">COMPUTADORES</a></li>             
                                                <li><a href="doccomputadores.php">DOCUMENTOS DE COMPUTADORES</a></li> 
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    
                                        
                                    <?php
                                    if ($_SESSION['administrador'] == 1) {
                                        ?>
                                        <li><a><i class="fa fa-map-marker"></i>TARJETAS ID<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><a href="asigtarjeta.php">ASIGNACIONES</a></li> 
                                                <li><a href="tarjeta.php">TARJETAS</a></li>                       
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                    if ($_SESSION['administrador'] == 1) {
                                        ?>
                                        <li><a><i class="fa fa-map-marker"></i>VEHICULOS<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><a href="asignacionvehiculo.php">ASIGNACIONES</a></li>
                                                <li><a href="asignacionvehiculo_hist.php">ASIGNACIONES HISTORICO</a></li>
                                                <li><a href="vehiculo.php">VEHICULOS</a></li>
                                                <li><a href="docvehiculos.php">DOCUMENTACION DE VEHICULOS</a></li>
                                                <li><a href="gestionvehiculos.php">GESTION DE VEHICULOS</a></li>                                               
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                     
                                    ?>

                                    <?php
                                    if ($_SESSION['vehiculos'] == 1) {
                                        ?>
                                        <li><a><i class="fa fa-map-marker"></i>VEHICULOS<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><a href="asignacionvehiculo.php">ASIGNACIONES</a></li>
                                                <li><a href="asignacionvehiculo_hist.php">ASIGNACIONES HISTORICO</a></li>
                                                <li><a href="vehiculo.php">VEHICULOS</a></li>
                                                <li><a href="docvehiculos.php">DOCUMENTACION DE VEHICULOS</a></li>                                              
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                     
                                    ?>

                                </ul>
                            </div>


                            <?php
                            if ($_SESSION['administrador'] == 1) {
                                ?>
                                <!--<div class="menu_section">
                                    <h3>Administracion</h3>
                                    <ul class="nav side-menu">

                                        <?php
                                        if ($_SESSION['administrador'] == 1) {
                                            ?>
                                            <li><a><i class="fa fa-bug"></i>SISTEMA<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">
                                                    <li><a href="usuario.php">USUARIOS</a></li>
                                                    <li><a href="role.php">PERFILES</a></li>
                                                    <li><a href="permiso.php">PERMISOS</a></li>

                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        ?>

                                        <?php
                                        if ($_SESSION['administrador'] == 1) {
                                            ?>
                                            <li><a><i class="fa fa-bug"></i>OFICINA<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">
                                                    <li><a href="#">OFICINAS</a></li>
                                                    <li><a href="departamentos.php">DEPARTAMENTOS</a></li>
                                                    <li><a href="cargos.php">CARGOS</a></li>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        ?>

                                        <?php
                                        if ($_SESSION['administrador'] == 1) {
                                            ?>
                                            <li><a><i class="fa fa-bug"></i>MOVILES<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">
                                                    <li><a href="detalle.php">TIPO</a></li>                       
                                                    <li><a href="operador.php">OPERADOR</a></li>

                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        ?>

                                        <?php
                                        if ($_SESSION['administrador'] == 1) {
                                            ?>
                                            <li><a><i class="fa fa-bug"></i>COMPUTADORES<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">                          
                                                    <li><a href="tipocomputador.php">TIPO</a></li>
                                                    <li><a href="marcacom.php">MARCA</a></li>                      
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        if ($_SESSION['administrador'] == 1) {
                                            ?>
                                            <li><a><i class="fa fa-bug"></i>DISPOSITIVOS<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">                          
                                                    <li><a href="tdispositivo.php">TIPO</a></li>                    
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        if ($_SESSION['administrador'] == 1) {
                                            ?>
                                            <li><a><i class="fa fa-bug"></i>VEHICULOS<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">
                                                    <li><a href="tvehiculo.php">TIPO</a></li>
                                                    <li><a href="marcave.php">MARCA</a></li>
                                                    <li><a href="modelove.php">MODELO</a></li>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        if ($_SESSION['administrador'] == 1) {
                                            ?>
                                            <li><a><i class="fa fa-bug"></i>TARJETAS ID<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">
                                                    <li><a href="nivel.php">NIVELES ACCESO</a></li>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        ?>

                                    </ul>
                                </div>-->
                                <?php
                            }
                            ?>
                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <!--<a data-toggle="tooltip" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Lock">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Salir" href="../ajax/usuario.php?op=salir">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>-->
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="../files/usuarios/<?php echo $_SESSION['imagen'] ?>" alt=""><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <!--<li><a href="#"> Perfil</a></li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li><a href="javascript:;">Help</a></li>-->
                                        <li><a href="../ajax/usuario.php?op=salir"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>