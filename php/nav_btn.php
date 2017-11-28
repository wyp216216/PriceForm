<?php
	require 'mysql.php';
	$servername = 'localhost';
	$username = 'root';
	$password = 'admin';
	$dbname = 'oa_con';
	header("Content-type:text/html;charset:utf-8");
	$sheel = isset($_POST['sheel'])?$_POST['sheel']:'';
	see_data_head($servername, $username, $password, $dbname, $sheel);
	see_data($servername, $username, $password, $dbname, $sheel);
?>