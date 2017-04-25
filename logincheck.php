<?php 
$username = $_POST['id'];
$cookie = $_POST['login'];
$pdo = new PDO('mysql:host=localhost;dbname=user','root','hal9396');
$sql = "SELECT * FROM `userinfo` WHERE `username`='{$username}'";
$stmt = $pdo->query($sql);
if ($stmt) {
	foreach ($stmt as $key => $value) {
		if ($cookie != $value['uniqid']) {
			echo '{"success":"true"}';
		} else {
			echo '{"success":"false"}';
		}
	}
}

 ?>