<?php
 session_start();
 ?>
<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>쓰레기 업로드 관리</title>
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
<?php require_once("conf.php");
 ?>
<?php
	$result = mysqli_query($link,"select * from garbage where mb_id = '".$_SESSION["ss_id"]."' ");
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
						<h3>쓰레기 업로드 관리</h3>
						<table class="table">
								<tr>
									<td>사진</td>
									<td>주소</td>
									<td>쓰레기종류</td>
									<td>등록일</td>
									<td>기능</td>
								</tr>
		<?php while ($row = mysqli_fetch_array($result)) { ?>
								<tr>
									<td><img src="/uploads/<?=$row["file_name"] ?>" width="100" height="100" /></td>
									<td><?=$row["addr"] ?></td>
									<td><?=$row["garbage_type"] ?></td>
									<td><?=$row["regdate"] ?></td>
									<td>
										
										<a class="btn btn-primary" href="/page/mypage/garbage_modify.php?id=<?=$row["id"] ?>">수정</a>
										<button class="btn btn-danger" type="button" onclick="garbage_delete(<?=$row["id"] ?>)">삭제</button>
										
									</td>
								</tr>
								<?php
								 }
							 ?>
						</table>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->
<script>
	function garbage_delete(id){
		if(confirm("정말 삭제하시겠습니까?")){
			location.href = "/page/mypage/garbage_upload_list_delete_process.php?id="+id;	
		}
	}
</script>
							
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