<?php require $_SERVER["DOCUMENT_ROOT"]."/include/head.php"; ?>
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
						    <form method="post" action="/page/camera_process.php" enctype="multipart/form-data">
						    	<input type="hidden" name="region1" id="region1" value="" />
						    	<input type="hidden" name="region2" id="region2" value="" />
						    	<input type="hidden" name="region3" id="region3" value="" />
						    	
						    	<input type="hidden" name="map_x" id="map_x" value="" />
						    	<input type="hidden" name="map_y" id="map_y" value="" />
						    	
						    	사진 <br/>
						    	<input type="file" id="camera" name="camera" capture="camera" accept="image/*"/>
						    	<br/>
						    	<img id="pic" style="width: 100px;height: 100px;" /><br/>
						    	<br/>
						    	주소입력:<br/>
						    	<input type="text" onclick="get_addr()" class="form-control" name="addr" id="addr" required="" />
						    	<br/>
						    	쓰레기종류 : <br/>
						    	<select class="form-control" name="garbage_type" required="">
						    		<?php 
						    		//DB에저장된 쓰레기 종류 리스트 가져오기 
						    		$garbage_type_result = mysqli_query($link,"select * from garbage_type");
						    		while ($garbage_row = mysqli_fetch_array($garbage_type_result)) { 
						    		?>
						    		<option value="<?=$garbage_row["name"] ?>"><?=$garbage_row["name"] ?></option>
						    		<?php } ?>
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
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=$map_api_key ?>&libraries=services"></script>

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
<?php require $_SERVER["DOCUMENT_ROOT"]."/include/tail.php"; ?>