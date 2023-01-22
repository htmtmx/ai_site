<?php session_start();

if (isset($_SESSION['usuario'])) {

    header('Location: inicio.php'); 

}

require './admin/admin_config.php';
require './admin/admin_funciones.php';

$conexion = conexion($bd_config);
if (!$conexion) {
    header('Location: error.php');
}

//Comprobar si han enviado los datos (vía POST)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Tomar las variables
    $usuario = strtolower($_POST['email']);
    $password = $_POST['password'];
    $activo = 'true';
    $errores = '';

    //Ahora hashear
    $password = hash('sha512', $password);

    $statement = $conexion->prepare('SELECT * FROM usuarios_admin WHERE usuario = :usuario AND password = :password AND activo = :activo');
    $statement->execute(array(':usuario' => $usuario, ':password' => $password, ':activo' => $activo));
    $resultado = $statement->fetch();
    //print_r($resultado);
    if ($resultado !== false) {//Significa que los datos fueron correctos
        
            $_SESSION['usuario']= $usuario;//Inicia la sesión con ese usuario y ya lo envía al inicio
            //$_SESSION['img_perfil']= $resultado[0].['admin_foto_perfil'];

            header('Location: inicio.php');

    } else {

        $errores .= '<li>Datos incorrectos</li>'.$resultado.'';

    }

}

require 'views/login.view.php';
