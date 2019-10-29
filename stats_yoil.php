<?php
 session_start();
 require_once("conf.php");
 ?>
<?php
	//가장 촬영을 많이 한 회원 아이디순
	$yoil_result = mysqli_query($link,"SELECT  yoil,count(yoil) as cnt FROM `garbage` where region3 is not null group by yoil order by cnt desc;");
	
	$time_result = mysqli_query($link,"SELECT  time,count(time) as cnt FROM `garbage` where region3 is not null group by time order by cnt desc;");
?>
<div id="page-wrapper">
			<!-- /.row -->
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
						 <?php 
						require_once("stats_tab.php"); ?>
						<h3>가장 촬영을 많이하는 요일</h3>
						<table class="table">
								<tr>
									<td>요일</td>
									<td>촬영횟수</td>
								</tr>
								<?php while ($row = mysqli_fetch_array($yoil_result)) { ?>
								<tr>
									<td><?=$row["yoil"] ?>요일</td>
									<td><?=$row["cnt"] ?></td>
								</tr>
								<?php } ?>
						</table>

						<h3>가장 촬영을 많이하는 시간대</h3>
						<table class="table">
								<tr>
									<td>시간</td>
									<td>촬영횟수</td>
								</tr>
								<?php while ($row = mysqli_fetch_array($time_result)) { ?>
								<tr>
									<td><?=$row["time"] ?>시</td>
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
