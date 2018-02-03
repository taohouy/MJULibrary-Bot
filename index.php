<?php
header('Content-Type: text/html; charset=utf-8');
/**
 * Webhook for Time Bot- Facebook Messenger Bot
 * User: adnan
 * Date: 24/04/16
 * Time: 3:26 PM
 */
$access_token = "EAAErkzQYJoQBAJa1r6995SyXy385Us6EjORzZAfymihtcNT6F1OmV1t8VQ7DCSzUGDIGp0QGGuXmBWMEhJ0HRNLPr59LuqTunG3Cw6LD3j3VpCBZAkgKlZByKAHyMM9VZBtiCHCCun2uzAFHODW2UfbEpOswdQqxv0lz4GZCLvQZDZD";
$verify_token = "mju_library_bot";
$hub_verify_token = null;

if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}


if ($hub_verify_token === $verify_token) {
    echo $challenge;
}

$input = json_decode(file_get_contents('php://input'), true);

$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];

$message_to_reply = '';

$getmessage = explode("#",$message);

/*
if("สมัครบริการแจ้งเตือน" == $getmessage[0]){ 
      $user_id = $getmessage[1];
      $url = 'http://www.library.mju.ac.th/api/getfb.php'; 
      
      $data = "fn=register&fb_id=".$sender."&user_id=".$user_id;
    
      
      try{
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        $content = curl_exec( $ch );
        curl_close($ch);
        if($content==1){
        //print_r($content);
            $message_to_reply = 'ขอบคุณที่สมัครใช้บริการ เราจะคอยส่งข้อมูลข่าวสารดีๆ ให้คุณได้รับทราบ';
        }
        
      }catch(Exception $ex){
      
        echo $ex;
      }
    
    

}*/

//API Url
$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;


//Initiate cURL.
$ch = curl_init($url);

//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
    },
    "message":{
        "text":"'.$message.'"
    }
}';

//Encode the array into JSON.
$jsonDataEncoded = $jsonData;

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

//Execute the request
if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
}
