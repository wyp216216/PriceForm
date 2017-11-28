<?php
	require'mysql.php';
	$dbname = 'oa_con';
	$sheel=isset($_POST['sheel'])?$_POST['sheel']:'';
	$write=isset($_POST['write'])?$_POST['write']:'';
	add_data($servername, $username, $password, $dbname, $sheel,$write);
	see_data($servername, $username, $password, $dbname,$sheel);
?>