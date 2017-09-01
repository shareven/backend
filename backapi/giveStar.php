<?php 

	header("Content-type: text/html; charset=utf-8"); 
	/*指定允许其他域名访问*/  
	header('Access-Control-Allow-Origin:*');
	/*响应类型 */ 
    header('Access-Control-Allow-Methods:POST');  
	/*响应头设置  */
 	header('Access-Control-Allow-Headers:x-requested-with,content-type');
	
	$lid = $_POST['lid'];
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
		$sql = "SELECT * FROM `leavemsg` WHERE `lid`= '$lid' ";
		
		if($result = mysqli_query($connection,$sql)){
			if($row = mysqli_fetch_assoc($result)){
				$stars=$row['stars']+1;

				$getSql = "UPDATE `leavemsg` SET `stars` = '$stars' WHERE `lid` = '$lid';";
				$getResult = mysqli_query($connection,$getSql);
				if($getResult && mysqli_affected_rows($connection)){
					$data = array('code'=>1,'mesg'=>"点赞成功",'stars'=>$stars);
				}else{
					$data = array('code'=>-1,'mesg'=>"点赞失败：".mysqli_error($connection)."改变数据数为".mysqli_affected_rows($connection));
				}
			}	
		}else{
			$data = array('code'=>0,'mesg'=>"点赞失败：".mysqli_error($connection)."改变数据数为".mysqli_affected_rows($connection));
		}
	}

	mysqli_close($connection);
	// $jsonp="userData";
	// 转换格式
	$dataToJson = json_encode($data);
	// 输出
	// echo $jsonp.'('.$dataToJson.')';输出函数
	echo $dataToJson;
	exit();
 ?>
 