<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/include/conf.php";
$post_id = trim($_POST['nm_id']);
$post_pw = trim($_POST['nm_pwd']);
$post_name = trim($_POST['nm_name']);
$sql = " select * from member where mb_id = '$post_id' limit 1";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) <= 0) {
	$sql = "insert into member ( mb_id, mb_password, mb_name,mb_datetime) values ( '$post_id', '$post_pw', '$post_name', now() )";
	$result = mysqli_query($link, $sql);
	if ($result) {
		$row = mysqli_fetch_object($result);
		$_SESSION['ss_name'] = $post_name;
		$_SESSION['ss_login_status'] = "logged_in";
		$_SESSION['ss_id'] = $post_id;
	} else {
		echo("<script>alert('Subscription Error !!!')</script>");
	}
} else {
	echo("<script>alert('The same ID exists !!!')</script>");
}
echo("<meta http-equiv='refresh' content='0; url=/index.php'>");
?>