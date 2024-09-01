<?php

require_once 'ConexionClase4.php';

// Creando el objeto que controla la conexion a la BD
$conexionClase4 = new ConexionClase4();
$conexion = $conexionClase4->conectar();

// Recibiendo los datos del form
$nombreCompleto = $_POST["nombreCompleto"];
$tipoDocumento = $_POST["tipoDocumento"];
$numeroIdentificacion = $_POST["numeroIdentificacion"];
$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

// Encriptando la contraseña del usuario
$claveHasheada = password_hash($clave, PASSWORD_ARGON2I);

try {

    // Iniciando la transacción
    $conexion->beginTransaction();

    // Preparar el sql que va a ejecutar en la BD
    $sql = $conexion->prepare("
        INSERT INTO usuarios ( nombreCompleto, tipoDocumento, 
            numeroIdentificacion, usuario, clave )
        VALUES ( :nombreCompleto, :tipoDocumento, :numeroIdentificacion,
            :usuario, :clave )
    ");

    // Blindar los datos que van a la BD y vienes del post para evitar injection SQL
    $sql->bindParam(":nombreCompleto", $nombreCompleto);
    $sql->bindParam(":tipoDocumento", $tipoDocumento);
    $sql->bindParam(":numeroIdentificacion", $numeroIdentificacion);
    $sql->bindParam(":usuario", $usuario);
    $sql->bindParam(":clave", $claveHasheada);

    // Ejecutar el script SQL
    $sql->execute();

    // Si ejecutó correctamente guarde los cambios
    $conexion->commit();

    echo "Se creó el registro exitosamente!";

} catch (\PDOException $e) {
    // Ejecución del sql falló no se guardan cambios
    $conexion->rollBack();
    echo "Error: ".$e;
}

