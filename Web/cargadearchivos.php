<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dar formato al selector de archivos</title>
    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <style>
        #image {display:none;}
        #botonSeleccion {
            color:#555;
            background-color:#e6e6e6;
            padding:5px 10px;
            border:1px solid #d3d3d3;
            cursor:pointer;
            display:inline-block;
            -moz-border-radius:4px;-webkit-border-radius:4px;-o-border-radius:4px;border-radius:4px;
        }
        #botonSeleccion:hover {
            color:#000;
            border-color:#999;
        }
        #listFile {
            color:#555;
            font-size:0.8em;
            margin:5px 0px;
        }
        form {
            margin:10px;
        }
    </style>
    <script>
        $(document).ready(function(){
 
            // cuando se pulsa sobre el div que hace de boton, se hace
            // clic sobre el input type=file que esta escondido
            $("#botonSeleccion").click(function(){
                $("#image").click();
            });
 
            // Cuando se modifique el input type=file se pone el nombre del
            // archivo seleccionado en el div listFile
            $("#image").change(function(){
                if($(this).val())
                {
                    // Si tiene valor, se muestra en div
                    $("#listFile").html($(this).val());
                }else{
                    // Si no tiene valor, se muestran los puntos ...
                    $("#listFile").html("No se ha seleccionado ningún archivo");
                }
            });
        });
    </script>
</head>
 
<body>
 
    <h1>Dar formato al selector de archivos</h1>
 
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
 
        <!-- selector de imagen que esta oculto -->
        <input type='file' name='image' id='image'>
 
        <!-- div en formato de boton para seleccionar la imagen -->
        <div id='botonSeleccion'>Seleccionar archivo</div>
 
        <!-- muestra el archivo seleccionado -->
        <div id="listFile">No se ha seleccionado ningún archivo</div>
 
        <br><input type="submit" value="Enviar">
    </form>
 
    <?php
    # mostramos la informacion recibida desde el formulario con PHP
    if(isset($_FILES) && $_FILES)
    {
        echo "<hr><div>";
            echo "Este es el archivo que se ha recibido";
            echo "<pre>";
                print_r($_FILES);
            echo "</pre>";
        echo "</div>";
    }
    ?>
 
</body>
</html>