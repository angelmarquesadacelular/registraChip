<?php
//include 'conexion.php';
require "php\claseSesion.php";
$q=$_POST['q'];
$res=claveCliente($q);
?>
 <tr>
  <td>
    <?php echo $res; ?>
  </td>
 </tr>
