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
          $.post("php/procesoRecarga",{task:tsk}, function(data){
            time = 0;
            clearTimeout(connect);
          });
        }
        $(".timer").html(time);
        if (time == 40) {
          $("#loader").hide();
          swal('Error...','¡Estimado usuario, revise su conexion a Internet e intente realizar de nuevo la activación de su chip!','error');
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
      <script src="ajax.js"></script>

<script>
function myFunction(str)
{
loadDoc("q="+str,"proc.php",function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  });
}
function myFunction2(str)
{
loadDoc("r="+str,"proc2.php",function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv2").innerHTML=xmlhttp.responseText;
    }
  });
}
</script>
<style>
  .select
  {
  border: 1px solid #DBE1EB;
  font-size: 16px;
  font-family: Arial, Verdana;
  padding-left: 7px;
  padding-right: 7px;
  padding-top: 10px;
  padding-bottom: 10px;
  border-radius: 4px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  -o-border-radius: 4px;
  background: #FFFFFF;
  background: linear-gradient(left, #FFFFFF, #F7F9FA);
  background: -moz-linear-gradient(left, #FFFFFF, #F7F9FA);
  background: -webkit-linear-gradient(left, #FFFFFF, #F7F9FA);
  background: -o-linear-gradient(left, #FFFFFF, #F7F9FA);
  color: #2E3133;
  }
  
  .select:hover
  {
  border-color: #FBFFAD;
  }
  
  .select option
  {
  border: 1px solid #DBE1EB;
  border-radius: 4px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  -o-border-radius: 4px;
  }
  
  .select option:hover
  {
  background: #FC4F06;
  background: linear-gradient(left, #FC4F06, #D85F2B);
  background: -moz-linear-gradient(left, #FC4F06, #D85F2B);
  background: -webkit-linear-gradient(left, #FC4F06, #D85F2B);
  background: -o-linear-gradient(left, #FC4F06, #D85F2B);
  font-style: italic;
  color: #FFFFFF;
  }
 </style>
</head>


<body>
  <!-- <h1 class="timer"></h1> -->
  <div class="container">
      <ul id="nav" >
          <li class="active"><a href="">Inicio</a></li>
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
      <tr>
        <?php
          $res=carrier();
        ?>
        <td>Compañía</td>
        <td>
          <select class="select" required id="carrier" name="carrier" onchange="myFunction(this.value)">

          <?php
            while($fila=$res->fetch_array(MYSQLI_ASSOC)){
          ?>

          <option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>

          <?php } ?>

          </select>
        </td>
        
      </tr>
      <tr>
        <div id="myDiv"></div>
      </tr>
      <input required id="digitos" name="digitos" maxlength="10" onkeypress = 'return tel(event)' type="text" placeholder="Número" autofocus/>
      <input required id="numero" onkeypress = 'return tel(event)' maxlength="10" name="numero" type="text" placeholder="Confirma el número"/>

      <!--<     -->
      
      <button id="btn_enviar" color = "black" onclick="puntero()">Aceptar</button>
    </form>
  </div>
</div>

<script>
$("#btn_enviar").click(function(){
  var url = "./php/procesoRecarga"; // El script a dónde se realizará la petición.
    $.ajax({
      type: "POST",
      url: url,
      data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
      //Ejecutar antes de ser enviado
      beforeSend: function(){
        var miCampoTexto = document.getElementById("digitos").value;
        var miCampoTexto2 = document.getElementById("numero").value;
        var miCampoTexto3 = document.getElementById("carrier").value;
        var miCampoTexto4 = document.getElementById("montoCarrier").value;
        //las condiciones de los campos del formulario
        if (miCampoTexto.length == 0 ) {
          alert('El campo número esta vacio!');
          document.getElementById("digitos").focus();
          return false;
        }else if (miCampoTexto2.length == 0 ) {
          alert('El campo verificar número esta vacio!');
          document.getElementById("numero").focus();
          return false;
        } else if (miCampoTexto.length < 10 ){
          alert('Deben de ser 10 digitos, compruebe su número en el campo número');
          document.getElementById("digitos").select();
          return false;
        }else if (miCampoTexto2.length < 10 ){
          alert('Deben de ser 10 digitos, compruebe su número en el campo verificar número');
          document.getElementById("numero").select();
          return false;
        } else if (miCampoTexto != miCampoTexto2){
          alert('Los dígitos del número telefónico no coinciden');
          document.getElementById("digitos").value = "";
          document.getElementById("numero").value = "";
          document.getElementById("digitos").focus();
          return false;
        }else if (miCampoTexto3 == 'Compañía'){
          alert('Seleccione la compañia');
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
      var url = "./php/procesoRecarga"; // El script a dónde se realizará la petición.
      $.ajax({
        type: "POST",
        url: url,
        data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
        //Ejecutar antes de ser enviado
        beforeSend: function(){
          var miCampoTexto = document.getElementById("digitos").value;
          var miCampoTexto2 = document.getElementById("numero").value;
          var miCampoTexto3 = document.getElementById("carrier").value;
          //las condiciones de los campos del formulario
            if (miCampoTexto.length == 0 ) {
              //alert('El campo 1 esta vacio!');
              document.getElementById("digitos").focus();
              return false;
            }else if (miCampoTexto2.length == 0 ) {
              //alert('El campo 2 esta vacio!');
              document.getElementById("numero").focus();
              return false;
            } else if (miCampoTexto.length < 10 ){
              alert('Deben de ser 10 digitos, compruebe su numero en el campo 1');
              document.getElementById("digitos").select();
              return false;
            }else if (miCampoTexto2.length < 10 ){
              alert('Deben de ser 10 digitos, compruebe su numero en el campo 2');
              document.getElementById("numero").select();
              return false;
            } else if (miCampoTexto != miCampoTexto2){
              alert('los digitos del numero telefonico no coinciden');
              document.getElementById("digitos").value = "";
              document.getElementById("numero").value = "";
              document.getElementById("digitos").focus();
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
