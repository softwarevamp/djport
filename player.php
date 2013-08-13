<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php

$id_musica = $_GET['musica'];

$sql = mysql_query("SELECT * FROM musicas WHERE id_musica='$id_musica'");
$player = mysql_fetch_object($sql);
?>

<div class="center">


<?php

$imagem_temp = "sounds/capas/".$player->capa_musica;
$img = getimagesize($imagem_temp);

$img_width = trim($img[0]);
$img_height = trim($img[1]);
 
 if($img_width >= $img_height){
 echo'
<a href="sounds.php?djport='.$player->id_musica.'" id="img_capas" style="background:#FFF url(sounds/capas/'.$player->capa_musica.') no-repeat center center;background-size:auto 100%;"></a>
';
 }elseif($img_width <= $img_height){
 echo'
<a href="perfil.php?djport='.$player->id_musica.'" id="img_capas" style="background:#FFF url(sounds/capas/'.$player->capa_musica.') no-repeat center center;background-size:100% auto;">
</a>
';
 }
?>

<video id="audio_player" src="sounds/<?php echo $player->url_musica; ?>" autoplay autobuffer controls>
</video>

<h3 id="dados_left"><?php echo $player->nome_musica; ?></h3>


</div><!-- center -->