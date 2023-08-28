<?php

$id_divulgacao=$usuario ['id_divulgacao'];

$link=getLink ($text);

if ($link === false){

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['erro_username'],
'parse_mode' => 'html'
]);

exit;

}

$BD->updateDivulgacao ($id_divulgacao, 'link', $link);

$divulgacao=$BD->getDivulgacao ($id_divulgacao);

$optionUser=[
[$telegram->buildInlineKeyBoardButton ($divulgacao ['nome'], $divulgacao ['link'])],
[$telegram->buildInlineKeyBoardButton ('✅ Pronto', '', '/finalizar_'.$id_divulgacao)],
[$telegram->buildInlineKeyBoardButton ('🔄 Refazer', '', '/refazer_'.$id_divulgacao)]
];

$keybUser=$telegram->buildInlineKeyBoard ($optionUser);

$telegram->sendPhoto ([
'chat_id' => $chat_id,
'photo' => $divulgacao ['file_id'],
'caption' => $divulgacao ['descricao'],
'reply_markup' => $keybUser
]);

$BD->limpaSessao ();
