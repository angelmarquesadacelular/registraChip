<?php
require "php\claseSesion.php";

$sesion = new Sesion();
if ($sesion->estadoLogin()==true) {
$datosUsuario=$sesion->datosUsuario();
  $usuarioID=$datosUsuario[0];
  $empresaID=$datosUsuario[1];
  $permisoID=$datosUsuario[2];
  
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.css">
<script type="text/javascript" src="../js/jquery.min.js"></script>

      <script>
        $(function(){
      var time = 0;
      tsk="";
      function connect(){
        setTimeout(connect, 800);
        if (time == 15) {
          // if (miCampoTexto2) {
          //   $.post("php/procesoRecarga",{data:miCampoTexto2}, function(data){
          //     $("#respuesta").html(data);
          //     time = 0;
          //     clearTimeout(connect);
          //   });
          // }
          $.post("php/procesoCliente.php",{task:tsk}, function(data){
            time = 0;
            clearTimeout(connect);
          });
        }
        $(".timer").html(time);
        if (time == 40) {
          $("#loader").hide();
          swal('Error...','¡Estimado usuario, revise su conexion a Internet e intente realizar de nuevo su captura de cliente!','error');
          time = 0;
          clearTimeout(connect);
        }
        time++;
      }
      connect();
    })
        function tel(e){
          key=e.keyCode || e.which;
          teclado=String.fromCharCode(key);
          numero='0123456789';
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
      <style type="text/css">
        #loader {
          position: fixed;
          left: 0px;
          top: 0px;
          width: 100%;
          height: 100%;
          z-index: 9999;
          background: 50% 50% no-repeat rgb(249,249,249);
          opacity: .8;
        }
      </style>
</head>

<body>
  <!-- <h1 class="timer"></h1> -->
  <div class="container">
      <ul id="nav" >
          <li ><a href="recarga">Inicio</a></li>
          <li ><a href="reporte">Reporte</a></li>
            <?php if ($permisoID == 1) {
            echo '<li class="active"><a href="">Cliente</a></li>';
          }
          else{
           echo '<li ><a href="estadoCuenta">Estado Cuenta</a></li>'; 
          } ?>
          <?php if ($permisoID == 1) {
            echo '<li ><a href="reporteSaldo">Saldo Clientes</a></li>';
          } ?>
            <li ><a href="cambioPassword">Cuenta</a></li>
            <li><a href="consultaFolio">Número</a></li>
            <ul id="nav-right">
              <li class="push-right"><a href="loginOut">Cerrar Sesion </a></li>

            </ul>
      </ul>
  </div>
  <div id="loader" style="display: none;"></div>
  <div class="login-page">
  <div class="form">

  <h1><img src="img/atc1.png">ctivaChip</h1>

    <form id="formulario" method='post'  autocomplete="off">

      <input required id="nombre" name="nombre" type="text" placeholder="Nombre" autofocus/>
      <input required id="direccion" name="direccion" type="text" placeholder="Dirección"/>
      <input required id="telefono" maxlength="10" onkeypress = 'return tel(event)' maxlength="10" name="telefono" type="text" placeholder="Teléfono"/>
      <input required id="email" name="email" type="text" placeholder="Email"/>
      <input required id="nick" name="nick" type="text" placeholder="Nickname"/>
      <input required id="pass" name="pass" type="text" placeholder="Password"/>
      
      <!--<     -->
      
      <button id="btn_enviar" color = "black" onclick="puntero()">Aceptar</button>
    </form>
  </div>
</div>

<script>
$("#btn_enviar").click(function(){
  var url = "./php/procesoCliente.php"; // El script a dónde se realizará la petición.
    $.ajax({
      type: "POST",
      url: url,
      data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
      //Ejecutar antes de ser enviado
      beforeSend: function(){
        var miCampoTexto = document.getElementById("nombre").value;
        var miCampoTexto2 = document.getElementById("direccion").value;
        var miCampoTexto3 = document.getElementById("telefono").value;
        var miCampoTexto4 = document.getElementById("email").value;
        var miCampoTexto5 = document.getElementById("nick").value;
        var miCampoTexto6 = document.getElementById("pass").value;
        //las condiciones de los campos del formulario
        if (miCampoTexto.length == 0 ) {
          alert('El campo nombre esta vacio!');
          document.getElementById("nombre").focus();
          return false;
        }else if (miCampoTexto2.length == 0 ) {
          alert('El campo direccion esta vacio!');
          document.getElementById("direccion").focus();
          return false;
        } else if (miCampoTexto3.length == 0 ){
          alert('El campo teléfono esta vacio');
          document.getElementById("telefono").select();
          return false;
        }else if (miCampoTexto5.length == 0 ){
          alert('El campo nickname esta vacio');
          document.getElementById("nick").select();
          return false;
        } else if (miCampoTexto6 == 0){
          alert('El campo password esta vacio');
          document.getElementById("pass").focus();
          return false;
        }
      document.getElementById("loader").style.display="block";
      document.getElementById("loader").innerHTML="<img src='./img/loading1.gif'>";
      },
      success: function(data){
        $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
          document.getElementById("loader").style.display="none";
          
      }

  });
  return false; // Evitar ejecutar el submit del formulario.
});

$(function(){
  //funcion cunado tecla enter se presiona
  $(window).keypress(function(e){
    if (e.keyCode == 13) {
      var url = "./php/procesoCliente.php"; // El script a dónde se realizará la petición.
    $.ajax({
      type: "POST",
      url: url,
      data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
      //Ejecutar antes de ser enviado
      beforeSend: function(){
        var miCampoTexto = document.getElementById("nombre").value;
        var miCampoTexto2 = document.getElementById("direccion").value;
        var miCampoTexto3 = document.getElementById("telefono").value;
        var miCampoTexto4 = document.getElementById("email").value;
        var miCampoTexto5 = document.getElementById("nick").value;
        var miCampoTexto6 = document.getElementById("pass").value;
        //las condiciones de los campos del formulario
        if (miCampoTexto.length == 0 ) {
          alert('El campo nombre esta vacio!');
          document.getElementById("nombre").focus();
          return false;
        }else if (miCampoTexto2.length == 0 ) {
          alert('El campo direccion esta vacio!');
          document.getElementById("direccion").focus();
          return false;
        } else if (miCampoTexto3.length == 0 ){
          alert('El campo teléfono esta vacio');
          document.getElementById("telefono").select();
          return false;
        }else if (miCampoTexto5.length == 0 ){
          alert('El campo nickname esta vacio');
          document.getElementById("nick").select();
          return false;
        } else if (miCampoTexto6 == 0){
          alert('El campo password esta vacio');
          document.getElementById("pass").focus();
          return false;
        }
      document.getElementById("loader").style.display="block";
      document.getElementById("loader").innerHTML="<img src='./img/loading1.gif'>";
      },
      success: function(data){
        $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
          document.getElementById("loader").style.display="none";
          
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