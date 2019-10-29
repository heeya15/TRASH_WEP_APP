<?php require $_SERVER["DOCUMENT_ROOT"]."/include/head.php"; ?>
<?php
	$result = mysqli_query($link,"select * from garbage_type");
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					
					<?php require $_SERVER["DOCUMENT_ROOT"]."/page/server/server_tab.php"; ?>
					
					
					<div>
						<form method="post" action="/page/server/garbage_type_insert_process.php">
						 	<h3>쓰레기 종류 등록하기</h3>
							<input type="text" class="form-control" name="name" required="" style="width: 50%; float: left;" />
							<button type="submit" class="btn btn-primary" style="float: left;">등록</button>
						</form>
					</div>
					<br/>
					<br/>
					<br/>
					<table class="table">
								<tr>
									<td>쓰레기이름</td>
									<td>기능</td>
								</tr>
								<?php while ($row = mysqli_fetch_array($result)) { ?>
								<tr>
									<td><?=$row["name"] ?></td>
									<td><button class="btn btn-danger" type="button" onclick="garbage_type_delete(<?=$row["id"] ?>)">삭제</button></td>
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
			location.href = "/page/server/garbage_type_delete_process.php?id="+id;	
		}
	}
</script>
<?php require $_SERVER["DOCUMENT_ROOT"]."/include/tail.php"; ?>
