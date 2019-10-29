<?php

	 require_once $_SERVER["DOCUMENT_ROOT"]."/include/conf.php";
	
	 // POST 변수 접수
  	 $addr = $_POST['addr']; 
	 $region1=$_POST["region1"];
	 $region2=$_POST["region2"];
	 $region3=$_POST["region3"];
	 $map_x=$_POST["map_x"];
	 $map_y=$_POST["map_y"];
  	 $garbage_type = $_POST['garbage_type'];
  	 $memo = $_POST['memo']; 
   
	  if (!is_dir($upload_folder)) { //업로드할폴더가 존재하지않으면 
    	  mkdir($upload_folder, 0777, true);  //폴더 생성후 권한부여 
	  }
	  
      $target_folder = $upload_folder."/"; //업로드할 폴더 하위에(안으로 들어가서)
      
      $name_array = $new_file_name = array();
      $file_name = basename($_FILES["camera"]["name"]); //파일명
      $original_file_name = "";//원본 파일 이름 초기화 
      if($file_name){
	      $name_array = explode(".",$file_name);//해당파일명에서 .을 구분자로 배열에 담기(파일명을 유니크하게 만들기위함)
	      
	      $new_file_name = (string)time().".".$name_array[1]; //파일명을 현재시간 + 확장자로 지정 
	      
	      $target_file = $target_folder.$new_file_name; // + 실제 저장된 파일경로 파일명
	      
	      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //확장자 찾기 
		  
		  $uploadOk = 1;
	      // Check if file already exists
	      if (file_exists($target_file)) { //해당파일이 이미존재하면 
	         echo "Previous file will be replaced";
	      	$uploadOk = 0;
	      }
		  
	      // Check file size
	      if ($_FILES["camera"]["size"] > $max_file_size) { //파일사이즈를 초과했을경우
	         echo "Sorry, your file is too large.";
	         $uploadOk = 0;
	      }
		  
		   //이미지 파일 확장자 체크 
	      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
	         echo "Sorry, only image files, HWP, DOC, DOCX, PDF formats are allowed.";
	         $uploadOk = 0;
	      }
	      
	      //Check if $uploadOk is set to 0 by an error
	      if ($uploadOk == 0) { //업로드성공한파일이 0개라면 
	         	$file_upload_ok = 0;
	      }else {  //업로드성공한파일이 1개이상이면 
	         	if (move_uploaded_file($_FILES["camera"]["tmp_name"], $target_file)){  //파일업로드
		            // 원래 업로드할 때의 이름으로 파일명 변경
		            $original_file_name = basename( $_FILES["camera"]["name"]);//업로드한 파일명
		            $renamed_path = $target_folder.$original_file_name; //업로드한 파일경로 
		            rename($target_file,$renamed_path);  //파일이름 수정
		            $file_upload_ok = 1;
	            } else {
	            	echo "Sorry, there was an error uploading your file.";
	         	}
	      }	
      }
		 
 	 //db 에저장 
 	 $yoil = get_yoil(date("Y-m-d"));
 	 $time = date("H");
  	 $sql = "INSERT INTO `garbage` (`mb_id`,`file_name`,`garbage_type`, `addr`,`region1`,`region2`,`region3`,`map_x`,`map_y`,`memo`,`regdate`,`yoil`,`time`) VALUES ('".$_SESSION["ss_id"]."','".$original_file_name."','".$garbage_type."', '".$addr."','".$region1."','".$region2."','".$region3."','".$map_x."','".$map_y."', '".$memo."',now(),'".$yoil."','".$time."');";
     $result = mysqli_query($link, $sql);
   
     if (mysqli_affected_rows($link) >= 1) {
	      $msg = "등록이 완료되었습니다.";
		 
		 //등록완료시 포인트 +1 
		 mysqli_query($link,"update member set mb_point = mb_point+1 where mb_id = '".$_SESSION["ss_id"]."'");
	 }else {
	      $msg = "등록에 실패하였습니다.";
	 }
	alert_go("/page/camera.php",$msg);
?>