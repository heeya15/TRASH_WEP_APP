<?php

    require_once  $_SERVER["DOCUMENT_ROOT"]."/include/dbconn.php"; //db설정파일 
	
	require_once  $_SERVER["DOCUMENT_ROOT"]."/include/functions.php"; //함수 모음 파일 
	
    session_start();
   
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
 ?>
