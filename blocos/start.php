<?php

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['start'],
'parse_mode' => 'html',
'disable_web_page_preview' => 'false'
]);

$BD->limpaSessao ();