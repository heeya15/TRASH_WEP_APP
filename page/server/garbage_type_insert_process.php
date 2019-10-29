<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/conf.php";

	//관리자 권한체크  
	check_admin();
	
	$name = $_POST["name"]; //업로드 고유 아이디를 받아서  
	
	//DB에서 삭제 
	if($name){
		$query = "insert into garbage_type(name) values('".$name."') ";
		$result=mysqli_query($link, $query);	
	}
	if (mysqli_num_rows($result) <= 0) {	
		echo("<script>alert('등록되었습니다')</script>");
	}else{
		echo("<script>alert('error!!')</script>");
	}
	echo("<meta http-equiv='refresh' content='0; url=/page/server/garbage_type.php'>");

?>