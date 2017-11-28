<?php
	require 'mysql.php';
	$servername = 'localhost';
	$username = 'root';
	$password = 'admin';
	$dbname = 'oa_con';
	header("Content-type:text/html;charset:utf-8");
	$x = see_table($servername, $username, $password, $dbname);
	$json_string = json_encode($x);
	file_put_contents('ind.json',$json_string);
?>