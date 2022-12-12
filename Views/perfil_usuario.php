<?php include("includes/header.php");

if(!isset($_SESSION['idusuario'])){
    echo '<script type="text/javascript">';
     echo 'window.location.href="sesion.php";';
     echo '</script>';
     echo '<noscript>';
     echo '<meta http-equiv="refresh" content="0;url=sesion.php" />';
     echo '</noscript>'; exit;
}else{
    include("infoperfil.php");

}

?>

<?php include("includes/footer.php"); ?>

