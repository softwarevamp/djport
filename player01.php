<?php session_start(); $segura = "active" ;?>
<?php include 'php/config/connection.php'; error_reporting ( E_ALL & ~ E_NOTICE ); ?>
<?php

$id_musica = $_GET['musica'];

$sql = mysql_query("SELECT * FROM musicas WHERE id_musica='$id_musica'");
$player = mysql_fetch_object($sql);


echo $id_musica."<br />";
echo $player->url_musica;
?>


<canvas id="waveform_hover"></canvas>

    
    <script>
$(document).ready(function($){
  
    var wavesurfer = (function () {
        'use strict';

        var wavesurfer = Object.create(WaveSurfer);

        wavesurfer.init({
            canvas        : document.querySelector('#waveform_hover'),
            fillParent    : true,
            markerColor   : 'rgba(0, 0, 0, 0.5)',
            frameMargin   : 0.1,
            maxSecPerPx   : parseFloat(location.hash.substring(1)),
            scrollParent  : true,
            loadPercent   : true,
            waveColor     : '#ea8c52',
            progressColor : '#ea8c52',
            loadingColor  : '#ea8c52',
            cursorColor   : 'transparent'
        });

        wavesurfer.load('waveformgenerator/outronome.mp3');

        return wavesurfer;
    }());

    $('#save-canvas').bind('click',function(e){

        var oCanvas = document.getElementById("waveform_normal");

        Canvas2Image.saveAsPNG(oCanvas);  // will prompt the user to save the image as PNG.
        e.preventDefault();
    })

});
	</script>
    <script src="waveformgenerator/src/canvas2image.js"></script>
    <script src="waveformgenerator/src/base64.js"></script>
    <script src="waveformgenerator/src/wavesurfer.js"></script>
    <script src="waveformgenerator/src/webaudio.js"></script>
    <script src="waveformgenerator/src/drawer.js"></script>
    
    EXISTE