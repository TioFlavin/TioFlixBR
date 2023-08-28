<?php

include '../includes/classeBD.php';

$host=$_POST ['host'];
$usuario=$_POST ['usuario'];
$senha=$_POST ['senha'];
$bd=$_POST ['bd'];
$token=$_POST ['token'];
$canal=$_POST ['canal'];
$id=$_POST ['id'];
$url=$_POST ['url'];

$BD=new BancoDeDados ($host, $usuario, $senha, $bd);

$divulgacao=$BD->Query ("CREATE TABLE IF NOT EXISTS `divulgacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_telegram` bigint(40) NOT NULL,
  `file_id` varchar(250) DEFAULT NULL,
  `descricao` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `nome` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8");

$sessao=$BD->Query ("CREATE TABLE IF NOT EXISTS `sessao` (
  `id_telegram` bigint(20) NOT NULL,
  `sessao` varchar(250) DEFAULT NULL,
  `id_divulgacao` bigint(20) DEFAULT '0',
  `advertencias` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

if ($divulgacao == false && $sessao == false){

header ('Location: ./?bd=false');

exit;
}

$getMe=json_decode (file_get_contents ('https://api.telegram.org/bot'.$token.'/getMe'));

if ($getMe->ok == true || $getMe == null){

$setWebhook=json_decode (file_get_contents ('https://api.telegram.org/bot'.$token.'/setWebhook?url='.$url));

$config=file_get_contents ('config.php');

file_put_contents ('config.php', sprintf ($config, $host, $usuario, $senha, $bd, $token, $canal, $id));

copy ('config.php', '../includes/config.php');

unlink ('config.php');

header ('Location: ./?ok=true');

exit;
}

header ('Location: ./?ok=false');
