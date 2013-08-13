<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php
$session_id = $_SESSION['id'];
$sql = mysql_query("SELECT * FROM perfil_informacoes_gerais WHERE id_relacional='$session_id'");
$perfil = mysql_fetch_object($sql);
?>
<script type="text/javascript" src="uploadify/jquery.uploadify-3.1.min.js"></script>
<script language="javascript">
$(document).ready(function(){

	$('#edita-perfil').submit(function(event){
    	event.preventDefault();
		$('input#bt-salvar-profile').attr('value', 'AGUARDE...');
    	$.ajax({
        type: "post",
        dataType: "html",
        url: 'php/editar_perfil_geral.php',
        data: $("#edita-perfil").serialize(),
        	success: function (response) {
			$("#resposta-atualizar-perfil").html(response).show();
			$('input#bt-salvar-profile').attr('value', 'SALVAR');
			}
		});
	});
	
	$(document).ready(function(){
$("a#ln").click(function(){
pagina = $(this).attr('href')
$("#loader").ajaxStart(function(){
$(this).show()})
$("#loader").ajaxStop(function(){$(this).hide();})
$("#show").load(pagina); return false; })
});
	
/*
$('#menu-categoria li a').click(function(){
	$('#menu-categoria li a').css({ backgroundPosition: "0px -35px"}, 0)
	$(this).css({ backgroundPosition: "0px 0px"}, 0);
	var categoria = $(this).attr('href');
	document.getElementById("categoria").value = categoria;
	return false;
});
$("#menu-generos li a").toggle(function() { 
    $(this).css({ backgroundPosition: "0px 0px"}, 0);
	var generos = $(this).attr('href');
	
	document.getElementById(generos).checked = true;

    }, function() { 
    $(this).css({ backgroundPosition: "0px -35px"}, 0);
    document.getElementById(generos).checked = false;
});
*/

});


function statusRespostaAtulizaPerfil(){setTimeout('statusHideAtulizaPerfil()', 2000);}
function statusHideAtulizaPerfil(){$('#erro-atualizar-perfil').fadeOut(500);$('#certo-atualizar-perfil').fadeOut(500);}

</script>
<h2>
<div class="center">
Editar Perfil - Informações gerais
</div><!-- center -->
</h2>
<div class="center">
<form id="edita-perfil" name="edita-perfil" action="php/editar_perfil_geral.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_relacional" value="<?php echo $id_relacional; ?>">
<div id="showFoto">
<?php include 'editar_perfil_foto.php'; ?>
</div><!-- show-foto -->
<label style="margin:40px 0px 0px 0px;float:right;width:950px;height:auto;color:#EEE;">Biografia</label>
<textarea id="biografia" name="biografia" autocomplete="off"><?php echo $perfil->biografia; ?></textarea>
<div id="left">
<label>Nome:</label>
<input type="text" name="nome" autocomplete="off" value="<?php echo $perfil->nome; ?>">
<label>Sobrenome:</label>
<input type="text" name="sobrenome" autocomplete="off" value="<?php echo $perfil->sobrenome; ?>">
<label>Nome Artístico:</label>
<input type="text" name="nomeartistico" autocomplete="off" value="<?php echo $perfil->nome_artistico; ?>">
<label>País:</label>
<select name="pais" id="pais">
<option selected='selected' disabled="disabled"><?php echo $perfil->pais; ?></option>
<?php
$sql = mysql_query("SELECT * FROM paises ORDER BY nome ASC");
	// Exibe as informações de cadastro
while ($paises = mysql_fetch_object($sql)) {
	// Montando uma vareável com o resultado
	echo '<option>'.$paises->nome.'</option>';
}
?>
</select>

<hr style="margin:40px 0px 0px 0px;float:left;width:100%;height:1px;background:#777;border:0px;" />
<?php
$sql = mysql_query("SELECT * FROM perfil_informacoes_gerais WHERE id_relacional='$session_id'");
$checks = mysql_fetch_object($sql);

if($checks->categoria == "Músico/artísta/produtor/banda"){
	echo '<label style="width:620px;">
<input type="radio" name="categoria" value="Músico/artísta/produtor/banda" checked="checked" />Músico/artísta/produtor/banda</label>';
}else{
	echo '<label style="width:620px;">
<input type="radio" name="categoria" value="Músico/artísta/produtor/banda"/>Músico/artísta/produtor/banda</label>';
}

if($checks->categoria == "Studio/masterizador/agência"){
	echo '<label style="width:620px;">
<input type="radio" name="categoria" value="Studio/masterizador/agência" checked="checked" />Studio/masterizador/agência</label>';
}else{
	echo '<label style="width:620px;">
<input type="radio" name="categoria" value="Studio/masterizador/agência"/>Studio/masterizador/agência</label>';
}

if($checks->categoria == "Selo/gravadora"){
	echo '<label style="width:620px;">
<input type="radio" name="categoria" value="Selo/gravadora" checked="checked" />Selo/gravadora</label>';
}else{
	echo '<label style="width:620px;">
<input type="radio" name="categoria" value="Selo/gravadora"/>Selo/gravadora</label>';
}

if($checks->categoria == "Dj"){
	echo '<label style="width:620px;">
<input type="radio" name="categoria" value="Dj" checked="checked" />Dj</label>';
}else{
	echo '<label style="width:620px;">
<input type="radio" name="categoria" value="Dj"/>Dj</label>';
}

if($checks->categoria == "Outros"){
	echo '<label style="width:620px;">
<input type="radio" name="categoria" value="Outros" checked="checked" />Outros</label>';
}else{
	echo '<label style="width:620px;">
<input type="radio" name="categoria" value="Outros"/>Outros</label>';
}

?>
<!-- 
<input type="hidden" id="categoria" name="categoria">
<ul id="menu-categoria">
<li><a href="Músico/artísta/produtor/banda">Músico/artísta/produtor/banda</a></li>
<li><a href="Studio/masterizador/agência">Studio/masterizador/agência</a></li>
<li><a href="Selo/gravadora">Selo/gravadora</a></li>
<li><a href="Dj">Dj</a></li>
<li><a href="Outros">Outros</a></li>
</ul>
-->
<hr style="margin:10px 0px 0px 0px;float:left;width:100%;height:1px;background:#777;border:0px;" />
<?php
$Breaks = "Breaks";
$ocorrencias = substr_count($checks->generos, $Breaks);
if($ocorrencias  == 1){
	echo '<label><input id="Breaks" type="checkbox" name="opcoes[]" value="Breaks" checked="checked"/>Breaks</label>';
}else{
	echo '<label><input id="Breaks" type="checkbox" name="opcoes[]" value="Breaks"/>Breaks</label>';
}
$Deep_House = "Deep_House";
$ocorrencias = substr_count($checks->generos, $Deep_House);
if($ocorrencias  == 1){
	echo '<label><input id="Deep House" type="checkbox" name="opcoes[]" value="Deep_House" checked="checked"/>Deep House</label>';
}else{
	echo '<label><input id="Deep House" type="checkbox" name="opcoes[]" value="Deep_House"/>Deep House</label>';
}
$Electro_House = "Electro_House";
$ocorrencias = substr_count($checks->generos, $Electro_House);
if($ocorrencias  == 1){
	echo '<label><input id="Electro House" type="checkbox" name="opcoes[]" value="Electro_House" checked="checked"/>Electro House</label>';
}else{
	echo '<label><input id="Electro House" type="checkbox" name="opcoes[]" value="Electro_House"/>Electro House</label>';
}
$House = "House";
$ocorrencias = substr_count($checks->generos, $House);
if($ocorrencias  == 1){
	echo '<label><input id="House" type="checkbox" name="opcoes[]" value="House" checked="checked"/>House</label>';
}else{
	echo '<label><input id="House" type="checkbox" name="opcoes[]" value="House"/>House</label>';
}
$Progressive_House = "Progressive_House";
$ocorrencias = substr_count($checks->generos, $Progressive_House);
if($ocorrencias  == 1){
	echo '<label>
	<input id="Progressive House" type="checkbox" name="opcoes[]" value="Progressive_House" checked="checked"/>Progressive House</label>';
}else{
	echo '<label><input id="Progressive House" type="checkbox" name="opcoes[]" value="Progressive_House"/>Progressive House</label>';
}
$R8B = "R8B";
$ocorrencias = substr_count($checks->generos, $R8B);
if($ocorrencias  == 1){
	echo '<label><input id="R&B" type="checkbox" name="opcoes[]" value="R8B" checked="checked"/>R&B </label>';
}else{
	echo '<label><input id="R&B" type="checkbox" name="opcoes[]" value="R8B"/>R&B </label>';
}
$Techno = "Techno";
$ocorrencias = substr_count($checks->generos, $Techno);
if($ocorrencias  == 1){
	echo '<label><input id="Techno" type="checkbox" name="opcoes[]" value="Techno" checked="checked"/>Techno</label>';
}else{
	echo '<label><input id="Techno" type="checkbox" name="opcoes[]" value="Techno"/>Techno</label>';
}
$Chill_Out = "Chill_Out";
$ocorrencias = substr_count($checks->generos, $Chill_Out);
if($ocorrencias  == 1){
	echo '<label><input id="Chill Out" type="checkbox" name="opcoes[]" value="Chill_Out" checked="checked"/>Chill Out</label>';
}else{
	echo '<label><input id="Chill Out" type="checkbox" name="opcoes[]" value="Chill_Out"/>Chill Out</label>';
}
$Drum_8_Bass = "Drum_8_Bass";
$ocorrencias = substr_count($checks->generos, $Drum_8_Bass);
if($ocorrencias  == 1){
	echo '<label><input id="Drum & Bass" type="checkbox" name="opcoes[]" value="Drum_8_Bass" checked="checked"/>Drum & Bass</label>';
}else{
	echo '<label><input id="Drum & Bass" type="checkbox" name="opcoes[]" value="Drum_8_Bass"/>Drum & Bass</label>';
}
$Hardcore5Hard_techno = "Hardcore5Hard_techno";
$ocorrencias = substr_count($checks->generos, $Hardcore5Hard_techno);
if($ocorrencias  == 1){
	echo '<label>
	<input id="Hardcore/Hard techno" type="checkbox" name="opcoes[]" value="Hardcore5Hard_techno" checked="checked"/>Hardcore/Hard techno</label>';
}else{
	echo '<label>
	<input id="Hardcore/Hard techno" type="checkbox" name="opcoes[]" value="Hardcore5Hard_techno"/>Hardcore/Hard techno</label>';
}
$Indie_Dance5Nu_Disco = "Indie_Dance5Nu_Disco";
$ocorrencias = substr_count($checks->generos, $Indie_Dance5Nu_Disco);
if($ocorrencias  == 1){
	echo '<label>
	<input id="Indie Dance/Nu Disco" type="checkbox" name="opcoes[]" value="Indie_Dance5Nu_Disco" checked="checked"/>Indie Dance/Nu Disco</label>';
}else{
	echo '<label>
	<input id="Indie Dance/Nu Disco" type="checkbox" name="opcoes[]" value="Indie_Dance5Nu_Disco"/>Indie Dance/Nu Disco</label>';
}
$Progressive_Trance = "Progressive_Trance";
$ocorrencias = substr_count($checks->generos, $Progressive_Trance);
if($ocorrencias  == 1){
	echo '<label><input id="Progressive Trance" type="checkbox" name="opcoes[]" value="Progressive_Trance" checked="checked"/>Progressive Trance</label>';
}else{
	echo '<label><input id="Progressive Trance" type="checkbox" name="opcoes[]" value="Progressive_Trance"/>Progressive Trance</label>';
}
$Reagge5Dub = "Reagge5Dub";
$ocorrencias = substr_count($checks->generos, $Reagge5Dub);
if($ocorrencias  == 1){
	echo '<label><input id="Reagge/Dub" type="checkbox" name="opcoes[]" value="Reagge5Dub" checked="checked"/>Reagge/Dub</label>';
}else{
	echo '<label><input id="Reagge/Dub" type="checkbox" name="opcoes[]" value="Reagge5Dub"/>Reagge/Dub</label>';
}
$Trance = "Trance";
$ocorrencias = substr_count($checks->generos, $Trance);
if($ocorrencias  == 1){
	echo '<label><input id="Trance" type="checkbox" name="opcoes[]" value="Trance" checked="checked"/>Trance</label>';
}else{
	echo '<label><input id="Trance" type="checkbox" name="opcoes[]" value="Trance"/>Trance</label>';
}
$Comercial = "Comercial";
$ocorrencias = substr_count($checks->generos, $Comercial);
if($ocorrencias  == 1){
	echo '<label><input id="Comercial" type="checkbox" name="opcoes[]" value="Comercial" checked="checked">Comercial</label>';
}else{
	echo '<label><input id="Comercial" type="checkbox" name="opcoes[]" value="Comercial"/>Comercial</label>';
}
$Dubstep = "Dubstep";
$ocorrencias = substr_count($checks->generos, $Dubstep);
if($ocorrencias  == 1){
	echo '<label><input id="Dubstep" type="checkbox" name="opcoes[]" value="Dubstep" checked="checked"/>Dubstep</label>';
}else{
	echo '<label><input id="Dubstep" type="checkbox" name="opcoes[]" value="Dubstep"/>Dubstep</label>';
}
$Hip_Hop = "Hip-Hop";
$ocorrencias = substr_count($checks->generos, $Hip_Hop);
if($ocorrencias  == 1){
	echo '<label><input id="Hip-Hop" type="checkbox" name="opcoes[]" value="Hip-Hop" checked="checked"/>Hip-Hop</label>';
}else{
	echo '<label><input id="Hip-Hop" type="checkbox" name="opcoes[]" value="Hip-Hop"/>Hip-Hop</label>';
}
$Minimal = "Minimal";
$ocorrencias = substr_count($checks->generos, $Minimal);
if($ocorrencias  == 1){
	echo '<label><input id="Minimal" type="checkbox" name="opcoes[]" value="Minimal" checked="checked"/>Minimal</label>';
}else{
	echo '<label><input id="Minimal" type="checkbox" name="opcoes[]" value="Minimal"/>Minimal</label>';
}
$Psy_Trance_Full_On = "Psy-Trance5Full_On";
$ocorrencias = substr_count($checks->generos, $Psy_Trance_Full_On);
if($ocorrencias  == 1){
	echo '<label>
	<input id="Psy-Trance/Full On" type="checkbox" name="opcoes[]" value="Psy-Trance5Full_On" checked="checked"/>Psy-Trance/Full On</label>';
}else{
	echo '<label><input id="Psy-Trance/Full On" type="checkbox" name="opcoes[]" value="Psy-Trance5Full_On"/>Psy-Trance/Full On</label>';
}
$Tech_House = "Tech_House";
$ocorrencias = substr_count($checks->generos, $Tech_House);
if($ocorrencias  == 1){
	echo '<label><input id="Tech House" type="checkbox" name="opcoes[]" value="Tech_House" checked="checked" />Tech House</label>';
}else{
	echo '<label><input id="Tech House" type="checkbox" name="opcoes[]" value="Tech_House" />Tech House</label>';
}

$Electronica = "Electronica";
$ocorrencias = substr_count($checks->generos, $Electronica);
if($ocorrencias  == 1){
	echo '<label><input id="Electronicae" type="checkbox" name="opcoes[]" value="Electronica" checked="checked" />Electronica</label>';
}else{
	echo '<label><input id="Electronica" type="checkbox" name="opcoes[]" value="Electronica" />Electronica</label>';
}

$Glitch_Hop = "Glitch_Hop";
$ocorrencias = substr_count($checks->generos, $Glitch_Hop);
if($ocorrencias  == 1){
	echo '<label><input id="Glitch Hop" type="checkbox" name="opcoes[]" value="Glitch_Hop" checked="checked" />Glitch Hop</label>';
}else{
	echo '<label><input id="Glitch Hop" type="checkbox" name="opcoes[]" value="Glitch_Hop" />Glitch Hop</label>';
}

$Hard_Dance = "Hard_Dance";
$ocorrencias = substr_count($checks->generos, $Hard_Dance);
if($ocorrencias  == 1){
	echo '<label><input id="Hard Dance" type="checkbox" name="opcoes[]" value="Hard_Dance" checked="checked" />Hard Dance</label>';
}else{
	echo '<label><input id="Hard Dance" type="checkbox" name="opcoes[]" value="Hard_Dance" />Hard Dance</label>';
}
?>
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
<input type="hidden" id="generos" name="generos" value="<?php echo $checks->generos; ?>">
<!--
<ul id="menu-generos">
<li><a href="Breaks">Breaks</a></li>
<li><a href="Deep House">Deep House</a></li>
<li><a href="Electro House">Electro House</a></li>
<li><a href="House">House</a></li>
<li><a href="Progressive House">Progressive House</a></li>
<li><a href="R&B">R&B</a></li>
<li><a href="Techno">Techno</a></li>

<li><a href="Chill Out">Chill Out</a></li>
<li><a href="Drum & Basse">Drum & Basse</a></li>
<li><a href="Hardcore/Hard techno">Hardcore/Hard techno</a></li>
<li><a href="Indie Dance/Nu Disco">Indie Dance/Nu Disco</a></li>
<li><a href="Progressive Dance">Progressive Dance</a></li>
<li><a href="Reagge/Dub">Reagge/Dub</a></li>
<li><a href="Trance">Trance</a></li>

<li><a href="Comercial">Comercial</a></li>
<li><a href="Dubstep">Dubstep</a></li>
<li><a href="Hip-Hop">Hip-Hop</a></li>
<li><a href="Minimal">Minimal</a></li>
<li><a href="Psy-Trance/Full On">Psy-Trance/Full On</a></li>
<li><a href="Tech House">Tech House</a></li>
</ul>
-->

<hr style="margin:0px 0px 0px 0px;float:left;width:100%;height:1px;border:0px;background:tramsparent;" />

<input id="bt-salvar-profile" type="submit" value="SALVAR" />

<div id="resposta-atualizar-perfil"></div>

</form>
</div><!-- left -->
<div id="right" style="margin:40px 0px 0px 0px;line-height:20px;">
<ul id="menu-info">
<li><a id="ln" style="background:#999;" href="editar_perfil_geral.php">INFORMAÇÕES GERAIS</a></li>
<li><a id="ln" href="editar_info_contato.php">INFORMAÇÕES DE CONTATO</a></li>
<li><a id="ln" href="editar_senha.php">ALTERAR SENHA</a></li>
</ul>
</div><!-- right -->
</div><!-- center -->