<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<script language="javascript">
$(document).ready(function(){
$("a#ln, a#home_first").click(function(){
$("#homeAll").hide(0);
pagina = $(this).attr('href')
$("#loader").ajaxStart(function(){
$(this).show()})
$("#loader").ajaxStop(function(){$(this).hide();})
$("#show").load(pagina); return false; })

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

});

<?php
$numeroToDez = 0;

  if(isset($_GET["top"])) {
	  
	$top = $_GET['top']; 
	
	
	if($top == "track"){
		$categoria = "Tracks";
	}elseif($top == "djset"){
		$categoria = "DjSets";
	}
	
	
	$sql = mysql_query("SELECT * FROM musicas WHERE pontos >= 0 AND categoria = '$top' ORDER BY pontos DESC LIMIT 100");

  }else{
	  $categoria = "Tracks e DjSets";
	  
	  $sql = mysql_query("SELECT * FROM musicas WHERE pontos >= 0 ORDER BY pontos DESC LIMIT 100");

  }
?>

</script>
<h2>
<div class="center">
+ Top 100 - <?php echo $categoria; ?>
</div><!-- center -->
</h2>

<div class="center">
<ul id="topDez">


<?php
 
while ($topDez = mysql_fetch_object($sql)) { 

if($topDez->categoria == "track"){
	$arrow = "play_yellow.png";
}else{
	$arrow = "play_red.png";
}

$numeroToDez = ++$numeroToDez;
$sqlC = "SELECT * FROM `perfil_informacoes_gerais` WHERE `id_relacional` = ".$topDez->id_relacional;
$queryC = mysql_query($sqlC);
$remixer = mysql_fetch_object($queryC);
echo '
<li>
<a id="player" href="#">
<img id="play_bt" src="img/'.$arrow.'" style="margin:80px 0px 0px 90px;width:50px;height:50px;background:none;" />
<img src="'.$topDez->capa_musica.'">
<span>'.$numeroToDez.'</span>
<p>'.$remixer->nome_artistico.'</p>
<p>'.$topDez->nome_musica.'</p>
</a>
</li>
';
}
?>
</ul><!-- top Dez -->
</div><!-- center -->
