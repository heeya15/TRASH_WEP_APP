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
   if (isset($_GET['original_no'])) {
      $original_no = (int)$_GET['original_no'];
   }
   else{
      $original_no = 0;
   }
   
   
   // POST 변수 접수
   $title = $_POST['nm_title']; 
   $content = $_POST['nm_content']; 
   
   $enrolltime = date("Y-m-d H:i:s", time());
   
   $total_file_no = count($_FILES['nm_files']['name']); // 전체 업로드한 파일 수
   
   if ($total_file_no > $max_upload_file_no) $total_file_no = $max_upload_file_no; // 5
   
   if (!is_dir($upload_folder)) {
      //echo "Upload-folder created"."<br> ";
      mkdir($upload_folder, 0777, true);
   }
   
   $target_folder = $upload_folder."/";
   $name_array = $new_file_name = array();
   for ($ndx=0; $ndx<$total_file_no; $ndx++) {
      
      $file_name = basename($_FILES["nm_files"]["name"][$ndx]);
      //echo "file_name: ".$file_name."<br>";
      // change to a english_only filename
      $name_array = explode(".",$file_name);
      
      $new_file_name[$ndx] = (string)time().".".$name_array[1];
      //echo "new_file_name[".$ndx."]".$new_file_name[$ndx];
      
      $target_file = $target_folder.$new_file_name[$ndx]; // + 실제 저장된 파일경로 파일명
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {
         $check = getimagesize($_FILES["nm_files"]["tmp_name"][$ndx]);
         if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
            } else {
            //echo "File is not an image.";
            //$uploadOk = 0;
         }
      }
      // Check if file already exists
      if (file_exists($target_file)) {
         echo "Previous file will be replaced";
         //$uploadOk = 0;
      }
      // Check file size
      if ($_FILES["nm_files"]["size"][$ndx] > $max_file_size) {
         echo "Sorry, your file is too large.";
         $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
         && $imageFileType != "gif" && $imageFileType != "hwp" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" ) {
         //echo "Sorry, only image files, HWP, DOC, DOCX, PDF formats are allowed.";
         $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
         //echo "Sorry, your file was not uploaded.";
         $file_upload_ok[$ndx] = 0;
         // if everything is ok, try to upload file
         } else {
         //echo "Files:".$_FILES["nm_files"]["tmp_name"][$ndx]."<br>";
         if (move_uploaded_file($_FILES["nm_files"]["tmp_name"][$ndx], $target_file)) {
            // 원래 업로드할 때의 이름으로 파일명 변경
            $original_file_name[$ndx] = basename( $_FILES["nm_files"]["name"][$ndx]);
            $renamed_path[$ndx] = $target_folder.$original_file_name[$ndx];
            rename($target_file,$renamed_path[$ndx]);
            $file_upload_ok[$ndx] = 1;
            //echo "The file ". $renamed_file. " has been uploaded.<br>";
            } else {
            echo "Sorry, there was an error uploading your file.";
         }
      }
   }   //for $ndx
   require_once "./include/dbconn.php";
    $now = date("Y-m-d H:i:s", time());
   
   // make insert query depending on the # of uploaded files
   $sql = " insert into $db_bbs_table (" ;
   $sql .= " bb_originalno, bb_id, bb_name, bb_title, bb_content, bb_writetime, bb_deleted, ";
   $sql .= " bb_file1, bb_file2, bb_file3, bb_file4, bb_file5 ";
   $sql .= " ) values (" ;
   $sql .= " $original_no, '$id', '$name', '$title', '$content', '$now', 0 ";
   for ($i=0; $i < $max_upload_file_no; $i++) {
      if ($file_upload_ok[$i] == 1) $sql .= ", '$original_file_name[$i]'";
      else $sql .= ", ''";
   }
   $sql .= " ) ";
   
   //echo "SQL: ".$sql."<br>";
   
   $result = mysqli_query($link, $sql);
   
   if (mysqli_affected_rows($link) >= 1) {
      $msg = "New article is well written.";
   }
   else {
      $msg = "Article is NOT written !!!";
   }
   echo ("<script>
   alert('$msg');
   </script>");
   echo ("<meta http-equiv='refresh' content='0; url=../index.php?page=bbslist'>"); 
   } // else
?>