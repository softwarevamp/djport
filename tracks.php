<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<script language="javascript">
$(document).ready(function(){
$("a#ln").click(function(){
pagina = $(this).attr('href')
$("#loader").ajaxStart(function(){
$(this).show()})
$("#loader").ajaxStop(function(){$(this).hide();})
$("#show").load(pagina); return false;})


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


});
</script>

<?php

  if(isset($_GET["genero"])) {
	  
	$genero = $_GET['genero']; 
	
	$sql = mysql_query("SELECT * FROM musicas WHERE pontos >= 0 AND categoria = 'track' AND genero = '$genero' ORDER BY pontos DESC LIMIT 10"); 
	 
 $genero = str_replace("_"," ", $genero);
 $genero = str_replace("5","/", $genero);
 $genero = str_replace("8","&", $genero);
	   
	  $resultado = "Resultado de todas as Tracks no gênero ".$genero."!";
	   $resultadoTop10 = "Resultado do Top 10 com Tracks no gênero ".$genero."!";
  }else{
  $sql = mysql_query("SELECT * FROM musicas WHERE pontos >= 0 AND categoria = 'track' ORDER BY pontos DESC LIMIT 10");
	  $resultado = "Tracks";
	  $resultadoTop10 = "Top 10 Tracks";
  }
 
 
 ?>

<h2>
<div class="center">
<?php echo $resultadoTop10; ?>


<a id="ln" href="top100.php?top=track" style="margin:4px 0px 0px 0px;float:right;color:#EEE;">
+ Top 100
</a>


</div><!-- center -->
</h2>


<div class="center">
<ul id="topDez">
<?php

$existe = mysql_num_rows($sql);
if($existe == 0){
	
	echo '<p id="nome" style="margin:10px 0px -25px 0px;width:100%;color:#EEE;">Não existe nenhum resultado para a categoria Track!</p>';
	
}else{


$numeroToDez = 0;
while ($topDez = mysql_fetch_object($sql)) { 
$numeroToDez = ++$numeroToDez;
$sqlC = "SELECT * FROM `perfil_informacoes_gerais` WHERE `id_relacional` = ".$topDez->id_relacional;
$queryC = mysql_query($sqlC);
$remixer = mysql_fetch_object($queryC);
echo '
<li>
<a id="player" href="player.php?musica='.$topDez->id_musica.'">
<img id="play_bt" src="img/play_yellow_big.png" style="margin:80px 0px 0px 90px;width:50px;height:50px;background:none;" />
<img src="sounds/capas/'.$topDez->capa_musica.'">
<span>'.$numeroToDez.'</span>
<p>'.$remixer->nome_artistico.'</p>
<p>'.$topDez->nome_musica.'</p>
</a>
</li>
';
}
}
?>
</ul><!-- top Dez -->
</div><!-- center -->


<hr style="margin:20px 0px 20px 0px;" />
<h2>
<div class="center">
<?php echo $resultado; ?></div><!-- center -->
</h2>


<hr style="margin:0px 0px 10px 0px;" />


<div class="center">
<div id="trackAll">
<?php

  if(isset($_GET["genero"])) {
	$genero = $_GET['genero'];
    $sql = mysql_query("SELECT * FROM musicas WHERE categoria='track' AND genero='$genero'");
  }else{
    $sql = mysql_query("SELECT * FROM musicas WHERE categoria='track' ORDER BY data DESC");
  }
  
 
$existe = mysql_num_rows($sql);
if($existe == 0){
	
	echo '<p id="nome" style="width:100%;color:#EEE;">Não existe nenhum resultado para a categoria Track!</p>';
	
}else{
	
while ($tracks = mysql_fetch_object($sql)) { 
	$sqlC = "SELECT * FROM `perfil_informacoes_gerais` WHERE `id_relacional` = ".$tracks->id_relacional;
	$queryC = mysql_query($sqlC);
	$remixer = mysql_fetch_object($queryC);
	
		$tracks->tamanho = substr($tracks->tamanho,0,4);
	
	$tracks->genero = str_replace("_"," ",$tracks->genero);
	$tracks->genero = str_replace("5","/",$tracks->genero);
	$tracks->genero = str_replace("8","&",$tracks->genero);
	
echo '
<div id="go_player_profileAll">
<div id="img_music">
<a id="player" href="player.php?musica='.$tracks->id_musica.'">
<img id="play_bt" src="img/play_yellow.png" />
<img id="img_music_capa" style="margin:0px 0px 0px 0px;width:100px;height:100px;" src="sounds/capas/'.$tracks->capa_musica.'" />
</a>
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
</div><!-- center -->