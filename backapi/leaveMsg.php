<?php 

	header("Content-type: text/html; charset=utf-8"); 
	/*指定允许其他域名访问*/  
	header('Access-Control-Allow-Origin:*');
	/*响应类型 */ 
    header('Access-Control-Allow-Methods:POST');  
	/*响应头设置  */
 	header('Access-Control-Allow-Headers:x-requested-with,content-type');
	
	$username = $_POST['username'];
	$message = $_POST['message'];
	$date = $_POST['date'];

	/*入库*/
	$host = "localhost";
	$user = "root";
	$pwd = "";
	$dbname = "regandlogin";
	/*$host = "bdm288172216.my3w.com";
	$user = "bdm288172216";
	$pwd = "xrw920406";
	$dbname = "bdm288172216_db";*/
	$connection = mysqli_connect($host,$user,$pwd,$dbname);
	/*设置utf8编码，避免乱码*/
	mysqli_query($connection,"set names utf8");
	if(mysqli_connect_errno($connection)){
		$data = array('code'=>-2,'mesg'=>"网络连接异常".mysqli_connect_error(), 'date'=>$date);
	}else{
		
		$sql = "INSERT INTO `leavemsg` (`username`, `message`, `date`) VALUES('$username', '$message', '$date')";
		$result = mysqli_query($connection,$sql);
		if($result){
			$data = array('code'=>1,'mesg'=>"留言成功", 'date'=>$date);
		}else{
			$data = array('code'=>0,'mesg'=>"留言失败", 'date'=>$date);
		}
	}
	// $jsonp="userData";
	// 转换格式
	$dataToJson = json_encode($data);
	// 输出
	// echo $jsonp.'('.$dataToJson.')';输出函数
	echo $dataToJson;
	exit();
 ?>
 