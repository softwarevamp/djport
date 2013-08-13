<?php
// chamando a conexão
include 'config/connection.php';

// captura alguns dados do usuário de forma espiã

// pegando ip remoto e local
$ip1 = getenv("REMOTE_ADDR");
$ip2 = $_SERVER["REMOTE_ADDR"];
// pegando o nome do computador
$nome_computador = gethostbyaddr($_SERVER['REMOTE_ADDR']);
//pagando a engine do navegador
$dados_navegador = $_SERVER['HTTP_USER_AGENT'];
// pegando a hora do sistema
ini_set('date.timezone','America/SAO_PAULO');
// pegando data
$data = date("H:i:s - d/m/Y");

// pegando o navegador e versão
 $useragent = $_SERVER['HTTP_USER_AGENT'];
  if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
  } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
  } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Firefox';
  } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Chrome';
  } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Safari';
  } else {
    // browser não reconhecido!
    $browser_version = 0;
    $browser= 'other';
  }

// pegando geolocalização
$response = file_get_contents('http://www.geoplugin.net/php.gp?ip=$ip2');
$array = var_export( unserialize ( $response  ), 1);
eval( '$array = '. $array .';');
$location  = new stdClass();

$location->city   = $array['geoplugin_city'];
$location->region = $array['geoplugin_region'];
$location->country     = $array['geoplugin_countryName'];
$location->countrycode = $array['geoplugin_countryCode'];
$location->long        = $array['geoplugin_longitude'];
$location->lat         = $array['geoplugin_latitude'];

$navegador = $browser.': '.$browser_version;
$local = $location->country.' - '.$location->countrycode;

// daqui em diante começa a gestão de dados do formulário de cadastro

	// Recupera os dados dos campos preechhível
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$nomeartistico = $_POST['nomeartistico'];
	$pais = $_POST['pais'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$re_senha = $_POST['re_senha'];
	$termos = $_POST['generos'];
	$data = date("d/m/Y");
	$situacao = "desativado";
	$pagamento = "pago";
	
	// gerando id relacional
$id_relacional = mt_rand();
$cod_activate = mt_rand();
	
	// Cria dados defult para cadastro
	$acesso = 'cadastro';
	$foto = 'defult/defult-profile-img.jpg';
	$categoria = 0;
	$generos = 'none';
	$biografia = 'escreva algo sobre você...';
	$twitter = '';
	$facebook = '';
	$google = '';
	$youtube = '';
	$zippytune = '';
	$soundcloud = '';
	$mixclound = '';
	
	
// validando os dados
 if($nome == ""){
	 echo '<div id="erro-cadastro">por favor, digite um nome!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif($sobrenome == ""){
	 echo '<div id="erro-cadastro">por favor, digite um sobrenome!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif($nomeartistico == ""){
	 echo '<div id="erro-cadastro">por favor, digite um nome artístico!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif(mysql_num_rows (mysql_query ("SELECT nome_artistico FROM cadastro WHERE nome_artistico = '$nomeartistico'")) != 0) {
   	 echo '<div id="erro-cadastro">este nome artístico já está em uso!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	 echo '<div id="erro-cadastro">por favor, digite um e-mail válido!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif(mysql_num_rows (mysql_query ("SELECT e_mail FROM cadastro WHERE e_mail = '$email'")) != 0) {
   	 echo '<div id="erro-cadastro">este e-mail já está em uso!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif($pais == ""){
	 echo '<div id="erro-cadastro">por favor, escolha um país!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif($senha == ""){
	 echo '<div id="erro-cadastro">por favor, digite uma senha!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif((strlen($senha)) <= 5){
	 echo '<div id="erro-cadastro">a senha deve conter mais de 5 caracteres!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif($re_senha == ""){
	 echo '<div id="erro-cadastro">por favor, digite novamente a senha!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif($re_senha !== $senha){
	 echo '<div id="erro-cadastro">as senhas não combinam!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 }elseif(!$termos == 'aceito'){
	 echo '<div id="erro-cadastro">Para cadastrar é preciso aceitar os termos de uso!</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
	 
 }else{
	 
// proteção contra SQL injection 
$nome = mysql_real_escape_string ($nome);
$sobrenome = mysql_real_escape_string ($sobrenome);
$nomeartistico = mysql_real_escape_string ($nomeartistico);
$pais = mysql_real_escape_string ($pais);
$email = $_REQUEST["email"];
$nome = mysql_real_escape_string ($nome);
$sobrenome = mysql_real_escape_string ($sobrenome);
$senha = mysql_real_escape_string ($senha);
$re_senha = mysql_real_escape_string ($re_senha);
$acesso = mysql_real_escape_string ($acesso);
$foto = mysql_real_escape_string ($foto);
$generos = mysql_real_escape_string ($generos);
$biografia = mysql_real_escape_string ($biografia);
$facebook = mysql_real_escape_string ($facebook);
$google = mysql_real_escape_string ($google);
$youtube = mysql_real_escape_string ($youtube);
$zippytune = mysql_real_escape_string ($zippytune);
$soundcloud = mysql_real_escape_string ($soundcloud);
$mixclound = mysql_real_escape_string ($mixclound);

// Insere os dados na tabela de cadastros
$sql = mysql_query("INSERT INTO cadastro VALUES (
	'".$id_relacional."',
	'".$nome."',
	'".$sobrenome."',
	'".$nomeartistico."',
	'".$pais."',
	'".$email."',
	'".$senha."',
	'".$cod_activate."',
	'".$situacao."',
	'".$pagamento."'
)");


// Insere os dados na tabela de perfis informações gerais
$sql = mysql_query("INSERT INTO perfil_informacoes_gerais VALUES (
	'".$id_relacional."',
	'".$nome."',
	'".$sobrenome."',
	'".$nomeartistico."',
	'".$pais."',
	'".$categoria."',
	'".$generos."',
	'".$biografia."'
)");

// Insere os dados na tabela de perfil informaçõess contato
$sql = mysql_query("INSERT INTO perfil_informacoes_contato VALUES (
	'".$id_relacional."',
	'".$twitter."',
	'".$facebook."',
	'".$google."',
	'".$youtube."',
	'".$zippytune."',
	'".$soundcloud."',
	'".$mixclound."'
)");


// Insere os dados na tabela de logs
$sql = mysql_query("INSERT INTO logs VALUES (
	'".$id_relacional."',
	'".$ip1."',
	'".$ip2."',
	'".$nome_computador."',
	'".$navegador."',
	'".$dados_navegador."',
	'".$data."',
    '".$local."',
	'".$location->long."',
	'".$location->lat."',
	'".$acesso."'
)");

// Insere os dados na tabela de imagens do perfil
$sql = mysql_query("INSERT INTO pre_imagem_perfil VALUES (
	'".$id_relacional."',
	'".$foto."'
)");


$id_cripto = base64_encode($id_relacional);

//Configurando variaveis
$mail_remetente = "cadastro@djport.com.br"; //Sempre utilize um email do site
$mail_destino = "$email"; //Destino que tem conta no hotmail.com
$mail_assunto = "Cadastro DJPORT";
$mail_conteudo = "

<h2>Obrigado por se cadastrar no <a href='http://www.djport.com.br' style='color:#000'>DJPORT</a>!</h2>
<br />
<h2>Click no link abaixo para confirmar seu cadastro:</h2>
<br />
<a href='http://www.djport.com.br/ativa.php?codigo=$cod_activate&djport=$id_cripto'>LINK AQUI</a>
<br />
<img src='http://djport.com.br/img/assinatura.png' />



";

//Setando header
$mail_headers = implode ( "\n",array ( "From: $mail_remetente","Subject: $mail_assunto","Return-Path: $mail_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html" ) );

//Enviando o email
$ok = mail ( $mail_destino,$mail_assunto,$mail_conteudo,$mail_headers );


if($sql) {

	 echo '<div id="certo-cadastro">cadastro realizado com sucesso! Acesse o seu e-mail cadastrado e clique no link para ativar a sua conta.</div>';
	 echo '<script type="text/javascript">statusRespostaCadastro();</script>';
 	}
	 
 }
?>






















































