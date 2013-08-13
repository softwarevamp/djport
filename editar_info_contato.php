<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php
$session_id = $_SESSION['id'];
$sql = mysql_query("SELECT * FROM perfil_informacoes_contato WHERE id_relacional='$session_id'");
$contato = mysql_fetch_object($sql);
?>
<script language="javascript">
$(document).ready(function(){
	
$('#edita-info').submit(function(event){
    	event.preventDefault();
		$('input#bt-salvar-contato').attr('value', 'AGUARDE...');
    	$.ajax({
        type: "post",
        dataType: "html",
        url: 'php/editar_info_contato.php',
        data: $("#edita-info").serialize(),
        	success: function (response) {
			$("#resposta-atualizar-perfil").html(response).show();
			$('input#bt-salvar-contato').attr('value', 'SALVAR');
			}
		});
	});

$("a#ln").click(function(){
pagina = $(this).attr('href')
$("#loader").ajaxStart(function(){
$(this).show()})
$("#loader").ajaxStop(function(){$(this).hide();})
$("#show").load(pagina); return false; })

});

function statusRespostaAtulizaPerfil(){setTimeout('statusHideAtulizaPerfil()', 2000);}
function statusHideAtulizaPerfil(){$('#erro-atualizar-perfil').fadeOut(500);$('#certo-atualizar-perfil').fadeOut(500);}
</script>
<h2>
<div class="center">
Editar Perfil - Informações de contato
</div><!-- center -->
</h2>



<div class="center">
<div id="left" style="width:666px;">

<form id="edita-info" name="edita-info" action="php/editar_info_contato.php" method="post">
<input type="hidden" name="id_relacional" value="<?php echo $id_relacional; ?>" />

<label>Twitter:</label>
<input type="text" name="twitter" autocomplete="off" value="<?php echo $contato->twitter; ?>" /> <img id="img-contato" src="img/twitter.jpg" />

<label>Facebook:</label>
<input type="text" name="facebook" autocomplete="off" value="<?php echo $contato->facebook; ?>" /> <img id="img-contato" src="img/face.jpg" />

<label>Google+:</label>
<input type="text" name="google" autocomplete="off" value="<?php echo $contato->google; ?>" /> <img id="img-contato" src="img/google.jpg" />

<label>Youtube:</label>
<input type="text" name="youtube" autocomplete="off" value="<?php echo $contato->youtube; ?>" /> <img id="img-contato" src="img/youtube.jpg" />

<label>ZippyTune:</label>
<input type="text" name="zippytune" autocomplete="off" value="<?php echo $contato->zippytune; ?>" /> <img id="img-contato" src="img/zippetune.jpg" />

<label>SoundCloud:</label>
<input type="text" name="soundcloud" autocomplete="off" value="<?php echo $contato->soundcloud; ?>" /> <img id="img-contato" src="img/soundcloud.jpg" />

<label>MixCloud:</label>
<input type="text" name="mixcloud" autocomplete="off" value="<?php echo $contato->mixcloud; ?>" /> <img id="img-contato" src="img/mixcloud.jpg" />

<input id="bt-salvar-contato" type="submit" value="SALVAR" />
<div id="resposta-atualizar-perfil"></div>
</form>
</div><!-- left -->

<div id="right" style="margin:40px 0px 0px 0px;line-height:20px;">
<ul id="menu-info">
<li><a id="ln" href="editar_perfil_geral.php?djport=<?php echo $id_relacional; ?>">INFORMAÇÕES GERAIS</a></li>
<li><a id="ln" style="background:#999;" href="editar_info_contato.php?djport=<?php echo $id_relacional; ?>">INFORMAÇÕES DE CONTATO</a></li>
<li><a id="ln" href="editar_senha.php?djport=<?php echo $id_relacional; ?>">ALTERAR SENHA</a></li>
</ul>
</div><!-- right -->
</div><!-- center -->





























































