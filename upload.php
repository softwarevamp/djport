<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php
$session_id = $_SESSION['id'];
$id_musica = mt_rand();
$session_musica = $_POST['session_musica']; // importante
$nome = $_POST['nome'];
$autor = $_POST['autor'];
$categoria = $_POST['categoria'];
$genero = $_POST['genero'];
$foto = $_FILES['files'];
$pontos = '1';
$data = date('y-m-d');


	// Se a imagens estiver sido selecionada
	if (!empty($foto["name"])) {
    	// Verifica se o arquivo é uma imagem
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
     	   $error[1] = "Isso não é uma imagem.";
   	 	} 

		// Se não houver nenhum erro
		if (count($error) == 0) {
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
        	// Gera um nome único para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
        	// Caminho de onde ficará a imagem
        	$caminho_imagem = "sounds/capas/" . $nome_imagem;
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			
		}
		
	$sql = mysql_query("INSERT INTO musicas VALUES (
	'".$session_id."',
	'".$id_musica."',
	'".$session_musica."',
	'".$nome."',
	'".$autor."',
	'".$nome_imagem."',
	'aguardando_url_musica',
	'aguardando_valor',
	'".$categoria."',
	'".$genero."',
	'".$data."',
	'".$pontos."'
	)");
		
	}


// A list of permitted file extensions
$allowed = array('mp3', 'wav');
if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
	
	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}
	
	// musica
	$_FILES['upl']['name'] = str_replace(" ","_",$_FILES['upl']['name']);
	$tamanho = $_FILES['upl']['size'];
	$valor = $tamanho / 1024;
	$valor = $valor / 1024;
	
	
	preg_match("/\.(mp3|wav|MP3|WAV){1}$/i", $_FILES['upl']['name'], $ext);
    // Gera um nome único para a musica
    $url_musica = md5(uniqid(time())) . "." . $ext[1];
	
	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'sounds/'.$url_musica)){
		
			
		
		// atualizando os dados do perfil no bd
$sql = mysql_query("UPDATE musicas SET
					url_musica='$url_musica',
					tamanho ='$valor'
					WHERE session_musica='$session_musica'");
	
		header("Location: ./"); 
		
		echo '{"status":"success"}';
		exit;
	}
}

echo '{"status":"error"}';
exit;