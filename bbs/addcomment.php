<?php
session_start();

if ($_SESSION['ss_login_status'] != 'logged_in') {
   echo ("<script>
   alert('Plz. Log-In first !!!');
   </script>");
   echo ("<meta http-equiv='refresh' content='0; url=../index.php?page=login'>"); 
}
else { // 세션정보로 사용자 정보 세팅
   require_once "../iccc/config.php";
   
   $id = $_SESSION['ss_id'];
   $name = $_SESSION['ss_name'];
   
   $title = "";
   $comment = trim($_POST['nm_comment']);  //post 형식으루 name 의값을 가져오고 공백제거 해서 저장.
   
   if (isset($_GET['original_no'])) {
      $original_no = (int)$_GET['original_no'];
   }
   else {
      $original_no = 0;
   }
   
   require_once "./include/dbconn.php";
   $now = date("Y-m-d H:i:s", time());
   
   // make insert query depending on the # of uploaded files
   $sql = " insert into $db_bbs_table ( ";
   $sql .= " bb_originalno, bb_id, bb_name, bb_title, bb_content, bb_writetime, bb_deleted, ";
   $sql .= " bb_file1, bb_file2, bb_file3, bb_file4, bb_file5 ";
   $sql .= " ) values ( ";
   $sql .= " $original_no, '$id', '$name', '$title', '$comment', '$now', 0, ";
   $sql .= " '', '', '', '', '' ) ";
   
   //echo "SQL: ".$sql."<br>";
   
   $result = mysqli_query($link, $sql);
   
   
   
   if (mysqli_affected_rows($link) >= 1) {
      $msg = "New comment is well written.";
	   
	    //댓글 갯수 update 
	   	if($original_no > 0){
			mysqli_query($link,"update $db_bbs_table set bb_comment = bb_comment+1 where bb_no = '".$original_no."' AND bb_originalno = 0 ");
		}	
   }
   else {
      $msg = "New comment is NOT written !!!";
   }
   echo ("<script>
      alert('$msg');
      </script>");
   echo ("<meta http-equiv='refresh' content='0; url=../index.php?page=bbslist'>"); 
   } // else
?>