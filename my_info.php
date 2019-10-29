<?php
 session_start();
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
					<h1><a href="./index.php" target="_self">Alpha</a> by HTML5 UP</h1>
					<nav id="nav">
						<ul>
							<li><a href="./index.php" target="_self">Home</a></li>
							<li>
								<a href="#" class="icon fa-angle-down">Layouts</a>
								<ul>
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
		<input type="submit" name="query" id="query" value="Logout"/>
		</form> </li>
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container">
					
					<div class="box">
<?php
require_once("conf.php");
	$result = mysqli_query($link,"select * from member where mb_id = '".$_SESSION["ss_id"]."'");
	$row = mysqli_fetch_assoc($result);
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					
					
					<ul class="actions special">
        <li><input type="button" name="nm_sub" id="id_sub" value="개인정보변경" onClick="location.href='my_info.php'"</li>
		<li><input type="button" name="nm_sub" id="id_sub" value="쓰레기 업로드관리" onClick="location.href='garbage_upload_list.php'"</li>
					</ul>
					
			

					<div class="form-group" style="margin-top:20px;">
						<label for="id" style="font-size:20px;">내 포인트: <?=$row["mb_point"] ?>점</label>
					</div>
										
					<h3>개인정보변경</h3>
					<form name="frm_subscribe" action="my_info_process.php" method="post">

					<div class="form-group">
						<label for="id">Name:</label>
						<input type="text" class="form-control" id="id_name2" name="nm_name" value="<?=$row["mb_name"] ?>" required>
					</div>
											
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" id="id_pwd2" name="nm_pwd">
					</div>
					
					<div class="form-group">
						<label for="pwd"2>Password again:</label>
						<input type="password" class="form-control" id="id_pwd3" name="nm_pwd2">
					</div>
	
					<div style="text-align:center;">
					<button type="submit" onClick="return checkPwd();" class="btn btn-primary">수정</button>
					</div>
				</form>
							
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->

<script>
	function garbage_type_delete(id){
		if(confirm("정말 삭제하시겠습니까?")){
			location.href = "/page/server/garbage_type_delete_process.php?id="+id;	
		}
	}
</script>
 <script>
	function checkPwd() {
		let
		pwd1 = document.getElementById('id_pwd2').value;
		let
		pwd2 = document.getElementById('id_pwd3').value;

		if (pwd1 != pwd2) {
			alert("Passwords Mismatch !!!");
			return false;
		}
		return true;
	}
</script>
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