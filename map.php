<?php
 session_start();
 require_once("conf.php");
 ?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>지도</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1><a href="./index.php" target="_self">Alpha</a></h1>
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
					<header>
						<h2>지도</h2>
						<p>A generic page for every non-generic situation.</p>
					</header>
					

<?php
		$result = mysqli_query($link,"select * from garbage");


		//지도 중심 좌표값 가져오기  
		$result_limit1 = mysqli_query($link,"select * from garbage where map_x is not null limit 1 ");
		$row_limit1=mysqli_fetch_assoc($result_limit1);
		$center_map_x=$row_limit1["map_x"];
		$center_map_y=$row_limit1["map_y"];
?>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=$map_api_key ?>"></script>

<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
							<!-- /#page-wrapper -->

							<div id="map" style="width:100%;height:550px;"></div>

							<script>
								var mapContainer = document.getElementById('map'), // 지도를 표시할 div  
								    mapOption = { 
								        center: new daum.maps.LatLng(<?=$center_map_y ?>, <?=$center_map_x ?>), // 지도의 중심좌표
								        level: 3 // 지도의 확대 레벨
								    };

								var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
								 
								// 마커를 표시할 위치와 내용을 가지고 있는 객체 배열입니다 
							var positions = [
							<?php 
										while ($row = mysqli_fetch_array($result)) {  //마커를 업로드한 만큼 찍는다 
											if($row["map_x"] && $row["map_y"]){ //좌표값이 있을때만 표시
		$marker_info_html = "<div><img src=/uploads/".$row["file_name"]." width=50 height=50 /></div><div>촬영자 아이디:".$row["mb_id"].
		"</div><div>촬영 일시".substr($row["regdate"],0,10)."</div>";
											
									?>	
								    {
								        content: '<div><?=$marker_info_html ?></div>', 
								        latlng: new daum.maps.LatLng(<?=$row["map_y"] ?>, <?=$row["map_x"] ?>),
								        marker_img : "http://localhost/img/marker/<?=$garbage_type_img_arr[$row["garbage_type"]]?>"
								    },
									<?php 
											} //if 
										}  //while

									?>								
								];

								for (var i = 0; i < positions.length; i ++) {

								var imageSrc = positions[i].marker_img, // 마커이미지의 주소입니다    
								    imageSize = new daum.maps.Size(30, 30), // 마커이미지의 크기입니다
								    imageOption = {offset: new daum.maps.Point(27, 69)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
								      
									// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
									var markerImage = new daum.maps.MarkerImage(imageSrc, imageSize, imageOption);
									
								    // 마커를 생성합니다
								    var marker = new daum.maps.Marker({
								        map: map, // 마커를 표시할 지도
								        position: positions[i].latlng, // 마커의 위치
								        image : markerImage
								    });

								    // 마커에 표시할 인포윈도우를 생성합니다 
								    var infowindow = new daum.maps.InfoWindow({
								        content: positions[i].content // 인포윈도우에 표시할 내용
								    });

								    // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
								    // 이벤트 리스너로는 클로저를 만들어 등록합니다 
								    // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
								    daum.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
								    daum.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
								}

								// 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
								function makeOverListener(map, marker, infowindow) {
								    return function() {
								        infowindow.open(map, marker);
								    };
								}

								// 인포윈도우를 닫는 클로저를 만드는 함수입니다 
								function makeOutListener(infowindow) {
								    return function() {
								        infowindow.close();
								    };
								}
							</script>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
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