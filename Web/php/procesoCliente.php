<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.6/sweetalert2.min.css">
<script type="text/javascript" src="../js/jquery.min.js"></script>
	<title>Document</title>
</head>
<body>
	
</body>
</html>
<?php
	require ("recargaATC.php");
	require "claseSesion.php";
$cliente = new nusoap_client("http://atc.mx/WebService/Aplicacion%20de%20escritorio/seguridad/seguridad.php?wsdl",false);
$sesion = new Sesion();
if ($sesion->estadoLogin()==true) 
{
	$datosUsuario=$sesion->datosUsuario();
  	$usuarioID=$datosUsuario[0];
  	$empresaID=$datosUsuario[1];
  	$permisoID=$datosUsuario[2];
	
	//Recibe los datos para trabajar correctamente
  	$nombre = $_POST['nombre'];
  	$direccion = $_POST['direccion'];
  	$telefono = $_POST['telefono'];
  	$email = $_POST['email'];
  	$nick = $_POST['nick'];
  	$pass = $_POST['pass'];
  	$permiso_id = 2;
	if (!empty($nombre))
	{
		//Verifica si tiene email si no coloca S/R
		if (empty($email))
		{
			$email = "S/R";
		}
		//Captura el nuevo cliente
		insertarUsuario($nombre,$direccion,$telefono,$email,$empresaID,$permiso_id);
		//Generar el password encriptado
		$parametros = array('password'=>$pass);
    	$pwsOldEncriptado = $cliente->call('encriptar',$parametros);
    	$resultUsuario = obtenerIdUsuario($nombre,$direccion,$telefono,$email,$empresaID,$permiso_id);
  
    	
    	if(!empty($resultUsuario))
    	{
    		insertarPermisoUsuario($nick,$pwsOldEncriptado,$resultUsuario);
    		$valor = 0;
    		insertarSaldo($valor,$resultUsuario);
    		echo "<script language=\"JavaScript\">swal('Proceso exitoso.','¡Cliente guardado con exito!','success');";
			echo "document.getElementById('nombre').value = '';";
			echo "document.getElementById('direccion').value = '';";
			echo "document.getElementById('telefono').value = '';";
			echo "document.getElementById('email').value = '';";
			echo "document.getElementById('nick').value = '';";
			echo "document.getElementById('pass').value = '';</script>";
    	}
			
	}
	
} 
else {
    header("location:index");
}
?>

<script type="text/javascript">
	function popup(url, ancho, alto) 
	{
		var posicion_x; 
		var posicion_y; 
		posicion_x=(screen.width/2)-(ancho/2); 
		posicion_y=(screen.height/2)-(alto/2); 
		window.open(url, "leonpurpura.com", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
	}
</script>