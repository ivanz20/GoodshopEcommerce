<?php
require_once "vendor/autoload.php";
include_once("../Database/Database.php");

use Omnipay\Omnipay;

define('CLIENT_ID','AdNXZ7HpWnTxfQCfE1KL9H_McQu49oRhJhKT1P7Kk3N3sKjokbrvYt2235-kITpA4rK4dH3iVRlCTul3');
define('CLIENT_SECRET','EARJrXy9v2eJvYt7Cnm8fdvPgGggJxGv04sk29aYUg1gGenefkTUKTcsbanjcY3HNe73nxkSNeSgDaG8');

define('PAYPAL_RETURN_URL','http://localhost/PWCI-PIA/Model/success.php');
define('PAYPAL_CANCEL_URL','http://localhost/PWCI-PIA/Model/cancel.php');
define('PAYPAL_CURRENCY','MXN');


$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live

?>