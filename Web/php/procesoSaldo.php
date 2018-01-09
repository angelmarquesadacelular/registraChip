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
	require "claseSesion.php";
$sesion = new Sesion();
if ($sesion->estadoLogin()==true) {
$datosUsuario=$sesion->datosUsuario();
  $usuarioID=$datosUsuario[0];
  $empresaID=$datosUsuario[1];
  $permisoID=$datosUsuario[2];
	
	//Recibe los datos para trabajar correctamente
	$folio = $_POST["folio"];
	$referencia = $_POST["referencia"];
	$banco = $_POST["banco"];
	$fecha = $_POST["fecha"];
	$monto = $_POST["monto"];
	$cliente =$_POST["nombre"];
	$comisionId=$_POST["comision"];
	$saldo = saldoUsuario($cliente);
	$comision = porncentajeComision($comisionId);
	$comision = $comision/100;
	//Realiza el deposito
	$resultado = insertarDetalleDeposito($folio, $referencia, $fecha, $banco,$cliente);
	$idDeposito = obtenerIdDeposito($folio,$referencia,$banco,$cliente);
	
	if ($idDeposito != 0)
	{
		insertarCargo($monto, $idDeposito, 1);
		$saldo = ($saldo+$monto);
		actualizarSaldo($cliente,$saldo);
		$comision = $monto * $comision;
		echo $comision;
		insertarDetalleComision($comision, $fecha, $cliente);
		$idComision = obtenerIdComision($comision,$fecha,$cliente);
		insertarCargo($comision, $idComision, 2);
		$saldo = ($saldo+$comision);
		actualizarSaldo($cliente,$saldo);
		echo "<script language=\"JavaScript\">swal('Proceso exitoso.','¡Deposito hecho de manera correcta.','success');";
		echo "document.getElementById('folio').value = '';";
		echo "document.getElementById('monto').value = '';";
		echo "document.getElementById('referencia').value = '';</script>";
	}
	//Este if sirve para comparar los errores 501 y 5106
	else
	{
		echo "<script language=\"JavaScript\">swal('Error...','¡Estimado usuario. Error al realizar el deposito!','error');";
		echo "document.getElementById('folio').value = '';";
		echo "document.getElementById('monto').value = '';";
		echo "document.getElementById('referencia').value = '';</script>";
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