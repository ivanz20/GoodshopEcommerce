<?php      
    
    if ( isset($_SESSION['nombre_usuario'])){ 
    session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOODSHOP</title>

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!--Styles-->
    <link rel="stylesheet" type="text/css" href="Views/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-light" style="position: fixed;z-index: 99999; width:10000px;">
  <a class="navbar-brand" href="#">  <img src="Views/img/goodshoplogo.png" width="250" style="position: relative; top:50%;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">          
</span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sesion.php">Iniciar Sesion</a>
      </li>
    </ul>
  </div>
</nav>

<div class="hero-image text-center" style="background-image: url('Views/img/family.jpg');height: 600px;">
    <div class="hero-text text-center">
        <div class="row">
            <h1>Los mejores productos y los mejores precios</h1>
        </div>
        <div class="row" style="position: relative; left: 40%">
            <button id="boton-index" ><a href="Views/sesion.php" style="text-decoration: none; color: white;"><strong>Comprar</strong></a></button>
        </div>
    </div>
</div>
<div class="container" class="mx-auto"  style="text-align:center;height: 600px; padding-top: 80px;     font-family: 'Roboto', sans-serif;
">
    <h1>Mejores Productos</h1>
    <div class="arrow mx-auto" style=" position:relative; display:  inline; bottom: 40px;">
        <button style="background-color: transparent; border: none"><i class="fa-solid fa-arrow-left"></i></button>
    </div>
    <?php for ($x=0; $x<4; $x++){
        echo
        "<div class='card'>
        <img src='Views/img/lampara.jpg'>
        <h4>Lámpara de techo Balti - Bronce</h4>
        <p>$2,799.00 MXN</p>
        <form action='sesion.php'><button type='submit'>Ver Articulo</button></form>
        </div>";
    } ?>

    <div class="arrow mx-auto" style=" position:relative; display:  inline; bottom: 40px;">
        <button style="background-color: transparent; border: none"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
</div>
<div class="hero-image text-center" style="background-image: url('Views/img/fotoindex.jpg');height: 600px;">
    <div class="hero-text text-center">
        <div class="row">
            <h1>Todo lo que buscas en un solo lugar.</h1>
        </div>
    
    </div>
</div>


<?php include("Views/includes/footer.php")?>