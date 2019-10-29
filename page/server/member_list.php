<?php require $_SERVER["DOCUMENT_ROOT"]."/include/head.php"; ?>
<?php
	$result = mysqli_query($link,"select * from member");
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					
						<?php require $_SERVER["DOCUMENT_ROOT"]."/page/server/server_tab.php"; ?>
						<h3>회원관리</h3>
						<table class="table">
								<tr>
									<td>회원아이디</td>
									<td>이름</td>
									<td>기능</td>
								</tr>
								
								<?php while ($row = mysqli_fetch_array($result)) { ?>
								<tr>
									<td><?=$row["mb_id"] ?></td>
									<td><?=$row["mb_name"] ?></td>
									<td><button class="btn btn-danger" type="button" onclick="member_delete('<?=$row["mb_id"] ?>')">삭제</button></td>
								</tr>
								<?php } ?>
						</table>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->

<script>
	function member_delete(mb_id){
		if(confirm("정말 삭제하시겠습니까?")){
			location.href = "/page/server/member_list_delete_process.php?mb_id="+mb_id;	
		}
	}
</script>


<?php require $_SERVER["DOCUMENT_ROOT"]."/include/tail.php"; ?>
