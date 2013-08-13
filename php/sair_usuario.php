<?php

session_start();
ob_start();
unset($_SESSION['id']);
session_destroy();

echo '<script>location.href="./";</script>';
echo '<meta http-equiv="refresh" content="5; url=./">';


?>