<?php 

	header("Content-type: text/html; charset=utf-8"); 
	/*指定允许其他域名访问*/  
	header('Access-Control-Allow-Origin:*');
	/*响应类型 */ 
    header('Access-Control-Allow-Methods:POST');  
	/*响应头设置  */
 	header('Access-Control-Allow-Headers:x-requested-with,content-type');
	
	$username = $_POST['username'];
	$eid = $_POST['eid'];
	$comment = $_POST['comment'];
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
	 /*设置utf8编码，避免数据库乱码*/ 
	 mysqli_query($connection,"set names utf8");

	if(mysqli_connect_errno($connection)){
		$data = array('code'=>-2,'mesg'=>"网络连接异常".mysqli_connect_error(), 'date'=>$date);
	}else{
		
		$sqlcomments = "INSERT INTO `comments` (`username`, `eid`, `comment`, `date`) VALUES('$username', '$eid','$comment', '$date')";
		$result = mysqli_query($connection,$sqlcomments);
		if($result){
			//评论成功
			$data = array('code'=>1,'mesg'=>"评论成功", 'date'=>$date);
			// 修改experience表中的评论数
			$sql = "SELECT * FROM `experience` WHERE `eid`= '$eid' ";
		
			if($result = mysqli_query($connection,$sql)){
				if($row = mysqli_fetch_assoc($result)){
					$commentsnum =$row['commentsnum']+1;
					$getSql = "UPDATE `experience` SET `commentsnum` = '$commentsnum' WHERE `eid` = '$eid';";
					$getResult = mysqli_query($connection,$getSql);
					if($getResult && mysqli_affected_rows($connection)){
						
					}else{
						$data = array('code'=>-3,'mesg'=>"修改评论数失败".mysqli_error($connection)."改变数据数为".mysqli_affected_rows($connection));
					}
				}	  
			}else{
				$data = array('code'=>-4,'mesg'=>"修改评论数失败：".mysqli_error($connection)."改变数据数为".mysqli_affected_rows($connection));
			}

		}else{
			$data = array('code'=>0,'mesg'=>"评论失败：".mysqli_error($connection), 'date'=>$date);
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
 