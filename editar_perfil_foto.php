<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>

<?php
$session_id = $_SESSION['id'];
$sql = mysql_query("SELECT * FROM pre_imagem_perfil WHERE id_relacional='$session_id'");
$img_perfil = mysql_fetch_object($sql);
?>
<script type="text/javascript">
var id_relacional = "<?php echo $session_id;?>";
$(function() {
		$('#foto-perfil').uploadify({
			'swf'      : 'uploadify/uploadify.swf',
			'uploader' : 'php/upload_imagem_perfil.php?djport='+id_relacional+'',
			'auto'      : true, // False para não começar automaticamente, e True para começar o upload automaticamente.
    		'multi'     : false, // False para fazer upload apenas de um arquivo e True para vários arquivos. 
			'onUploadStart': function (file) {
				$('#load_img_profile').show(0);
                var cliente = $("#img-profile").val()
                var formData = { '#edita-perfil': cliente }
                $('#foto-perfil').uploadify("settings", "formData", formData);
            },
	
			'onUploadComplete': function () { 
			refreshRightSide($('#showFoto').load('editar_perfil_foto.php?djport='+id_relacional+''));
			$('#load_img_profile').hide(0);
			}
		});	
});
</script>

 <?php
 
$imagem_temp = "img/img-profiles/".$img_perfil->foto;
$img = getimagesize($imagem_temp);

$img_width = trim($img[0]);
$img_height = trim($img[1]);
 
 if($img_width >= $img_height){
 echo'
<div id="img-profile" style="background:#FFF url(img/img-profiles/'.$img_perfil->foto.') no-repeat center center;background-size:auto 100%;"><input type="file" name="foto-perfil" id="foto-perfil">
<img style="margin:80px 0px 0px -38px;float:left;width:40px;height:40px;display:none;" id="load_img_profile" src="img/loader_small.gif" />
</div>
';
 }elseif($img_width <= $img_height){
 echo'
<div id="img-profile" style="background:#FFF url(img/img-profiles/'.$img_perfil->foto.') no-repeat center center;background-size:100% auto;"><input type="file" name="foto-perfil" id="foto-perfil">
<img style="margin:80px 0px 0px -38px;float:left;width:40px;height:40px;display:none;" id="load_img_profile" src="img/loader_small.gif" />
</div>
';
 }
?>





