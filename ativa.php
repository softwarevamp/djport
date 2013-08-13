<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DJPORT</title>
</head>

<body>
<?php

$codigo = $_GET['codigo'];
$id_cripto = $_GET['djport'];
$situacao = "ativado via e-mail";

$id_relacional = base64_decode($id_cripto);

$sql = mysql_query("UPDATE cadastro SET situacao='$situacao' WHERE cod_activate = '$codigo' AND id_relacional = '$id_relacional'");

echo '
<script language="javascript"type="text/javascript">
window.location="http://www.djport.com.br/?ativo='.$id_cripto.'";</script>';

?>

</body>
</html>