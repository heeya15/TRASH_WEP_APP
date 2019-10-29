<?php
  function alert_go($url,$msg = ""){
	   echo ("<script>alert('$msg');</script>");
	   echo ("<meta http-equiv='refresh' content='0; url=".$url."'>"); 
  }
  
  //관리자 체크 
  function check_admin(){
  		if($_SESSION['ss_id'] != "admin"){
  			echo "관리자아아디로 로그인해주세요.";
  			exit;
  		}
  }
  
  //요일정보 가져오기
  function get_yoil($date){
  	 $yoil = array("일","월","화","수","목","금","토");
	 return $yoil[date('w', strtotime($day))];
  }
  
  
?>