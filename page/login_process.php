<?php
require_once "include/dbconn.php"; //db설정파일 
//require_once $_SERVER["DOCUMENT_ROOT"]."/gimal2/include/conf.php"; //db 연결 과 , 변수 정의가 되있는 php 다.
$post_id = trim($_POST['nm_id']);
$post_pw = trim($_POST['nm_pwd']);

$sql = " select * from member where mb_id = '$post_id' limit 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 1) {
	$sql = " select * from member where ";
	$sql .= " mb_id = '$post_id' and mb_password = '$post_pw' limit 1";
	$result = mysqli_query($link, $sql);
	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_object($result);
		$_SESSION['ss_name'] = $row -> mb_name;
		$_SESSION['ss_login_status'] = "logged_in";
		$_SESSION['ss_id'] = trim($_POST['nm_id']);
		$msg = 'OK';
		echo("<meta http-equiv='refresh' content='0; url=./index.php'>");
	} else {
		$msg = 'PWD';
		echo("<script>alert('Password is Wrong !!!')</script>");
		echo("<meta http-equiv='refresh' content='0; url=/index.php'>");
	}
} else {
	$msg = 'ID';
	echo("<script>alert('ID is Wrong or Inactive !!!')</script>");
	echo("<meta http-equiv='refresh' content='0; url=/index.php'>");
}
?>