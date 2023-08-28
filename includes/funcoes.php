<?php

function tempo ($seg){

if ($seg >= 3600 && $seg < 84600){

$pref=$seg > 7200 ? 'hs' : 'h';

return round ($seg/3600).$pref;

}elseif ($seg >= 84600 && $seg < 2592000){

$pref=$seg > 169200 ? ' dias' : ' dia';

return round ($seg/84600).$pref;

}elseif ($seg >= 2592000){

$pref=$seg > 2592000 ? ' meses' : ' mês';

return round ($seg/2592000).$pref;

}

}

function getLink ($link){

if (strpos ($link, '@') !== false){

$link=str_replace ('@', '', $link);

return 'https://t.me/'.$link;

}elseif (strpos ($link, '/joinchat/') !== false){

return $link;

}

return false;

}

function limitaStr ($str, $tamanho=15){

if (strlen ($str) > $tamanho){
$str=substr ($str, 0, $tamanho).'...';
}

return $str;

}