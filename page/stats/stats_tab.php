<select id="stats_tab" class="form-control">
		<option value="/page/stats/stats_id.php" <?php if($_SERVER["PHP_SELF"] == "/page/stats/stats_id.php") echo "selected"; ?>>가장 촬영을 많이 한 회원 아이디순</option>
		<option value="/page/stats/stats_garbage.php"  <?php if($_SERVER["PHP_SELF"] == "/page/stats/stats_garbage.php") echo "selected"; ?>>가장 많은 쓰레기 종류 순</option>
		<option value="/page/stats/stats_yoil.php"  <?php if($_SERVER["PHP_SELF"] == "/page/stats/stats_yoil.php") echo "selected"; ?>>가장 촬영을 많이하는 요일+시간대 순</option>
		<option value="/page/stats/stats_location.php"  <?php if($_SERVER["PHP_SELF"] == "/page/stats/stats_location.php") echo "selected"; ?>>가장 쓰레기가 많이 발견된 지역</option>
</select>

<script>

		//select 변경시 해당 value 값페이지로 이동 
		$("#stats_tab").change(function(){
				location.href = $(this).val();
		});
</script>