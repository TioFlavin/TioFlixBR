<?php

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['bloqueado'],
'parse_mode' => 'html'
]);
