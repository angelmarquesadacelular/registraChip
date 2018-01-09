<?php
	error_reporting(0);
	$db = new mysqli('localhost', 'root', 'root', 'recargaclientes');

	if ($db->connect_error) 
	{

		echo "<script language=\"JavaScript\">alert(\"Error en la conexion de la base de datos (cMysql)\");</script>";
		die();
	}

	//Funcion que inserta el chip a la tabla cuando ya fue activado
	function insertarSaldo($valor,$usuario_id)
	{

		$query = "INSERT INTO saldo (valor, usuario_id)
			VALUES('$valor', '$usuario_id')";
		
		global $db;  
		$result = $db->query($query);
		
		//mysqli_close($db);
		return $result;
	}

	//Funcion que obtiene el id del cliente
	function porncentajeComision($comisionId)
	{
		$query = "SELECT procentaje
					FROM comision
					WHERE id = '$comisionId'";
		global $db;
	
		$result =  $db->query($query);
		$row=mysqli_fetch_row($result);
		return $row[0];
	}

	//Función que obtiene los montos por compañia
	function comision()
	{
		$query = "SELECT id, procentaje FROM comision";
		global $db;
	
		$result =  $db->query($query);
		//$row=mysqli_fetch_row($result);
		//$count=$row[0];
	
		//mysqli_close($db);
		return $result;
	}

	//Funcion que inserta el chip a la tabla cuando ya fue activado
	function insertarCargo($monto, $detalle, $tipoCargo)
	{

		$query = "INSERT INTO cargo (cantidad, detalle_id, tipocargo_id)
			VALUES('$monto', '$detalle','$tipoCargo')";
		
		global $db;  
		$result = $db->query($query);
		
		//mysqli_close($db);
		return $result;
	}

	//Funcion que obtiene el id del cliente
	function obtenerIdDeposito($folio,$referencia,$cuenta_id,$usuario_id)
	{
		$query = "SELECT id
					FROM detalle_deposito
					WHERE folio = '$folio'
					AND referencia = '$referencia'
					AND cuenta_id = '$cuenta_id'
					AND usuario_id = '$usuario_id'";
		global $db;
	
		$result =  $db->query($query);
		$row=mysqli_fetch_row($result);
		return $row[0];
	}

	//Funcion que obtiene el id del cliente
	function obtenerIdComision($monto,$fecha,$usuario_id)
	{
		$query = "SELECT id
					FROM detalle_comision
					WHERE monto = '$monto'
					AND fecha = '$fecha'
					AND usuario_id = '$usuario_id'";
		global $db;
	
		$result =  $db->query($query);
		$row=mysqli_fetch_row($result);
		return $row[0];
	}

	//Funcion que inserta el chip a la tabla cuando ya fue activado
	function insertarDetalleDeposito($folio, $referencia, $fecha, $cuenta_id,$usuario_id)
	{

		$query = "INSERT INTO detalle_deposito (folio, referencia, fecha,cuenta_id, usuario_id)
			VALUES('$folio', '$referencia','$fecha','$cuenta_id', '$usuario_id')";
		
		global $db;  
		$result = $db->query($query);
		
		//mysqli_close($db);
		return $result;
	}
	//Funcion que inserta el chip a la tabla cuando ya fue activado
	function insertarDetalleComision($monto, $fecha, $usuario_id)
	{

		$query = "INSERT INTO detalle_comision (monto,fecha,usuario_id)
			VALUES('$monto', '$fecha','$usuario_id')";
		
		global $db;  
		$result = $db->query($query);
		
		//mysqli_close($db);
		return $result;
	}

	//Funcion que obtiene el id del cliente
	function cliente($nombre,$direccion,$telefono)
	{
		$query = "SELECT id
					FROM usuario
					WHERE nombre = '$nombre'
					AND direccion = '$direccion'
					AND telefono = '$telefono'";
		global $db;
	
		$result =  $db->query($query);
		$row=mysqli_fetch_row($result);
		return $row[0];
	}
	//Función que obtiene los montos por compañia
	function banco($empresa_id)
	{
		$query = "SELECT cb.id, ban.nombre FROM banco ban,cuenta_banco cb where cb.empresa_id = $empresa_id and cb.banco_id=ban.id";
		global $db;
	
		$result =  $db->query($query);
		//$row=mysqli_fetch_row($result);
		//$count=$row[0];
	
		//mysqli_close($db);
		return $result;
	}

	//Funcion que muetsra el reporte de saldo
	function reporteSaldo($empresaID)
	{
		$query = "SELECT usu.nombre,usu.direccion,usu.telefono,usu.email,sal.valor
			from usuario usu,saldo sal
			where sal.usuario_id=usu.id
			and usu.activo=true
			and usu.empresa_id='$empresaID'
			order by usu.nombre asc;";

		global $db;
		$result = $db->query($query);
		
		return $result;
	}
	//Funcion que inserta un nuevo usuario
	function actualizarSaldo($usuario_id,$saldo)
	{
		global $db;

		$query= "UPDATE saldo SET valor = '$saldo' WHERE usuario_id= '$usuario_id'";
		$result = $db->query($query);
	
	}

	//Funcion que obtiene el saldo
	function saldoUsuario($usuario_id)
	{
		$query = "SELECT valor
					FROM saldo
					WHERE usuario_id = '$usuario_id'";
		global $db;
	
		$result =  $db->query($query);
		$row=mysqli_fetch_row($result);
		return $row[0];
	}	

	//Funcion que obtiene el nombre del usuario
	function nombreUsuario($usuario_id)
	{
		$query = "SELECT nombre
					FROM usuario
					WHERE id = '$usuario_id'";
		global $db;
	
		$result =  $db->query($query);
		$row=mysqli_fetch_row($result);
		return $row[0];
	}	
	//Funcion que inserta un nuevo usuario
	function insertarUsuario($nombre, $direccion, $telefono, $email, $empresa_id,$permiso_id)
	{
		global $db;

		$query= "INSERT INTO usuario(nombre, direccion, telefono, email, activo, empresa_id,permiso_id) 
				VALUES ('$nombre', '$direccion', '$telefono', '$email',true,$empresa_id,$permiso_id);";
		$result = $db->query($query);
	
	}

	//Funcion que inserta un nuevo usuario
	function insertarPermisoUsuario($nick, $pass,$usuario_id)
	{
		global $db;

		$query= "INSERT INTO permiso_usuario(nickname,pass,activo,usuario_id) 
				VALUES ('$nick', '$pass',true,$usuario_id);";
		$result = $db->query($query);
	}
	
	//Función que obtiene el id del susrio
	function obtenerIdUsuario($nombre, $direccion, $telefono, $email, $empresa_id,$permiso_id)
	{
		$query = "SELECT id
					FROM usuario 
					WHERE nombre = '$nombre'
					AND direccion = '$direccion'
					AND telefono = '$telefono'
					AND email = '$email'
					AND empresa_id = $empresa_id
					AND permiso_id = $permiso_id";
		global $db;
	
		$result =  $db->query($query);
		$row=mysqli_fetch_row($result);
		//$row=mysqli_fetch_row($result);
		//$count=$row[0];
	
		//mysqli_close($db);
		return $row[0];
	}

	//Funcion que obtiene la empresa
	function empresa()
	{
		$query = "SELECT id,nombre
					FROM empresa
					WHERE activo=true";
		global $db;
	
		$result =  $db->query($query);
		//$row=mysqli_fetch_row($result);
		//$count=$row[0];
	
		//mysqli_close($db);
		return $result;
	}

	//Funcion que obtiene los permiso
	function permiso()
	{
		$query = "SELECT id,tipo
					FROM permiso";
		global $db;
	
		$result =  $db->query($query);
		//$row=mysqli_fetch_row($result);
		//$count=$row[0];
	
		//mysqli_close($db);
		return $result;
	}

	//Función que obtiene las compañias
	function carrier()
	{
		$query = "SELECT id, nombre FROM carrier WHERE nombre<>'TEST'";
		global $db;
	
		$result =  $db->query($query);
		//$row=mysqli_fetch_row($result);
		//$count=$row[0];
	
		//mysqli_close($db);
		return $result;
	}

	//Función que obtiene los montos por compañia
	function montoCarrier($idCarrier)
	{
		$query = "SELECT id, monto FROM monto_carrier where carrier_id = $idCarrier";
		global $db;
	
		$result =  $db->query($query);
		//$row=mysqli_fetch_row($result);
		//$count=$row[0];
	
		//mysqli_close($db);
		return $result;
	}

	//Método que permite saber si un numero existe en la base de datos
	function consultarNumero($numero, $idCliente)
	{
		$query = "SELECT id FROM numero WHERE digitos = '$numero' AND cliente_id = $idCliente";
		global $db;
		$result = mysqli_query($db , $query);
		if(!$result)
		{
			echo 'Cannot run query.';
			exit;
		}
		
		$row = mysqli_fetch_row($result);
		$count=$row[0];

		//mysqli_close($db);
		return $count;
	}
	
	//Método que permite saber si un numero existe en la base de datos con su empresa 
	function consultarNumeroCliente($numero, $empresaID)
	{
		$query = "SELECT num.cliente_id FROM numero num, cliente cli WHERE num.digitos = '$numero' and num.cliente_id = cli.id and cli.empresa_id = '$empresaID';";
		global $db;
		$result = mysqli_query($db , $query);
		if(!$result)
		{
			echo 'Cannot run query.';
			exit;
		}
		
		$row = mysqli_fetch_row($result);
		$count=$row[0];

		//mysqli_close($db);
		return $count;
	}

	//Checa si el numero ya fue activado
	function checarActivo($numero)
	{
		$query = "SELECT a.estado FROM activado a, numero n WHERE a.numero_id = n.id AND n.digitos = '$numero';";
		global $db;
		$result = mysqli_query($db , $query);
		if(!$result)
		{
			echo 'sin conexion a la base de datos.';
			exit;
		}
	  
		$row = mysqli_fetch_row($result);
		$count = $row[0];

		//mysqli_close($db);
		return $count;
	}
	
	//Saca el id del numero
	function sacarIDNumero($numero)
	{
		$query = "SELECT id FROM recarga WHERE digitos = '$numero';";
		global $db;
		$result = mysqli_query($db , $query);
		if(!$result)
		{
			echo 'sin conexion a la base de datos.';
			exit;
		}
	  
		$row = mysqli_fetch_row($result);
		$count = $row[0];

		//mysqli_close($db);
		return $count;
	}

	//Funcion que inserta el chip a la tabla cuando ya fue activado
	function insertarActivado($numero, $idRecargas, $folio, $montoCarrier,$carrierID,$usuarioID,$estado)
	{
		date_default_timezone_set('america/mexico_city');
		$fecha=date("Y-m-d H:i:s");

		$query = "INSERT INTO recarga (digitos, cantidad, folio,idRecargas, fecha, estado, carrier_id,usuario_id)
			VALUES('$numero', '$montoCarrier','$folio','$idRecargas', '$fecha', '$estado', '$carrierID','$usuarioID')";
		
		global $db;  
		$result = $db->query($query);
		
		//mysqli_close($db);
		return $result;
	}

	
	//Función que saca si existen los datos del login del cliente
	function loginCliente($nick, $pass)
	{
		$query = "SELECT usu.id,usu.empresa_id,usu.permiso_id from permiso_usuario pu, usuario usu where pu.usuario_id = usu.id and pu.nickname = '$nick' and pu.pass = '$pass' AND usu.activo = true";
		global $db;
	
		$result =  $db->query($query);
		$row=mysqli_fetch_row($result);
		$count=$row[0];
	
		//mysqli_close($db);
		return $row;
	}
	
	//Función que saca si existen los datos del login del administrador
	function loginAdmin($nick, $pass)
	{
		$query = "SELECT pa.administrador_id, adm.empresa_id FROM permiso_administrador pa, administrador adm  WHERE pa.nickname = '$nick' AND pa.pass = '$pass' AND pa.activo = true and pa.administrador_id = adm.id;";
		global $db;
	
		$result =  $db->query($query);
		$row=mysqli_fetch_row($result);
		$count=$row[0];
	
		//mysqli_close($db);
		return $row;
	}

	//Función que saca los datos de compañia y monto a recargar (manda el objeto con el resultado de la consulta)
	function checarCompania($telefono)
	{
		$query = "SELECT n.monto, c.nombre FROM numero n, carrier c WHERE n.carrier_id = c.id AND n.digitos = '$tel'";
		global $db;
		$result = $db->query($query);
		$row = mysqli_fetch_assoc($result);
	   
		//mysqli_close($db);
		return $row;
	}
	
	//Saca el monto a recargar del numero
	function sacarMonto($monto)
	{
		$query = "SELECT monto FROM monto_carrier WHERE id = '$monto';";
		global $db;
		$result = $db->query($query);
		$row=mysqli_fetch_row($result);
		
		return $row[0];
	}
	
	//Saca la compañia del numero
	function sacarCompania($carrierId)
	{
		$query = "SELECT c.nombre FROM carrier c WHERE c.id = '$carrierId';";
		global $db;
		$result = $db->query($query);
		$row=mysqli_fetch_row($result);
		
		return $row[0];
	}
	
	//Saca la clave del cliente
	function sacarClaveCliente($idUsuario){

		$query = "SELECT emp.nombre,usu.id FROM empresa emp, usuario usu WHERE usu.empresa_id = emp.id
			AND usu.id = '$idUsuario'";
	
		global $db;
		$result = $db->query($query);
		
		if ($result)
		{
			$row = mysqli_fetch_row($result);
			$clave = $row[0]."-".str_pad($row[1], 3, "0", STR_PAD_LEFT);
		}
		
		//mysqli_close($db);
		return $clave;
	}

	//Inserta un registro de login
	function insertarRegistroLogin($idCliente)
	{
		//sacar la  hora y fecha actual
		date_default_timezone_set('america/mexico_city');
		$fechaHoy=date("Y-m-d H:i:s");
	 
		$query = "INSERT INTO registro_login(fecha,usuario_id) VALUES ('$fechaHoy','$idCliente')";
		global $db;
		$result = $db->query($query);
		
		//mysqli_close($db);
	}


	//Funcion que saca los datos para el reporte
	function Reporte($id, $fechainicio)
	{
		$query = "SELECT car.nombre,rec.digitos, rec.fecha, rec.cantidad,usu.nombre
			from carrier car,recarga rec,usuario usu
			where rec.usuario_id = usu.id
			and rec.carrier_id = car.id
			and rec.estado=true
			and usu.id = '$id'
			and DATE(rec.fecha) ='$fechainicio'
			order by rec.fecha desc;";

		global $db;
		$result = $db->query($query);
		
		return $result;
	}
	
	//Funcion que saca los datos para el reporte si es administrador
	function reporteAdministrador($empresaID,$fechainicio)
	{
		$query = "SELECT car.nombre,rec.digitos, rec.fecha, rec.cantidad,usu.nombre
			from recarga rec,carrier car,usuario usu
			where rec.carrier_id = car.id
			and rec.usuario_id = usu.id
			and rec.estado= true
			and DATE(rec.fecha) ='$fechainicio'
			and usu.empresa_id='$empresaID'
			order by rec.fecha desc;";

		global $db;
		$result = $db->query($query);
		
		return $result;
	}
	
	function ReporteContador($id, $fechainicio)
	{
		$query = "SELECT COUNT(*)
			from numero n, activado a, cliente c, carrier ca
			where a.numero_id = n.id
			and n.cliente_id = c.id
			and n.carrier_id= ca.id
			and c.id = '$id'
			and DATE(a.fecha) ='$fechainicio';";

		global $db;
		$result = $db->query($query);
		if ($result)
		{
			$row=mysqli_fetch_row($result);
			$num =$row[0];
		}
		else{
			echo "No entro";
		}
	  return $num;
	}

	//Saca la fecha en el que se registró un numero
	function sacarFecha($telefono)
	{
		$query ="SELECT fecha FROM numero WHERE digitos = '$telefono'";
		global $db;
		$result = $db->query($query);
		
		if ($result)
		{
			$row = mysqli_fetch_row($result);
			$count=$row[0];
		}
		
		//mysqli_close($db);
		return $count;
	}
	
	//Funcion que saca el correo de contacto y el id de la notificacion a partir del numero
	function sacarNotificacion($usuarioID)
	{
		$query = "SELECT id, email FROM notificaciones WHERE usuario_id = '$usuarioID';";
		global $db;
		$result = $db->query($query);
		$row=mysqli_fetch_row($result);
		
		return $row;
	}
	
	//Funcion que saca la bandera para saber si ya fue enviado el mensaje
	function sacarAlerta($notificacion_id)
	{
		$query = "SELECT activo FROM alerta_notificaciones WHERE notificaciones_id = $notificacion_id;";
		global $db;
		$result = $db->query($query);
		$row=mysqli_fetch_row($result);
		
		return $row[0];
	}
	
	//Funcion que cambia el estado de la alerta
	function actualizarAlerta($notificacion_id, $estado)
	{
		$query = "UPDATE alerta_notificaciones SET activo = $estado WHERE notificaciones_id = $notificacion_id;";
		global $db;
		$result = $db->query($query);
	}
	
	//Saca el id de la empresa de acuerdo al numero registrado
	function sacarIDEmpresa($usuarioID)
	{
		$query = "SELECT empresa_id FROM usuario WHERE id = '$usuarioID';";
		global $db;
		$result = $db->query($query);
		$row=mysqli_fetch_row($result);
		
		return $row[0];
	}

	// funcion para sacar los dias restantes antes de que no se puedan activar chips
	function reporteCaducidad($idCliente,$inicio,$TAMANO_PAGINA)
	{
		$fechaHoy=date("Y-m-d");
		global $db;

		$query= "SELECT  nu.digitos, ca.nombre,nu.fecha,29-DATEDIFF(now(),nu.fecha) AS caducidad
		FROM numero nu, carrier ca, cliente cl
		where nu.id NOT IN(SELECT numero_id from activado)
		and nu.carrier_id = ca.id
		and nu.cliente_id = cl.id
		and cl.id = '$idCliente'
		and ca.nombre !='TELCEL'
        and 29 >= DATEDIFF(now(),nu.fecha)
        order by caducidad ASC LIMIt ".$inicio.", ".$TAMANO_PAGINA;
		 
		 $result = $db->query($query);
		 if ($result){
		 }else{
		  //echo "No entro";
		 }
		 return $result;
	}

	function reporteCaducidadcount($idCliente)
	{
		$fechaHoy=date("Y-m-d");
		global $db;

		$query= "SELECT  count(nu.id)
		FROM numero nu, carrier ca, cliente cl
		where nu.id NOT IN(SELECT numero_id from activado)
		and nu.carrier_id = ca.id
		and nu.cliente_id = cl.id
		and cl.id = '$idCliente'
		and ca.nombre !='TELCEL'
        and 29 >= DATEDIFF(now(),nu.fecha);";
		 
		 global $db;
		$result = $db->query($query);
		if ($result)
		{
			$row=mysqli_fetch_row($result);
			$num =$row[0];
		}else{
			echo "No entro";
		}
	  return $num;
	}
	//Compara folio con el numero con su respectivo cliente
	function folioCliente($folio, $empresaID)
	{
		global $db;
	
		$query = "select usu.nombre,rec.cantidad,rec.fecha
		from recarga rec,usuario usu
		where rec.digitos='$folio'
		and rec.usuario_id=usu.id
		and rec.estado=true
		and usu.empresa_id='$empresaID'
		order by rec.fecha desc;";

	
		$result = $db->query($query);
				 $row=mysqli_fetch_row($result);
				return $row;
	}

	//comparar el folio con el numero
	function comprobarFolio($folio, $clienteID)
	{
		global $db;

		$query = "select rec.cantidad,rec.fecha from recarga rec,usuario usu where rec.digitos = '$folio' and usuario_id='$clienteID'
			and rec.estado=true
			order by rec.fecha desc;";
		
	  	$result = $db->query($query);
			 $row=mysqli_fetch_row($result);
			return $row;
	}


	//cambia la contraseña del cliente(usuario)
	function cambiarPassword($idCliente, $password)
	{
	   global $db;

		$query= "UPDATE permiso_usuario
				  SET pass = '$password'
				  WHERE usuario_id = '$idCliente'";
		 $result = $db->query($query);
		 if ($result){
		 }else{
		  //echo "No entro";
		 }
	}
	function sacarCliente($idCliente)
	{
	   global $db;

		$query= "SELECT nick
								FROM permiso_cliente
								where cliente_id = '$idCliente'";
		 $result = $db->query($query);
			 $row=mysqli_fetch_row($result);
			return $row[0];
	}

	//Funcion que inserta un nuevo dato al log de los errores
	function insertarError($idNumero, $folioCliente, $topUpID, $idError, $descripcion)
	{
		$fechaHoy=date("Y-m-d");
		global $db;

		$query= "INSERT INTO log_error(fecha, folioCliente, topUpID, errorCode, errorMessage, recarga_id) VALUES (now(), '$folioCliente', $topUpID, $idError, '$descripcion', $idNumero);";
		$result = $db->query($query);
	}

	// checa si la contraseña antigua que desea cambiar esta registrada en la base de datos
	function cambiarPasswordOld($idCliente)
	{
	   global $db;

		$query= "SELECT pass FROM permiso_cliente
				  WHERE cliente_id = '$idCliente'";
		 $result = $db->query($query);
			 $row=mysqli_fetch_row($result);
			return $row[0];
	}
 ?>
 
