<?php
	@session_set_cookie_params(3600,"/","../../Price/",true,TRUE);
	session_start();
	require 'mysql.php';

	$dbname = 'user';
	$id = isset($_POST['username'])?$_POST['username']:'';
	$paw = isset($_POST['password'])?$_POST['password']:'';
	$keyWord = 'username';
	function tesing(){
		global $servername, $username, $password, $dbname,$keyWord,$id,$paw;
		$bool = query_data($servername, $username, $password, $dbname,'admin',$keyWord,$id,$paw);
		if($bool==true){
			$_SESSION['id']=$id;
			$_SESSION['paw']=$paw;
			echo $bool;
		}else{
			echo $bool;
		}
	};
	tesing();

	
	close_table($servername, $username, $password,$dbname);
?> 