<?php
 session_start();
 require_once("pdbcoon.php");
	
 require_once("functions.php");
   
	
	date_default_timezone_set('Asia/Seoul');
   
    $site_name_abbr = "Garbage Location";  // 모바일 경우 이름
	$site_name_full = "Garbage Location Application Html";
	$licence_name_abbr = "Garbage Location";
	$licence_name_full = "Garbage Location Application Html";

    $upload_folder = "./uploads";
	$upload_folder_from_bbs = "./bbs/uploads/";

	$foundation_name = "CODE-AI";
	$base_folder = "iccc";
	
	$upload_folder = "../uploads";
	$max_upload_file_no = 5;
	$max_file_size = 500000000;
	
	$article_no_per_page = 5; // 한 페이지에 보여줄 게시글 수
	$max_display_page_no = 5; // 게시판 아래 , 보여줄 최대 페이지 링크 수1


	//다음 map api key 
	$map_api_key = "2588437a7382afb6e3857d35f41835a8";
	
	
	//쓰레기 마커이미지 이미지 (종류별로 구분)
	$garbage_type_img_arr = array(
	'플라스틱' => "plastic.png",
	'캔' => "can.png",
	'유리병' => "glass.png",
	'페트병' => "pet.png",
	'기타' => "etc.png",
	);
 ?>
