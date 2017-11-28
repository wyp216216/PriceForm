<?php
	header("Content-type:text/html;charset=utf-8");
	$servername = 'localhost';
	$username = 'root';
	$password = 'admin';
	$dbname = 'oa_con';
	
//	连接数据库
	function open_table($servername, $username, $password, $dbname){
		if($dbname==null){
			$conn = new mysqli($servername, $username, $password);
			if ($conn->connect_error) {
			    die("连接失败: " . $conn->connect_error);
			} 
			echo "连接成功";
		}else{
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			    die("连接失败: " . $conn->connect_error);
			} 
			echo "连接成功";
		}
	};
	
//	创建数据库
	function add_table($servername, $username, $password, $myDB){
		$conn = new mysqli($servername, $username, $password);
		$sql="CREATE DATABASE ".$myDB;
		if($conn->query($sql) === TRUE){
			echo "创建成功！";
		}else{
			echo "Error creating database: " . $conn->error;
		}
	};
	
//	创建数据表
	function add_sheel($servername, $username, $password, $myDB,$sheel, $sql_arr){
		$conn = new mysqli($servername, $username, $password,$myDB);
		$k='';
		for($i=0;$i<count($sql_arr);$i++){
			$k.="`".$sql_arr[$i]."` VARCHAR(30) NOT NULL,";
		};
		$sql = "CREATE TABLE `".$sheel."` (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ".$k."reg_date TIMESTAMP)ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8";
		echo $sql;
		if ($conn->query($sql) === TRUE) {
		    echo "Table MyGuests created successfully";
		} else {
		    echo "创建数据表错误: " . $conn->error;
		}
	};
	
//	删除数据表
	function delete_sheel($servername, $username, $password, $myDB,$sheel){
		$conn = new mysqli($servername, $username, $password,$myDB);
		$sql = "DROP TABLE ".$sheel;
		if($conn->query($sql)===TRUE){
			echo "删除数据库成功！";
		}else{
			echo "删除数据库失败：".$conn->error;
		}
		
	}
	
//	添加数据
	function add_data($servername, $username, $password, $myDB, $sheel,$write){
		$conn = new mysqli($servername, $username, $password, $myDB);
		$i=0;
		$str='';
		$write=explode(',',$write);
		for($i=0;$i<count($write);$i++){
			$str.="'".$write[$i]."',";
		}
		$str=rtrim($str,",");
		$sql="describe ".$sheel;
		$result = $conn->query($sql);
		if ($result->num_rows) {
		    // 输出数据
		    while($row = $result->fetch_assoc()) {
		    	$r[$i]=$row['Field'];
				$i++;
		    }
			$result=array_pop($r);
			$result=array_shift($r);
			$r=implode(',',$r);
		} else {
		    echo "0 结果";
		}
		
		$sql = "INSERT INTO ".$sheel." (".$r.")
				VALUES (".$str.")";
				
		if ($conn->query($sql) === TRUE) {
		    echo "新记录插入成功";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	};
	
//	删除数据
	function delete_data($servername, $username, $password, $myDB, $sheel, $keyword, $data){
		$conn = new mysqli($servername, $username, $password, $myDB);
		$sql="DELETE FROM ".$sheel." WHERE ".$keyword."='".$data."'";
		if($conn->query($sql)===TRUE){
			echo "删除数据成功！";
		}else{
			echo $sql;
			echo "删除数据失败：".$conn->error;
		}
	};
	
//	输出数据
	function see_data($servername, $username, $password, $myDB, $sheel){
		$i=0;
		$r;
		$x=Array();
		$conn = new mysqli($servername, $username, $password, $myDB);
		$sql="describe ".$sheel;
		$result = $conn->query($sql);
		if ($result->num_rows) {
		    // 输出数据
		    while($row = $result->fetch_assoc()) {
		    	$r[$i]=Array($row['Field']);
				$i++;
		    }
			$result=array_pop($r);
			$result=array_shift($r);
		}
		$a=Array();
		$sql = "SELECT * FROM ".$sheel;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // 输出数据
		    while($row = $result->fetch_assoc()){
		    	for($i=0;$i<count($r);$i++){
		    		array_push($x,$row[$r[$i][0]]);
		    	}
		    }
			$a=array_chunk($x,count($r));
			$json_string = json_encode($a);
			$sheel=iconv('UTF-8', 'GBK',$sheel);
			echo $sheel;
			file_put_contents('../tableData/'.$sheel.'.json',$json_string);
		} else {
			$sheel=iconv('UTF-8', 'GBK',$sheel);
			file_put_contents('../tableData/'.$sheel.'.json','null');
		}
	};
	
//	输出数据库的所以列表
	function see_table($servername, $username, $password, $myDB){
    	$i=0;
		$conn = new mysqli($servername, $username, $password, $myDB);
		$sql = "show tables";
		$result = $conn->query($sql);
    	$table_sheel = Array();
		if ($result->num_rows > 0) {
		    // 输出数据
		    while($row = $result->fetch_assoc()) {
				$table_sheel[$i] = $row['Tables_in_'.$myDB];
				$i++;
		    }
		} else {
		    echo "0 结果";
		}
		return $table_sheel;
	};
	
//	查询数据表结构

	function see_data_head($servername, $username, $password, $myDB, $sheel){
		$i=0;
		$r=Array();
		$conn = new mysqli($servername, $username, $password, $myDB);
		$sql="describe ".$sheel;
		$result = $conn->query($sql);
		if ($result->num_rows) {
		    // 输出数据
		    while($row = $result->fetch_assoc()) {
		    	$r[$i]=Array(
				($row['Field']));
				$i++;
		    }
			$result=array_pop($r);
			$result=array_shift($r);
			$r=Array('header'=>$r);
			$json_string = json_encode($r);
			file_put_contents('field.json',$json_string);
		} else {
		    echo "0 结果";
		}
		
	}
	
//	查询数据
	function query_data($servername, $username, $password, $dbname, $sheel, $keyWord, $id,$paw){
		$con=mysqli_connect($servername, $username, $password, $dbname);
		$result = mysqli_query($con,"SELECT * FROM ".$sheel."
		WHERE ".$keyWord."='".$id."'");
		
		while($row = mysqli_fetch_array($result))
		{
			if(($row['username']==$id)&&($row['passname']==$paw)){
				$bool = true;
				return $bool;
			}else{
				$bool = false;
				return $bool;
			}
		};
	};
	
//	关闭数据库
	function close_table($servername, $username, $password, $dbname){
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn->close();
	};
?>