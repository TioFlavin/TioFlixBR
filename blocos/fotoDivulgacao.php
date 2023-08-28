<?php

$BD->limpaSessao ();

$membro=$telegram->getChatMember ([
'chat_id' => CANAL,
'user_id' => $user_id
]);

if (SO_MEMBROS && $membro ['ok'] === false || $membro ['result']['status'] == 'left'){

$urlCanal='https://t.me/'.substr (CANAL, 1);

$option [][]=$telegram->buildInlineKeyBoardButton ('Entrar', $urlCanal);

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['so_membros'],
'parse_mode' => 'html',
'reply_markup' => $telegram->buildInlineKeyBoard ($option)
]);

exit;

}

if (($usuario ['ultima_divulgacao']+PROXIMA_DIVULGACAO) > time () && LIMITAR_DIVULGACAO){

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['ja_divulgou'],
'parse_mode' => 'html'
]);

exit;

}

$numKey=count ($message ['photo'])-1;
$file_id=$message ['photo'][$numKey]['file_id'];

$insert=$BD->setDivulgacao ($file_id, time ());

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['pede_descricao'],
'parse_mode' => 'html'
]);

$BD->updateUsuario ('descricao', $insert ['id']);
