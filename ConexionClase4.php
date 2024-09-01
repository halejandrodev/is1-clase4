<?php

class ConexionClase4 {

    //Atributos de conexión
    private $host = 'localhost';
    private $dataBase = 'clase4';
    private $usuario = 'halejandro';
    private $password = 'halejandro';
    private $atributos = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

    // Atributo protegido para otorgar todos los poderes de conexión a la BD
    protected $conexion;

    // Función que permite otorgar a la variable protegida todo lo de la librería PDO
    public function conectar(){

        try{
            $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->dataBase};charset=utf8", 
                $this->usuario, $this->password, $this->atributos);
            return $this->conexion;
        }catch(PDOException $e) {
            echo 'Error conectando con la base de datos: ' . $e->getMessage();
        }

    }

    public function desconectar(){
        $this->conexion = null;
    }

}