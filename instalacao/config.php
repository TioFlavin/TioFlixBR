<?php

/**
* Credenciais para conexão com o Banco de Dados.
**/

define ('HOST', '%s');

define ('USUARIO', '%s');

define ('SENHA', '%s');

define ('BD', '%s');

/**
* Caso queira guardar erros SQL
**/

define ('ERROS_SQL', false);

define ('TOKEN', '%s');

define ('CANAL', '%s');

define ('ADM', '%s');

define ('TIME_ZONE', 'America/Sao_Paulo');

/**
* false para que os usuários não tenham limite de divulgação.
**/

define ('LIMITAR_DIVULGACAO', true);

/**
* Tempo para a próxima divulgação em segundos.
* O tempo padrão e 24h em segundos 86400.
**/

define ('PROXIMA_DIVULGACAO', 86400);

/**
* Número de advertências para o usuário ser bloqueado.
**/

define ('NUMERO_ADVERTENCIAS', 3);

/**
* Link de um banner de divulgação para que o usuário também possa divulgar o seu canal.
**/

define ('BANNER_RETIBUIR', '');

/**
* Se true o usuário terá que se tornar membro do canal para que possa fazer divulgações.
**/

define ('SO_MEMBROS', false);

/*
* Se true a divulgação será enviada diretamente para o canal sem passar pela confirmação do adm.
*/

define ('DIVULGACAO_DIRETA', false);
