<?php
error_reporting(E_ERROR);
require "php\claseSesion.php";
require "php/library/nusoap/lib/nusoap.php";


$sesion = new Sesion();
$cliente = new nusoap_client("http://atc.mx/WebService/Aplicacion%20de%20escritorio/seguridad/seguridad.php?wsdl",false);
if ($sesion->estadoLogin()==true) {
$datosUsuario=$sesion->datosUsuario();
  $usuarioID=$datosUsuario[0];
  $empresaID=$datosUsuario[1];
  $permisoID=$datosUsuario[2];

  //Saca el saldo actual del usurio
  $saldo = saldoUsuario($usuarioID);
  $nombre = nombreUsuario($usuarioID);
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>ActivaChip</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" type="text/css" href="css/principal.css" />
      <link href="css/styleR.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" type="text/css" href="css/principal.css" />
      <link href="css/styleR.css" rel="stylesheet" type="text/css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.css">
</head>

<body>
  <div class="container">
      <ul id="nav" >
          <li><a href="recarga">Inicio</a></li>
          <li ><a href="reporte">Reporte</a></li>
            <?php if ($permisoID == 1) {
            echo '<li ><a href="cliente">Cliente</a></li>';
          }
          else{
           echo '<li class="active"><a href="estadoCuenta">Estado Cuenta</a></li>'; 
          } ?>
          <?php if ($permisoID == 1) {
            echo '<li ><a href="reporteSaldo">Saldo Clientes</a></li>';
          } ?>
            <li ><a href="cambioPassword">Cuenta</a></li>
            <li ><a href="consultaFolio">Número</a></li>
            <ul id="nav-right">
              <li class="push-right"><a href="loginOut">Cerrar Sesion </a></li>

            </ul>
      </ul>
  </div>
  <div class="login-page">
  <div class="form">

  <h1><img src="img/atc1.png">ctivaChip</h1>
    <form id="formulario" method='post'  autocomplete="off">
      <p>
        Estimado cliente: 
        <b>
          <?php
            echo $nombre ;
          ?>
        </b>
        <br>Su Saldo disponible es: $
        <b>
          <?php
            echo $saldo ;
          ?>
        </b>
        <br>
        <br>
      </p>
      <p align="justify">
        Para aumentar su saldo lo invitamos a realizar un depósito en la sucursal bancaria de su preferencia.
      </p>
    </form>
  </div>
</div>


</body>
<footer >
Contacto: webmaster.atc.mx@gmail.com <br>
Copyright© 2017-2018. Morpheus DSS<br>
Teléfono de soporte: 4661472278
</footer>
</html>
<?php
} else {
    header("location:index");
}
?>