<?php
require "php\claseSesion.php";
//require "php\ConsultasMySQL.php";
require "php/library/nusoap/lib/nusoap.php";
$cliente = new nusoap_client("http://atc.mx/WebService/Aplicacion%20de%20escritorio/seguridad/seguridad.php?wsdl",false);

$sesion = new Sesion();

if (isset($_POST["nick"]))
{
    $usuario = $_POST["nick"];
    $pass = $_POST["pass"];
    $parametros = array('password'=>$pass);
    $passencriptado = $cliente->call('encriptar',$parametros);
	//Checa si la persona logeada es administrador
	$resultado = loginCliente($usuario, $passencriptado);
	if ($resultado[0] > 0)
	{
		$permisoID = $resultado[2];
		$usuarioID = $resultado[0];
		$empresaID=$resultado[1];

		$sesion->inicioLogin($usuario,$passencriptado);
		insertarRegistroLogin($usuarioID);
		echo "<script language=\"JavaScript\">alert('Bienvenido usuario: $usuario.'); location.href='recarga.php';</script>";
	}
	else
	{
				
		echo "<script language=\"JavaScript\">alert('$usuario,$passencriptado usted no esta autorizado para acceder.');location.href='login';</script>";
	}
}
?>
