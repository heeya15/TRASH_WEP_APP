<?php
	require_once "conf.php";

	
	$id = $_GET["id"]; //업로드 고유 아이디를 받아서
	$mb_id = $_SESSION["ss_id"];; //로그인 한아이디 세션에서 가져오기   
	
	//db key 값과 회원아이디로 DB에서삭제
	if($id && $mb_id){ 
		$query = " delete from garbage where id = '".$id."' AND mb_id = '".$mb_id."'" ;
		mysqli_query($link, $query);
		$sql = " UPDATE member SET mb_point = mb_point-1 where '$mb_id'= mb_id or '$mb_id'='admin' and mb_point>=0 ";
		mysqli_query($link,$sql);
		
		
	}
	
	echo("<script>alert('삭제되었습니다')</script>");
	echo("<meta http-equiv='refresh' content='0; url=garbage_upload_list.php'>");

?>