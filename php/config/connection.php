<?php
// ON

define('BD_USER', 'djportco_user');
define('BD_PASS', 'leggocom5');
define('BD_NAME', 'djportco_db');

// OFF
/*
define('BD_USER', 'root');
define('BD_PASS', '');
define('BD_NAME', 'djport_db');
*/
mysql_connect('localhost', BD_USER, BD_PASS);
mysql_select_db(BD_NAME);
 
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

?>