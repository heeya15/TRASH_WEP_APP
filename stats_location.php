<?php
 session_start();
 require_once("conf.php");
 ?>
<?php
	$result = mysqli_query($link,"SELECT  region3,count(region3) as cnt FROM `garbage` where region3 is not null group by region3 order by cnt desc;");
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
						 <?php 
						require_once("stats_tab.php"); 
						?>
						<h3>가장 쓰레기가 많이 발견된 지역</h3>
						<table class="table">
								<tr>
									<td>아이디</td>
									<td>촬영횟수</td>
								</tr>
								<?php while ($row = mysqli_fetch_array($result)) { ?>
								<tr>
									<td><?=$row["region3"] ?></td>
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
