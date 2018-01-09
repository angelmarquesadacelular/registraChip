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

  $clave0 = $_POST['actual'];
  $clave1 = $_POST['digitos'];
  $clave2 = $_POST['numero'];
  
  if (!empty($clave0))
  {
	  
  }

  if (!empty($clave1)&&!empty($clave2)) {
    if ($clave1 == $clave2) {
      //$parametros = array('password'=>$clave2);
      //$passencriptado = $cliente->call('encriptar',$parametros);
      $cambio = comprobarFolio($folio);
      //$usuario = sacarCliente($usuarioID);
      //$sesion->nuevoPass($passencriptado);
      ?>
      <script type="text/javascript">
        alert("Tu nueva contraseña ha sido cambiado con exito")
        //location.href="recarga.php"
      </script>
      <?php
    }else {
      ?>
      <script type="text/javascript">
        alert("no coinciden los campos")
      </script>
      <?php
    }
  }

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
<script type="text/javascript" src="../js/jquery.min.js"></script>
      <script>
        function tel(e){
          key=e.keyCode || e.which;
          teclado=String.fromCharCode(key);
          numero='0123456789qazwsxedcrfvtgbyhnujmiklopñQAZWSXEDCRFVTGBYHNUJMIKOLPÑ.-_';
          especiales='37-38-46';
          teclado_especiales=false;
          for(var i in especiales){
            if(key==especiales[i]){
              teclado_especiales=true;
            }
          }
          if(numero.indexOf(teclado)==-1 && !teclado_especiales){
            return false;
          }
          if(e.value.length <15){
            return false;
          }
        };
      </script>
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
           echo '<li ><a href="estadoCuenta">Estado Cuenta</a></li>'; 
          } ?>
          <?php if ($permisoID == 1) {
            echo '<li ><a href="reporteSaldo">Saldo Clientes</a></li>';
          } ?>
            <li ><a href="cambioPassword">Cuenta</a></li>
            <li class="active"><a href="consultaFolio">Número</a></li>
            <ul id="nav-right">
              <li class="push-right"><a href="loginOut">Cerrar Sesion </a></li>

            </ul>
      </ul>
  </div>
  <div class="login-page">
  <div class="form">

  <h1><img src="img/atc1.png">ctivaChip</h1>

    <form id="formulario" method='post'  autocomplete="off">
      
      <input id="campoFolio" name="campoFolio" onkeypress = 'return tel(event)' maxlength="20" type="text" placeholder="Número" autofocus/>
      <!--<     -->
      <button id="btn_enviar" color = "black" onclick="puntero()">Aceptar</button>
    </form>
  </div>
</div>
  <script>
    $("#btn_enviar").click(function(){
  var url = "./php/procesoFolio.php"; // El script a dónde se realizará la petición.
    $.ajax({
      type: "POST",
      url: url,
      data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
      //Ejecutar antes de ser enviado
      beforeSend: function(){
        var miCampoTexto0 = document.getElementById("campoFolio").value;
        //las condiciones de los campos del formulario
        if (miCampoTexto0.length == 0){;
          document.getElementById("campoFolio").focus();
          return false;
        }},
      success: function(data){
        $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
      }

  });
  return false; // Evitar ejecutar el submit del formulario.
});

$(function(){
  //funcion cunado tecla enter se presiona
  $(window).keypress(function(e){
    if (e.keyCode == 13) {
      var url = "./php/procesoFolio.php"; // El script a dónde se realizará la petición.
      $.ajax({
        type: "POST",
        url: url,
        data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
        //Ejecutar antes de ser enviado
        beforeSend: function(){
          var miCampoTexto0 = document.getElementById("campoFolio").value;
          //las condiciones de los campos del formulario
          if (miCampoTexto0.length == 0){
          document.getElementById("campoFolio").focus();
          return false;
        }
      },
        success: function(data){
          $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
        }
      });
      return false; // Evitar ejecutar el submit del formulario.
    }
  });
});
</script>

<div id="respuesta"></div>

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
