<!DOCTYPE HTML>
<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
<html>
	<head>
		<title>Garbage Location Application Html</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="landing is-preload">
	

			<!-- CTA -->
				<section id="cta">

<link href="/css/min.css" rel="stylesheet" type="text/css">
<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="/css/metisMenu.min.css" rel="stylesheet">
<link href="/css/sb-admin-2.css" rel="stylesheet">
<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery.min.js"></script>
<?php
 if ($_SESSION['ss_login_status'] != 'logged_in')  //로그인 상태가 아닐때 
 {
	  ?>
<h2 style="text-align:center;">Trash Member Loigin</h2>
<br><br>
<div style="text-align:center;">
	<form name="nm_login" class="form-inline" action="plogin.php" method="post">
		<label for="ID">ID:</label>
       <br />
		<input type="text" class="form-control" id="id_id" placeholder="Enter ID" name="nm_id">
        <br />
		<label for="pwd">Password:</label>
        <br />
		<input type="password" class="form-control" id="id_pwd" placeholder="Enter password" name="nm_pwd">
         <br />
		<button type="submit" class="btn btn-primary">Log In</button>
	</form>
</div>
<br /><hr />
<h2 style="text-align:center;">Member Subscription</h2>
<form name="frm_subscribe" action="/page/subscribe_process.php" method="post">
	<div class="form-group">
	<label for="id">Id:</label>
	<input type="text" class="form-control" id="id_id2" name="nm_id" required>
	</div>
	<div class="form-group">
	<label for="pwd">Password:</label>
	<input type="password" class="form-control" id="id_pwd2" name="nm_pwd" required>
	</div>
	<div class="form-group">
	<label for="pwd"2>Password again:</label>
	<input type="password" class="form-control" id="id_pwd3" name="nm_pwd2" required>
	</div>
	<div class="form-group">
	<label for="id">Name:</label>
	<input type="text" class="form-control" id="id_name2" name="nm_name" required>
	</div>
	<div style="text-align:center;">
	<button type="submit" onClick="return checkPwd();" class="btn btn-primary">Subscribe</button>
	</div>
</form>
<br /><br /><br /><br /><br />
<?php 
}else
 { 
 ?>
	<h2 style="text-align:center;">Trash information web</h2>
<?php 
} // else 
?>
	</section>

		

</div>
</body>
</html>