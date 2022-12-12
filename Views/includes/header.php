<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOODSHOP</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="../Views/css/style.css">

</head>
<body>
    <div class="container">
    <nav id="nav-icm" class="navbar navbar-expand-lg text-center">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mx-auto">
            
            <!-- <li class="nav-item animate__animated animate__zoomIn mx-auto">
                <a class="nav-link" href="historial.php">Historial</a>
            </li> -->
            <li class="nav-item animate__animated animate__zoomIn mx-auto">
                <a class="nav-link" href="../Views/favoritos.php">Wishlists</a>
            </li>
            <li class="nav-item animate__animated animate__zoomIn mx-auto">
            <a class="navbar-brand animate__animated animate__fadeInDownBig" href="../Views/inicio.php">
                <img src="../Views/img/goodshoplogo.png" alt="logo-goodshop" height="50">
            </a>
            </li>
            <li class="nav-item animate__animated animate__zoomIn mx-auto">
                <a class="nav-link" href="carrito.php">Carrito</a>
            </li>
            <li class="nav-item animate__animated animate__zoomIn mx-auto" >
                <button>
                    <a  class="nav-link" href="../Views/perfil_usuario.php">Perfil</a>
                </button>
            </li>
            
        </ul>
    </div>
</nav>
        <br>
<div class="container">
    <div id="box" class="text-center">
        <form method="POST" action="paginabuscador.php">
           <input id="barrabusqueda" name="barrabusqueda" type="text" value="">
            <button id="botonbusqueda" type="submit"><i class="fa-solid fa-magnifying-glass" ></i></button>
        </form>
    </div>
</div>
    </div>
