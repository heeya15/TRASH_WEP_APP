<?php
session_start();
?>
  
        
<select id="stats_tab" class="form-control">
<?php 
		if($_SERVER["PHP_SELF"] == "/stats_id.php")$sel_str = "selected";
		
		 ?>
		<option value="elements.php" <?=$sel_str?> >
		
        가장 촬영을 많이 한 회원 아이디순
        </option>
         <?php 
		 if($_SERVER["PHP_SELF"] == "/stats_garbage.php") $sel_str = "selected";
		  ?>
		<option value="stats_garbage.php"  <?=$sel_str?> >가장 많은 쓰레기 종류 순
          </option>
          <?php 
		if($_SERVER["PHP_SELF"] == "stats_yoil.php") $sel_str = "selected"?>
		<option value="stats_yoil.php" <?=$sel_str?> >가장 촬영을 많이하는 요일+시간대 순
        </option>
        <?php if($_SERVER["PHP_SELF"] == "stats_location.php") $sel_str = "selected" ?>
		<option value="stats_location.php" <?=$sel_str?> >가장 쓰레기가 많이 발견된 지역</option>
</select>

<script>

		//select 변경시 해당 value 값페이지로 이동 
		$("#stats_tab").change(function(){
				location.href = $(this).val();
		});
</script>