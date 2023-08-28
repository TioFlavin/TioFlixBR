<!DOCTYPE html>
<html>
<title>Vamos ativar o seu bot</title>
<style>
body {
    font-family: san serif;
    text-align: center !important;
}
input {
    margin: 10px;
    padding: 7px;
}
.submit {
    padding: 5px 10px;
    border-radius: 5px;
}
</style>
</html>
<body>

<h1>Vamos colocar esse bot online, os passos são simples.</h1>

<?php

if ($_GET){

if ($_GET ['bd'] == 'false'){

?>

<p style="color: red;">As informações de acesso ao seu banco de dados parecem estar erradas.</p>

<?php
} elseif ($_GET ['ok'] == 'true'){
?>

<p style="color: green;">
Ok, o seu bot foi configurado com sucesso!
<br>
Agora você pode deletar a pasta instalacao.
</p>

<?php
}elseif ($_GET ['ok'] == 'false'){
?>

<p style="color: red;">Infelizmente tivemos um erro ao configurar o seu bot tente fazer isso de modo manual editando o arquivo <b>config.php</b> e definindo a sua url de webhook com a API do Telegram.</p>

<?php
}

}else {

?>

<p>Coloque aqui as credenciais de acesso ao seu banco de dados e informações do seu bot.</p>

<form action="instalacao.php" method="post">

<label>Host:</label>
<input type="text" name="host" placeholder="Host">
<br>
<label>Usuário: </label>
<input type="text" name="usuario" placeholder="Usuário do banco de dados">
<br>
<label>Senha: </label>
<input type="text" name="senha" placeholder="Senha do banco de dados">
<br>
<label>BD: </label>
<input type="text" name="bd" placeholder="Nome do banco de dados">
<br>
<label>Token:</label>
<input type="text" name="token" placeholder="Token do seu bot.">
<br>
<label>ID: </label>
<input type="text" name="id" placeholder="ID do ADM do bot">
<br>
<label>Canal: </label>
<input type="text" name="canal" placeholder="Username do canal ex: @meucanal">
<br>
<input type="hidden" value="<?php echo 'https://'.$_SERVER ['SERVER_NAME'].str_replace ('/instalacao/', '/', $_SERVER ['REQUEST_URI']).'bot.php'; ?>" name="url"/>
<input class="submit" type="submit" value="Pronto">
</form>

<?php
}
?>

</body>
</html>