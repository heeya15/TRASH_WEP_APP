<?php
	require_once "conf.php";

	//관리자 권한체크  
	check_admin();
	
	$name = $_POST["gr_name"]; //업로드 고유 아이디를 받아서  
	
	//DB에서 삭제 
	if($name){
		$sql = "insert into garbage_type(name) values('".$name."') "; //해당 name 필드에 쓰레기 종류 입력받은값을 넣어준다
		$result=mysqli_query($link, $sql);	
	}
	if (mysqli_num_rows($result) <= 0) {	
		echo("<script>alert('등록되었습니다')</script>");
	}else{
		echo("<script>alert('error!!')</script>");
	}
	echo("<meta http-equiv='refresh' content='0; url= garbage_type.php'>");

?>