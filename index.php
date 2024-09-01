<?php

require_once 'ConexionClase4.php';

// Creando el objeto que controla la conexion a la BD
$conexionClase4 = new ConexionClase4();
$conexion = $conexionClase4->conectar();

$sql = $conexion->prepare("
    select
	    codigo,
	    descripcion
    from tipoDocumentos
");

$sql->execute();
$tipoDocumentos = $sql->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="formulario.php" method="post">
        <label for="nombreCompleto">Nombre Completo</label>
        <input type="text" name="nombreCompleto" id="nombreCompleto">
        <br><br>

        <label for="tipoDocumento">Tipo Documento</label>
        <select name="tipoDocumento" id="tipoDocumento">
            <option value="">Seleccione...</option>
            <?php 
                foreach($tipoDocumentos as $key){
            ?>
                    <option value="<?=$key['codigo']?>"><?=$key['descripcion']?></option>
            <?php
                }
            ?>
        </select>
        <br><br>

        <label for="numeroIdentificacion">Número Identificación</label>
        <input type="text" name="numeroIdentificacion" id="numeroIdentificacion">
        <br><br>

        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario">
        <br><br>

        <label for="clave">Contraseña</label>
        <input type="password" name="clave" id="clave">
        <br><br>

        <button type="submit">:: Guardar ::</button>

    </form>
    
</body>
</html>