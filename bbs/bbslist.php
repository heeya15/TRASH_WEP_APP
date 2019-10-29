<?php
session_start();

$bbs_title1 = "BOARD";

if ($_SESSION['ss_login_status'] != 'logged_in') { // 로그인 상태 확인
	echo ("<script>
	alert('Log in first !!!');
	</script>");
	echo ("<meta http-equiv='refresh' content='0; url=./index.php?page=login'>"); 
}
else{	// 세션정보로 사용자 정보 세팅
	require_once "./bbs/include/dbconn.php";

	$id = $_SESSION['ss_id'];
	$name = $_SESSION['ss_name'];
	
	$today = date("Y-m-d",time()); 
?>
<h4 style="text-align:center"><?=$bbs_title1?></h4>
<br>
<div class="row" style="    width: 250px;margin-left:10px;">
		    <form method="get" action="./index.php">
		    	<input type="hidden" name="page" value="bbslist" />
		    	<div class="input-group">
                <input type="text" name="keyword" class="form-control" value="<?=$_GET["keyword"] ?>">
                <span class="input-group-btn">
                    <button class="btn btn-default" style="height: 34px;" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
          	  </div>
           </form> 
</div>


<div>
<?php
		if ($_GET['act'] != 'modify') { 
?>
	<p style="text-align:right"><a href="#write_table"><button>Write a New Article</button></a></p>
<?php
		}
?>
</div>


	<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr class="success">
			<th style="width:30px" >NO</th>
			<th >ARTICLE</th>
			</tr>
			</thead>
		
		<tbody>
<?php
	// 페이지 번호 설정
	// select count(컬럼) from 테이블 - 테이블에 존재하는 데이터 갯수를 가져올 때 사용
	// 이 때 NULL인 데이터는 제외하고 계산한다. 전체 행 갯수를 가져올 때는 *를 지정
	$sql = " select COUNT(bb_no) as max_no from $db_bbs_table ";
	$sql .= " where bb_deleted = 0 and bb_originalno = 0 ";
	$result = mysqli_query($link, $sql);

	$row = mysqli_fetch_object($result);
	$total_article_no = $row->max_no;
	//ceil은 입력값에 소수부분이 존재할 때 값을 올려서 리턴하는 함수
	$no_of_pages = ceil($total_article_no / $article_no_per_page); 
	
	if (!isset($_GET['pageno'])) {
		$current_page_no = 1;
		$first_page_no = 1;
	}
	else {
		$current_page_no = (int)$_GET['pageno'];
		$first_page_no = (int)$_GET['firstpage'];
	}
	$last_page_no = $first_page_no + $max_display_page_no - 1;
	if ($last_page_no > $no_of_pages ) $last_page_no = $no_of_pages;


	//검색처리 
	$keyword=$_GET["keyword"];
	$add_query = "";
	if($keyword){
		$add_query .= " AND bb_title like '%".$keyword."%' ";
	}

	// , 현재 페이지 번호 연관하여 상위 레코드 번호 추출
	$article_begin_offset = ($current_page_no-1) * $article_no_per_page;
	$article_end_ndx = $article_begin_offset + $article_no_per_page;
	//as는 테이블 열에 대해서 임시로 이름을 변경한 것
	$sql = "select bb_no as article_no from $db_bbs_table where ";
	$sql .= " bb_originalno = 0 and bb_deleted = 0 $add_query ";
	$sql .= " order by bb_no desc limit $article_begin_offset, $article_no_per_page ";
	$result = mysqli_query($link, $sql);
	//echo "SQL:".$sql;
	
	$article_no = array();
	
	$article_no_this_page = 1;
	if (mysqli_num_rows($result) >= 1) {
		$n = 1;
		while ($row=mysqli_fetch_object($result)) {
			$article_no[$n++] = $row->article_no; 
		}
		$article_no_this_page = mysqli_num_rows($result); // 현재 페이지의 레코드 수
	}
	
	$sql = " select * from $db_bbs_table where ";
	$sql .= " bb_no >= $article_no[$article_no_this_page] and bb_no <= $article_no[1] and bb_originalno = 0 ";
	$sql .= " and bb_deleted = 0 $add_query order by bb_no desc limit $article_no_per_page ";
	
	//echo $sql."<br>";
	$result = mysqli_query($link, $sql);
	
	if (mysqli_num_rows($result) >= 1) {
		
		while ($row=mysqli_fetch_object($result)) {
			$num = 1;
			// 글쓴이와 저자가 동일인인지 확인
			$is_author = 0;
			if ($row->bb_id == $_SESSION['ss_id']) {
				$is_author = 1;
			}
			
			// 모바일에서는 제목 짧게 표시
			$title_str = $row->bb_title;
			$char_len = 32;
			if ( $isMobile && strlen($title_str) > $char_len ) {
				// 뒤에서 첫번째 공백 찾아서 거기 까지만 출력
				$pos = $char_len-1;
				while (($title_str[$pos] != " " && $title_str[$pos] != "-" && $title_str[$pos] != "_") &&
					   $pos> 0) {
					$pos --;
				}
				if ($pos <=0 ) {
					$title_str = substr($title_str,0,$char_len);
				}
				else {
					$title_str = substr($title_str,0,$pos);
				}
				$title_str .= " ...";
			}
			
			$readonly_str = "";
			if (!$is_author) $readonly_str = "readOnly";
			
			$article_no = $row->bb_no;
			
			//-----------------------------------------------------------------
			// - / 시간표시 오늘인지 여부에 따라 작성시간 작성날짜 중 하나로 설정
			$writedate = substr($row->bb_writetime, 0, 10);
			if (strcmp($writedate,$today)) {
				$thisyear = date('Y',time());
				// 같은해인지에 따라 년도 표시 다르게
				if (substr($writedate,0,4) == $thisyear)
					$writetime = substr($writedate,5,5); // - - 년월일
				else
					$writetime = $writedate; // - 월 일
			}
			else{
				$writetime = substr($row->bb_writetime, 11, 5); // time only
			}
			
			// id 변수값 설정
			$doc_id = "id_".(string)$article_no;
			$comment_id = "id_comment_".(string)$article_no;
			// textarea 본문글 내의 줄 수 카운트하여 의 높이 설정에 사용
			$content_rows_no = substr_count($row->bb_content, "\n")+2;
			if ($content_rows_no > 10) $content_rows_no = 10; // 10 최대높이를 줄로 제한
			
			
?>
			<tr >
				<td >
					<?=$article_no?><br />
					</td>
				<td><a  data-toggle="tooltip" data-placement="right" title="show content" >
					<span  class="title_span" article_no="<?=$article_no ?>" data-toggle="collapse" data-target="#<?=$doc_id?>">
				<?=$title_str?>(<?=$row->bb_count ?>)</span></a>
<?php
				if ($row->bb_file1 != "") {
?>
					&nbsp;
					<span class= "glyphicon glyphicon-file" ></span>
<?php
				}
			if ($is_author ) { 
?>
					&nbsp;
					<a href= "./index.php?page=bbslist&act=modify&no= <?=$article_no?>#write_table"
					   data-toggle="tooltip" data-placement="right" title="Change">
						<span class="glyphicon glyphicon-edit"></a>&nbsp;
						<a href= "./bbs/delete.php?no= <?=$article_no?>"><span class="glyphicon glyphicon-remove-sign" 
						onclick="return confirmAction();" data-toggle="tooltip" data-placement="left"
						title="delete record"></span> </a> 
<?php
							 }
?>
						<br />
						<span style="font-size:10px; color:#aaa"><?=substr($row->bb_name,0,30)?>, <?=$writetime?>, (<?=$row->bb_view ?>)</span>
						</td>
					</tr>
			
			<tr id="<?=$doc_id?>" class="collapse">
				<td ><span class="glyphicon glyphicon-chevron-right"></span></td>
				<td >
					<textarea style="text-align:left" class="form-control" cols="100%" rows="<?=$content_rows_no?>"
					<?=$readonly_str?> readOnly><?=trim($row->bb_content);?></textarea>
					posted at <?=$row->bb_writetime?><br />
<?php
				// 첨부파일이 있는 경우 첨부파일 다운로드 목록 출력
				if ($row->bb_file1 != "") {
?>
					<span class="glyphicon glyphicon-download-alt" style"font-size:10px;"></span>&nbsp;

					<a href= '<?=$upload_folder_from_bbs?><?=$row->bb_file1?>' data-toggle="tooltip"
					data-placement="top" title="download file"><?=$row->bb_file1?></a><br />
					<a href='<?=$upload_folder_from_bbs?><?=$row->bb_file2?>' data-toggle="tooltip"
					   data-placement="top" title="download file"><?=$row->bb_file2?></a><br />
					<a href='<?=$upload_folder_from_bbs?><?=$row->bb_file3?>' data-toggle="tooltip"
					   data-placement="top" title="download file"><?=$row->bb_file3?></a><br />
					<a href='<?=$upload_folder_from_bbs?><?=$row->bb_file4?>' data-toggle="tooltip"
					   data-placement="top" title="download file"><?=$row->bb_file4?></a><br />
					<a href='<?=$upload_folder_from_bbs?><?=$row->bb_file5?>' data-toggle="tooltip"
					   data-placement="top" title="download file"><?=$row->bb_file5?></a><br />
<?php
					}
			// 해당 글에 대한 덧글 읽어오기 수정 삭제 기능
			$sql2 = " select * from $db_bbs_table where ";
			$sql2 .= " bb_originalno = $article_no ";
			$sql2 .= " and bb_deleted = 0 order by bb_no desc ";

			//echo $sql."<br>";
			$result2 = mysqli_query($link, $sql2);
			
			if (mysqli_num_rows($result2) >= 1) {
?>
					<br />
<?php
				while ($row2=mysqli_fetch_object($result2)) {
					$no = 1;
					if ($id == $row2->bb_id) $readonly_str2 = "";
					else $readonly_str2 = "readOnly";
?>
					<div class="form-group">
						<form name="form_comment2_<?=$no?>" id = "form_comment2_<?=$no?>"
							action="./bbs/update.php?no=<?=$row2->bb_no?>" method="post">
							<input type="hidden" name = "nm_no" value="<?=$row2->bb_no?>" />
							<div class="form-group">
							<input type="hidden" name="nm_title" value="" />
							<textarea name="nm_content" class="form-control" cols="80%" rows="3"
								<?=$readonly_str2?>><?=$row2->bb_content?>
							</textarea>
							<p style= "text-align :right" >
								by <?=$row2->bb_id?><br />
<?php
						if ($id == $row2->bb_id) { // / 로그인한 사람과 덧글작성자가 동일인이면 수정 삭제버튼 추가
?>
								
			<span onClick="return confirmCommentUpdate('form_comment2_<?=$no?>');" class="glyphicon glyphicon-edit">
			<input type="submit" formaction="./bbs/delete.php?no=<?=$row2->bb_no?>"
				   formmethod="post" onClick="return confirmAction();" value="X" />
<?php
												 }
					
?>
				<?=$row2->bb_writetime?>
				</p>
				</div>
				</form>
			</div>
<?php
						$no++; 
					} // while
				} // if
			
?>
		<!--덧글 업로드 양식 -->
					<div class="form-group">
	<form name="form_comment_<?=$num?>". action="./bbs/addcomment.php?original_no=<?=$row->bb_no?>" method="post">
		<textarea name="nm_comment" class="form-control" rows="3" style="background-color:#FFFFDD"> </textarea>
		<p style="text-align:center">
			<br />
	<button type="submit" class="btn btn-primary" onClick="return confirmAction();">Upload a Comment</button>
							</p>
						</form>
						</div>
					</td>
				</tr>
<?php
				$num++;
			} // while
		} // if
?>
			</tbody>
		</table>
		</div>

	<div class="text-center">
	<ul class="pagination justify-content-center pagination-sm ">
<?php
	$prev_page_no = $next_page_no = $first_page_no;
	
	if ($first_page_no <= 1) {
		$disable_str_previous = " disabled";
	}
	else {
		$disable_str_previous = "";
		$prev_page_no = $last_page_no - $max_display_page_no;
		}
	
	if ($last_page_no >= $no_of_pages) {
		$disable_str_next = " disabled";
	}
	else {
		$disable_str_next = "";
		$next_page_no = $last_page_no + 1; 
	}
?>
		<li class="page-item <?=$disable_str_previous?>"><a href="./index.php?page=bbslist&pageno=1&firstpage=1&keyword=<?=$keyword ?>">
			<span class="glyphicon glyphicon-fast-backward"></span></a></li>
		
<?php
		if ($first_page_no > 1) {
?>
		<li class="page-item <?=$disable_str_previous?>"><a href="./index.php?page=bbslist&pageno=<?=($prev_page_no+$max_display_page_no-1)?>&firstpage=<?=$prev_page_no?>&keyword=<?=$keyword ?>">
			<span class="glyphicon glyphicon-backward"></span></a></li>
<?php
								}
	else{
?>
	<li class="page-item <?=$disable_str_previous?>"><a href="#">
		<span class="glyphicon glyphicon-backward"></span></a></li>
<?php
		}
	for ($n=$first_page_no; $n<=$last_page_no; $n++) {
		if ($current_page_no == $n) $active_str = "active";
		else $active_str = "";
?>
		<li class="page-item <?=$active_str?>"><a class="page-link"
		href="./index.php?page=bbslist&pageno=<?=$n?>&firstpage=<?=$first_page_no?>&keyword=<?=$keyword ?>"><?=$n?></a></li>
<?php } // for
	if ($last_page_no < $no_of_pages) {
?>
		<li class="page-item <?=$disable_str_next?>">
			<a href="./index.php?page=bbslist&pageno=<?=$next_page_no?>&firstpage=<?=$next_page_no?>&keyword=<?=$keyword ?>">
				<span class="glyphicon glyphicon-forward"></span></a></li>
<?php }
	else {
?>
		<li class="page-item <?=$disable_str_next?>">
			<a href="#">
				<span class="glyphicon glyphicon-forward"></span></a></li>
<?php
		 }
	$begin_page = (int)(($no_of_pages-1) / $max_display_page_no) * $max_display_page_no + 1 ;
?>
		<li class="page-item <?=$disable_str_next?>">
			<a href="./index.php?page=bbslist&pageno=<?=$no_of_pages?>&firstpage=<?=$begin_page?>&keyword=<?=$keyword ?>">
			<span class="glyphicon glyphicon-fast-forward"></span></a></li>
		</ul>
		</div>
		</form>
		<br>
<?php
	$mod_title = "";
	$mod_content = "";
	$btn_string = "Upload";
	$mode = "";
	$no = 0;
	
	if (isset($_GET['act'])) {
		$mode = $_GET['act'];
	}
	if (isset($_GET['no'])) {
		$no = (int)$_GET['no'];
	}
	
	$bbs_title2 = "WRITE an ARTICLE";
	if ( $mode == 'modify' && $no > 0) {
		$bbs_title2 = "UPDATE # ".(string)$no;
		$btn_string = "Update";
		$no = (int)$_GET['no'];

		$sql = " select * from $db_bbs_table where ";
		$sql .= " bb_no = $no and bb_id = '$id' limit 1 ";
		
		$result = mysqli_query($link, $sql);
		
		if (mysqli_num_rows($result) >= 1) {
			$row=mysqli_fetch_object($result);
			
			$mod_title = $row->bb_title;
			$mod_content = $row->bb_content;
			for ($i=1; $i<= $max_upload_file_no; $i++) {
				$field_name = "bb_file".(string)$i;
				$uploaded_file_list[$i] = $row->$field_name;
			}
		}
	}
?>
	<br>

<h4 id="write_table" style="text-align:center"><?=$bbs_title2?></h4>
<p style="text-align:right">
	<a href="./index.php?page=bbslist#write_table"><button>Clear this form</button></a>
	</p>

<div class="form-group">
	<form name="nm_write" action="./bbs/write.php" method="post" enctype="multipart/form-data">
		<div class="table-responsive">
<table class="table table-striped" >
	<tr class="success">
		<th style="width:20%" >TITLE</th>
		<td >
			<input type="text" name="nm_title" class="form-control" value = "<?=$mod_title?>" required>
			</td>
		</tr>
		<tr >
			<th >CONTENT</th>
			<td >
				<textarea name="nm_content" class="form-control" rows="5" style="background-color:#FFFFDD"><?=$mod_content?> </textarea>
				</td>
			</tr>
	<tr >
		<th >FILES</th>
		<td >
<?php
		$file_str = "";
	if ( $mode == 'modify' && $no > 0) { 
		for ($i=1; $i<= $max_upload_file_no; $i++) {
			if ($uploaded_file_list[$i] != "") {
				$file_str .= $uploaded_file_list[$i];
				if ($i < $max_upload_file_no) $file_str .= ", ";
			}
		}
?>
			Uploaded Files: <?=$file_str?><br>
<?php
	}
	else {
?>
			<input type="file" name="nm_files[]" multiple >
<?php
		}
?>
			</td>
		</tr>
	</table>
	</div>
		
		<div style="text-align:center">
<?php
	if ( $mode != 'modify' ) {
?>
			<button type="submit" class="btn btn-primary"><?=$btn_string?></button>
<?php
							 }
	else {
?>
			<p style="color:#a00;text-align:left;">
				Be sure that only title and content will be updated. The previously attached files will not be changed.
				</p>
			<button type="submit" formaction="./bbs/update.php?no=<?=$no?>" formmethod="post"
					formenctype="multipart/form-data" class="btn btn-primary"><?=$btn_string?></button>
<?php
		 }
?>
			</div>
			</form>
			</div>
			<br><br><br><br>
<?php
	} //else
?>

<script>
	function closeOtherCommentForms(id) {
		var obj = document.getElementById(id); // (tr)
		var rememberToRestore = 0;
		var classArray = document.querySelectorAll('.collapse');
		
		/*
		if (obj.style.display == 'none') alert('none');
		else if (obj.style.display == '') alert('blank');
		else alert('other');
		*/
		
		//alert(obj);
		for (var i=1; i<classArray.length; i++) {
			alert (i+": "+classArray[i].style.display+", "+classArray[i].style.visibility);
			if (classArray[i].style.display == "" ) {
				//classArray[i].style.display = "none";
			}
		}
	}
	function confirmCommentUpdate(formName) {
		if (confirm("Want to Update your comment?")) {
			document .getElementById (formName).submit();
			return;
		}
		else {
			return false;
		}
	}
	
	$(function(){
		$(".title_span").click(function(){
			var article_no = $(this).attr("article_no");
			if(!$("#id_"+article_no).hasClass("in")){ //in class 가 없을떄만 update 처리 , 제목클릭시 in class 발생  닫을때는 사라짐 
				$.post("./bbs/update_bb_view.php",{
					article_no:article_no
				},function(data){
						console.log(data);
				});	
			}
			
		})
	});
</script> 


	

		



				
				
				
				
				
				
				
				
				
				
				
				
				
				

