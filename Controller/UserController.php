<?php
include ('../Database/Database.php');

include("../Model/UsuarioModel.php");

$users = new UserModel();
$data = [];
session_start();

//Inicio de Sesion
    if(isset($_POST['usuario-inicio'])) {
        $usuariologin = $_POST['usuario-inicio'];
        $passwordlogin = $_POST['pass-inicio'];
    
        if(!$users->inicio_sesion($usuariologin,$passwordlogin)){

            http_response_code(500);
            echo json_encode(array("message"=>"Internal Error"));
        }else{
            http_response_code(200);
            echo json_encode(array("message"=>"Entro"));
        }
}

//Registro de Usuario
if(isset($_POST['email-registro'])) {
        $regex =  "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";        
        $email = $_POST['email-registro'];
        $usuario = $_POST['usuario-registro'];
        $password = $_POST['password-registro'];
        $rol = $_POST['rol-registro'];
        $imagen = addslashes(file_get_contents($_FILES['foto-perfil']['tmp_name']));
        $nombre = $_POST['name-segunda'];
        $apellidopaterno = $_POST['apellidopaterno-segunda'];
        $apellidomaterno = $_POST['apellidomaterno-segunda'];
        $nacimiento = $_POST['fecha-segunda'];
        $sexo = $_POST['sexo-form'];
        $privacidad = 1;
        $validacionPassword = preg_match($regex, $password);

    if($validacionPassword){
        try{
            $users->agregar_usuario(1,$email,$usuario,$password,$rol,$imagen,$nombre,$apellidopaterno,$apellidomaterno,$nacimiento,$sexo,$privacidad);
        }
        catch(Exception $e){
            http_response_code(500);
            echo json_encode(array("message"=>$e));
        }
        http_response_code(200);
        echo json_encode(array("message"=>"Registro Hecho"));
        
    }
    else{
        http_response_code(500);
        echo json_encode(array("message"=>"La contraseña esta mal puesta"));
    }
}

//Editar Usuario
if(isset($_POST['email-editar'])) {
    $email = $_POST['email-editar'];
    $usuario = $_POST['usuario-editar'];
    $imagen = addslashes(file_get_contents($_FILES['foto-editar']['tmp_name']));
    $nombre = $_POST['name-editar'];
    $apellidopaterno = $_POST['apellidopaterno-editar'];
    $apellidomaterno = $_POST['apellidomaterno-editar'];
    $nacimiento = $_POST['fecha-editar'];
    $sexo = $_POST['sexo-editar'];
    $privacidad = $_POST['privacidad-editar'];
    $idusuario = $_SESSION['idusuario'];
    try{
        $users->editar_usuario(2,$idusuario,$email,$usuario,$imagen,$nombre,$apellidopaterno,$apellidomaterno,$nacimiento,$sexo,$privacidad);
        http_response_code(200);
        echo json_encode(array("message"=>"Hecho"));
    }
    catch(Exception $e){
        http_response_code(500);
        echo json_encode(array("message"=>$e));
    }
        
}


?>
