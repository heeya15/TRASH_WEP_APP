<?php
 session_start();
 require_once("conf.php");
 ?>
<?php
	//가장 촬영을 많이 한 회원 아이디순
	$result = mysqli_query($link,"select * from member order by mb_point desc");
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
						 <?php 
					require_once("stats_tab.php"); ?>
						<h3>가장 촬영을 많이 한 회원 아이디순</h3>
						<table class="table">
								<tr>
									<td>아이디</td>
									<td>촬영횟수</td>
								</tr>
								<?php while ($row = mysqli_fetch_array($result)) { ?>
								<tr>
									<td><?=$row["mb_id"] ?></td>
									<td><?=$row["mb_point"] ?></td>
								</tr>
								<?php } ?>
						</table>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->

<?php require $_SERVER["DOCUMENT_ROOT"]."/include/tail.php"; ?>
