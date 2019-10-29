<?php session_start();
 
	require './vendor/autoload.php';
 
 	use PhpOffice\PhpSpreadsheet\Spreadsheet;
 	use PhpOffice\PhpSpreadsheet\IOFactory;
 
 	if ($_SESSION['ss_login_status'] != 'logged_in') { // 로그인 상태 확인
 		echo ("<script>alert('Log in first !!!');</script>");
		echo ("<meta http-equiv='refresh' content='0; url=../index.php?page=login'>");
	}
	else {
		require_once "../iccc/config.php";
		require_once "./include/dbconn.php";

		$id = $_SESSION['ss_id'];
		$name = $_SESSION['ss_name'];

		$timestamp_one_month_ago = time() - (30 * 24 * 60 * 60);
		$one_month_ago = date("Y-m-d 00:00:00",$timestamp_one_month_ago);

		$sql = "select * from $db_bbs_table where bb_writetime >= '$one_month_ago' order by bb_writetime desc" ;
		//echo $sql;
		$result = mysqli_query($link, $sql);

		//========================
		// 엑셀파일로 저장
		//========================
		/** PHP Spreadsheet */
		
		// Create new spreadsheet object
		$spreadsheet = new Spreadsheet();

		// Excel . . 문서 속성을 지정해주는 부분이다 적당히 수정하면 된다
		$spreadsheet->getProperties()->setCreator("김광희")
									->setLastModifiedBy("김광희")
									->setTitle("한 달 게시글")
									->setSubject("게시글 명단")
									->setDescription("한달이내 게시글 목록")
									->setKeywords("한달 게시글")
									->setCategory("게시글");
		// Worksheet title 설정
		$spreadsheet->getActiveSheet()->setTitle('한달 이내 글목록');

		// Excel . 파일의 각 셀의 타이틀을 정해준다
		$spreadsheet->setCellValue("A1", "ID")
		->setCellValue("B1", " 이름 ")
		->setCellValue("C1", " 글제목")
		->setCellValue("D1", " 작성시각");

		// for DB . 문을 이용해 에서 가져온 데이터를 순차적으로 입력한다
		// i (row) 변수 의 값은 엑셀쉬트에서 줄 값
		$i = 2;
		while ($rows = mysqli_fetch_object($result)) {
			$id = $rows->bb_id;
			$name = $rows->bb_name;
			$title = $rows->bb_title;
			$writetime = $rows->bb_writetime;
		
			// Add some data
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue("A".$i, "$id")
			->setCellValue("B".$i, "$name")
			->setCellValue("C".$i, "$title")
			->setCellValue("D".$i, "$writetime");
		
			$i++;
		} // while
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		
		$spreadsheet->setActiveSheetIndex(0);
		// utf-8 euc-kr . 파일의 저장형식이 일 경우 한글파일 이름은 깨지므로 로 변환해준다
		//$filename = iconv("UTF-8", "EUC-KR", " .xlsx"); 한달 게시글
		
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Content-Disposition: attachment;filename="excelfile.xlsx"');
		header('Cache-Control: max-age=0');
		
		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
	}// else
?>