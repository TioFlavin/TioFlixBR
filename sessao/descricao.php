<?php

$id_divulgacao=$usuario ['id_divulgacao'];

$divulgacao=$BD->getDivulgacao ($id_divulgacao);

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['pede_nome'],
'parse_mode' => 'html'
]);

$BD->updateDivulgacao ($id_divulgacao, 'descricao', $text);

$BD->updateUsuario ('nome', $id_divulgacao);
