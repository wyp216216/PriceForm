<?php
	session_start();
	$ses = isset($_SESSION['id'])?$_SESSION['id']:'';
	if($ses!==false&&$ses!==null){
		setcookie('id',$ses);
		setcookie('password',$ses);
		echo $ses;
	}else{
		echo $ses;
	}
?>