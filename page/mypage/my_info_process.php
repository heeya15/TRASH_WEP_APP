<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/include/conf.php";

$mb_id = $_SESSION["ss_id"]; //현재 로그인한 아이디 정보 가져오기 
$post_pw = trim($_POST['nm_pwd']);
$post_name = trim($_POST['nm_name']);

if($post_pw){ //비밀번호를 입력했다면 비밀번호도 수정 
	$sql = "update member set mb_password = '".$post_pw."' , mb_name = '".$post_name."' where mb_id = '".$mb_id."'";	
}else{ 
	$sql = "update member set mb_name = '".$post_name."' where mb_id = '".$mb_id."'";
}
$result = mysqli_query($link, $sql);
echo("<script>alert('변경되었습니다.')</script>");
echo("<meta http-equiv='refresh' content='0; url=/page/mypage/my_info.php'>");
?>