<?php
include_once("../Database/Database.php");
include("../Model/ProductosModel.php");
$productos = new GestionProductos();
$data=[];
session_start();

if(isset($_POST['nombreproducto'])) {
    $nombreproducto = $_POST['nombreproducto'];
    $descripcionproducto = $_POST['descripcionproducto'];
    $foto1 = addslashes(file_get_contents($_FILES['foto1producto']['tmp_name']));
    $foto2 =addslashes(file_get_contents($_FILES['foto2producto']['tmp_name']));
    $foto3 =addslashes(file_get_contents($_FILES['foto3producto']['tmp_name']));
    $video = addslashes(file_get_contents($_FILES['videoproducto']['tmp_name']));
    $categoria = $_POST['categoriaproducto'];
    $esCotizacion = $_POST['cotizacionproducto'];
    if($esCotizacion == 1){
        $cotizacion = "1";
        $venta = "0";
    }else{
        $cotizacion = "0";
        $venta = "1";
    }
    $precioproducto = $_POST['precioproducto'];
    $cantidadproducto = $_POST['cantidadproducto'];
    $vendedorid = $_SESSION['idusuario'];
    try{
        $productos->agregar_producto($nombreproducto,$descripcionproducto,$foto1,$foto2,$foto3,$video,$venta,$cotizacion,$precioproducto,$cantidadproducto,$vendedorid,$categoria);
        http_response_code(200);
        echo json_encode(array("message"=>"Registro Hecho"));
    }
    catch(Exception $e){
        http_response_code(500);
        echo json_encode(array("message"=>$e));
    }
}



?>