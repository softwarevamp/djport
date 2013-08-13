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
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	
	// verifica erros
	if($email == "e-mail"){
	  echo '<div id="erro-login">por favor, digite um e-mail!</div>';
	  echo '<script type="text/javascript">statusRespostaLogin();</script>';
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	  echo '<div id="erro-login">este e-mail não é válido!</div>';
	  echo '<script type="text/javascript">statusRespostaLogin();</script>';
	}elseif($senha == "senha"){
	  echo '<div id="erro-login">por favor, digite uma senha!</div>';
	  echo '<script type="text/javascript">statusRespostaLogin();</script>';
	}else{

//verifica se o login e a senha conferem no db
$login = mysql_query("SELECT * FROM `cadastro` WHERE e_mail = '$email' AND senha = '$senha'");
$verifica = mysql_num_rows($login); //traz o resultado da pesquisa acima
$usuario = mysql_fetch_assoc($login);

$situacao = $usuario['situacao'];

if($situacao == "desativado"){
	
	
	echo '<div id="erro-login">sua conta não está ativada!</div>';
	  echo '<script type="text/javascript">statusRespostaLogin();</script>';
	
}else{
	
	
	
if ( $verifica == 1 ) {
  setcookie ("e_mail", $email); //grava o cookie com o login
  setcookie ("senha", $senha); //grava o cookie com a senha
  
  // inicia a session
  session_start();
  $_SESSION['id'] = $usuario['id_relacional'];
 		echo '<script>location.href="./";</script>';
		echo '<meta http-equiv="refresh" content="5; url=./">';
		
$acesso = 'login';
  // Insere os dados no banco quando o usuário loga
$sql = mysql_query("INSERT INTO logs VALUES (
	'".$_SESSION['id']."',
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
		
  } else {
  $_SESSION['id'] = "";
	echo '<div id="erro-login">e-mail ou senha incorretos!</div>';
	echo '<script type="text/javascript">statusRespostaLogin();</script>';
  }
	
	
	
}

 
  
  
}// fecha inicia a session
?>