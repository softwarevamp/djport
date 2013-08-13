// DJ PORT DESKTOP

// validando url's mestres
function verificaUrl(){
var urlMestre = document.sendSoundForm.urlSound.value;
var soundCloud = /(http):+(\/\/{1})+(soundcloud.com\/[a-zA-Z0-9])/
if (soundCloud.test){	
$('#submitSound').submit()
}else{
$("#status").html('<div id="error">Url inválida!</div>').show();
return false;
}
}