<?php
require "config.php";

if(!isset($_FILES['file'])) exit;

$name = preg_replace("/[^a-zA-Z0-9_-]/","_",$_POST['filename']);
$tmp  = $_FILES['file']['tmp_name'];

$zipPath = sys_get_temp_dir()."/".$name.".zip";

$zip = new ZipArchive();
$zip->open($zipPath, ZipArchive::CREATE);
$zip->addFile($tmp, $_FILES['file']['name']);
$zip->close();

/* Telegram upload */
$url = "https://api.telegram.org/bot".BOT_TOKEN."/sendDocument";
$post = [
"chat_id"=>CHAT_ID,
"document"=> new CURLFile($zipPath)
];

$ch = curl_init();
curl_setopt_array($ch,[
CURLOPT_URL=>$url,
CURLOPT_POST=>true,
CURLOPT_RETURNTRANSFER=>true,
CURLOPT_POSTFIELDS=>$post
]);
$res = curl_exec($ch);
curl_close($ch);

$data = json_decode($res,true);
$link = "https://t.me/c/".str_replace("-100","",CHAT_ID)."/".$data['result']['message_id'];

$history = file_exists("history.json")
? json_decode(file_get_contents("history.json"),true)
: [];

$history[]=[
"name"=>$name,
"bytes"=>filesize($zipPath),
"date"=>date("d M Y H:i"),
"link"=>$link
];

file_put_contents("history.json",json_encode($history,JSON_PRETTY_PRINT));
unlink($zipPath);