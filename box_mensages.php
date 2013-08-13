<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
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
Mensagens
</div><!-- center -->
</h2>

<div class="center">
<?php

$de = $_SESSION['id'];

$sql = mysql_query("SELECT * FROM mensages WHERE de='$de' LIKE ja_leu = '1'");
$mensagens = mysql_num_rows($sql);
if($mensagens == '0'){
	
	echo '<h2 style="margin:10px 0px 0px 0px;background:transparent;border:0px;">Você não tem nenhuma mensagem!</h2>';
	
}else{
	
$sql = mysql_query("SELECT * FROM mensages WHERE para='$de' ORDER BY data ASC");
while ($display = mysql_fetch_object($sql)) {


echo '<a id="ln" href="send_mensages.php?djport='.$display->de.'&mensagem='.$display->id_mensagem.'"><div id="box_mensagem">';

$imagem_temp = "img/img-profiles/".$display->foto;
$img = getimagesize($imagem_temp);
$img_width = trim($img[0]);
$img_height = trim($img[1]);

 if($img_width > $img_height){
 echo'
<div id="img-profile" style="background:#FFF url(img/img-profiles/'.$display->foto.') no-repeat center center;background-size:auto 100%;width:50px;height:50px;margin:10px;float:left;border:solid 3px #555;">
</div>
';
 }elseif($img_width < $img_height){
 echo'
<div id="img-profile" style="background:#FFF url(img/img-profiles/'.$display->foto.') no-repeat center center;background-size:auto 100%;width:50px;height:50px;margin:10px;float:left;border:solid 3px #555;">
</div>
';
 }

echo '<h4 style="margin:10px 0px 0px 5px;width:770px;float:left;color:#EEE;font-size:15px;">'.$display->nome_artistico.'</h4>

<p style="margin:0px 0px 0px 0px;float:right;width:1100px;padding:10px;text-align:left;font-size:15px;color:#555;background:#EEE;">
'.$display->mensagem.'
</p>

</div></a><!-- box mensagem -->
	
	';
	}
}


?>
</div><!-- center -->