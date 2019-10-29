<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/conf.php";

	
	$id = $_GET["id"]; //업로드 고유 아이디를 받아서
	$mb_id = $_SESSION["ss_id"];; //로그인 한아이디 세션에서 가져오기   
	
	//db key 값과 회원아이디로 DB에서삭제
	if($id && $mb_id){ 
		$query = "delete from garbage where id = '".$id."' AND mb_id = '".$mb_id."'";
		mysqli_query($link, $query);	
	}
	
	echo("<script>alert('삭제되었습니다')</script>");
	echo("<meta http-equiv='refresh' content='0; url=/page/mypage/garbage_upload_list.php'>");

?>