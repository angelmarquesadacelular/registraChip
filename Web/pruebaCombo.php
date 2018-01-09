<?php
/**
*	@author 	Ing. Israel Barragan C.  Email: reedyseth@gmail.com
*	@since 		17-Jun-2013
*	##########################################################################################
*	Comments:
*	This file is to show how to extract records from a database with PDO and fill a select(combobox)
* 	with the data.
*
*	Requires:
*	Connection.simple.php
*	##########################################################################################
*	@version
*	##########################################################################################
*	1.0	|	17-Jun-2013	|	Creation of the file .
*	##########################################################################################
*/
	require "php\claseSesion.php";
	$result = "";
	$result = carrier();
	if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
	{
    $combobit="";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit .=" <option value='".$row['id']."'>".$row['nombre']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}
else
{
    echo "No hubo resultados";
}
 ?>
 <!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="UTF-8" />
        <title>Prueba de comobobox</title>
        <meta http-equiv="X-UA-Compatible" content="IE=9,crome" />
		<meta name="copyright" content="Datasoft Engineering 2013"/>
		<meta name="author" content="Reedyseth"/>
		<meta name="email" content="ibarragan@behstant.com"/>
		<meta name="description" content="Query data sending an ID" />
		<style type="text/css">
			body {font-family: Arial, Helvetica, sans-serif;}
		</style>
	</head>

    <body>

    	<fieldset style="width:480px" 	>
    		<legend>Compañia</legend>
	    	<form action="" method="post">
	    		<div>
	    			<label for="id">Compañía:</label>
					<select name="carrierName">
						<?php echo $combobit; ?>
	    			</select>
	    			<input type="submit" name="Enviar" value="Enviar" />
	    		</div>
	    	</form>
    	</fieldset>
    </body>
</html>