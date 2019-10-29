<?php
/// 게시글 밑 댓글 수정 php 이다.
session_start();
require_once "./include/base.js";

if ($_SESSION['ss_login_status'] != 'logged_in') { // 로그인 상태 확인
   echo ("<script>
   alert('Log in first !!!');
   </script>");
   echo ("<meta http-equiv='refresh' content='0; url=../index.php?page=login'>"); 
}
else { // 세션정보로 사용자 정보 세팅
   require_once "./iccc/config.php";
   require_once "./bbs/include/dbconn.php";
   
   $no = (int)$_GET['no']; 
   if (isset($_POST['nm_no'])) {
    $no = (int)$_POST['nm_no'];
    }
   
   $id = $_SESSION['ss_id'];
   $name = $_SESSION['ss_name'];
   
   $title = trim($_POST['nm_title']);
   $content = trim($_POST['nm_content']);
   
   $now = date("Y-m-d H:i:s", time());
   
   $sql = " update $db_bbs_table set bb_title = '$title', bb_content = '$content', ";
   $sql .= " bb_writetime = '$now' ";
   $sql .= " where bb_no = $no and bb_id = '$id' and bb_name = '$name' ";
   $sql .= " and bb_deleted = 0 limit 1 ";
   
   //echo $sql."<br>";
   //exit;
   
   $result = mysqli_query($link, $sql);
   
   if (mysqli_affected_rows($link) >= 1) {
      $msg = "The article is well updated.";
   }
   else {
      $msg = "The article was NOT updated !!!";
   }
   /*
   echo ("<script>
   alert('$msg');
   </script>");
   */
?>
   <!doctype html>
   <html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
      <!-- Latest compiled and minified CSS -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      
      <title><?=$site_name_abbr?></title>
      </head>
      <body>
         <div class="alert alert-success" role="alert">
            <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</s
pan></button> -->
            <?=$msg?>
            </div> 
         </body>
      </html>
<?php
      echo ("<meta http-equiv='refresh' content='0; url=./index.php?page=bbslist'>");
}//else
?>