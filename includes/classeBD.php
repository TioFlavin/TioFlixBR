<?php

class BancoDeDados {
	
public function __construct ($host, $user, $senha, $banco_de_dados, $errostatus=true){
	
	$c=@mysqli_connect($host,$user,$senha,$banco_de_dados);
	
	if (!$c){
	# Se retornar erro tenta conectar novamente.
	
	$c=@mysqli_connect($host,$user,$senha,$banco_de_dados);
	
	}
	
	$this->c=$c;
	$this->errostatus=$errostatus;

	@mysqli_set_charset ($this->c, 'utf8mb4');
	
	}
	
public function Query ($query){

   $execQuery=@mysqli_query ($this->c, $query);

    if ($execQuery === false){
       $this->erro ();
   }

      return $execQuery;

     }

public function erro (){
	
	if ($this->errostatus){

   $erroSTR=mysqli_error ($this->c);
   $erroCODE=mysqli_errno ($this->c);

   $erro='
'.$erroCODE.' | '.$erroSTR.' '.date ('d-m-Y H:i:s').'
--------------------------------------------';

   $open=fopen ('erroSQL.txt', 'a');
   fwrite ($open, $erro);
   fclose ($open);
   
   }

      }

public function QueryNumRow ($query){

   $execQuery=@mysqli_num_rows (mysqli_query ($this->c, $query));

    if ($execQuery === false){
       $this->erro ();
   }

      return $execQuery;

     }
     
public function fecha (){
	
	@mysqli_close ($this->c);
	
	}
	
public function usuarioAtual ($id_telegram){
	$this->id_telegram=$id_telegram;
	}
	
public function getUsuario ($id_telegram=''){
	
	if ($id_telegram == ''){
		$id_telegram=$this->id_telegram;
		}
	
	if ($this->usuarioCadastrado ($id_telegram)){
		$query=$this->Query ("SELECT * FROM sessao WHERE id_telegram='".$id_telegram."' ");
		}else {
			$this->Query ("INSERT INTO sessao (id_telegram, sessao, id_divulgacao) VALUES ('".$id_telegram."', '', '0') ");
			$query=$this->Query ("SELECT * FROM sessao WHERE id_telegram='".$id_telegram."' ");
			}
			
	if ($query === false){
		$this->erro ();
		}
		
		$totalDV=$this->QueryNumRow ("SELECT * FROM divulgacao WHERE id_telegram='".$id_telegram."' ");
		$dv=$this->Query ("SELECT * FROM divulgacao WHERE id_telegram='".$id_telegram."' ORDER BY id DESC LIMIT 1");
		
		$info_dv=mysqli_fetch_array ($dv, MYSQLI_ASSOC);
		$info=mysqli_fetch_array ($query, MYSQLI_ASSOC);
		$info ['ultima_divulgacao']=$info_dv ['time'];
		$info ['total_divulgacoes']=$totalDV;
		
		return $info;
	
	}
	
public function usuarioCadastrado (){
	
	$query=$this->QueryNumRow ("SELECT * FROM sessao WHERE id_telegram='".$this->id_telegram."'");
	
	if ($query === false){
		$this->erro ();
		}
	
	if ($query >= 1){
		return true;
		}
		return false;
	
	}
	
public function setDivulgacao ($file_id, $time='', $descricao='', $nome='', $link=''){
	
	$descricao=mysqli_real_escape_string ($this->c, $descricao);
	$nome=mysqli_real_escape_string ($this->c, $nome);
	
	$query=$this->Query ("INSERT INTO divulgacao (id_telegram, file_id, time, descricao, nome, link) VALUES ('".$this->id_telegram."', '".$file_id."', '".$time."', '".$descricao."', '".$nome."', '".$link."') ");
	
	if ($query === false){
		$this->erro ();
		}
		
		$busca=$this->Query ("SELECT * FROM divulgacao WHERE id_telegram='".$this->id_telegram."' AND file_id='".$file_id."' LIMIT 1");
		
		return mysqli_fetch_array ($busca, MYSQLI_ASSOC);
	
	}
	
public function updateUsuario ($sessao, $id_divulgacao){
	
	$query=$this->Query ("UPDATE sessao SET sessao='".$sessao."', id_divulgacao='".$id_divulgacao."' WHERE id_telegram='".$this->id_telegram."' ");
	
	if ($query === false){
		$this->erro ();
		}
		
		return $query;
	
	}
	
public function getDivulgacao ($id){
	
	$query=$this->Query ("SELECT * FROM divulgacao WHERE id='".$id."' LIMIT 1");
	
	if ($query === false){
		$this->erro ();
		}
		
	return mysqli_fetch_array ($query, MYSQLI_ASSOC);

	}

public function updateDivulgacao ($id, $campo, $valor){
	
	$valor=mysqli_real_escape_string ($this->c, $valor);
	
	$query=$this->Query ("UPDATE divulgacao SET ".$campo."='".$valor."' WHERE id='".$id."' ");
	
	if ($query === false){
		$this->erro ();
		}
	
	return $query;
	
	}
	
public function limpaSessao (){
	
	$sessao=$this->getUsuario ($this->id_telegram);
	
	if (isset ($sessao ['sessao']) or isset ($sessao ['id_divulgacao'])){
		$query=$this->Query ("UPDATE sessao SET sessao='', id_divulgacao='0' WHERE id_telegram='".$this->id_telegram."' ");
		}
		
	}
	
public function setAdvertencia ($id_telegram){
	
	$advert=$this->getUsuario ($id_telegram);
	$advertencia=$advert ['advertencias']+1;
	
	$update=$this->Query ("UPDATE sessao SET advertencias='".$advertencia."' WHERE id_telegram='".$id_telegram."' ");
	
	if ($update === false || $advert === false){
		$this->erro ();
		}
		
		return $update;
		
	}
	
public function removeAdvertencias ($id_telegram){
	
	$update=$this->Query ("UPDATE sessao SET advertencias='0' WHERE id_telegram='".$id_telegram."' ");
	
	if ($update === false){
		$this->erro ();
		}
		
		return $update;
	
	}
	
public function getAdvertencias ($id_telegram){
	
	$advert=$this->getUsuario ($id_telegram);
	
	if ($advert === false){
		$this->erro ();
		}
		
		return $advert ['advertencias'];
			
	}
	
	}