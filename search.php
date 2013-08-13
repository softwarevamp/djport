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


$(document).ready(function(){
$("a#player").click(function(){
pagina = $(this).attr('href');
$('#content-player').show(0).animate({height: "auto"}, 1000);
$("#content-player").load(pagina); return false; });
});


</script>
<?php
 if (isset($_POST["search"])) {
	$search = $_POST['search'];
$sql1 = mysql_query("SELECT * FROM perfil_informacoes_gerais WHERE nome_artistico LIKE '%".$search."%' ORDER BY nome_artistico ASC");
$sql2 = mysql_query("SELECT * FROM musicas WHERE nome_musica LIKE '%".$search."%' AND categoria='track' ORDER BY nome_musica ASC");
$sql3 = mysql_query("SELECT * FROM musicas WHERE nome_musica LIKE '%".$search."%' AND categoria='djset' ORDER BY nome_musica ASC");
  } else {
	  
  }
?>
<h2>
<div class="center">
Artists
</div><!-- center -->
</h2>


<div class="center">
<?php 
	 $existe = mysql_num_rows($sql1);
if($existe == 0){

	echo '<p id="nome" style="margin:30px 0px 0px 0px;width:100%;color:#EEE;">Não existe nenhum resultado de Artists para essa busca!</p>';
	
}else{
while ($artists = mysql_fetch_object($sql1)) { 
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




<hr style="margin:30px 0px 0px 50px;float:left;width:100%;height:0px;border:0px;" />




<div id="tracks">
<h2 style="margin:0px 0px 10px 0px;padding-left:10px;width:580px;">Tracks</h2>



<?php

	 $existe = mysql_num_rows($sql2);
if($existe == 0){

	echo '<p id="nome" style="margin:20px 0px 0px 0px;width:100%;color:#EEE;">Não existe nenhuma Track para essa busca!</p>';
	
}else{


while ($tracks = mysql_fetch_object($sql2)) { 
	$sqlC = "SELECT * FROM `perfil_informacoes_gerais` WHERE `id_relacional` = $tracks->id_relacional";
	$queryC = mysql_query($sqlC);
	$remixer = mysql_fetch_object($queryC);
	
	$tracks->tamanho = substr($tracks->tamanho,0,4);
	
 $tracks->genero = str_replace("_"," ",$tracks->genero);
 $tracks->genero = str_replace("5","/",$tracks->genero);
 $tracks->genero = str_replace("8","&",$tracks->genero);
	
echo '
<div id="go_player_profile">
<div id="img_music">
<a id="player" href="player.php?musica='.$tracks->id_musica.'">
<img id="play_bt" src="img/play_yellow.png" />
<img id="img_music_capa" style="margin:0px 0px 0px 0px;width:100px;height:100px;" src="sounds/capas/'.$tracks->capa_musica.'" />
</div>
<a id="download01" target="_blank" href="sounds/'.$tracks->url_musica.'" style="background:#fff000 url(img/download01.png) no-repeat center center;"></a>
<span id="estilo" title="'.$tracks->genero.'">'.$tracks->genero.'</span>
<p id="nome"><a target="_blank" href="music.php'.$tracks->id_musica.'">'.$tracks->nome_musica.'</a></p>
<p id="data">'.$tracks->data.'</p>
<p id="musica"><a href="#">'.$tracks->autor.'</a></p>
<p id="mixer"><a href="#">'.$remixer->nome_artistico.'</a></p>
<p id="tamanho">'.$tracks->tamanho.' MB</p>
</div><!-- go player profile -->
';
}
}
?>
</div><!-- tracks -->

<div id="djsets">
<h2 style="margin:0px 0px 10px 0px;padding-left:10px;width:580px;">Djsets</h2>


<?php
	 $existe = mysql_num_rows($sql3);
if($existe == 0){

	echo '<p id="nome" style="margin:20px 0px 0px 0px;width:100%;color:#EEE;">Não existe nenhum DjSet para essa busca!</p>';
	
}else{


while ($sets = mysql_fetch_object($sql3)) { 
	$sqlC = "SELECT * FROM `perfil_informacoes_gerais` WHERE `id_relacional` = $sets->id_relacional";
	$queryC = mysql_query($sqlC);
	$remixer = mysql_fetch_object($queryC);
	
	$sets->tamanho = substr($sets->tamanho,0,4);
	
 $sets->genero = str_replace("_"," ",$sets->genero);
 $sets->genero = str_replace("5","/",$sets->genero);
 $sets->genero = str_replace("8","&",$sets->genero);
	
echo '
<div id="go_player_profile">
<div id="img_music">
<a id="player" href="player.php?musica='.$tracks->id_musica.'">
<img id="play_bt" src="img/play_red.png" />
<img id="img_music_capa" style="margin:0px 0px 0px 0px;width:100px;height:100px;" src="sounds/capas/'.$sets->capa_musica.'" />
</div>
<a id="download01" target="_blank" href="sounds/'.$sets->url_musica.'" style="background:#f50044 url(img/download01.png) no-repeat center center;"></a>
<span id="estilo" title="'.$sets->genero.'">'.$sets->genero.'</span>
<p id="nome"><a target="_blank" href="music.php'.$sets->id_musica.'">'.$sets->nome_musica.'</a></p>
<p id="data">'.$sets->data.'</p>
<p id="musica"><a href="#">'.$sets->autor.'</a></p>
<p id="mixer"><a href="#">'.$remixer->nome_artistico.'</a></p>
<p id="tamanho">'.$sets->tamanho.' MB</p>
</div><!-- go player profile -->
';
}
}
?>

</div><!-- djsets -->


</div><!-- center -->