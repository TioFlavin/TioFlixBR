<?php

$telegram->answerCallbackQuery ([
'callback_query_id' => $callback_id,
'text' => '👍 Divulgação publicada no canal.'
]);

$divulgacao=$BD->getDivulgacao ($query);

$urlCanal='https://t.me/'.substr (CANAL, 1).'/';

// Envia divulgação para o canal

$optionCanal=[
[$telegram->buildInlineKeyBoardButton ($divulgacao ['nome'], $divulgacao ['link'])]
];

$returnCanal=$telegram->sendPhoto ([
'chat_id' => CANAL,
'photo' => $divulgacao ['file_id'],
'caption' => $divulgacao ['descricao'],
'reply_markup' => $telegram->buildInlineKeyBoard ($optionCanal)
]);

// Retorna confirmação

$optionAdm=[
[$telegram->buildInlineKeyBoardButton ($divulgacao ['nome'], $divulgacao ['link'])],
[$telegram->buildInlineKeyBoardButton ('Ver no canal', $urlCanal.$returnCanal ['result']['message_id'])],
[$telegram->buildInlineKeyBoardButton ('💡 Sobre o usuário', '', '/sobreusuario_'.$divulgacao ['id_telegram'])],
[$telegram->buildInlineKeyBoardButton ('🚮 Apagar Divulgação', '', '/deletar_'.$returnCanal ['result']['message_id'])]
];

$telegram->editMessageReplyMarkup ([
'chat_id' => $chat_id,
'message_id' => $msg_id,
'reply_markup' => $telegram->buildInlineKeyBoard ($optionAdm) 
]);

// Avisa o criador da divulgação

$optionUser [][]=$telegram->buildInlineKeyBoardButton ('Ver no canal', $urlCanal.$returnCanal ['result']['message_id']);

if (BANNER_RETIBUIR != ''){

$optionUser [][]=$telegram->buildInlineKeyBoardButton ('Nos divulgue também', BANNER_RETIBUIR);

}

$telegram->sendMessage ([
'chat_id' => $divulgacao ['id_telegram'], 
'text' => $send ['aceito'],
'parse_mode' => 'html',
'reply_markup' => $telegram->buildInlineKeyBoard ($optionUser)
]);
