<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=user','root','hal9396');
$username = $_POST['username'];
$userpass = $_POST['userpass'];
$sql = "SELECT * FROM `userinfo` WHERE username = '{$username}' AND userpass = '{$userpass}'";
$stmt = $pdo->query($sql);
if (!$stmt) {
	alt('帐号或密码不正确','login.php');
}
foreach ($stmt as $key => $value) {
    if (!$_COOKIE['uniqid'] && $value['userstatus'] == 0 || !$_COOKIE['uniqid'] && $value['userstatus'] == 1 || $_COOKIE['uniqid'] && $_COOKIE['uniqid'] != $value['uniqid']  && $value['userstatus'] == 1) {
        $uniqid = md5(uniqid(mt_rand(),1));
        setcookie('uniqid',$uniqid);
        $id = $username;
        setcookie('id',$id);
		$sql = "UPDATE `userinfo` SET `userstatus`=1,uniqid='{$uniqid}' WHERE id = {$value['id']}";
		$stmt = $pdo->query($sql);
		if ($stmt) {alt('登陆成功','index.php');}
	} /*elseif (!$_COOKIE['uniqid'] && $value['userstatus'] == 1 || $_COOKIE['uniqid'] && $_COOKIE['uniqid'] != $value['uniqid']  && $value['userstatus'] == 1) {
		$uniqid = md5(uniqid(mt_rand(),1));
		setcookie('uniqid',$uniqid);
//		$_SESSION['username'] = $id;
		setcookie('id',$id);
		$sql = "UPDATE `userinfo` SET `userstatus`=1,`uniqid`='{$uniqid}' WHERE `id` = {$value['id']}";
		$stmt = $pdo->query($sql);
		if ($stmt) {alt('登陆成功','index.php');}
	}*/ /*elseif ($_COOKIE['uniqid'] && $value['userstatus'] == 1) {
		if ($_COOKIE['uniqid'] != $value['uniqid']) {
			alt('你的帐号已在另一台设备登录！','login.php');
		}
	}*/
}

if ($_GET['user'] == 'loginout') {
	if ($stmt) {
		foreach ($stmt as $key => $value) {
			$sql = "UPDATE `userinfo` SET `userstatus`=0,uniqid='' WHERE id = {$value['id']}";
			$stmt = $pdo->query($sql);
			echo "string";
			if ($stmt) {
				alt('注销','login.php');			
			}
		}
	}
	$_COOKIE['uniqid'] = null;
}

function alt($msg,$url) {
	echo "<script>alert('$msg');location.href='$url'</script>";
}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>登录</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
 	<script type="text/javascript">
 	// setInterval(function(){
 		$.ajax({
 			url:'logincheck.php',
 			data:{
 				login:'<?php echo $_COOKIE['uniqid']; ?>',
 				id:'<?php echo $_COOKIE['id']; ?>'
 			},
 			type:'post',
 			dataType:"json",
 			success:function(data){
				if (data.success == 'true') {
					alert('你的帐号已在另一台设备登录！');
					location.href="login.php";
				}
			},
 			error:function(jqXHR){
 				alert(jqXHR.status);
 			}
 		});
 	// },1000);
 	</script>
 </body>
 </html>