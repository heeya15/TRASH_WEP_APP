<?php
session_start();
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>쓰레기 등록</title>
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
		<input type="submit" name="logout" id="logout" value="Logout"/>
		</form> </li>
								
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container">
					<header>
						<h2>Camera</h2>
						<p>사진을 찍으세요.</p>
					</header>
					<div class="box">
					<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
						</head>
						
						<body>
	<form method="post" action="/page/camera_process.php" enctype="multipart/form-data">
						    	
			<input type="hidden" name="region1" id="region1" value="" />
			<input type="hidden" name="region2" id="region2" value="" />
			<input type="hidden" name="region3" id="region3" value="" />
						    	
			<input type="hidden" name="map_x" id="map_x" value="" />
			<input type="hidden" name="map_y" id="map_y" value="" />
						    	
						    	
						    	사진 <br/>
			<input type="file" id="camera" name="camera" capture="camera" accept="image/*"/>
						    	<br/>
			<img id="pic" style="width: 200px;height: 200px;" /><br/>
						    	<br/>
						    	주소입력:<br/>
			<input type="text" onClick="get_addr()" class="form-control" name="addr" id="addr" required />
						    	<br/>
						    	쓰레기종류 : <br/>
						    	<select class="form-control" name="garbage_type" required="">
						    		<option value="플라스틱">플라스틱</option>
						    		<option value="캔">캔</option>
						    		<option value="유리병">유리병</option>
						    		<option value="페트병">페트병</option>
						    		<option value="기타">기타</option>
						    	</select>
						    	<br/>
						    	메모란(요청사항) : <br/>
						    	<textarea name="memo" class="form-control"></textarea>
						    	<div style="text-align: center; margin-top:20px;">
						    		<button type="submit" class="btn btn-primary">올리기</button>
						    	</div>
						    </form>
						<br/>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->

<!-- 주소정보를 가져오기위한 다음 우편번호 API  -->
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

<!-- 좌표값을 가져오긴 다음 맵 API  -->
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=65b1a3d76db744b0bcacdc34470729e1&libraries=services"></script>

<script>
    function get_addr() {
    	
    	//다음 우편번호 API 호출 (주소값을 가져오기위한 용도)
        new daum.Postcode({
            oncomplete: function(data) { //검색후 주소를 클릭시 발생하는 이벤트 함수 , 주소값정보는  data 에 담겨져있음 
            	
            	//다음 맵 API 호출(좌표를 가져오기위한 용도)
                var geocoder = new daum.maps.services.Geocoder();
                
                //callback 함수  
				var callback = function(result, status) { 
				    if (status === daum.maps.services.Status.OK) { //정상적으로 검색이 됬다면
				    	 
				    	//MAP API 에서 받은 data 들 form hidden 값에 저장
				    	$("#map_x").val(result[0]["address"].x); 
				    	$("#map_y").val(result[0]["address"].y);
				    	$("#region1").val(result[0]["address"].region_1depth_name); 
				    	$("#region2").val(result[0]["address"].region_2depth_name);
				    	$("#region3").val(result[0]["address"].region_3depth_name);
				    }
				};
				
				//맵 API 함수 , 주소값과 callback 이란 함수를 넣어서 결고값음 callback 함수에서 받기   
				geocoder.addressSearch(data.address, callback);
				
				//우편번호 API 에서 받은 주소값 주소 input 에 넣기  
                $("#addr").val(data.address);
            }
        }).open();
    }
</script>
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