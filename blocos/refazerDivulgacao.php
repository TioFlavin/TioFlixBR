<?php

$divulgacao=$BD->getDivulgacao ($query);

$option [][]=$telegram->buildInlineKeyBoardButton ($divulgacao ['nome'], $divulgacao ['link']);

$telegram->editMessageReplyMarkup ([
'chat_id' => $chat_id,
'message_id' => $msg_id,
'reply_markup' => $telegram->buildInlineKeyBoard ($option)
]);

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['refazer'],
'parse_mode' => 'html'
]);
