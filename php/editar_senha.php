<?php session_start(); $segura = "active" ;?>
<?php include 'config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php
	$session_id = $_SESSION['id'];
	$senha_atual = $_POST['senha_atual'];
	$novasenha = $_POST['novasenha'];
	$re_novasenha = $_POST['re_novasenha'];
	

$sql = mysql_query("SELECT * FROM cadastro WHERE id_relacional='$session_id'");
$cadastro = mysql_fetch_object($sql);

$senha = $cadastro->senha;


if($senha_atual == "") {
   	 echo '<div id="erro-atualizar-perfil">Digite a sua senha atual!</div>';
	 echo '<script type="text/javascript">statusRespostaAtulizaPerfil();</script>';
 }elseif($senha_atual !== $senha){
	 echo '<div id="erro-atualizar-perfil">Senha atual não confere!</div>';
	 echo '<script type="text/javascript">statusRespostaAtulizaPerfil();</script>';
 }elseif($novasenha == ""){
	 echo '<div id="erro-atualizar-perfil">Digite uma nova senha!</div>';
	 echo '<script type="text/javascript">statusRespostaAtulizaPerfil();</script>';
 }elseif($novasenha !== $re_novasenha){
	 echo '<div id="erro-atualizar-perfil">As novas senhas não são iguais!</div>';
	 echo '<script type="text/javascript">statusRespostaAtulizaPerfil();</script>';
 }else{
	 	// Se os dados forem inseridos com sucesso
		
		$sql = mysql_query("UPDATE cadastro SET senha='$novasenha' WHERE id_relacional='$session_id'");
		
		
		if ($sql){
				
	echo '<div id="certo-atualizar-perfil">Informações de contato atualizadas!</div>';
	echo '<script type="text/javascript">statusRespostaAtulizaPerfil();</script>';
			}
			exit;
	
		// Se houver mensagens de erro, exibe-as
		if (count($error) != 0) {
			foreach ($error as $erro) {
	echo '<div id="erro-atualizar-perfil">Erro ao atualizar informações de contato!</div>';
	echo '<script type="text/javascript">statusRespostaAtulizaPerfil();</script>';
			}
		}
		
 }




?>