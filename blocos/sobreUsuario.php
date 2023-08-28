<?php

date_default_timezone_set (TIME_ZONE);

$infoUsuario=$BD->getUsuario ($query);

$getUser=$telegram->getChatMember ([
'chat_id' => CANAL,
'user_id' => $query
]);

if ($getUser == null || $getUser ['ok'] == false){

$info='Não foi possível ter informações desse usuário!';

}else {

if (isset ($getUser ['result']['user']['username'])){

$username='@'.$getUser ['result']['user']['username'];

}else {

$username='Sem username';

}

$ultima_divulgacao=date ('d/m/Y H:i', $infoUsuario ['ultima_divulgacao']);

$info='
💡 Sobre esse usuário:

Nome: '.$getUser ['result']['user']['first_name'].'
Usuário: '.$username.'
ID do usuário: '.$query.'
Última Divulgação: '.$ultima_divulgacao.'
Total de divulgações: '.$infoUsuario ['total_divulgacoes'].'
Advertências: '.$infoUsuario ['advertencias'];

}

$telegram->answerCallbackQuery ([
'callback_query_id' => $callback_id,
'text' => $info,
'show_alert' => 'true'
]);
