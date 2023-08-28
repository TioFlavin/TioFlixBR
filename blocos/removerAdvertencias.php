<?php

$BD->removeAdvertencias ($query);

$telegram->answerCallbackQuery ([
'callback_query_id' => $callback_id,
'text' => '⚠️ Todas as advertências deste usuario foram removidas.',
'show_alert' => 'true'
]);