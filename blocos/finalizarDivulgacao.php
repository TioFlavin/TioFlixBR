<?php

$divulgacao=$BD->getDivulgacao ($query);

$optionUser=[
[$telegram->buildInlineKeyBoardButton ($divulgacao ['nome'], $divulgacao ['link'])]
];

$telegram->editMessageReplyMarkup ([
'chat_id' => $chat_id,
'message_id' => $msg_id,
'reply_markup' => $telegram->buildInlineKeyBoard ($optionUser)
]);

if (DIVULGACAO_DIRETA){

$urlCanal='https://t.me/'.substr (CANAL, 1).'/'; 

// Esse método usará a variável de keyboard criada para o usuário.

$returnCanal=$telegram->sendPhoto ([
'chat_id' => CANAL, 
'photo' => $divulgacao ['file_id'],
'caption' => $divulgacao ['descricao'],
'reply_markup' => $telegram->buildInlineKeyBoard ($optionUser) 
]);

$optionAdm=[
[$telegram->buildInlineKeyBoardButton ($divulgacao ['nome'], $divulgacao ['link'])],
[$telegram->buildInlineKeyBoardButton ('Ver no canal', $urlCanal.$returnCanal ['result']['message_id'])],
[$telegram->buildInlineKeyBoardButton ('💡 Sobre '.limitaStr ($user_nome), '', '/sobreusuario_'.$user_id)],
[$telegram->buildInlineKeyBoardButton ('⚠️ Adv.  Divulgação', '', '/advertencia_'.$user_id)]
];

if ($usuario ['advertencias'] >= 1){

$optionAdm [][]=$telegram->buildInlineKeyBoardButton ('Remover Advertências', '', '/removeradvertencias_'.$user_id);

}

$telegram->sendPhoto ([
'chat_id' => ADM, 
'photo' => $divulgacao ['file_id'],
'caption' => $divulgacao ['descricao'],
'reply_markup' => $telegram->buildInlineKeyBoard ($optionAdm) 
]);

$optionFinal [][]=$telegram->buildInlineKeyBoardButton ('Ver no canal', $urlCanal.$returnCanal ['result']['message_id']);

if (BANNER_RETIBUIR != ''){

$optionFinal [][]=$telegram->buildInlineKeyBoardButton ('Nos divulgue também', BANNER_RETIBUIR);

}

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['finaliza_divulgacao_direta'],
'parse_mode' => 'html',
'reply_markup' => $telegram->buildInlineKeyBoard ($optionFinal)
]);

exit;

}

$telegram->sendMessage ([
'chat_id' => $chat_id,
'text' => $send ['finaliza'],
'parse_mode' => 'html'
]);

$optionAdm=[
[$telegram->buildInlineKeyBoardButton ($divulgacao ['nome'], $divulgacao ['link'])],
[$telegram->buildInlineKeyBoardButton ('💡 Sobre '.limitaStr ($user_nome), '', '/sobreusuario_'.$user_id)],
[$telegram->buildInlineKeyBoardButton ('🚫', '', '/recusar'), $telegram->buildInlineKeyBoardButton ('✅', '', '/aceitar_'.$query)],
[$telegram->buildInlineKeyBoardButton ('⚠️ Adv.  Divulgação', '', '/advertencia_'.$user_id)]
];

if ($usuario ['advertencias'] >= 1){

$optionAdm [][]=$telegram->buildInlineKeyBoardButton ('Remover Advertências', '', '/removeradvertencias_'.$user_id);

}

$telegram->sendPhoto ([
'chat_id' => ADM, 
'photo' => $divulgacao ['file_id'],
'caption' => $divulgacao ['descricao'],
'reply_markup' => $telegram->buildInlineKeyBoard ($optionAdm) 
]);
