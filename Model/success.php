<?php
include("../Views/includes/header.php");
require_once '../config.php';
require_once ('../Database/Database.php');
require_once ('../Model/CarritoModel.php');

// Once the transaction has been approved, we need to complete it.
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $response = $transaction->send();
 
    if ($response->isSuccessful()) {
        // The customer has successfully paid.
        $arr_body = $response->getData();
 
        $payment_id = $arr_body['id'];
        $payer_id = $arr_body['payer']['payer_info']['payer_id'];
        $payer_email = $arr_body['payer']['payer_info']['email'];
        $amount = $arr_body['transactions'][0]['amount']['total'];
        $currency = PAYPAL_CURRENCY;
        $payment_status = $arr_body['state'];

        $mysqlcon = new mysqldb;
        $conn = $mysqlcon->OpenCon();
        $conn->query("INSERT INTO payments(payment_id, payer_id, payer_email, amount, currency, payment_status) VALUES('". $payment_id ."', '". $payer_id ."', '". $payer_email ."', '". $amount ."', '". $currency ."', '". $payment_status ."')");
        $mysqlcon->CloseCon($conn);

        $CartService = new Cart();

        $CartService->WhenOrderIsPurchased($payment_id);

        echo "
        <div class='container text-center'>
        <h2>Pago realizado con exito.</h2> 
        El ID de tu pedido es: ". $payment_id .
        "<br><br><img src='https://thumbs.dreamstime.com/b/happy-dog-puppy-smiling-colored-blue-backgorund-closed-eyes-happy-dog-puppy-smiling-colored-blue-backgorund-193236837.jpg' class='rounded mx-auto d-block' alt='perrotruste' width=600px> <br><br>
        <br><button id='boton-mas'><a href='inicio.php' style='text-decoration: none; color: white;'>Volver al inicio</a></button><br><br><br>
        </div> ";
       
    } else {
        echo $response->getMessage();
    }
} else {
    echo 'Transaction is declined';
}
include("../Views/includes/footer.php");
?>