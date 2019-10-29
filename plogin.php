<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>무제 문서</title>
</head>

<body>
<?php
session_start();
require_once("pdbcoon.php");
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
	 echo("<meta http-equiv='refresh' content='0,url=./index.php
'>");
 }
else {
		$msg = 'PWD';
		echo("<script>
	 alert('비밀번호가 틀렸습니다.');
	 </script>");
	 
echo("<meta http-equiv='refresh' content='0; url=./login.php'>");
	}
} else {
	$msg = 'ID';
	echo("<script>
	 alert('ID 가 틀렸습니다.');
	 </script>");
	echo("<meta http-equiv='refresh' content='0; url=./login.php'>");
}
?>
</body>
</html>
