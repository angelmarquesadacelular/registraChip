<?php
error_reporting(E_ERROR);

require ("recargaATC.php");
require "claseSesion.php";

$sesion = new Sesion();
if ($sesion->estadoLogin()==true) {
$datosUsuario=$sesion->datosUsuario();
  $usuarioID=$datosUsuario[0];
  $empresaID=$datosUsuario[1];
  $permisoID=$datosUsuario[2];

  $folio = $_POST['campoFolio'];
  
  if ($permisoID == 1)
  {
    $bandera = folioCliente($folio, $empresaID);
  }else
  {
    $bandera = comprobarFolio($folio,$usuarioID);
  }

  if(!empty($bandera[0]) && $permisoID==1)
  {
    echo "<script language=\"JavaScript\">swal('Proceso exitoso','Estimado usuario, el número: $folio, tiene recarga realizada por: $bandera[0], con un monto: $bandera[1], fecha: $bandera[2]','success');";
    echo "document.getElementById('campoFolio').value = '';</script>";    
    exit;
  }else if(!empty($bandera[0]) && $permisoID == 2){
    echo "<script language=\"JavaScript\">swal('Proceso exitoso','Estimado usuario, el número: $folio, tiene recarga realizada con un monto: $bandera[0], fecha: $bandera[1]','success');";
    echo "document.getElementById('campoFolio').value = '';</script>";    
    exit;
  }else {
       echo "<script language=\"JavaScript\">swal('Error...','¡Estimado usuario, el número de folio: $folio, no existe en la base de datos!','error');";
    echo "document.getElementById('campoFolio').value = '';</script>";    
    exit;
  }
 
} else {
  header("location:index");
}
?>
