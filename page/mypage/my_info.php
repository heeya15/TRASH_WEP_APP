<?php require $_SERVER["DOCUMENT_ROOT"]."/include/head.php"; ?>
<?php
	$result = mysqli_query($link,"select * from member where mb_id = '".$_SESSION["ss_id"]."'");
	$row = mysqli_fetch_assoc($result);
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					
					<?php require $_SERVER["DOCUMENT_ROOT"]."/page/mypage/mypage_tab.php"; ?>

					<div class="form-group" style="margin-top:20px;">
						<label for="id" style="font-size:20px;">내포인트:<?=$row["mb_point"] ?>점</label>
					</div>
										
					<h3>회원정보수정</h3>
					<form name="frm_subscribe" action="/page/mypage/my_info_process.php" method="post">

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
<?php require $_SERVER["DOCUMENT_ROOT"]."/include/tail.php"; ?>
