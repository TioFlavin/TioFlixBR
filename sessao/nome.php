<?php

$id_divulgacao=$usuario ['id_divulgacao'];

$BD->updateDivulgacao ($id_divulgacao, 'nome', $text);

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['pede_username'],
'parse_mode' => 'html'
]);


$BD->updateUsuario ('link', $id_divulgacao);
