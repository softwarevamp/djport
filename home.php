<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<script language="javascript">

$(document).ready(function(){
$("a#player").click(function(){
paginaPlayer = null;
paginaPlayer = $(this).attr('href');
$('#content-player').show(0).animate({height: "auto"}, 1000);
$("#content-player").load(paginaPlayer); return false; });
});

$(document).ready(function(){
$("a#ln, a#home_first").click(function(){
$("#homeAll").hide(0);
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


</script>
<h2>
<div class="center">
Top <b style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;font-size:22px;">10
<img style="margin:5px 0px 0px 0px;" src="img/moni_logo.png" />
</b>

<a id="ln" href="top100.php" style="margin:4px 0px 0px 0px;float:right;color:#EEE;">
+ Top 100
</a>


</div><!-- center -->
</h2>

<div class="center">
<ul id="topDez">
<?php
$numeroToDez = 0;
$sql = mysql_query("SELECT * FROM musicas WHERE pontos >= 0 ORDER BY pontos DESC LIMIT 10");
while ($topDez = mysql_fetch_object($sql)) { 

if($topDez->categoria == "track"){
	$arrow = "play_yellow_big.png";
}else{
	$arrow = "play_red_big.png";
}


$numeroToDez = ++$numeroToDez;
$sqlC = "SELECT * FROM `perfil_informacoes_gerais` WHERE `id_relacional` = ".$topDez->id_relacional;
$queryC = mysql_query($sqlC);
$remixer = mysql_fetch_object($queryC);

echo '<li>';
$imagem_temp = "sounds/capas/".$home->capa_musica;
$img = getimagesize($imagem_temp);

$img_width = trim($img[0]);
$img_height = trim($img[1]);
if($img_width >= $img_height){
echo'
<a id="player" href="player.php?musica='.$topDez->id_musica.'" style="background:#FFF url(sounds/capas/'.$topDez->capa_musica.') no-repeat center center;background-size:auto 100%;">
<img id="play_bt" src="img/'.$arrow.'" style="margin:80px 0px 0px 90px;width:50px;height:50px;background:none;" />
<span>'.$numeroToDez.'</span>
<p>'.$remixer->nome_artistico.'</p>
<p>'.$topDez->nome_musica.'</p>
</a>
';
}elseif($img_width <= $img_height){
 echo'
<a id="player" href="player.php?musica='.$topDez->id_musica.'" style="background:#FFF url(sounds/capas/'.$home->capa_musica.') no-repeat center center;background-size:100% auto;">
<img id="play_bt" src="img/'.$arrow.'" style="margin:80px 0px 0px 90px;width:50px;height:50px;background:none;" />
<span>'.$numeroToDez.'</span>
<p>'.$remixer->nome_artistico.'</p>
<p>'.$topDez->nome_musica.'</p>
</a>
';
echo'</li>';
}

}
?>
</ul><!-- top Dez -->
</div><!-- center -->


<h2 style="margin:8px 0px 0px 0px;">
<div class="center">
New Tracks
</b>
</div><!-- center -->
</h2>


<div class="center">
<!-- Slideshow HTML -->
<div id="slideshowTrack">
<div id="slidesContainerTrack">
<ul id="topDez">
<?php
$i = 1; 
$sql = mysql_query("SELECT * FROM musicas WHERE categoria='track' ORDER BY data DESC LIMIT 30");
while ($home = mysql_fetch_object($sql)) { 

$sqlC = "SELECT * FROM `perfil_informacoes_gerais` WHERE `id_relacional` = ".$home->id_relacional;
$queryC = mysql_query($sqlC);
$remixer = mysql_fetch_object($queryC);

if($i == 1){
echo '<div class="slideTrack">';
}
echo '<li>';
$imagem_temp = "sounds/capas/".$home->capa_musica;
$img = getimagesize($imagem_temp);

$img_width = trim($img[0]);
$img_height = trim($img[1]);
if($img_width >= $img_height){
echo'
<a href="player.php?musica='.$home->id_musica.'" id="player" style="background:#FFF url(sounds/capas/'.$home->capa_musica.') no-repeat center center;background-size:auto 100%;">
<img id="play_bt" src="img/play_yellow_big.png" style="margin:80px 0px 0px 90px;width:50px;height:50px;background:none;" />
<p style="margin:64px 0px 0px 0px;">'.$remixer->nome_artistico.'</p>
<p>'.$home->nome_musica.'</p>
</a>
';
}elseif($img_width <= $img_height){
 echo'
<a href="player.php?musica='.$home->id_musica.'" id="player" style="background:#FFF url(sounds/capas/'.$home->capa_musica.') no-repeat center center;background-size:100% auto;">
<img id="play_bt" src="img/play_yellow_big.png" style="margin:80px 0px 0px 90px;width:50px;height:50px;background:none;" />
<p style="margin:64px 0px 0px 0px;">'.$remixer->nome_artistico.'</p>
<p>'.$home->nome_musica.'</p>
</a>
';
}
echo'
</li>
';
if($i == 10){
echo '</div></div><!-- FECHANDO -->';
$i = 1;
}else{
$i++;
}
}
?>   

</ul>  
</div><!-- slidesContainer -->
</div><!-- slide show -->
<!-- Slideshow HTML -->
</div><!-- center -->


<h2 style="margin:8px 0px 0px 0px;">
<div class="center">
New DjSets
</b>
</div><!-- center -->
</h2>

<div class="center">
<!-- Slideshow HTML -->
<div id="slideshowDjset">
<div id="slidesContainerDjset">
<ul id="topDez">
<?php
$i = 1;  
$sql = mysql_query("SELECT * FROM musicas WHERE categoria='djset' ORDER BY data DESC LIMIT 30");
while ($home = mysql_fetch_object($sql)) { 
if($i == 1){
echo '<div class="slideDjset">';
}

echo '<li>';
$imagem_temp = "sounds/capas/".$home->capa_musica;
$img = getimagesize($imagem_temp);

$img_width = trim($img[0]);
$img_height = trim($img[1]);
if($img_width >= $img_height){
echo'
<a href="player.php?musica='.$home->id_musica.'" id="player" style="background:#FFF url(sounds/capas/'.$home->capa_musica.') no-repeat center center;background-size:auto 100%;">
<img id="play_bt" src="img/play_red_big.png" style="margin:80px 0px 0px 90px;width:50px;height:50px;background:none;" />
<p style="margin:64px 0px 0px 0px;">'.$remixer->nome_artistico.'</p>
<p>'.$home->nome_musica.'</p>
</a>
';
}elseif($img_width <= $img_height){
 echo'
<a href="player.php?musica='.$home->id_musica.'" id="player" style="background:#FFF url(sounds/capas/'.$home->capa_musica.') no-repeat center center;background-size:100% auto;">
<img id="play_bt" src="img/play_red_big.png" style="margin:80px 0px 0px 90px;width:50px;height:50px;background:none;" />
<p style="margin:64px 0px 0px 0px;">'.$remixer->nome_artistico.'</p>
<p>'.$home->nome_musica.'</p>
</a>
';
}
echo'
</li>
';
if($i == 10){
echo '</div></div><!-- FECHANDO -->';
$i = 1;
}else{
$i++;
}
}
?>  
</ul>   
</div><!-- slidesContainer -->
</div><!-- slide show -->
<!-- Slideshow HTML -->
</div><!-- center -->




<h2 style="margin:10px 0px 0px 0px;">
<div class="center">
New Profiles
</b>
</div><!-- center -->
</h2>

<div class="center" style="font-family: 'Ropa Sans', sans-serif;">
<?php
$sql = mysql_query("SELECT * FROM perfil_informacoes_gerais ORDER BY id_relacional DESC LIMIT 0, 1");
while ($home = mysql_fetch_object($sql)) { 

$sqlC = "SELECT * FROM `pre_imagem_perfil` WHERE `id_relacional` = ".$home->id_relacional;
$queryC = mysql_query($sqlC);
$foto = mysql_fetch_object($queryC);

$imagem_temp = "img/img-profiles/".$foto->foto;
$img = getimagesize($imagem_temp);

$img_width = trim($img[0]);
$img_height = trim($img[1]);
 
 if($img_width >= $img_height){
 echo'
<a href="perfil.php?djport='.$home->id_relacional.'" id="home_first" style="background:#FFF url(img/img-profiles/'.$foto->foto.') no-repeat center center;background-size:auto 100%;">
<p style="margin:445px 0px 0px 0px;background:#000;font-size:18px;text-align:left;float:left;padding:5px;width:460px;color:#FFF;">'.$home->nome_artistico.'</p>
</a>
';
 }elseif($img_width <= $img_height){
 echo'
<a href="perfil.php?djport='.$home->id_relacional.'" id="home_first" style="background:#FFF url(img/img-profiles/'.$foto->foto.') no-repeat center center;background-size:100% auto;">
<p style="margin:445px 0px 0px 0px;background:#000;font-size:18px;text-align:left;float:left;padding:5px;width:460px;color:#FFF;">'.$home->nome_artistico.'</p>
</a>
';
 }
}
?>

<!-- Slideshow HTML -->
<div id="slideshowProfile">
<div id="slidesContainerProfile">
<?php
$i = 1;  
$sql = mysql_query("SELECT * FROM perfil_informacoes_gerais ORDER BY id_relacional DESC LIMIT 1, 6");
while ($home = mysql_fetch_object($sql)) { 
$sqlC = "SELECT * FROM `pre_imagem_perfil` WHERE `id_relacional` = ".$home->id_relacional;
$queryC = mysql_query($sqlC);
$foto = mysql_fetch_object($queryC);
$imagem_temp = "img/img-profiles/".$foto->foto;
$img = getimagesize($imagem_temp);
$img_width = trim($img[0]);
$img_height = trim($img[1]);
if($i == 1){
echo '<div class="slideProfile">';
}
if($img_width >= $img_height){
echo'
<a id="ln" href="perfil.php?djport='.$home->id_relacional.'" style="background:url(img/img-profiles/'.$foto->foto.') no-repeat center center;background-size:auto 100%;">
<p style="margin:204px 0px 0px 0px;background:#000;font-size:18px;text-align:left;float:left;padding:5px;width:220px;color:#FFF;">'.$home->nome_artistico.'</p>
</a>
';
 }elseif($img_width <= $img_height){
 echo'
<a id="ln" href="perfil.php?djport='.$home->id_relacional.'" style="background:url(img/img-profiles/'.$foto->foto.') no-repeat center center;background-size:100% auto;">
<p style="margin:204px 0px 0px 0px;background:#000;font-size:18px;text-align:left;float:left;padding:5px;width:220px;color:#FFF;">'.$home->nome_artistico.'</p>
</a>
';
}
if($i == 6){
echo '</div></div><!-- FECHANDO -->';
$i = 1;
}else{
$i++;
}
}

?>     
</div><!-- slidesContainer -->
</div><!-- slide show -->
<!-- Slideshow HTML -->

</div><!-- center -->
</div>


<script language="javascript">

$(document).ready(function(){
  var currentPosition = 0;
  var slideWidth = 1200;
  var slides = $('.slideTrack');
  var numberOfSlides = slides.length;
  // Remove scrollbar in JS
  $('#slidesContainerTrack').css('overflow', 'hidden');
  // Wrap all .slides with #slideInner div
  slides
    .wrapAll('<div id="slideInnerTrack"></div>')
    // Float left to display horizontally, readjust .slides width
	.css({
      'float' : 'left',
      'width' : slideWidth
    });
  // Set #slideInner width equal to total width of all slides
  $('#slideInnerTrack').css('width', slideWidth * numberOfSlides);
  // Insert controls in the DOM
  $('#slideshowTrack')
    .prepend('<span class="controlTrack" id="leftControlTrack">Anterior</span>')
    .append('<span class="controlTrack" id="rightControlTrack">Próximo</span>');
  // Hide left arrow control on first load
  manageControls(currentPosition);
  // Create event listeners for .controls clicks
  $('.controlTrack')
    .bind('click', function(){
    // Determine new position
	currentPosition = ($(this).attr('id')=='rightControlTrack') ? currentPosition+1 : currentPosition-1;
	// Hide / show controls
    manageControls(currentPosition);
    // Move slideInner using margin-left
    $('#slideInnerTrack').animate({
      'marginLeft' : slideWidth*(-currentPosition)
    });
  });
  // manageControls: Hides and Shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ $('#leftControlTrack').hide() } else{ $('#leftControlTrack').show() }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $('#rightControlTrack').hide() } else{ $('#rightControlTrack').show() }
  }	
});

$(document).ready(function(){
  var currentPosition = 0;
  var slideWidth = 1200;
  var slides = $('.slideDjset');
  var numberOfSlides = slides.length;
  // Remove scrollbar in JS
  $('#slidesContainerDjset').css('overflow', 'hidden');
  // Wrap all .slides with #slideInner div
  slides
    .wrapAll('<div id="slideInnerDjset"></div>')
    // Float left to display horizontally, readjust .slides width
	.css({
      'float' : 'left',
      'width' : slideWidth
    });
  // Set #slideInner width equal to total width of all slides
  $('#slideInnerDjset').css('width', slideWidth * numberOfSlides);
  // Insert controls in the DOM
  $('#slideshowDjset')
    .prepend('<span class="controlDjset" id="leftControlDjset">Anterior</span>')
    .append('<span class="controlDjset" id="rightControlDjset">Próximo</span>');
  // Hide left arrow control on first load
  manageControls(currentPosition);
  // Create event listeners for .controls clicks
  $('.controlDjset')
    .bind('click', function(){
    // Determine new position
	currentPosition = ($(this).attr('id')=='rightControlDjset') ? currentPosition+1 : currentPosition-1;
	// Hide / show controls
    manageControls(currentPosition);
    // Move slideInner using margin-left
    $('#slideInnerDjset').animate({
      'marginLeft' : slideWidth*(-currentPosition)
    });
  });
  // manageControls: Hides and Shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ $('#leftControlDjset').hide() } else{ $('#leftControlDjset').show() }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $('#rightControlDjset').hide() } else{ $('#rightControlDjset').show() }
  }	
});


$(document).ready(function(){
  var currentPosition = 0;
  var slideWidth = 714;
  var slides = $('.slideProfile');
  var numberOfSlides = slides.length;
  // Remove scrollbar in JS
  $('#slidesContainerProfile').css('overflow', 'hidden');
  // Wrap all .slides with #slideInner div
  slides
    .wrapAll('<div id="slideInnerProfile"></div>')
    // Float left to display horizontally, readjust .slides width
	.css({
      'float' : 'left',
      'width' : slideWidth
    });
  // Set #slideInner width equal to total width of all slides
  $('#slideInnerProfile').css('width', slideWidth * numberOfSlides);
  // Insert controls in the DOM
  $('#slideshowProfile')
    .prepend('<span class="controlProfile" id="leftControlProfile">Anterior</span>')
    .append('<span class="controlProfile" id="rightControlProfile">Próximo</span>');
  // Hide left arrow control on first load
  manageControls(currentPosition);
  // Create event listeners for .controls clicks
  $('.controlProfile')
    .bind('click', function(){
    // Determine new position
	currentPosition = ($(this).attr('id')=='rightControlProfile') ? currentPosition+1 : currentPosition-1;
	// Hide / show controls
    manageControls(currentPosition);
    // Move slideInner using margin-left
    $('#slideInnerProfile').animate({
      'marginLeft' : slideWidth*(-currentPosition)
    });
  });
  // manageControls: Hides and Shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ $('#leftControlProfile').hide() } else{ $('#leftControlProfile').show() }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $('#rightControlProfile').hide() } else{ $('#rightControlProfile').show() }
  }	
  
  
});



$(document).ready(function(){
  var currentPosition = 0;
  var slideWidth = 851;
  var slides = $('.slideGigs');
  var numberOfSlides = slides.length;
  // Remove scrollbar in JS
  $('#slidesContainerGigs').css('overflow', 'hidden');
  // Wrap all .slides with #slideInner div
  slides
    .wrapAll('<div id="slideInnerGigs"></div>')
    // Float left to display horizontally, readjust .slides width
	.css({
      'float' : 'left',
      'width' : slideWidth
    });
  // Set #slideInner width equal to total width of all slides
  $('#slideInnerGigs').css('width', slideWidth * numberOfSlides);
  // Insert controls in the DOM
  $('#slideshowGigs')
    .prepend('<span class="controlGigs" id="leftControlGigs">Anterior</span>')
    .append('<span class="controlGigs" id="rightControlGigs">Próximo</span>');
  // Hide left arrow control on first load
  manageControls(currentPosition);
  // Create event listeners for .controls clicks
  $('.controlGigs')
    .bind('click', function(){
    // Determine new position
	currentPosition = ($(this).attr('id')=='rightControlGigs') ? currentPosition+1 : currentPosition-1;
	// Hide / show controls
    manageControls(currentPosition);
    // Move slideInner using margin-left
    $('#slideInnerGigs').animate({
      'marginLeft' : slideWidth*(-currentPosition)
    });
  });
  // manageControls: Hides and Shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ $('#leftControlGigs').hide() } else{ $('#leftControlGigs').show() }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $('#rightControlGigs').hide() } else{ $('#rightControlGigs').show() }
  }	
  
  
});



</script>
