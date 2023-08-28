<?php

$retorno=$telegram->deleteMessage ([
'chat_id' => CANAL,
'message_id' => $query
]);

if ($retorno ['ok']){

$telegram->answerCallbackQuery ([
'callback_query_id' => $callback_id,
'text' => '🚮 Divulgação Deletada do Canal.',
'show_alert' => 'true'
]);

$telegram->deleteMessage ([
'chat_id' => $chat_id,
'message_id' => $msg_id
]);

}else {

$telegram->answerCallbackQuery ([
'callback_query_id' => $callback_id,
'text' => '🚮 Desculpe mas já se passaram 48h e essa divulgação não pode ser mais apagada!',
'show_alert' => 'true'
]);

}
