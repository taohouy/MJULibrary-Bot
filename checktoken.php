<?php
header('Content-Type: text/html; charset=utf-8');
/**
 * Webhook for Time Bot- Facebook Messenger Bot
 * User: adnan
 * Date: 24/04/16
 * Time: 3:26 PM
 */
$access_token = "EAAFiLqqrKJcBAJl3qCcn9fZAnujlQEhbXsROiW9xq336ZA8iOSMWhLPh1wZCpW9tZAjgDD25XPq10kWIZATkIWWJ8G0QRpSamjDiSI7ivoYobGdxMlztDRszonhXbkxcnXZBWKZAjj4CI0FUupk5ypHr3xAClcIARf0ngZAfCauGSgZDZD";
$verify_token = "mju_library_bot";
$hub_verify_token = null;
if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}
if ($hub_verify_token === $verify_token) {
    echo $challenge;
}
?>
