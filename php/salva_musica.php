<?php session_start(); $segura = "active" ;?>
<?php include 'config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php


$session_id = $_SESSION['id'];
$id_musica = mt_rand();
$nome = $_POST['nome'];
$autor = $_POST['autor'];
$music = $_POST['mp3'];
$categoria = $_POST['categoria'];
$genero = $_POST['genero'];

$pontos = '1';
$data = date('y-m-d');







$uploaddir = '../sounds/';
$uploadfile = $uploaddir . $_FILES['mp3']['name'];

$tamanho = $_FILES['mp3']['size'];

$valor = $tamanho / 1024;
$valor = $valor / 1024;

print "<pre>";
if (move_uploaded_file($_FILES['mp3']['tmp_name'], $uploaddir . $id_musica.'.mp3')) {
	
	$sql = mysql_query("INSERT INTO musicas VALUES (
	'".$session_id."',
	'".$id_musica."',
	'".$nome."',
	'".$autor."',
	'defult/defult-music-img.jpg',
	'".$id_musica.".mp3"."',
	'".$valor."',
	'".$categoria."',
	'".$genero."',
	'".$data."',
	'".$pontos."'
)");
	
    print "O arquivo é valido e foi carregado com sucesso. Aqui esta alguma informação:\n";
    print_r($_FILES);
	
	echo '
<script language="javascript"type="text/javascript">
window.location="http://www.djport.com.br/?upload='.$id_musica.'";</script>';

} else {
    print "Possivel ataque de upload! Aqui esta alguma informação:\n";
    print_r($_FILES);
}
print "</pre>";



/*

if($_FILES['mp3']['type'] != 'audio/mp3'){
	echo 'O arquivo deve estar em mp3.';
}else{

// Insira aqui a pasta que deseja salvar o arquivo
if(move_uploaded_file($_FILES['mp3']['tmp_name'], '../sounds/'.$id_musica.'.mp3')){
	echo 'arquivo enviado';
}else{
	echo 'erro';
}


}

*/
