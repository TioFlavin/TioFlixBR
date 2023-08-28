<?php

include 'includes/config.php';
include 'includes/Telegram.php';
include 'includes/classeBD.php';
include 'includes/funcoes.php';
include 'includes/dialogo.php';

$telegram=new Telegram (TOKEN);
$BD=new bancoDeDados (HOST, USUARIO, SENHA, BD, ERROS_SQL);

$data=$telegram->getData ();
$message=@$data ['message'];

$chat_id=$telegram->ChatID ();
$user_id=$telegram->UserID ();
$msg_id=$telegram->MessageID ();
$user_nome=$telegram->FirstName ();
$text=@$telegram->Text ();
$callback_id=@$telegram->Callback_ID ();
$BD->usuarioAtual ($user_id);
$usuario=$BD->getUsuario ();

$is_adm=$user_id == ADM ? true : false;
@list ($cmd, $query)=@explode ('_', $text);

$cmdADM=[
'/aceitar', '/recusar', '/deletar', '/advertencia', '/removeradvertencias', '/sobreusuario'
];

if (in_array ($cmd, $cmdADM) && !$is_adm){
exit;
}

if ($usuario ['advertencias'] >= NUMERO_ADVERTENCIAS){

include 'blocos/block.php';
exit;

}

if ($telegram->getUpdateType () == 'photo'){

include 'blocos/fotoDivulgacao.php';
exit;

}

switch ($cmd){

case '/start':

include 'blocos/start.php';

break;
case '/info':

include 'blocos/info.php';

break;
case '/refazer':

include 'blocos/refazerDivulgacao.php';

break;
case '/finalizar':

include 'blocos/finalizarDivulgacao.php';

break;
case '/aceitar':

include 'blocos/aceitarDivulgacao.php';

break;
case '/deletar':

include 'blocos/deletarDivulgacao.php';

break;
case '/recusar':

include 'blocos/recusarDivulgacao.php';

break;
case '/advertencia':

include 'blocos/advertencia.php';

break;
case '/removeradvertencias':

include 'blocos/removerAdvertencias.php';

break;
case '/sobreusuario':

include 'blocos/sobreUsuario.php';

break;
case $usuario ['sessao'] == 'descricao':

include 'sessao/descricao.php';

break;
case $usuario ['sessao'] == 'nome':

include 'sessao/nome.php';

break;
case $usuario ['sessao'] == 'link':

include 'sessao/link.php';

break;

}
