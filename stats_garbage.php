<?php
 session_start();
 require_once("conf.php");
 ?>
<?php
	//가장 촬영을 많이 한 회원 아이디순
	$result = mysqli_query($link,"SELECT  garbage_type,count(garbage_type) as cnt FROM `garbage` group by garbage_type order by cnt desc;");
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
			 <?php 
			 require_once("stats_tab.php"); ?>
						<h3>가장 많은 쓰레기 종류 순</h3>
						<table class="table">
								<tr>
									<td>쓰레기종료</td>
									<td>촬영횟수</td>
								</tr>
								<?php while ($row = mysqli_fetch_array($result)) { ?>
								<tr>
									<td><?=$row["garbage_type"] ?></td>
									<td><?=$row["cnt"] ?></td>
								</tr>
								<?php } ?>
						</table>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
</div>
<!-- /#page-wrapper -->

<?php require $_SERVER["DOCUMENT_ROOT"]."/include/tail.php"; ?>
