<?php
require "php\claseSesion.php";
$nombre = $_GET['nombre'];
$direccion = $_GET['direccion'];
$telefono = $_GET['telefono'];
$saldo = $_GET['saldo'];
$clienteID = cliente($nombre,$direccion,$telefono);
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
          $.post("php/procesoSaldo",{task:tsk}, function(data){
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
          <li ><a href=""><?php echo $nombre?></a></li>
            <ul id="nav-right">
              <li class="push-right"><a href="reporteSaldo">Regresar </a></li>

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
          $res=banco($empresaID);
        ?>
        <td>Banco
        </td>
        <td>
          <select class="select" required id="banco" name="banco">

          <?php
            while($fila=$res->fetch_array(MYSQLI_ASSOC)){
          ?>

          <option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>

          <?php } ?>

        </select>
        </td>
        
      </tr>
      <?php
          date_default_timezone_set('america/mexico_city');
      ?>
      <input type="text" name="nombre" value="<?php echo $clienteID ?>" style="display:none;">
      <input type="text" name="saldo" value="<?php echo $saldo ?>" style="display:none;">
      <input required id="folio" name="folio" maxlength="20" onkeypress = 'return tel(event)' type="text" placeholder="Folio" autofocus/>
      <input required id="referencia" name="referencia" maxlength="20" onkeypress = 'return tel(event)' type="text" placeholder="Referencia" autofocus/>
        <input type="date" name="fecha"  step="1" value="<?php echo date("Y-m-d");?>">
      <input required id="monto" onkeypress = 'return tel(event)' maxlength="10" name="monto" type="text" placeholder="Monto"/>
      <tr>
        <?php
          $res=comision();
        ?>
        <td>Comisión
        </td>
        <td>
          <select class="select" required id="comision" name="comision">

          <?php
            while($fila=$res->fetch_array(MYSQLI_ASSOC)){
          ?>

          <option value="<?php echo $fila['id']; ?>"><?php echo $fila['procentaje']." %"; ?></option>

          <?php } ?>

        </select>  
        </td>
        
      </tr>
      <!--<     -->
      
      <button id="btn_enviar" color = "black" onclick="puntero()">Aceptar</button>
    </form>
  </div>
</div>

<script>
$("#btn_enviar").click(function(){
  var url = "./php/procesoSaldo"; // El script a dónde se realizará la petición.
    $.ajax({
      type: "POST",
      url: url,
      data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
      //Ejecutar antes de ser enviado
      beforeSend: function(){
        var miCampoTexto = document.getElementById("referencia").value;
        var miCampoTexto2 = document.getElementById("monto").value;
        //las condiciones de los campos del formulario
        if (miCampoTexto.length == 0 ) {
          alert('El campo 1 esta vacio!');
          document.getElementById("referencia").focus();
          return false;
        }else if (miCampoTexto2.length == 0 ) {
          alert('El campo 2 esta vacio!');
          document.getElementById("monto").focus();
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
      var url = "./php/procesoSaldo"; // El script a dónde se realizará la petición.
      $.ajax({
        type: "POST",
        url: url,
        data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
        //Ejecutar antes de ser enviado
        beforeSend: function(){
          var miCampoTexto = document.getElementById("referencia").value;
          var miCampoTexto2 = document.getElementById("monto").value;
          //las condiciones de los campos del formulario
            if (miCampoTexto.length == 0 ) {
              //alert('El campo 1 esta vacio!');
              document.getElementById("referencia").focus();
              return false;
            }else if (miCampoTexto2.length == 0 ) {
              //alert('El campo 2 esta vacio!');
              document.getElementById("monto").focus();
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
Copyright© 2017-2018. Morpheus DSS
</footer>
</html>
<?php
} else {
    header("location:index");
}
?>