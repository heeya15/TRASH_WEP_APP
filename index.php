<?php 
session_start();
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Garbage Location Application Html</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="landing is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<h1><a href="./index.php" target="_self">Alpha</a></h1>
  <?php
    require_once("conf.php");
if ($_SESSION['ss_login_status'] == 'logged_in') {
?>
					<nav id="nav">
						<ul>
							<li><a href="./index.php">Home</a></li>
							<li>
								<a href="#" class="icon fa-angle-down">Menu</a>
								<ul>
									<li><a href="camera.php">쓰레기 등록</a></li>
									<li><a href="contact.php">지도</a></li>
									<li><a href="elements.php">통계</a></li>
									<li><a href="my_info.php">회원정보</a></li>
								</ul>
							</li>
                            
					<li><input type="button"name="res" id="res" value="logout" onclick="location.href='plogout.php'"> </li>

						</ul>
					</nav>
				</header>
<?php
}
?>
			<!-- Banner -->
				<section id="banner">
					<h2>Garbage Location Application </h2>
   <?php
              if ($_SESSION['ss_login_status'] != 'logged_in') {

// 로그인이 아닌경우 처리 (로그인 및 회원가입 창 보여주기)
?>
					<p>Garbage Location LogIn</p>
					<ul class="actions special">
						  <li><input type="button" name="nm_sub" id="id_sub" value="Login" onClick="location.href='login.php'"</li>
					</ul>
                    <?php }
					?>
				</section>
                

			<!-- Main -->
				<section id="main" class="container">

					<section class="box special">
						<header class="major">
							<h2> Garbage Location 사용법</h2>
							<p>1. 계정이없는사람은 회원가입후 , 로그인을 한다.</br>
                               2. 사진촬영후 쓰레기등록 ,찍은위치 ,종류선택 , 만약 종류가 없을시 요청사항에 적을것.</br>
                               3. 지도에 자기가  올린사진,위치확인.</br>
                               4. 회원정보에서 자기가 올린쓰레기 수정,밑 삭제가능.</p>
						</header>
					</section>

					

			<!-- CTA -->
				<section id="cta">

					<h2>이 어플을 만든 목적</h2>
					<p>쓰레기 위치를 올림으로, 환경 관리원이 위치를 알게 되어 쓰레기를, 방치해 두지않고 즉각 치울수 있다.</p>

					<form>
						<div class="row gtr-50 gtr-uniform">
					
						</div>
					</form>

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
<div >  <!-- 요것이 본문닫는 div -->
		<?php
		require_once $content_url ;// default 로 보여줄수있는  페이지를 보여주는 것을 의미한다.
		?>
	</div>
	</body>
</html>