<?php

$telegram->answerCallbackQuery ([
'callback_query_id' => $callback_id,
'text' => '⚠️ Usuário Advertido.'
]);

$BD->setAdvertencia ($query);

$advertencias=$BD->getAdvertencias ($query);

$getUser=$telegram->getChatMember ([
'chat_id' => CANAL,
'user_id' => $query
]);

if ($getUser == null || $getUser ['ok'] == false){

$adv_nome='Usuário';

}else {

$adv_nome=$getUser ['result']['user']['first_name'];

}

if ($advertencias >= NUMERO_ADVERTENCIAS){

$msg_user='⚠️ <b>'.$advertencias.' de '.NUMERO_ADVERTENCIAS.' advertencias.</b>

Você recebeu sua última advertência e não poderá fazer mais nenhuma divulgação.';

$msg_adm='⚠️ <b>'.$advertencias.' de '.NUMERO_ADVERTENCIAS.' advertencias.</b>

Usuário <a href="tg://user?id='.$user_id.'">'.$adv_nome.'</a> foi bloqueado, agora ele não poderá fazer mais nenhuma divulgação.';

}else {

$msg_user='⚠️ <b>'.$advertencias.' de '.NUMERO_ADVERTENCIAS.' advertencias.</b>

Você recebeu uma advertência por sua divulgação.
Após '.NUMERO_ADVERTENCIAS.' advertência você não poderá fazer mais nenhuma divulgação no bot.';

$msg_adm='⚠️ <b>'.$advertencias.' de '.NUMERO_ADVERTENCIAS.' advertencias.</b>

Usuário <a href="tg://user?id='.$user_id.'">'.$adv_nome.'</a> foi Advertido.
Após atingir o limite de '.NUMERO_ADVERTENCIAS.' advertências esse usuário não poderá fazer mais divulgações.';

}

// notifica usuário

$telegram->sendMessage ([
'chat_id' => $query,
'text' => $msg_user,
'parse_mode' => 'html'
]);

// notifica ADM

$telegram->deleteMessage ([
'chat_id' => $chat_id,
'message_id' => $msg_id
]);

$telegram->sendMessage ([
'chat_id' => ADM,
'text' => $msg_adm,
'parse_mode' => 'html'
]);
