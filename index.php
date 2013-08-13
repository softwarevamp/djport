<?php
$id_cripto = $_GET["ativo"];
if(!$id_cripto == ""){
	
	$id_relacional = base64_decode($id_cripto);
	
	  // inicia a session
  session_start();
  $_SESSION['id'] = $id_relacional;
 		echo '<script>location.href="./";</script>';
		echo '<meta http-equiv="refresh" content="5; url=./">';
		
}else{
	session_start();
	$segura = "active";
}
?>

<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/png" href="favicon.ico">
<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>

<!-- upload -->
<!-- Google web fonts -->
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<!-- The main CSS file -->
<link href="assets/css/style.css" rel="stylesheet" />
<!-- upload -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>

<!-- upload -->
<script src="assets/js/jquery.knob.js"></script>
<!-- jQuery File Upload Dependencies -->
<script src="assets/js/jquery.ui.widget.js"></script>
<script src="assets/js/jquery.iframe-transport.js"></script>
<script src="assets/js/jquery.fileupload.js"></script>
<!-- Our main JS file -->
<script src="assets/js/script.js"></script>
<!-- upload -->

<script language="javascript" src="js/main.js"></script>
<title>DJ PORT</title>
<script language="javascript">
function resolucao(){ 
if(screen.width <= 1000){
document.write('<link rel="stylesheet" href="css/gadget.css" />');
}else{
document.write('<link rel="stylesheet" href="css/desktop.css" />');
}
}
resolucao();

valor = "SELECIONA A MUSICA";
</script>
</head>

<body>


<div id="upload_div">

<form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
<a href="#" id="bt-fechar-upload" title="Fechar e cancelar o upload"></a>
<input id="nome" type="text" name="nome" value="nome da musica" autocomplete="off"
onfocus="if (this.value=='nome da musica'){this.value='';};return false;"
onblur="if (this.value==''){this.value='nome da musica';};return false;" />

<input id="autor" type="text" name="autor" value="autor" autocomplete="off" style="margin:15px 0px 0px 0px;"
onfocus="if (this.value=='autor'){this.value='';};return false;"
onblur="if (this.value==''){this.value='autor';};return false;" />

<select name="categoria" id="categoria">
<option selected='selected' disabled="disabled">categoria</option>
<option>track</option>
<option>djset</option>
</select>

<select name="genero" id="genero" style="margin:15px 0px 0px 0px;">
<option selected='selected' disabled="disabled">genenro</option>
<option>Breaks</option>
<option>Deep House</option>
<option>Electro House</option>
<option>House</option>
<option>Progressive House</option>
<option>R & B</option>
<option>Techno</option>
<option>Chill Out</option>
<option>Drum & Bass</option>
<option>Hardcore/Hard techno</option>
<option>Indie Dance/Nu Disco</option>
<option>Progressive Trance</option>
<option>Reagge/Dub</option>
<option>Comercial</option>
<option>Dubstep</option>
<option>Hip-Hop</option>
<option>Minimal</option>
<option>Psy-Trance/Full On</option>
<option>Tech House</option>
<option>Electronica</option>
<option>Glitch Hop</option>
<option>Hard Dance</option>
</select>

<?php $session_musica = mt_rand(); ?>
<input type="hidden" name="session_musica" value="<?php echo $session_musica; ?>" />
<div id="drop">
<a>ESCOLHA CAPA DA MUSICA</a>
<input type="file" name="files">
</div>
<hr style="margin:0px 0px 0px 0px;float:left;width:100%;height:1px;border:0px;" />
<div id="drop">
<a>SELECIONE A MUSICA</a>
<input type="file" name="upl" id="upl" />
</div>
<ul>
</ul>
</form>
</div>
<div style="margin:0px 0px 0px -1000px;position:absolute;left:50%;top:-100px;width:2000px;height:1px;"></div>

<div id="top">
<div class="center">

<div id="login">
<form id="form-login" name="form-login">
<input id="email" type="text" name="email" value="e-mail" autocomplete="off"
onfocus="if (this.value=='e-mail'){this.value='';};return false;"
onblur="if (this.value==''){this.value='e-mail';};return false;" />

<input id="senha" type="text" name="senha" value="senha" autocomplete="off"
onfocus="if (this.value=='senha'){this.value='', type='password';};return false;"
onblur="if (this.value==''){this.value='senha', type='text';};return false;" />

<input id="bt-login" type="submit" value="ENTRAR" />
</form>
<div id="resposta-login"></div>
<hr style="margin:0px 0px 0px 0px;float:left;width:100%;height:1px;border:0px;" />
<a href="#">Esqueceu sua senha?</a>
</div><!-- login -->
<?php

$quantas_mensagens = $_SESSION['id'];

$sql = mysql_query("SELECT * FROM mensages WHERE para='$quantas_mensagens' AND ja_leu = '1'");
$mensagens = mysql_num_rows($sql);


$sql = mysql_query("SELECT * FROM cadastro WHERE id_relacional='$quantas_mensagens'");
$pagamento = mysql_fetch_object($sql);

if(!$_SESSION['id'] == ''){
	
	
	if($pagamento->pagamento == "devendo"){
			echo '<a id="bt-upload-deve" href="pagamento.php">Upload</a>';
	}else{
		echo '<a id="bt-upload-yes" href="#">Upload</a>';
	}
	
	echo '
	<div id="menu-log-off">
	<a id="ln" class="bt-user" href="php/sair_usuario.php">Sair</a>
	<p>|</p>
	<li>';
	
		if($pagamento->pagamento == "devendo"){
			echo '<a id="ln" class="bt-user" style="color:#f72343;" href="pagamento.php">Mensagens';
	}else{
		echo '<a id="ln" class="bt-user" href="box_mensages.php">Mensagens';
	}
	
	
	
	if($mensagens == 0){
	}else{
		echo '<span>'.$mensagens.'</span>';
	}
	
	echo '</a></li>
	<p>|</p>
	<li>';
	
	
	if($pagamento->pagamento == "devendo"){
			echo '<a id="ln" class="bt-user" style="color:#f72343;" href="pagamento.php">Editar Perfil</a>';
	}else{
		echo '<a id="ln" class="bt-user" href="editar_perfil_geral.php">Editar Perfil</a>';
	}
	
	
	echo'
	</li>
	<p>|</p>
	<a id="ln" class="bt-user" href="perfil.php">Meu Perfil</a>
	</div>
	
	';
}else{
	echo '
	
	<div id="menu-log-off">
	<a id="bt-upload-no" class="uploadOff" href="#">Upload</a>
	<a id="bt-abrir-login" class="bt-user" href="#">Login</a>
	<p>|</p>
	<a id="bt-cadastro" class="bt-user" href="cadastro.php">Cadastro</a>
	</div>

	<div id="menu-log-on" style="display:none;">
	<a id="bt-fechar-login" class="bt-user" href="#">Fechar</a>
	</div>
	';
}
?>
</div>
</div><!-- center -->
</div><!-- top -->

<div id="content-player">


</div><!-- player -->

<div id="content-menu">
<div class="center">
<a href="./">
<img id="logo" src="img/logo.png" />
</a>
<form id="form-search" name="form-search">

<input type="submit" id="bt-search" value="Search" />

<input id="search" type="text" name="search" value="Procurar artista ou faixa" autocomplete="off"
onfocus="if (this.value=='Procurar artista ou faixa'){this.value='';};return false;"
onblur="if (this.value==''){this.value='Procurar artista ou faixa';};return false;" />
</form>

<ul id="menu">

<li class="menu_ul">
<a id="ln" href="artist.php" style="margin:0px 5px 0px 0px;">Artists</a>
<ul>
<li><a id="ln" href="artist.php?genero=Breaks">Breaks</a></li>
<li><a id="ln" href="artist.php?genero=Deep_House">Deep House</a></li>
<li><a id="ln" href="artist.php?genero=Electro_House">Electro House</a></li>
<li><a id="ln" href="artist.php?genero=House">House</a></li>
<li><a id="ln" href="artist.php?genero=Progressive_House">Progressive House</a></li>
<li><a id="ln" href="artist.php?genero=R8B">R&B </a></li>
<li><a id="ln" href="artist.php?genero=Techno">Techno</a></li>
<li><a id="ln" href="artist.php?genero=Chill_Out">Chill Out</a></li>
<li><a id="ln" href="artist.php?genero=Drum_8_Bass">Drum & Bass</a></li>
<li><a id="ln" href="artist.php?genero=Hardcore5Hard_techno">Hardcore/Hard techno</a></li>
<li><a id="ln" href="artist.php?genero=Indie_Dance5Nu_Disco">Indie Dance/Nu Disco</a></li>
<li><a id="ln" href="artist.php?genero=Progressive_Trance">Progressive Trance</a></li>
<li><a id="ln" href="artist.php?genero=Reagge5Dub">Reagge/Dub</a></li>
<li><a id="ln" href="artist.php?genero=Comercial">Comercial</a></li>
<li><a id="ln" href="artist.php?genero=Dubstep">Dubstep</a></li>
<li><a id="ln" href="artist.php?genero=Hip-Hop">Hip-Hop</a></li>
<li><a id="ln" href="artist.php?genero=Minimal">Minimal</a></li>
<li><a id="ln" href="artist.php?genero=Psy-Trance5Full_On">Psy-Trance/Full On</a></li>
<li><a id="ln" href="artist.php?genero=Tech_House">Tech House</a></li>
<li><a id="ln" href="artist.php?genero=Electronica">Electronica</a></li>
<li><a id="ln" href="artist.php?genero=Glitch_Hop">Glitch Hop</a></li>
<li><a id="ln" href="artist.php?genero=Hard_Dance" style="border-bottom:0px;">Hard Dance</a></li>
</ul>
</li>

<li class="menu_ul">
<a id="ln" href="tracks.php">Tracks</a>
<ul>
<li><a id="ln" href="tracks.php?genero=Breaks">Breaks</a></li>
<li><a id="ln" href="tracks.php?genero=Deep_House">Deep House</a></li>
<li><a id="ln" href="tracks.php?genero=Electro_House">Electro House</a></li>
<li><a id="ln" href="tracks.php?genero=House">House</a></li>
<li><a id="ln" href="tracks.php?genero=Progressive_House">Progressive House</a></li>
<li><a id="ln" href="tracks.php?genero=R8B">R&B </a></li>
<li><a id="ln" href="tracks.php?genero=Techno">Techno</a></li>
<li><a id="ln" href="tracks.php?genero=Chill_Out">Chill Out</a></li>
<li><a id="ln" href="tracks.php?genero=Drum_8_Bass">Drum & Bass</a></li>
<li><a id="ln" href="tracks.php?genero=Hardcore5Hard_techno">Hardcore/Hard techno</a></li>
<li><a id="ln" href="tracks.php?genero=Indie_Dance5Nu_Disco">Indie Dance/Nu Disco</a></li>
<li><a id="ln" href="tracks.php?genero=Progressive_Trance">Progressive Trance</a></li>
<li><a id="ln" href="tracks.php?genero=Reagge5Dub">Reagge/Dub</a></li>
<li><a id="ln" href="tracks.php?genero=Comercial">Comercial</a></li>
<li><a id="ln" href="tracks.php?genero=Dubstep">Dubstep</a></li>
<li><a id="ln" href="tracks.php?genero=Hip-Hop">Hip-Hop</a></li>
<li><a id="ln" href="tracks.php?genero=Minimal">Minimal</a></li>
<li><a id="ln" href="tracks.php?genero=Psy-Trance5Full_On">Psy-Trance/Full On</a></li>
<li><a id="ln" href="tracks.php?genero=Tech_House">Tech House</a></li>
<li><a id="ln" href="tracks.php?genero=Electronica">Electronica</a></li>
<li><a id="ln" href="tracks.php?genero=Glitch_Hop">Glitch Hop</a></li>
<li><a id="ln" href="tracks.php?genero=Hard_Dance" style="border-bottom:0px;">Hard Dance</a></li>
</ul>
</li>

<li class="menu_ul">
<a id="ln" href="djset.php">Djsets</a>
<ul>
<li><a id="ln" href="djset.php?genero=Breaks">Breaks</a></li>
<li><a id="ln" href="djset.php?genero=Deep_House">Deep House</a></li>
<li><a id="ln" href="djset.php?genero=Electro_House">Electro House</a></li>
<li><a id="ln" href="djset.php?genero=House">House</a></li>
<li><a id="ln" href="djset.php?genero=Progressive_House">Progressive House</a></li>
<li><a id="ln" href="djset.php?genero=R8B">R&B </a></li>
<li><a id="ln" href="djset.php?genero=Techno">Techno</a></li>
<li><a id="ln" href="djset.php?genero=Chill_Out">Chill Out</a></li>
<li><a id="ln" href="djset.php?genero=Drum_8_Bass">Drum & Bass</a></li>
<li><a id="ln" href="djset.php?genero=Hardcore5Hard_techno">Hardcore/Hard techno</a></li>
<li><a id="ln" href="djset.php?genero=Indie_Dance5Nu_Disco">Indie Dance/Nu Disco</a></li>
<li><a id="ln" href="djset.php?genero=Progressive_Trance">Progressive Trance</a></li>
<li><a id="ln" href="djset.php?genero=Reagge5Dub">Reagge/Dub</a></li>
<li><a id="ln" href="djset.php?genero=Comercial">Comercial</a></li>
<li><a id="ln" href="djset.php?genero=Dubstep">Dubstep</a></li>
<li><a id="ln" href="djset.php?genero=Hip-Hop">Hip-Hop</a></li>
<li><a id="ln" href="djset.php?genero=Minimal">Minimal</a></li>
<li><a id="ln" href="djset.php?genero=Psy-Trance5Full_On">Psy-Trance/Full On</a></li>
<li><a id="ln" href="djset.php?genero=Tech_House">Tech House</a></li>
<li><a id="ln" href="djset.php?genero=Electronica">Electronica</a></li>
<li><a id="ln" href="djset.php?genero=Glitch_Hop">Glitch Hop</a></li>
<li><a id="ln" href="djset.php?genero=Hard_Dance" style="border-bottom:0px;">Hard Dance</a></li>
</ul>
</li>

</ul>

</div><!-- center -->
</div><!-- contant menu -->

<script language="javascript">
$(document).ready(function(){
pagina = 'home.php';
$("#show").load(pagina);
});
</script>


<div id="show">
</div>

<h2 style="margin:-40px 0px 0px 0px; padding:0px;">
<div class="center">
<h4 style="float:left;font-size:25px;width:auto;padding-top:2px;padding-bottom:3px;">Gigs</h4>
<h4 style="float:right;font-size:25px;width:333px;border-left:solid 12px #222;height:30px;padding-top:3px;padding-left:5px;">Publicidade</h4>
</div><!-- center -->
</h2>

<div class="center">

<!-- Slideshow HTML -->
<div id="slideshowGigs">
<div id="slidesContainerGigs">
    
</div><!-- slidesContainer -->
</div><!-- slide show -->
<!-- Slideshow HTML -->


<div id="adsence">



</div>
</div><!-- center -->



<h2 style="margin:12px 0px 0px 0px; padding:0px;">
<div class="center">
<h4 style="float:left;font-size:25px;width:auto;padding-top:5px;padding-bottom:0px;">Facebook</h4>
<h4 style="float:right;font-size:25px;width:400px;border-left:solid 12px #222;height:30px;padding:2px;">Twitter</h4>
</div><!-- center -->
</h2>

<div class="center">

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=159682254191270";
  fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk'));

</script>

<div id="facebookDiv" style="margin:14px 0px 0px 0px;">
<div class="fb-like" data-href="http://www.facebook.com/djport" data-send="true" data-width="784" data-show-faces="true" data-font="tahoma" data-colorscheme="dark"></div>
</div>


<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<div style="margin:14px 0px 15px 0px;float:right;height:auto;background:#555;">
                <script>
                new TWTR.Widget({
                  version: 2,
                  type: 'profile',
                  rpp: 4,
                  interval: 30000,
                  width: 404,
                  height: 304,
                  theme: {
                    shell: {
                      background: '#555',
                      color: '#FFF'
                    },
                    tweets: {
                      background: '#111',
                      color: '#EEE',
                      links: '#AAA',
					  font: '15px'
                    }
                  },
                  features: {
                    scrollbar: false,
                    loop: false,
                    live: true,
					avatars: true,
                    behavior: 'defult'
                  }
                }).render().setUser('djportoficial').start();
                </script>
</div>
</div><!-- center -->

<div id="bottom">
<p id="link-bottom"><b>&bull;</b> <a id="ln" href="sobre.php">Sobre</a> | <a id="ln" href="funciona.php">Como funciona</a> | <a id="ln" href="politica_privacidade.php">Política de privacidade</a> | <a id="ln" href="termos_uso.php">Termos de Uso</a> | <a id="ln" href="planos.php">Planos</a> | <a id="ln" href="ajuda.php">Ajuda</a> <b>&bull;</b></p>
<p><a target="_blank" href="https://twitter.com/djportoficial"><img src="img/bt.twitter.bottom.png" /></a> <a target="_blank" href="http://www.facebook.com/pages/Djport/225880610877827?ref=ts&fref=ts"><img src="img/bt.facebook.bottom.png" /></a></p>
<p>Todos os direitos reservados &reg;</p>
</div><!-- bottom -->
<p>Desenvolvimento &nbsp; <a href="http://www.agencialeggo.com" target="_blank"><img src="img/leggo.png" /></a></p>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37853901-1']);
  _gaq.push(['_setDomainName', 'djport.com.br']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>