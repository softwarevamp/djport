<?php
  $Aux = $_POST['imagem'];
  $snapshot = fopen('snapshot.txt', 'w+');
  fwrite($snapshot,($Aux));
  fclose($snapshot);
?>