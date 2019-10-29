<?php
session_start();
require_once "conf.php";
$post_id = trim($_POST['nm_id']); //id 
$post_pw = trim($_POST['nm_pwd']);  //비번
$post_name = trim($_POST['nm_name']); //이름
$sql = " select * from member where mb_id = '$post_id' limit 1";
$result = mysqli_query($link, $sql);
$now = date("Y-m-d H:i:s",time());
if (mysqli_num_rows($result) <= 0) {
	$sql = "insert into member ( mb_id, mb_password, mb_name,mb_datetime) values ( '$post_id', '$post_pw', '$post_name', '$now' )";
	$result = mysqli_query($link, $sql);
	if (mysqli_affected_rows($result)<= 0) {
		$row = mysqli_fetch_object($result);
		$_SESSION['ss_name'] = $post_name;
		$_SESSION['ss_login_status'] = "logged_in";
		$_SESSION['ss_id'] = $post_id;
		echo ("<meta http-equiv='refresh' content='0; url=./index.php'>");
} 
else {  // 다 입력을 하지않을때 , 즉 조건이 맞지않을경우 
		echo("<script>alert('Subscription Error !!!')</script>");
		echo ("<meta http-equiv='refresh' content='0; url=./login.php'>");
	}
}  // if 문 닫는부분
 else {  //  id 가 동일한게 있는경우
		echo ("<script>alert('동일한 아이디가 있습니다. !!!')</script>"); //동일한 아이디가 있는경우
		echo ("<meta http-equiv='refresh' content='0; url=./login.php'>");
 }
 
?>