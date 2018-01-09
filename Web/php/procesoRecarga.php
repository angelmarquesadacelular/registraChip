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
$sesion = new Sesion();
if ($sesion->estadoLogin()==true) {
$datosUsuario=$sesion->datosUsuario();
  $usuarioID=$datosUsuario[0];
  $empresaID=$datosUsuario[1];
  $permisoID=$datosUsuario[2];
	
	//Recibe los datos para trabajar correctamente
	$inicial = $_POST["digitos"];
	$numero = $_POST["numero"];
	$carrierId = $_POST["carrier"];
	$montoId = $_POST["montoCarrier"];
	
	//Saca el monto y la compañia a recargar
	$montoCarrier = sacarMonto($montoId);

	$compania = sacarCompania($carrierId);
	
	//Saca el saldo actual del usurio
	$saldo = saldoUsuario($usuarioID);
	
	
	
	if(($saldo-$montoCarrier) <= -1)
	{
		echo "<script language=\"JavaScript\">swal('Error...','¡Estimado cliente, saldo insuficiente para la transacción!','error');";
		echo "document.getElementById('digitos').value = '';";
		echo "document.getElementById('numero').value = '';</script>";		
		exit;
	}
	
	
	//Saca el id del producto de la compañia de recarga
	//$idProducto = sacarIdProducto($compania, $montoCarrier);
	
	//id de prueba (QUITAR DESPUES DE PROBAR)
	$idProducto = 100;
	
	//Saca el ultimo folio de la transaccion(si no existe genera el primero)
	
	$claveCliente = sacarClaveCliente($usuarioID);
	
	$folio = sacarFolio();
	
	
	if (empty($folio))
		$folio = primerFolio($claveCliente);
	else
	{
		$folio = folioNuevo($folio, $claveCliente);
	}
	
	
	//Realiza la recarga
	$resultado = recargarSaldo($numero, $idProducto, $folio,$usuarioID,$empresaID,$montoCarrier,$carrierId);
	
	if ($resultado[0] != 0)
	{
		//$idNumero = sacarIDNumero($numero);
		$estado = true;
		insertarActivado($numero, $resultado[0], $folio, $montoCarrier,$carrierId,$usuarioID,$estado);
		$saldoActualizado = ($saldo-$montoCarrier);
		actualizarSaldo($usuarioID,$saldoActualizado);
		echo "<script language=\"JavaScript\">swal('Proceso exitoso.','¡Recarga al numero $numero hecha de manera correcta. Guarde su folio $folio para cualquier aclaración.!','success');";
		echo "document.getElementById('digitos').value = '';";
		echo "document.getElementById('numero').value = '';</script>";
	}
	//Este if sirve para comparar los errores 501 y 5106
	else
	{
		if($resultado[1] == 'ERROR 501 TELEFONO NO VALIDO' || $resultado[1] == 'ERROR 5106. NUMERO TELEFONICO INVALIDO.'){
		echo "<script language=\"JavaScript\">swal('Error...','¡Estimado cliente, $resultado[1]. Error al activar $numero\!, por favor marque al *611 para activar su numero','error');";
		echo "document.getElementById('digitos').value = '';";
		echo "document.getElementById('numero').value = '';</script>";
		}
		else{

			//insertarActivado($numero, $resultado[1], $folio, $montoCarrier,$carrierId,$usuarioID,false);
			echo "<script language=\"JavaScript\">swal('Error...','¡Estimado cliente, $resultado[1]. Error al activar $numero\!','error');";
			echo "document.getElementById('digitos').value = '';";
			echo "document.getElementById('numero').value = '';</script>";
		}
	}
	} else {
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