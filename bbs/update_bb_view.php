<?php
	require_once "../iccc/config.php" ;
	require_once "./include/dbconn.php" ;
	//조회수 업데이트 
	$article_no  = $_POST["article_no"];
	if($article_no > 0){
		mysqli_query($link,"update $db_bbs_table set bb_view = bb_view+1 where bb_no = '".$article_no."' AND bb_originalno = 0 ");
	}	
	exit;
?>
