<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Guia de Servicio</title>
    
    <link rel="icon" href="../public/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap -->
    <link href="../public/build/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../public/build/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../public/build/css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../public/build/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../public/build/css/custom.min.css" rel="stylesheet">
    <style>
            #loadingDiv{
              display: none;
              position:fixed;
              top:0px;
              right:0px;
              width:100%;
              height:100%;
              background-color:#666;
              z-index:10000000;
              opacity: 0.4;
              filter: alpha(opacity=40); /* For IE8 and earlier */
            }
            #imgLoading {
              position: absolute;
              margin: auto;
              top: 0;
              left: 0;
              right: 0;
              bottom: 0;
            }
        </style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" id="frmAcceso" name="frmAcceso">
              <h1>Guia de Servicio</h1>
              <div>
                <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required="" />
              </div>
              <div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-default" type="submit">Ingresar</button>
                <a class="reset_pass" href="#">Olvidaste tu clave?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-building "></i>Fabrimetal</h1>
                  <p>©2018 Fabrimetal sobre plantilla Bootstrap. Terminos y Privacidad</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
<div id="loadingDiv"><img src="../public/build/images/gif-sap.gif" id="imgLoading"></div>
    <!-- jQuery -->
    <script src="../public/build/js/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="../public/build/js/bootstrap.min.js"></script>
    <!-- Bootbox Alert -->
    <script src="../public/build/js/bootbox.min.js"></script>

    <script type="text/javascript" src="scripts/login.js"></script>

  </body>
</html>
