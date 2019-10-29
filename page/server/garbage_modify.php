<?php require $_SERVER["DOCUMENT_ROOT"]."/include/head.php"; ?>
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
						    <form method="post" action="/page/server/garbage_modify_process.php" enctype="multipart/form-data">
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
						    		<button type="submit" class="btn btn-primary">수정하기</button>
						    		<a href="/page/server/garbage_upload_list.php" class="btn btn-default">목록</a>
						    	</div>
						    </form>
						<br/>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->

<?php require $_SERVER["DOCUMENT_ROOT"]."/include/tail.php"; ?>