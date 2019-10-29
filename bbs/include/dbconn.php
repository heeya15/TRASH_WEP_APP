
	<?php
	$link = mysqli_connect("localhost","root","asddsa123","iccc");
	
	//mysql 접속에러 메세지
	if(mysqli_connect_errno()){
		echo "Error: unable to connect to MySQL.".PHP_EOL;
		echo "Debugging errno:".mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error:".mysqli_connect_erroer() . PHP_EOL;
	exit;
	}
	?>

