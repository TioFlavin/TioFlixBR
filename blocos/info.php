<?php

$keyb=$telegram->buildInlineKeyBoard ([[$telegram->buildInlineKeyBoardButton('💁‍♂ Canal Desenvolvedor', 'https://t.me/httd1dev')]]);

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['info'],
'parse_mode' => 'html',
'disable_web_page_preview' => 'true',
'reply_markup' => $keyb
]);
