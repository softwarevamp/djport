<?php session_start(); $segura = "active" ;?>
<?php include 'config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php
	$session_id = $_SESSION['id'];
	$biografia = $_POST['biografia'];
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$nomeartistico = $_POST['nomeartistico'];
	$pais = $_POST['pais'];
	$categoria = $_POST['categoria'];
	$generos = $_POST['generos'];
	

$sql = mysql_query("SELECT * FROM perfil_informacoes_gerais WHERE id_relacional='$session_id'");
$dados_vazios = mysql_fetch_object($sql);

if($categoria == ""){
	$categoria = $dados_vazios->categoria;
}
if($generos == ""){
	$generos = "Nenhum genero";
}

$generos = str_replace(" ","_",$generos);

$sql = mysql_query("UPDATE perfil_informacoes_gerais SET
					nome='$nome',
					sobrenome='$sobrenome',
					nome_artistico='$nomeartistico',
					pais='$pais',
					categoria='$categoria',
					generos='$generos',
					biografia='$biografia'
					WHERE id_relacional='$session_id'");
					
					
					// Se os dados forem inseridos com sucesso
			if ($sql){
	echo '<div id="certo-atualizar-perfil">Informações gerais atualizadas!</div>';
	echo '<script type="text/javascript">statusRespostaAtulizaPerfil();</script>';
			}
			exit;
	
		// Se houver mensagens de erro, exibe-as
		if (count($error) != 0) {
			foreach ($error as $erro) {
	echo '<div id="erro-atualizar-perfil">Erro ao atualizar informações gerais!</div>';
	echo '<script type="text/javascript">statusRespostaAtulizaPerfil();</script>';
			}
		}


?>
