<?php
error_reporting(E_ERROR);
require "php/claseSesion.php";

$sesion = new Sesion();
if ($sesion->estadoLogin()==true) {
$datosUsuario=$sesion->datosUsuario();
  $usuarioID=$datosUsuario[0];
  $empresaID=$datosUsuario[1];
  $permisoID=$datosUsuario[2];  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
	<title>ActivaChip</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.functions.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="css/styleReporte.css">
	<link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/principal.css" />
  <link href="css/styleR.css" rel="stylesheet" type="text/css" />
  <style>
.boton {border:1px solid #808080;cursor:pointer;padding:2px 5px;color:Blue;}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>

<script>
$(document).ready(function(){
$(".boton").click(function(){

var valores="";
var nombre="";
var direccion="";
var telefono="";
var saldo="";
// Obtenemos todos los valores contenidos en los <td> de la fila
// seleccionada
$(this).parents("tr").find("#nombre").each(function(){
nombre+=$(this).html();
});
$(this).parents("tr").find("#direccion").each(function(){
direccion+=$(this).html();
});
$(this).parents("tr").find("#telefono").each(function(){
telefono+=$(this).html();
});
$(this).parents("tr").find("#saldo").each(function(){
saldo+=$(this).html();
});
var url = "./php/depositoSaldo?nombre="+nombre;
console.log(valores);
document.location.href = "depositoSaldo?nombre="+nombre+"&direccion="+direccion+"&telefono="+telefono+"&saldo="+saldo;
});
});

</script>
</head>

<body>
	<div class="container">
      <ul id="nav" >
          <li ><a href="recarga">Inicio</a></li>
          <li ><a href="reporte">Reporte</a></li>
            <?php if ($permisoID == 1) {
            echo '<li ><a href="cliente">Cliente</a></li>';
          }
          else{
           echo '<li ><a href="estadoCuenta">Estado Cuenta</a></li>'; 
          } ?>
          <?php if ($permisoID == 1) {
            echo '<li class="active"><a href="">Saldo Clientes</a></li>';
          } ?>
            <li ><a href="cambioPassword">Cuenta</a></li>
            <li><a href="consultaFolio">Número</a></li>
            <ul id="nav-right">
              <li class="push-right"><a href="loginOut">Cerrar Sesion </a></li>


            </ul>
      </ul>

	<div class = "reporte">
		<br>
		<br>

		<p><br></p>
		<h1>Reporte de Saldo Clientes</h1>
	</div>
<form  method="post" action="" id="formulario">
	<div class= "fecha">
		<article id='art1' class='col-lg-11 col-md-11 col-sm-11 col-xs-12'>
		<form id="formulario">

			<?php
				$result = reporteSaldo($empresaID);
			?>

		    </div>
		    </label>
		    </p>
		</form>
	</article>
  </div>
<div class = "tabla">
	<article id='art1' class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
<table class="responstable">
	<br>
  <tr>
    <th>Nombre</th>
    <th data-th="Driver details"><span>Dirección</span></th>
    <th>Teléfono</th>
    <th>Correo</th>
    <th>Saldo</th>
    <th></th>
  </tr>
				  <?php
				  	while ($row = mysqli_fetch_array($result))
				  	{
				  ?>

					<tr id="usuario" onclick="alerta(<?php echo $row[0];?> );">
						<td id="nombre" class="textos" height="10"><?php echo $row[0];?></td>
						<td id="direccion" class="textos" height="10"><?php echo $row[1];?></td>
						<td id="telefono" class="textos" height="10"><?php echo $row[2];?></td>
						<td id="correo" class="textos" height="10"><?php echo $row[3];?></td>
						<td id="saldo" class="textos" height="10"><?php echo $row[4];?></td>
						<td class="boton">Registrar Pago</td>
					</tr>
				<?php
					}
				?>

				 
	</article>
</div>


</table>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js'></script>
	</div>
<div id="respuesta"></div>
</body>
<footer >
<br>
<br>
<br>
<br>
Contacto: webmaster.atc.mx@gmail.com <br>
Copyright© 2017-2018. Morpheus DSS <br>
Teléfono de soporte: 4661472278
</footer>
</html>
<?php
} else {
    header("location:index");
}
?>