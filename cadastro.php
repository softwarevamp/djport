<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<script>
$(document).ready(function(){

	// cadastro com validação
	$('#form-cadastro').submit(function(event){
    	event.preventDefault();
		$('input#bt-cadastro').attr('value', 'AGUARDE...');
    	$.ajax({
        type: "post",
        dataType: "html",
        url: 'php/cadastro_usuario.php',
        data: $("#form-cadastro").serialize(),
        	success: function (response) {
			$("#resposta-cadastro").html(response).show();
			$('input#bt-cadastro').attr('value', 'CADASTRAR');
			}
		});
	});
	
});
</script>
<h2>
<div class="center">
Cadastro
</div><!-- center -->
</h2>
<div class="center">
<div id="left">
<form name="form-cadastro" id="form-cadastro">
<label>Nome:</label>
<input type="text" name="nome" autocomplete="off">

<label>Sobrenome:</label>
<input type="text" name="sobrenome" autocomplete="off">

<label>Nome Artístico:</label>
<input type="text" name="nomeartistico" autocomplete="off">


<label>E-mail:</label>
<input type="text" name="email" autocomplete="off">


<label>País:</label>
<select name="pais" id="pais">
<option disabled="disabled" selected="selected"></option>

<?php
$sql = mysql_query("SELECT * FROM paises ORDER BY nome ASC");
	// Exibe as informações de cadastro
while ($paises = mysql_fetch_object($sql)) {
	// Montando uma vareável com o resultado
	echo '<option>'.$paises->nome.'</option>';
}
?>

</select>

<label>Senha:</label>
<input type="password" name="senha" autocomplete="off"/>

<label>Repetir senha:</label>
<input type="password" name="re_senha" autocomplete="off">


<script>
$(document).ready(function() {
$("input[name='opcoes[]']").click(function() {
valor = []
$("input[name='opcoes[]']:checked").each(function() {
valor.push($(this).val());
});
$("#generos").val(valor);
});
});
</script>

<label style="margin:48px 0px 0px 0px;float:left;width:400px;height:auto;">
<input type="checkbox" name="opcoes[]" value="aceito"/>Eu li e aceito os <a id="termos" href="#" style="color:#EEE;">termos de uso.</a>
</label>
<input type="hidden" id="generos" name="generos" value="">

<input id="bt-cadastro" type="submit" value="CADASTRAR" style="margin:34px 0px 0px 0px;float:right;" />

</form>
<div id="resposta-cadastro" style="width:100%;"></div>
</div><!-- left -->
<div id="right" style="margin:40px 0px 0px 0px;line-height:20px;">
<b style="font-size:20px;">INFORMAÇÕES:</b>
<br />
<p style="font-size:14px;text-align:left;line-height:25px;font-family: 'Source Sans Pro', sans-serif;">
&bull;	Todo conteúdo postado no Djport é de responsabilidade de quem está postando.
<br />
<br />
&bull;	Nunca poste músicas que não sejam de sua autoria. 
<br />
<br />
&bull;	Músicas que tenham direitos autorais e que sejam denunciadas pelos detentores de seus direitos, serão retiradas do ar e os responsáveis pela postagem poderão sofrer as sanções legais.
<br />
<br />
&bull;	Os arquivos das tracks deverão estar no formato MP3 e ter qualidade 320kbps. 
<br />
<br />
&bull;	Os arquivos djset deverão estar no formato MP3 e ter qualidade entre 128kbps e 320kbps.
<br />
<br />
&bull;	O tamanho dos arquivos deve ser no máximo 200MB.
</p>

</div><!-- right -->
</div><!-- center -->








