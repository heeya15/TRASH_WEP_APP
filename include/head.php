<?php include $_SERVER["DOCUMENT_ROOT"]."/include/conf.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<title>기말</title>
<link href="/css/min.css" rel="stylesheet" type="text/css">
<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="/css/metisMenu.min.css" rel="stylesheet">
<link href="/css/sb-admin-2.css" rel="stylesheet">
<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>
</head>
<style>
	#page-wrapper{
		padding-top:20px;	
	}
</style>
<body>
<?php if($_SESSION['ss_login_status'] == 'logged_in')
{ //로그인 시에만 메뉴노출 ?>
<div id="wrapper">
	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
            <!-- 해당로그인 아이디로 누가 로그인했는지 보여주는부분-->
			<a class="navbar-brand" href="/manage"><?=$_SESSION["ss_id"] ?> 님</a>
		</div>
		<!-- /.navbar-header -->

		<ul class="nav navbar-top-links navbar-right ">
			<li class="dropdown pull-right" >
				<a href="/page/logout_process.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				<!-- /.dropdown-user -->
			</li>
			<!-- /.dropdown -->
		</ul>
		<!-- /.navbar-top-links -->
		
		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse collapse">
				<ul class="nav" id="side-menu">
					<li><a href="/">HOME</a></li>
					<li><a href="/page/camera.php">카메라</a></li>
					<li><a href="/page/map.php">지도</a></li>
					<li><a href="/page/stats/stats_id.php">통계</a></li>
					<li><a href="/page/mypage/my_info.php">회원정보</a></li>
					<?php if($_SESSION['ss_id'] == "admin"){ //관리자로 로그인시에만 ?>
					<li><a href="/page/server/garbage_type.php">서버관리</a></li>
					<?php 
					} ?>
				</ul>
			</div>
			<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	</nav>
<?php 
}  //
 ?>	