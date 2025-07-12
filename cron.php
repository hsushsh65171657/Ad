<?php
require_once 'index.php';

$game = loadGame();
if (!$game || $game['started']) exit;

if (time() >= $game['start_time'] + GAME_DURATION) {
    $game['started'] = true;
    saveGame($game);
    $chat_id = $game['chat_id'];

    // هنا تبدأ اللعبة فعليًا (نخلي placeholder)
    sendMessage($chat_id, "🎯 اللعبة بدأت! (هنا نعرض العجلة ونبدأ اختيار اللاعبين)");

    // راح نكمل هنا جزء رسم العجلة لاحقًا 👇
}