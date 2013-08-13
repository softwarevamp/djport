<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>

<?php
$session_id = $_SESSION['id'];
?>
<script language="javascript">
$(document).ready(function(){
$("a#ln").click(function(){
pagina = $(this).attr('href')
$("#loader").ajaxStart(function(){
$(this).show()})
$("#loader").ajaxStop(function(){$(this).hide();})
$("#show").load(pagina); return false; })
});
</script>
<h2>
<div class="center">
Artists
</div><!-- center -->
</h2>

<div class="center">

<ul id="abcd">
<li><a href="#" style="width:auto;padding-left:5px;padding-right:5px;">0 - 9</a></li>

<li><a href="#">A</a></li>
<li><a href="#">B</a></li>
<li><a href="#">C</a></li>
<li><a href="#">D</a></li>
<li><a href="#">E</a></li>
<li><a href="#">F</a></li>
<li><a href="#">G</a></li>
<li><a href="#">H</a></li>
<li><a href="#">I</a></li>
<li><a href="#">J</a></li>

<li><a href="#">K</a></li>
<li><a href="#">J</a></li>
<li><a href="#">M</a></li>
<li><a href="#">N</a></li>
<li><a href="#">O</a></li>
<li><a href="#">P</a></li>
<li><a href="#">Q</a></li>
<li><a href="#">R</a></li>
<li><a href="#">S</a></li>
<li><a href="#">T</a></li>

<li><a href="#">U</a></li>
<li><a href="#">V</a></li>
<li><a href="#">W</a></li>
<li><a href="#">X</a></li>
<li><a href="#">Y</a></li>
<li><a href="#">Z</a></li>
</ul>
</div><!-- center -->

<div class="center">
<?php

   if (isset($_GET["genero"])){
	$genero = $_GET['genero'];
	$sql = mysql_query("SELECT * FROM perfil_informacoes_gerais WHERE generos LIKE '%".$genero."%' ORDER BY nome_artistico ASC");
  } else {
    $sql = mysql_query("SELECT * FROM perfil_informacoes_gerais ORDER BY nome_artistico ASC");
  }
  

$existe = mysql_num_rows($sql);
if($existe == 0){

	echo '<p id="nome" style="margin:40px 0px 0px 0px;width:100%;color:#EEE;">Não existe nenhum resultado para Artists!</p>';
	
}else{

while ($artists = mysql_fetch_object($sql)) { 


	$sqlC = "SELECT * FROM pre_imagem_perfil WHERE id_relacional = ".$artists->id_relacional;
	$queryC = mysql_query($sqlC);
	$foto_perfil = mysql_fetch_object($queryC);

$imagem_temp = "img/img-profiles/".$foto_perfil->foto;
$img = getimagesize($imagem_temp);

$img_width = trim($img[0]);
$img_height = trim($img[1]);
 
 if($img_width >= $img_height){
 echo'
 <div id="img-artistas">
  <a id="ln" href="perfil.php?djport='.$artists->id_relacional.'">
<div style="background:#FFF url(img/img-profiles/'.$foto_perfil->foto.') no-repeat center center;background-size:auto 100%;">
</div>
<h3>'.$artists->nome_artistico.'</h3>
</a>
</div>
';
 }elseif($img_width <= $img_height){
 echo'
<div id="img-artistas">
 <a id="ln" href="perfil.php?djport='.$artists->id_relacional.'">
<div style="background:#FFF url(img/img-profiles/'.$foto_perfil->foto.') no-repeat center center;background-size:100% auto;">
</div>
<h3>'.$artists->nome_artistico.'</h3>
</a>
</div>
';
}
}
}
?>
<hr style="margin:0px 0px 40px 0px;float:left;width:100%;height:0px;border:0px;" />
</div><!-- center -->