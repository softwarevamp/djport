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

	$('#send').submit(function(event){
    	event.preventDefault();
    	$.ajax({
        type: "post",
        dataType: "html",
        url: 'php/mensage.php',
        data: $("#send").serialize(),
        	success: function (response) {
			$("#mensagens").html(response).show();
			$('input#bt-enviar-mensage').attr('value', 'ENVIAR');
			}
		});
	});


$('#mensagens').stop().animate({ scrollTop: $("#mensagens")[0].scrollHeight }, 0);


});

setInterval(carrega, 500);
function carrega()
{
//$('#mensagens').load("show_mensages.php?djport=<?php echo $session_id; ?>");
}

</script>
<h2>
<div class="center">
Mensagens
</div><!-- center -->
</h2>

<div class="center">

<?php
$imagem_temp = "img/img-profiles/".$foto_perfil->foto;
$img = getimagesize($imagem_temp);
$img_width = trim($img[0]);
$img_height = trim($img[1]);
 if($img_width > $img_height){
 echo'
<div id="img-profile" style="background:#FFF url(img/img-profiles/'.$foto_perfil->foto.') no-repeat center center;background-size:auto 100%;width:280px;height:280px;">
</div>
';
 }elseif($img_width < $img_height){
 echo'
<div id="img-profile" style="background:#FFF url(img/img-profiles/'.$foto_perfil->foto.') no-repeat center center;background-size:100% auto;width:280px;height:280px;">
</div>
';
 }
?>

<h3><?php echo $dados_perfil->nome_artistico; ?></h3>
<h4><?php echo $dados_perfil->pais; ?></h4>

<div id="mensagens">
<?php include 'show_mensages.php'; ?>
</div><!-- mensagens -->

<form id="send" name="send" action="php/manda_mensages.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="djport" autocomplete="off" value="<?php echo $para; ?>">
<input id="send_mensage" type="text" name="send_mensage" autocomplete="off" value="">
<input id="bt-enviar-mensage" type="submit" value="ENVIAR" />
</form>

</div><!-- center -->































































