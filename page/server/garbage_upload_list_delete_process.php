<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/conf.php";

	//관리자 권한체크  
	check_admin();
	
	$id = $_GET["id"]; //업로드 고유 아이디를 받아서  
	
	//DB에서 삭제 
	if($id){
		$query = "delete from garbage where id = '".$id."'";
		mysqli_query($link, $query);	
	}
		
	echo("<script>alert('삭제되었습니다')</script>");
	echo("<meta http-equiv='refresh' content='0; url=/page/server/garbage_upload_list.php'>");

?>