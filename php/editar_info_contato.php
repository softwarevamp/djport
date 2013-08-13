<?php session_start(); $segura = "active" ;?>
<?php include 'config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php
	$session_id = $_SESSION['id'];
	$twitter = $_POST['twitter'];
	$facebook = $_POST['facebook'];
	$google = $_POST['google'];
	$youtube = $_POST['youtube'];
	$zippytune = $_POST['zippytune'];
	$soundcloud = $_POST['soundcloud'];
	$mixcloud = $_POST['mixcloud'];

	
$sql = mysql_query("UPDATE perfil_informacoes_contato SET
					twitter='$twitter',
					facebook ='$facebook ',
					google='$google',
					youtube='$youtube',
					zippytune='$zippytune',
					soundcloud='$soundcloud',
					mixcloud='$mixcloud'
					WHERE id_relacional='$session_id'");
					
					
					// Se os dados forem inseridos com sucesso
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
?>