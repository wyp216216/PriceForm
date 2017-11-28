<?php
	require 'mysql.php';
	$dbname = 'oa_con';
	header("Content-type:text/html;charset='utf-8");
	$sheel = isset($_POST['sheel'])?$_POST['sheel']:'';
	delete_sheel($servername, $username, $password, $dbname, $sheel);
	$x = see_table($servername, $username, $password, $dbname);
	$json_string = json_encode($x);
	file_put_contents('ind.json',$json_string);
	close_table($servername, $username, $password, $dbname);
?>