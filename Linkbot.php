<?php
ob_start();
define('API_KEY','6537388792:AAHX6zkK28V53j5KoOiP880O2aULroBVoJs');

echo "setWebhook ~> <a href=\"https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']."\">https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']."</a>";
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}
else
{
return json_decode($res);
}
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$message_id = $update->message->message_id;
$from_id = $message->from->id;
$username = $message->from->username;
$name = $message->from->first_name;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$user_id = $message->from->id;
$name = $message->from->first_name;
$username = $message->from->username;
$ch = "@M1_M2S";
$join = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$ch&user_id=".$from_id);
if($message && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){
bot('sendMessage', [
'chat_id'=>$chat_id,
 'text'=>"~ اشترڪ اولآ @M1_M2S 💓🖤.",
]);return false;}
if($text == "/start"){
bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"- مرحبا بك  في بوت اختصار الروبط  من خلال هذا البوت يمكنك اختصار اي رابط الى رابط قصير 😊.
* فقط ارسل رابط ليتم اختصاره ✅.",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[
['text'=>'- تسجيل ؟🔖 ،','url'=>'https://donia2link.com/ref/MohamedQais'],
['text'=>'- شراء نسخه ، 🗞','callback_data'=>'buy']
],
]
])
]);
}
if($data == 'buy'){
bot('editMessageText',[
'chat_id'=>$chat_id2,
'message_id'=>$message_id,
'text'=>"• مرحبا بك ،
~ عندما تملك نسخه من بوت @donia2linkBot سوف تكون جميع ارباح البوت لڪ
~ توجد عدةة طرق لـ سحب ارباحڪ من البوت 
- للاستفسار اكثر راسل ماثيو ↙.
~ للرجوع ↪ اضغط /start ✅.",
'parse_mode'=>"MarkDown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'• مراسلةة ماثيو ✅.','url'=>'t.me/iiiiZ']]    
]    
])
]);
}
if(preg_match('/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/',$text) ){
$api = "https://donia2link.com/api?api=90d89b51fd07b276cff6ce247587a46479b14202&url=$text"; 
$result = json_decode(file_get_contents($api), true); 
$short = $result["shortenedUrl"];
bot('sendMessage',[ 
'chat_id'=>$chat_id,  
'text'=>"~ تم اختصار الرابط اضغط للنسخ ↙ 📑.
`$short`", 
'parse_mode'=>"MarkDown",
]); 
bot('sendmessage',[
'chat_id'=> 500144557,
'text'=> "• قام شخص بـ اختصار رابط ↙.
- اسم الشخص ~> [$username](tg://user?id=$user_id)
- الرابط ~> $short",
   'parse_mode'=>"Markdown",
   'disable_web_page_preview'=>'true',
    ]);
}

if(!preg_match('/^ "start" (.*)(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt]/me',$text) ){
$api = "https://donia2link.com/api?api=90d89b51fd07b276cff6ce247587a46479b14202&url=$text"; 
$result = json_decode(file_get_contents($api), true); 
$short = $result["shortenedUrl"];
bot('sendMessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- خطأ ❌.
~ ارسل رابط يحتوي على ↙
• https , http , t.me ...", 
'parse_mode'=>"MarkDown",
]); 
}
if($text == "/start" and $chat_id !== 500144557){
bot('sendMessage',[
'chat_id'=>500144557,
'text'=>"ضغط ستارت [$username](tg://user?id=$user_id)",
'disable_web_page_preview'=>'true',
'parse_mode'=>"Markdown",
]);
}
