<?php
 session_start();
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>서버관리- 쓰레기 종류 추가</title>
  <link href="/css/min.css" rel="stylesheet" type="text/css">
 <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 <link href="/css/metisMenu.min.css" rel="stylesheet">

<script src="//code.jquery.com/jquery.min.js"></script>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
                    <?php
						if($_SESSION['ss_id'] == "admin"){ //관리자로 로그인시에만 ?>
					<h1><a href="my_info.php" target="_self"><?=$_SESSION["ss_name"] ?> 님</a></h1>
					<nav id="nav">
						<ul>
							<li><a href="./index.php" target="_self">Home</a></li>
							<li>
								<a href="#" class="icon fa-angle-down">Layouts</a>
								<ul>
                             
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
		<input type="submit" class="button special small" name="query" id="query" value="Logout"/>
		</form> </li>
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container">
					
					<div class="box">
<?php require_once "conf.php"; ?>
<?php
	$result = mysqli_query($link,"select * from garbage_type");
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					
					<ul class="nav nav-tabs">
     <li <?php echo "active"; ?>><input type="button" class="button" name="nm_sub" id="id_sub" value="쓰레기 종류 관리" onClick="location.href='garbage_type.php'"</li>
        <li <?php echo "active"; ?>><input type="button" class="button" name="nm_sub" id="id_sub" value="회원관리" onClick="location.href='member_list.php'"</li>
		<li<?php echo "active"; ?>><input type="button" class="button" name="nm_sub" id="id_sub" value="쓰레기 업로드 관리" onClick="location.href='server_garbage_upload_list.php'"</li>
					</ul></br>
							
					
					<div>
						<form method="post" action="garbage_type_insert.php">
						 	<h3>쓰레기 종류 추가등록</h3>
                            <div class="col-12">
		<input type="text" name="gr_name" id="subject"  placeholder="추가할 쓰레기 종류입력" required style="width: 50%; float: left;"/>
          <button type="submit" class="button primary" style="float: left;"> 등록</button>
							</div>	
						</form>
					</div>
					<br/>
					<br/>
					<br/>
					<table class="table">
								<tr>
									<td>쓰레기 이름</td>
									<td>기능</td>
								</tr>
								<?php 
						while ($row = mysqli_fetch_array($result))  //쓰레기 종류만큼동안 array -->배열로
								{  // 쓰레기 이름을 하나씩 행으루 추가한다.
								?>
								<tr>
									<td><?=$row["name"] ?></td>  <!-- 쓰레기 이름을 나타낸다-->  
									<td><button class="button primary" type="button" onclick="garbage_type_delete(<?=$row["id"] ?>)"> 삭제</button></td>
								</tr>
								<?php } ?>
					</table>
					
					
							
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->

<script>
	function garbage_type_delete(id){
		if(confirm("정말 삭제하시겠습니까?")){
			location.href = "garbage_type_delete.php?id="+id;	  //현재 위치는 / 안부친다 !!
		}
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