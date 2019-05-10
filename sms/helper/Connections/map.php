<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_map = "localhost";
$database_map = "tfwsmg";
$username_map = "root";
$password_map = "";
$map = mysql_pconnect($hostname_map, $username_map, $password_map) or trigger_error(mysql_error(),E_USER_ERROR); 
?>