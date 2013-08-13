<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php
$session_id = $_SESSION['id'];
$sql = mysql_query("SELECT * FROM perfil_informacoes_contato WHERE id_relacional='$session_id'");
$contato = mysql_fetch_object($sql);
?>
<script language="javascript">
$(document).ready(function(){
	
$('#edita-senha').submit(function(event){
    	event.preventDefault();
		$('input#bt-salvar-contato').attr('value', 'AGUARDE...');
    	$.ajax({
        type: "post",
        dataType: "html",
        url: 'php/editar_senha.php',
        data: $("#edita-senha").serialize(),
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
Editar Perfil - Senha
</div><!-- center -->
</h2>



<div class="center">
<div id="left">

<form id="edita-senha" name="edita-senha" action="php/editar_senha.php" method="post">
<input type="hidden" name="id_relacional" value="<?php echo $id_relacional; ?>" />

<label>Senha atual: <span style="color:#F66;font-size:15px;">(Obrigatório)</span></label>
<input type="password" name="senha_atual" autocomplete="off" style="background:#FFF;"/>

<label>Nova senha:</label>
<input type="password" name="novasenha" autocomplete="off"/>

<label>Repetir nova senha:</label>
<input type="password" name="re_novasenha" autocomplete="off">


<input id="bt-salvar-contato" type="submit" value="SALVAR" />
<div id="resposta-atualizar-perfil"></div>
</form>
</div><!-- left -->

<div id="right" style="margin:40px 0px 0px 0px;line-height:20px;">
<ul id="menu-info">
<li><a id="ln" href="editar_perfil_geral.php?djport=<?php echo $id_relacional; ?>">INFORMAÇÕES GERAIS</a></li>
<li><a id="ln" href="editar_info_contato.php?djport=<?php echo $id_relacional; ?>">INFORMAÇÕES DE CONTATO</a></li>
<li><a id="ln"style="background:#999;"  href="editar_senha.php?djport=<?php echo $id_relacional; ?>">ALTERAR SENHA</a></li>
</ul>
</div><!-- right -->
</div><!-- center -->


