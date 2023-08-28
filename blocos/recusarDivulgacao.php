<?php

$telegram->deleteMessage ([
'chat_id' => $chat_id,
'message_id' => $msg_id
]);

$telegram->answerCallbackQuery ([
'callback_query_id' => $callback_id,
'text' => '🚫 Divulgação recusada e deletada.'
]);