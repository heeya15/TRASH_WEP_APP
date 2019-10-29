<?php
 session_start();
 require_once("conf.php");
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>내정보</title>
        
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
				<h1><a href="my_info.php" target="_self"><?=$_SESSION["ss_name"] ?> 님</a></h1>
					<nav id="nav">
						<ul>
							<li><a href="./index.php" target="_self">Home</a></li>
							<li>
								<a href="#" class="icon fa-angle-down">Layouts</a>
								<ul>
                                 <?php
								 if($_SESSION['ss_id'] == "admin"){ //관리자로 로그인시에만 ?>
									<li><a href="garbage_type.php">서버관리</a></li>
								<?php
								 }
								  ?>
									<li><a href="camera.php">쓰레기 등록</a></li>
									<li><a href="map.php">지도</a></li>
									<li><a href="elements.php">통계</a></li>
									<li><a href="my_info.php">회원정보</a></li>
									<li>
										<a href="#">Submenu</a>
										<ul>
											<li><a href="#">Option One</a></li>
											<li><a href="#">Option Two</a></li>
											<li><a href="#">Option Three</a></li>
											<li><a href="#">Option Four</a></li>
										</ul>
									</li>
								</ul>
							</li>
								
<li><form method="post" action="plogout.php">
		<input type="submit"  class="button special small" name="query" id="query" value="Logout"/>
		</form> 
        </li>
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container">
					
					<div class="box">
<?php
// meber 테이블에 해당아이디만 실행시키게끔 하였습니다.
	$result = mysqli_query($link,"select * from member where mb_id = '".$_SESSION["ss_id"]."'");
	$row = mysqli_fetch_assoc($result);  //연관배열로 하는 방식이다.
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					
<?php

	//id 값과  로그인한 아이디정보로 db select  
	$result = mysqli_query($link,"select * from garbage where id  = '".$_GET["id"]."' AND mb_id = '".$_SESSION["ss_id"]."'");
	$row = mysqli_fetch_assoc($result);
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
						<script>
						$(document).ready(function(){
						    if (!('url' in window) && ('webkitURL' in window)) {
						        window.URL = window.webkitURL;
						    }
						 
						    $('#camera').change(function(e){
						        $('#pic').attr('src', URL.createObjectURL(e.target.files[0]));
						    });
						});
						</script>
						</head>
						
						<body>
						    <form method="post" action="garbage_modify_process.php" enctype="multipart/form-data">
						    	<input type="hidden" name="id" value="<?=$row["id"] ?>" />
						    	사진 <br/>
						    	<img src="/uploads/<?=$row["file_name"] ?>" width="100" height="100" />
						    	<br/>
						    	주소입력:<br/>
						    	<input type="text" class="form-control" name="addr" value="<?=$row["addr"] ?>" />
						    	<br/>
						    	쓰레기종류 : <br/>
						    	<select class="form-control" name="garbage_type">
						    		<?php 
						    		//DB에저장된 쓰레기 종류 리스트 가져오기 
						    		$garbage_type_result = mysqli_query($link,"select * from garbage_type");
						    		while ($garbage_row = mysqli_fetch_array($garbage_type_result)) { 
						    		?>
						    		<option value="<?=$garbage_row["name"] ?>" <?php if($garbage_row["name"] == $row["garbage_type"]) echo "selected"; ?>><?=$garbage_row["name"] ?></option>
						    		<?php } ?>
						    	</select>
						    	<br/>
						    	메모란(요청사항) : <br/>
						    	<textarea name="memo" class="form-control" ><?=$row["memo"] ?></textarea>
						    	<div style="text-align: center; margin-top:20px;">
						    		<button type="submit" class="button primary">수정하기</button>
						    		<a href="garbage_upload_list.php" class="btn btn-default">목록</a>
						    	</div>
						    </form>
						<br/>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->

				  </div>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>