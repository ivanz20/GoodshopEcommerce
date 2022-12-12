<?php


class UserModel extends mysqldb
{
    
    function agregar_usuario($opcion,$email,$usuario,$password,$rol,$imagen,$nombre,$apellidopaterno,$apellidomaterno,$nacimiento,$sexo,$privacidad){
      
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sqlvalidacion =  "CALL sp_usuarios(7, NULL, '" . $email . "','" . $usuario . "','" . $password .
        "','" . $rol . "','" . $imagen . "','" . $nombre . "','" . $apellidopaterno . "','" . $apellidomaterno .
        "','" . $nacimiento . "','" . $sexo . "'," . $privacidad . ",NULL,NULL,NULL);";
        
        $result = $conn->query($sqlvalidacion);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            while($row = $result->fetch_assoc()) {
                if($row['nombre_usuario']!=$usuario){
                    if($row['correo_electronico']!=$email){
    
                        $Validacion = true;
    
                    }else{
                        echo "El Correo ya esta registrado";
                        $Validacion = false;
                    }
                }else{
                    echo "El nombre de usuario ya esta registrado";
                    $Validacion = false;
                }
              
            }
        }else{
            $Validacion = true;
        }
        
        $mysqlcon->CloseCon($conn);

        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        if($Validacion){
            $sql = "CALL sp_usuarios(" . $opcion . ",NULL," . "'" . $email . "','" . $usuario . "','" . $password .
               "','" . $rol . "','" . $imagen . "','" . $nombre . "','" . $apellidopaterno . "','" . $apellidomaterno .
               "','" . $nacimiento . "','" . $sexo . "'," . $privacidad . ",NULL,NULL,NULL);";
                   if ($conn->query($sql) === TRUE) {
                       echo "Usuario Registrado";
                   } else {
                       echo "Error: " . $sql . "<br>" . $conn->error;
                   }
       }
       $mysqlcon->CloseCon($conn);


    }

    function editar_usuario($opcion,$id,$email,$usuario,$imagen,$nombre,$apellidopaterno,$apellidomaterno,$nacimiento,$sexo,$privacidad){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_usuarios(" . $opcion . "," . $id . "," . "'" . $email . "','" . $usuario . "','NULL','NULL',"  . 
        "'" . $imagen . "','" . $nombre . "','" . $apellidopaterno . "','" . $apellidomaterno .
                "','" . $nacimiento . "','" . $sexo . "'," . $privacidad . ",NULL,NULL,NULL);";
        
        if ($conn->query($sql) === TRUE) {
            echo "Usuario Editado";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $sql2 = "CALL sp_usuarios(6," . $id . ",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
        $result = $conn->query($sql2);
        while($row = $result->fetch_assoc()) {
            if($row['nombre_usuario']==$usuario){
                $_SESSION['idusuario'] = $row['id_usuario'];
                $_SESSION['correo_electronico'] = $row['correo_electronico'];
                $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
                $_SESSION['avatar_imagen'] = $row['avatar_imagen'];
                $_SESSION['nombres'] = $row['nombres'];
                $_SESSION['apellidopaterno'] = $row['apellidopaterno'];
                $_SESSION['apellidomaterno'] = $row['apellidomaterno'];
                $_SESSION['fecha_nacimiento'] = $row['fecha_nacimiento'];
                $_SESSION['sexo_usuario'] = $row['sexo_usuario'];
                $_SESSION['privacidad_perfil'] = $row['privacidad_perfil'];
            }
        }
        $mysqlcon->CloseCon($conn);
    }

    function inicio_sesion($usuario, $pass){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_usuarios(5, NULL, NULL,'" . $usuario . "','" . $pass . "',". "NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            if($row['nombre_usuario']==$usuario){
                session_id();
                session_start();
                $_SESSION['idusuario'] = $row['id_usuario'];
                $_SESSION['correo_electronico'] = $row['correo_electronico'];
                $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
                $_SESSION['rol_usuario'] = $row['rol_usuario'];
                $_SESSION['avatar_imagen'] = $row['avatar_imagen'];
                $_SESSION['nombres'] = $row['nombres'];
                $_SESSION['apellidopaterno'] = $row['apellidopaterno'];
                $_SESSION['apellidomaterno'] = $row['apellidomaterno'];
                $_SESSION['fecha_nacimiento'] = $row['fecha_nacimiento'];
                $_SESSION['fecharegistro'] = $row['fecha_registro'];
                $_SESSION['sexo_usuario'] = $row['sexo_usuario'];           
                $_SESSION['privacidad_perfil'] = $row['privacidad_perfil'];
                $_SESSION['direccion1'] = $row['direccion1'];
                $_SESSION['direccion2'] = $row['direccion2'];
                $_SESSION['direccion3'] = $row['direccion3'];
    
                header("Location: inicio.php");
                return true;
            }else{
               return false;
            }
        }
    }

    function GetUserById($iduser){
        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $sql = "CALL sp_usuarios(6," . $iduser . ",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
        $result = $conn->query($sql);
        $results_array = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($results_array, $row);
        }
        $mysqlcon->CloseCon($conn);
        return $results_array;
    }

    
}
?>