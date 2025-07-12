<?php
// بداية الملف
ini_set('display_errors', 0);
error_reporting(0);
define('ADMIN_ID', 6099048919);
define('GAME_DURATION', 30);
define('GAME_FILE', 'game_data.json');
$token = "6132217025:AAFwbsrGTmrOFG-B8zGu29WO3TUijm74WpQ";
define('API_KEY',$token);
echo file_get_contents("https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']);
            function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function send($text,$mode = null){
	bot('sendMessage',[
'chat_id'=>$GLOBALS['chat_id'],
'text'=>$text,
'parse_mode'=>$mode,
 'reply_to_message_id'=>$GLOBALS['message_id'],
]);
	}
function SendChatAction($chat_id, $action)
{
    return bot('sendChatAction', [
        'chat_id' => $chat_id,
        'action' => $action
    ]);
}
function sendMessage($chat_id, $text, $parse_mode = "MARKDOWN", $disable_web_page_preview = true, $reply_to_message_id = null, $reply_markup = null)
{
    return bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => $parse_mode,
        'disable_web_page_preview' => $disable_web_page_preview,
        'disable_notification' => false,
        'reply_to_message_id' => $reply_to_message_id,
        'reply_markup' => $reply_markup
    ]);
}

function loadGame() {
    if (!file_exists(GAME_FILE)) return null;
    return json_decode(file_get_contents(GAME_FILE), true);
}

function saveGame($data) {
    file_put_contents(GAME_FILE, json_encode($data));
}

function resetGame() {
    unlink(GAME_FILE);
}
$update = json_decode(file_get_contents('php://input'));
if($update->message){
	$message = $update->message;
$message_id = $update->message->message_id;
$username = $message->from->username;
$chat_id = $message->chat->id;
$title = $message->chat->title;
$text = $message->text;
$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
}
if($update->callback_query){
$data = $update->callback_query->data;
$chat_id = $update->callback_query->message->chat->id;
$title = $update->callback_query->message->chat->title;
$message_id = $update->callback_query->message->message_id;
$name = $update->callback_query->message->chat->first_name;
$user = $update->callback_query->message->chat->username;
$from_id = $update->callback_query->from->id;
}
if($update->edited_message){
	$message = $update->edited_message;
	$message_id = $message->message_id;
$username = $message->from->username;
$chat_id = $message->chat->id;
$chat_id = $message->chat->id;
$text = $message->text;
$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
	}
	if($update->channel_post){
	$message = $update->channel_post;
	$message_id = $message->message_id;
$chat_id = $message->chat->id;
$text = $message->text;
$user = $message->chat->username;
$title = $message->chat->title;
$name = $message->author_signature;
$from_id = $message->chat->id;
	}
	if($update->edited_channel_post){
	$message = $update->edited_channel_post;
	$message_id = $message->message_id;
$chat_id = $message->chat->id;
$text = $message->text;
$user = $message->chat->username;
$name = $message->author_signature;
$from_id = $message->chat->id;
	}
	if($update->inline_query){
		$inline = $update->inline_query;
		$message = $inline;
		$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
$query = $message->query;
$text = $query;
		}
	if($update->chosen_inline_result){
		$message = $update->chosen_inline_result;
		$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
$inline_message_id = $message->inline_message_id;
$message_id = $inline_message_id;
$text = $message->query;
$query = $text;
		}
		$tc = $update->message->chat->type;
		$re = $update->message->reply_to_message;
		$re_id = $update->message->reply_to_message->from->id;
$re_user = $update->message->reply_to_message->from->username;
$re_name = $update->message->reply_to_message->from->first_name;
$re_messagid = $update->message->reply_to_message->message_id;
$re_chatid = $update->message->reply_to_message->chat->id;
$photo = $message->photo;
$video = $message->video;
$sticker = $message->sticker;
$file = $message->document;
$audio = $message->audio;
$voice = $message->voice;
$caption = $message->caption;
$photo_id = $message->photo[0]->file_id;
$video_id= $message->video->file_id;
$sticker_id = $message->sticker->file_id;
$file_id = $message->document->file_id;
$music_id = $message->audio->file_id;
$forward = $message->forward_from_chat;
$forward_id = $message->forward_from_chat->id;
$title = $message->chat->title;
if($re){
	$forward_type = $re->forward_from->type;
$forward_name = $re->forward_from->first_name;
$forward_user = $re->forward_from->username;
	}else{
$forward_type = $message->forward_from->type;
$forward_name = $message->forward_from->first_name;
$forward_user = $message->forward_from->username;
$forward_id = $message->forward_from->id;
if($forward_name == null){
	$forward = $message->forward_from_chat;
$forward_id = $message->forward_from_chat->id;
$forward_title = $message->forward_from_chat->title;
	}
}
$title = $message->chat->title;
if($text == "/start"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم شغال",
'reply_to_message_id'=>$message->message_id,
]);
}
if ($text === 'رول' ) {
        $game = [
            'chat_id' => $chat_id,
            'players' => [],
            'start_time' => time(),
            'started' => false
        ];
        saveGame($game);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"تم بدء الرول",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'انضمام' ,'callback_data'=>"join_game"],['text'=>'مغادره' ,'callback_data'=>"leave_game"]],
]])
]);
}

$game = loadGame();

    if (!$game) exit;

    if ($data === 'join_game') {
        if (!in_array($from_id, $game['players'])) {
            $game['players'][] = $from_id;
            saveGame($game);
        }
    }

    if ($data === 'leave_game') {
        if (in_array($from_id, $game['players'])) {
            $game['players'] = array_values(array_diff($game['players'], [$from_id]));
            saveGame($game);
        }
    }

    // تحديث الرسالة
// تحديث الرسالة
$count = count($game['players']);
$time_left = max(0, ($game['start_time'] + GAME_DURATION) - time());

bot('editMessageText', [
    'chat_id' => $chat_id,
    'message_id' => $message_id,
    'text' => "🎯 لعبة الروليت بدت!\n⏳ اللعبة تبدأ بعد <b>$time_left ثانية</b>\n👥 عدد اللاعبين: $count\n\nاضغط الزر للانضمام أو المغادرة.",
    'parse_mode' => 'HTML',
    'reply_markup' => json_encode([
        'inline_keyboard' => [
            [['text' => '🎮 انضم للعبة', 'callback_data' => 'join_game']],
            [['text' => '📤 مغادرة', 'callback_data' => 'leave_game']]
        ]
    ])
]);