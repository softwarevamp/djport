<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>

<?php

if($_GET['djport']){
$session_id = $_GET['djport'];
}else{
	$session_id = $_SESSION['id'];
}

$sql = mysql_query("SELECT * FROM pre_imagem_perfil WHERE id_relacional='$session_id'");
$foto_perfil = mysql_fetch_object($sql);

$sql = mysql_query("SELECT * FROM perfil_informacoes_gerais WHERE id_relacional='$session_id'");
$dados_perfil = mysql_fetch_object($sql);

if($dados_perfil->categoria == '0'){
	$dados_perfil->categoria = "Nenhuma categoria foi selecionada.";
}else{
	$dados_perfil->categoria = $dados_perfil->categoria;
}

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

$(document).ready(function(){
	$('#mais_biografia').click(function(){
		$('#mais_biografia').hide(0);
		$('#menos_biografia').show(0);
		$('#biografia_perfil_visualizado').css({height: 'auto'}, 1000);
	});
	$('#menos_biografia').click(function(){
		$('#menos_biografia').hide(0);
		$('#mais_biografia').show(0);
		$('#biografia_perfil_visualizado').css({height: '95px'}, 1000);
	});
	
});

$(document).ready(function(){
$("a#player").hover(
  function () {
    $('#play_bt', this).show(0);
  },
  function () {
    $('#play_bt', this).hide(0);
  }
);
});
</script>
<h2>
<div class="center">
<?php
if($_GET['djport']){
echo 'Artists';	
}else{
	echo 'Meu perfil';
}
?>
</div><!-- center -->
</h2>

<div class="center">

<?php
 
$imagem_temp = "img/img-profiles/".$foto_perfil->foto;
$img = getimagesize($imagem_temp);

$img_width = trim($img[0]);
$img_height = trim($img[1]);
 
 if($img_width >= $img_height){
 echo'
<div id="img-profile" style="background:#FFF url(img/img-profiles/'.$foto_perfil->foto.') no-repeat center center;background-size:auto 100%;width:280px;height:280px;">
</div>
';
 }elseif($img_width <= $img_height){
 echo'
<div id="img-profile" style="background:#FFF url(img/img-profiles/'.$foto_perfil->foto.') no-repeat center center;background-size:100% auto;width:280px;height:280px;">
</div>
';
 }
?>



<!-- <img id="img-profile" src="img/img-profiles/<?php //echo $foto_perfil->foto; ?>" style="width:300px;height:300px;" /> -->
<h3><?php echo $dados_perfil->nome_artistico; ?>

<?php

if(!$_SESSION['id'] == ''){

if($_GET['djport'] && $_GET['djport'] !== $_SESSION['id']){
echo '<a id="ln" href="send_mensages.php?djport='.$dados_perfil->id_relacional.'">ENVIAR MENSAGEM</a>';	
}else{
}
}
?>



</h3>
<h4><?php echo $dados_perfil->pais; ?></h4>
<h4 style="margin:10px 0px 0px 0px;color:#aaa;"><?php echo $dados_perfil->categoria;?></h4>
<h4>
<span>
<?php
$sql = mysql_query("SELECT * FROM perfil_informacoes_gerais WHERE id_relacional='$session_id'");
while ($generos = mysql_fetch_object($sql)) { 

if($generos->generos == 'none'){
	$generos->generos = "Nenhum genero foi selecionado.";
}else{
	$generos->generos = $generos->generos;
}

$generos->generos = str_replace("_"," ",$generos->generos);
$generos->generos = str_replace("5","/",$generos->generos);
$generos->generos = str_replace("8","&",$generos->generos);


$generos->generos = str_replace(",","</span><span>",$generos->generos);
echo $generos->generos;
}
?>
</span>
</h4>
<h4 style="margin:18px 0px 0px 0px;">
<?php

$sql = mysql_query("SELECT * FROM perfil_informacoes_contato WHERE id_relacional='$session_id'");
$info_contato = mysql_fetch_object($sql);

if(!$info_contato->twitter == ""){
	echo '<a style="margin:0px 5px 0px 0px;" href="#" target="_blank"><img src="img/twitter.jpg" /></a>';
}
if(!$info_contato->facebook == ""){
	echo '<a style="margin:0px 5px 0px 0px;" href="'.$info_contato->facebook.'" target="_blank"><img src="img/face.jpg" /></a>';
}
if(!$info_contato->google == ""){
	echo '<a style="margin:0px 5px 0px 0px;" href="'.$info_contato->google.'" target="_blank"><img src="img/google.jpg" /></a>';
}
if(!$info_contato->youtube == ""){
	echo '<a style="margin:0px 5px 0px 0px;" href="'.$info_contato->youtube.'" target="_blank"><img src="img/youtube.jpg" /></a>';
}
if(!$info_contato->zippytune == ""){
	echo '<a style="margin:0px 5px 0px 0px;" href="'.$info_contato->zippytune.'" target="_blank"><img src="img/zippetune.jpg" /></a>';
}
if(!$info_contato->soundcloud == ""){
	echo '<a style="margin:0px 5px 0px 0px;" href="'.$info_contato->soundcloud.'" target="_blank"><img src="img/soundcloud.jpg" /></a>';
}
if(!$info_contato->mixcloud == ""){
	echo '<a style="margin:0px 5px 0px 0px;" href="'.$info_contato->mixcloud.'" target="_blank"><img src="img/mixcloud.jpg" /></a>';
}
?>

</h4>
<h4 style="margin:10px 0px 0px 0px;">Biografia:</h4>
<div id="biografia_perfil_visualizado">
<?php echo $dados_perfil->biografia ?>
</div>

<?php
if($dados_perfil->biografia == 'escreva algo sobre você...'){
	echo '
<a id="mais_biografia" href="#"></a>
<a id="menos_biografia" href="#"></a>
	';
}else{
	echo '
<a id="mais_biografia" href="#">Expandir</a>
<a id="menos_biografia" href="#">Recolher</a>
	';
	
}

?>
</div><!-- center -->

<hr style="margin:20px 0px 20px 0px;" />

<div class="center">

<div id="tracks">
<h2 style="margin:0px 0px 10px 0px;padding-left:10px;width:580px;">Tracks</h2>



<?php
$sql = mysql_query("SELECT * FROM musicas WHERE id_relacional='$session_id' AND categoria='track' ORDER BY data DESC");
while ($tracks = mysql_fetch_object($sql)) { 

	$sqlC = "SELECT * FROM `perfil_informacoes_gerais` WHERE `id_relacional` = ".$session_id;
	$queryC = mysql_query($sqlC);
	$remixer = mysql_fetch_object($queryC);
	
	$tracks->tamanho = substr($tracks->tamanho,0,4);
	
echo '
<div id="go_player_profile">
<div id="img_music">
<a id="player" href="#"><img id="play_bt" src="img/play_yellow.png" />
<img id="img_music_capa" style="margin:0px 0px 0px 0px;width:100px;height:100px;" src="sounds/capas/'.$tracks->capa_musica.'" />
</a>
</div>
<a id="download01" target="_blank" href="sounds/'.$tracks->url_musica.'" style="background:#fff000 url(img/download01.png) no-repeat center center;"></a>
<span id="estilo" title="Progressive Dance">'.$tracks->genero.'</span>
<p id="nome"><a target="_blank" href="'.$tracks->id_musica.'">'.$tracks->nome_musica.'</a></p>
<p id="data">'.$tracks->data.'</p>
<p id="musica"><a href="#">'.$tracks->autor.'</a></p>
<p id="mixer"><a href="#">'.$remixer->nome_artistico.'</a></p>
<p id="tamanho">'.$tracks->tamanho.' MB</p>
</div><!-- go player profile -->
';
}
?>
</div><!-- tracks -->

<div id="djsets">
<h2 style="margin:0px 0px 10px 0px;padding-left:10px;width:580px;">Djsets</h2>


<?php

$sql = mysql_query("SELECT * FROM musicas WHERE id_relacional='$session_id' AND categoria='djset' ORDER BY data DESC");
while ($sets = mysql_fetch_object($sql)) { 
	$sqlC = "SELECT * FROM `perfil_informacoes_gerais` WHERE `id_relacional` = ".$session_id;
	$queryC = mysql_query($sqlC);
	$remixer = mysql_fetch_object($queryC);
	
	$sets->tamanho = substr($sets->tamanho,0,4);
	
echo '
<div id="go_player_profile">
<div id="img_music">
<a id="player" href="#" style="margin:0px;display:block;width:100px;height:100px;"><img id="play_bt" src="img/play_red.png" />
<img id="img_music_capa" style="margin:0px 0px 0px 0px;width:100px;height:100px;" src="sounds/capas/'.$sets->capa_musica.'" />
</a>
</div>
<a id="download01" target="_blank" href="sounds/'.$sets->url_musica.'" style="background:#f50044 url(img/download01.png) no-repeat center center;"></a>
<span id="estilo" title="Progressive Dance">'.$sets->genero.'</span>
<p id="nome"><a target="_blank" href="'.$sets->id_musica.'">'.$sets->nome_musica.'</a></p>
<p id="data">'.$sets->data.'</p>
<p id="musica"><a href="#">'.$sets->autor.'</a></p>
<p id="mixer"><a href="#">'.$remixer->nome_artistico.'</a></p>
<p id="tamanho">'.$sets->tamanho.' MB</p>
</div><!-- go player profile -->
';
}
?>

</div><!-- djsets -->
</div><!-- center -->















