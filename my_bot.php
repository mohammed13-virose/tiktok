<?php
function bot($method, $datas = []) {
$token = '5286040531:AAE0TRB4EhrObpwiFIqT5dp1D01bXSA49Fs';//توكن
$url = "https://api.telegram.org/bot$token/" . $method;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$res = curl_exec($ch);
curl_close($ch);
return json_decode($res,true);
}
function getupdates($up_id){
$get = bot('getupdates', ['offset' => $up_id]);
return end($get['result']);
}
$id =1229230037;
$tokenn='5286040531:AAE0TRB4EhrObpwiFIqT5dp1D01bXSA49Fs';
while(1){
$get_up = getupdates($last_up + 1);
$last_up = $get_up['update_id'];
if ($get_up) {
$message = $get_up['message'];
//$mid = $get_up->message->message_id;
}
$check = 0;
$hit = 0;
$bad = 0;
$txt ="Hi sir\n-----------\nCheck : ".$check."\nhit :".$hit."\nbad :".$bad;
$a = file_get_contents('https://api.telegram.org/bot'.$tokenn.'/sendMessage?'.http_build_query(['chat_id'=>$id,'text'=>$txt,'parse_mode'=>'markdown']));
$jsonms=json_decode($a,true);
$msg_id=$jsonms['result']['message_id'];
while(true){
$api=file_get_contents('http://mohamed89882k.6te.net/api.php');
$js=json_decode($api,true);
if($js['stat']=='true'){
$hit ++;
$check ++;
$txt ="Hi sir\n-----------\nCheck : ".$check."\nhit :".$hit."\nbad :".$bad;
bot('EditMessageText',['chat_id'=>$id,'message_id'=>$msg_id,'text'=>$txt]);
$user=$js['user'];
$fg=$js['fg'];
$fr=$js['fr'];
$email=$js['email'];
$text = "
New Username Hit ✅
- Username : $user
- Email : $email
- Followers : *$fr*
- Following : *$fg*
--------------------------
";
bot('SendMessage',['chat_id'=>$id,'text'=>$text,'parse_mode'=>'markdown']);
}else{
$check ++;
$bad ++;
$txt ="Hi sir\n-----------\nCheck : ".$check."\nhit :".$hit."\nbad :".$bad;
bot('EditMessageText',['chat_id'=>$id,'message_id'=>$msg_id,'text'=>$txt]);
}}}
