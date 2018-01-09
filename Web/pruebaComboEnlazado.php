<?php
//include 'conexion.php';
require "php\claseSesion.php";
?>
<!DOCTYPE html>

<html>

<head>

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

</head>

<body>
<h2>Recargas</h2>

<?php
$res=carrier();
?>
<label for="id">Compañía:</label>
<select id="carrier" onchange="myFunction(this.value)">

<!--<option value="">Seleccione</option>-->

<?php
while($fila=$res->fetch_array(MYSQLI_ASSOC)){
?>

 <option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>

<?php } ?>

</select>


<div id="myDiv"></div>



</body>

</html>