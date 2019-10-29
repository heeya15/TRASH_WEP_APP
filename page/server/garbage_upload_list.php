<?php require $_SERVER["DOCUMENT_ROOT"]."/include/head.php"; ?>
<?php
	$result = mysqli_query($link,"select * from garbage");
?>

<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					
						 <?php require $_SERVER["DOCUMENT_ROOT"]."/page/server/server_tab.php"; ?>
						<h3>쓰레기 업로드 관리</h3>
						<table class="table">
								<tr>
									<td>사진</td>
									<td>주소</td>
									<td>쓰레기종류</td>
									<td>등록일</td>
									<td>기능</td>
								</tr>
								<?php while ($row = mysqli_fetch_array($result)) { ?>
								<tr>
									<td><img src="/uploads/<?=$row["file_name"] ?>" width="100" height="100" /></td>
									<td><?=$row["addr"] ?></td>
									<td><?=$row["garbage_type"] ?></td>
									<td><?=$row["regdate"] ?></td>
									<td>
										 <a class="btn btn-primary" href="/page/server/garbage_modify.php?id=<?=$row["id"] ?>">수정</a>
										<button class="btn btn-danger" type="button" onclick="garbage_delete(<?=$row["id"] ?>)">삭제</button>
									</td>
								</tr>
								<?php } ?>
						</table>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->
<script>
	function garbage_delete(id){
		if(confirm("정말 삭제하시겠습니까?")){
			location.href = "/page/server/garbage_upload_list_delete_process.php?id="+id;	
		}
	}
</script>

<?php require $_SERVER["DOCUMENT_ROOT"]."/include/tail.php"; ?>
