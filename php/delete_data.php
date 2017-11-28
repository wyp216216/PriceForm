<?php
	require 'mysql.php';
	$dbname = 'oa_con';
	header("Content-type:text/html;charset='utf-8");
	$sheel = isset($_POST['sheel'])?$_POST['sheel']:'';
	$keyword = isset($_POST['keyword'])?$_POST['keyword']:'';
	$data = isset($_POST['data'])?$_POST['data']:'';
	delete_data($servername, $username, $password, $dbname, $sheel,$keyword,$data);
	close_table($servername, $username, $password, $dbname);
?>