<?php
$con = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS) or die(mysql_error());
mysql_select_db(MYSQL_DB, $con);
?>
