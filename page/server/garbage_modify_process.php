<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/conf.php";
	
	//관리자 권한체크  
	check_admin();
	
	$id = $_POST["id"]; //업로드 고유 아이디를 받아서
	$addr = $_POST["addr"];
	$garbage_type = $_POST["garbage_type"];
	$memo = $_POST["memo"];
	
	$mb_id = $_SESSION["ss_id"];; //로그인 한아이디 세션에서 가져오기   
	
	//db key 값과 회원아이디로 DB에서수정
	if($id && $mb_id){ 
		$query = "update garbage set addr = '".$addr."' , garbage_type = '".$garbage_type."' , memo =  '".$memo."'  where id = '".$id."'";
		mysqli_query($link, $query);	
	}
	echo("<script>alert('수정되었습니다')</script>");
	echo("<meta http-equiv='refresh' content='0; url=/page/server/garbage_modify.php?id=".$id."'>");

?>