<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_senkron = "localhost";
$database_senkron = "senkron_uzem";
$username_senkron = "root";
$password_senkron = "";
$senkron = mysql_pconnect($hostname_senkron, $username_senkron, $password_senkron) or trigger_error(mysql_error(),E_USER_ERROR); 
?>