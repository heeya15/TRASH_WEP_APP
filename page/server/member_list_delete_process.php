<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/conf.php";

	//관리자 권한체크  
	check_admin();
	
	$mb_id = $_GET["mb_id"]; //회원아이디를 받아서 
	
	//DB에서 삭제 
	if($mb_id){
		$query = "delete from member where mb_id = '".$mb_id."'";
		mysqli_query($link, $query);	
	}
		
	echo("<script>alert('삭제되었습니다')</script>");
	echo("<meta http-equiv='refresh' content='0; url=/page/server/member_list.php'>");

?>