<?php
require 'config.php';

require 'AfricasTalkingGateway.php';

$status = $_GET['status'];

$tx_ref = $_GET['tx_ref'];

$readPayment = $dbConnection->query("SELECT * FROM payments WHERE tx_ref = '$tx_ref'");

$results = $readPayment->fetch_assoc();

$phone_number = $results['phone_number'];

$name = $results['name'];

$seatNumber = "VIP-12";

if($status == "successful"){

	$dbConnection->query("UPDATE payments SET status='$status' WHERE tx_ref='$tx_ref' ");

	$message = "Hello ".$name." Thank you for football match, your seat number is ".$seatNumber.", The match start at 4:00 PM today";	

	$apikey     = "fb12d6e588408064b3f3828f1dc3cb264a71230c6c47f3e8f94a44e88c7a20f3";	

	$gateway    = new AfricasTalkingGateway("", $apikey,);

	$gateway->sendMessage($phone_number, $message);

	header("Location:thank_you.php?message='Thank you for paying'  ");

}else{

	header("Location:thank_you.php?message='You payment failed' ");

}

 