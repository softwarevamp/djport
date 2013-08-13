/* MAIN */
$(document).ready(function(){
	$('#bt-abrir-login, .uploadOff').click(function(){
		$('#menu-log-off').hide(0);
		$('#top').animate({height: "200px"}, 500);
		$('#menu-log-on').show(0);
		setTimeout('openLoginTop()', 300); 
	});
	$('#bt-fechar-login').click(function(){
		$('#menu-log-on').hide(0);
		$('#top').animate({height: "70px"}, 500);
		$('#menu-log-off').show(0);
		setTimeout('closeLoginTop()', 100); 
	});
});



$(document).ready(function(){
	$('#bt-upload-yes').click(function(){
	$('#upload_div').fadeIn(100);
	});
	$('#bt-fechar-upload').click(function(){
	$('#upload_div').fadeOut(100);
	});
});


function openLoginTop(){
	// abrindo o login
	$('#login, #login label').fadeIn(200);
}
function closeLoginTop(){
	// fechando login
	$('#login').fadeOut(200);
	
	// limpando os campos
	document.getElementById('senha').type= "text";
	$('#senha').val('senha');
	$('#email').val('e-mail');
	$('#erro-login').hide(0);
}

$(document).ready(function(){
// form login
	$('#form-login').submit(function(event){
    	event.preventDefault();
		$('input#bt-login').attr('value', 'AGUARDE...');
		
    	$.ajax({
        type: "post",
        dataType: "html",
        url: 'php/login_usuario.php',
        data: $("#form-login").serialize(),
        	success: function (response) {
				$('input#bt-login').attr('value', 'ENTRAR');
			$("#resposta-login").html(response).show();
			}
		});
	});
	
});


$(document).ready(function(){
// form search
	$('#form-search').submit(function(event){
    	event.preventDefault();
		$('input#bt-search').attr('value', 'Buscando...');
    	$.ajax({
        type: "post",
        dataType: "html",
        url: 'search.php',
        data: $("#form-search").serialize(),
        	success: function (response) {
				$('input#bt-search').attr('value', 'Search');
			$("#show").html(response).show();
			}
		});
	});
	
});

$(document).ready(function(){
$("a#bt-cadastro, a#bt-sair-usuario, a#ln, #bt-upload-deve").click(function(){
$("#homeAll, #rightControlTrack, #leftControlTrack, #rightControlDjset, #leftControlDjset, #rightControlProfile, #leftControlProfile, #rightControlGigs, #leftControlGigs").hide(0);
pagina = $(this).attr('href')
$("#loader").ajaxStart(function(){
$(this).show()})
$("#loader").ajaxStop(function(){$(this).hide();})
$("#show").load(pagina); return false;})
});

function statusRespostaCadastro(){setTimeout('statusHideRespostaCadastro()', 2000);}
function statusHideRespostaCadastro(){$('#erro-cadastro').fadeOut(500);$('#certo-cadastro').fadeOut(500);}

function statusRespostaLogin(){setTimeout('statusHideRespostaLogin()', 2000);}
function statusHideRespostaLogin(){$('#erro-login').fadeOut(500);$('#certo-login').fadeOut(500);}


$(document).ready(function(){
$(".menu_ul").hover(
  function () {
    $('> ul', this).show(0);
  },
  function () {
    $('> ul', this).hide(0);
  }
);
});



/*
// cadastro user
function limpaCadastro(){
	
	document.getElementById('senha').type= "text";
	document.getElementById('re-senha').type= "text";
	
	$('#email').val('e-mail');
	$('#nome').val('nome');
	$('#senha').val('senha');
	$('#re-senha').val('repita a senha');
	$('#captcha').val('digite o código abaixo');
};
*/


/*
// validando URL
function pegaSom(){
var urlMestre = document.form_upload.url_som.value;
var zippyTune = /(http):+(\/\/{1})+(www.zippytune.com\/[a-zA-Z]{4,4}\/[0-9])|(zippytune.com\/[A-Z]{4,4}\/[0-9])/
var soundCloud = /(http):+(\/\/{1})+(www.soundcloud.com\/*)|(soundcloud.com\/*)/
//var mixCloud = /(http):+(\/\/{1})+(www.mixcloud.com\/[a-zA-Z])|(mixcloud.com\/[a-zA-Z])/

		if (zippyTune.test(urlMestre)){
		pegaZippyTune(event);
		}else if(soundCloud.test(urlMestre)){
		pegaSoundCloud(event);
		}else if(mixCloud.test(urlMestre)){
		//pegaMixCloud(event);
		}else{
		return false;
		}
}


function pegaZippyTune(){
	$('#load_upload').fadeIn(500);
	event.preventDefault();
    	$.ajax({
        type: "get", // GET nessesário
        dataType: "html",
        url: 'php/pega_som_zippy_tune.php',
        data: $("#form_upload").serialize(),
        	success: function (response) {
				$('#top').animate({height: "220px"}, 500);
				$('#load_upload').fadeOut(500);
				
			$("#resposta_upload").html(response).hide(0);
			setTimeout('showUploadTop()', 400);
			}
	});
}


function pegaMixCloud(){
	$('#load_upload').fadeIn(500);
	event.preventDefault();
    	$.ajax({
        type: "get", // GET nessesário
        dataType: "html",
        url: 'php/pega_som_mix_cloud.php',
        data: $("#form_upload").serialize(),
        	success: function (response) {
				$('#top').animate({height: "220px"}, 500);
				$('#load_upload').fadeOut(500);
				
			$("#resposta_upload").html(response).hide(0);
			setTimeout('showUploadTop()', 400);
			}
	});
}

function pegaSoundCloud(){
	
	$('#load_upload').fadeIn(500);
	
SC.oEmbed("http://soundcloud.com/forss/flickermood", {auto_play: true}, function(oembed){
    console.log("oEmbed response: ", oembed);
  });

}
*/













