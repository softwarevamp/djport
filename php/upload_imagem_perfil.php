<?php session_start(); $segura = "active" ;?>
<?php include 'config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php

// define a pasta das imagens
$targetFolder = '../img/img-profiles/'; // Relative to the root

$session_id = $_SESSION['id'];

if (!empty($_FILES)) {
	
	$img = $_FILES['Filedata']['name'];
	$ext = substr ($img, -4);
	$img = md5($img).date("dmYHis").$ext;
	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['root'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $img;
	
	// valida o tipo de imagem
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	// Largura máxima em pixels
		$largura = 2000;
		// Altura máxima em pixels
		$altura = 2000;
		
		
		if(mysql_num_rows (mysql_query ("SELECT id_relacional FROM pre_imagem_perfil WHERE id_relacional = '$session_id'")) != 0){
			
			
			$sql = mysql_query("SELECT * FROM pre_imagem_perfil WHERE id_relacional='$session_id'");
			$apaga_atual = mysql_fetch_object($sql);
			
			
			
			
			if($apaga_atual->foto == "defult/defult-profile-img.jpg"){
				$nada = $apaga_atual->foto;
			}else{
				unlink('../img/img-profiles/'.$apaga_atual->foto);
			}
			
			

			$sql = mysql_query("UPDATE pre_imagem_perfil SET foto = '$img' WHERE id_relacional = '$session_id'");
			
		move_uploaded_file($tempFile,$targetFile);
	
		}else{
			
			$sql = mysql_query("INSERT INTO pre_imagem_perfil VALUES ('".$session_id."', '".$img."')");

		move_uploaded_file($tempFile,$targetFile);
	
		}
}
?>