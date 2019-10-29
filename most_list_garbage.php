<?php
 session_start();
 require_once("conf.php");
 ?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Elements - Alpha by HTML5 UP</title>
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
								 if($_SESSION['ss_active'] == 3){ //관리자로 로그인시에만 ?>
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
					<header>
						<h2>가장 많은 쓰레기 종류</h2>
						<p>Just an assorted selection of elements.</p>
					</header>
					<div class="row">
						<div class="col-12">
<?php
	//가장 촬영을 많이 한 회원 아이디순
	$result = mysqli_query($link,"SELECT  garbage_type,count(garbage_type) as cnt FROM `garbage` group by garbage_type order by cnt desc;");
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
						  <ul class="nav nav-tabs">
     <li<?php echo "active"; ?>><input type="button" class="button special small" name="nm_sub" id="id_sub" value="가장 촬영을 많이 한 회원 아이디" onClick="location.href='elements.php'"</li>
        <li<?php echo "active"; ?>><input type="button" class="button special small" name="nm_sub" id="id_sub" value="가장 많은 쓰레기 종류" onClick="location.href='most_list_garbage.php'"</li>
		<li<?php echo "active"; ?>><input type="button" class="button special small" name="nm_sub" id="id_sub" value="가장 촬영을 많이하는 요일+시간대" onClick="location.href='stats_yoil.php'"</li>
       <li<?php echo "active"; ?>><input type="button" class="button special small" name="nm_sub" id="id_sub" value="가장 쓰레기가 많이 발견된 지역" onClick="location.href='stats_location.php'"</li>
				</ul></br>
						<h3>가장 많은 쓰레기 종류 순</h3>
						<table class="table">
								<tr>
									<td>쓰레기종류</td>
									<td>촬영횟수</td>
								</tr>
								<?php while ($row = mysqli_fetch_array($result)) { ?>
								<tr>
									<td><?=$row["garbage_type"] ?></td>
									<td><?=$row["cnt"] ?></td>
								</tr>
								<?php } ?>
						</table>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->


						</div>
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