<?php session_start(); $segura = "active" ;?>
<?php include 'config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php

$de = $_SESSION['id'];
$para = $_POST['djport'];
$mensagem = $_POST['send_mensage'];
$ja_leu = 1;
$id_mensagem = mt_rand();

$sql = mysql_query("SELECT * FROM perfil_informacoes_gerais WHERE id_relacional='$de'");
$dono_sessao = mysql_fetch_object($sql);

$sql = mysql_query("SELECT * FROM pre_imagem_perfil WHERE id_relacional='$de'");
$foto_dono_sessao = mysql_fetch_object($sql);


$data = date("d/m/Y");
$hora = date("H:i:s");

// Insere os dados na tabela de mensagens
$sql = mysql_query("INSERT INTO mensages VALUES (
	'".$id_mensagem."',
	'".$de."',
	'".$para."',
	'".$foto_dono_sessao->foto."',
	'".$dono_sessao->nome_artistico."',
	'".$mensagem."',
	'".$data."',
	'".$hora."',
	'".$ja_leu."'
)");


?>