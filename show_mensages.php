<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?><?php

$para = $_GET['djport'];
$de = $_SESSION['id'];
$id_mensagem = $_GET['mensagem'];
$ja_leu = '0';

$sql = mysql_query("SELECT * FROM mensages WHERE de='$de'");
$mensagens = mysql_num_rows($sql);
if($mensagens == 0){
	
}else{
$sql = mysql_query("SELECT * FROM mensages WHERE de='$de' AND para='$para' OR para='$de' AND de='$para' ORDER BY data");
while ($display = mysql_fetch_object($sql)) {


echo '<div id="mensagem">';

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

echo '<h4 style="margin:40px 0px 0px 0px;width:770px;float:left;color:#555;">'.$display->nome_artistico.'
<p style="margin:5px 0px 0px 0px;float:right;width:auto;height:auto;color:#777;">'.$display->hora.' - '.$display->data.'</p>
</h4>

<p style="margin:0px 0px 0px 0px;float:right;width:840px;padding:10px;padding-top:0px;text-align:left;font-size:15px;color:#555;">
'.$display->mensagem.'
</p>

</div><!-- mensagem -->
	
	';
	}
	
	$sql = mysql_query("UPDATE mensages SET ja_leu='$ja_leu' WHERE de='$de' AND para='$para' OR para='$de' AND de='$para' LIKE id_mensagem = '$id_mensagem'");
}

?>