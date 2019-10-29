<?php
    session_start();
   
    if ($_SESSION['ss_login_status'] != 'logged_in') { // 로그인 상태 확인
         echo ("<script>alert('Log in first !!!');</script>");
         echo ("<meta http-equiv='refresh' content='0; url=../index.php?page=login'>");
   }
   else {                // 세션정보로 사용자 정보 세팅
          require_once "../iccc/config.php";
          require_once "./include/dbconn.php";
      
       $no = (int)$_GET['no'];
      
       $id = $_SESSION['ss_id'];
       $name = $_SESSION['ss_name'];
      
       $sql = " update $db_bbs_table set bb_deleted = 1 where ";
       $sql .= " bb_no = $no and bb_id = '$id' and bb_name = '$name' ";
       $sql .= " and bb_deleted = 0 limit 1 ";
      
       //echo $sql."<br>";
      //exit;
      
       $result = mysqli_query($link, $sql);
      
       if (mysqli_affected_rows($link) >= 1) {
             $msg = "The article is well deleted.";
       }
       else {
         $msg = "The article was NOT deleted !!!";
       }
	  echo ("<script>alert('$msg');</script>");
	  echo ("<meta http-equiv='refresh' content='0; url=../index.php?page=bbslist'>");
    } //else
?> 