<?php
	require 'mysql.php';
	
	$dbname='oa_con';
	header("Content-type:text/html;charset:utf-8");
	$sql_head = isset($_POST['sql_head'])?$_POST['sql_head']:'';
	$sql_content = isset($_POST['sql_content'])?$_POST['sql_content']:'';
	$sql_arr = explode(',',$sql_content);
	echo $sql_head;
	echo $sql_content;
	print_r ($sql_arr);
	$k='';
	see_data_head($servername, $username, $password, $dbname,'admin');
	add_sheel($servername, $username, $password, $dbname, $sql_head, $sql_arr);
	$x = see_table($servername, $username, $password, $dbname);
	$json_string = json_encode($x);
	file_put_contents('ind.json',$json_string);
	close_table($servername, $username, $password, $dbname);
?>