 <?php
session_start();

$title1 = $site_name_abbr." LogIn";
$title2 = $site_name." LogOut";

if (isset($_GET['act'])) {
// 로그인 및 세션 처리
 //------------------------------------------------------------------------------------------
if ($_GET['act'] == 'login') {
require_once "./bbs/include/dbconn.php";
$post_id = trim($_POST['nm_id']);
//$post_pw = md5(trim($_POST['nm_pwd']));
$post_pw = trim($_POST['nm_pwd']);

$sql = " select * from member where mb_id = '$post_id' and mb_active > 0 limit 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 1) {
$sql = " select * from member where ";
$sql .= " mb_id = '$post_id' and mb_password = '$post_pw' and mb_active = 1 limit 1";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 1) {
$row = mysqli_fetch_object($result);
$_SESSION['ss_name'] = $row->mb_name;
$_SESSION['ss_login_status'] = "logged_in";
$_SESSION['ss_id'] = trim($_POST['nm_id']);
$msg = 'OK';
echo ("<meta http-equiv='refresh' content='0; url=./index.php?page=bbslist'>");
}
else {
$msg = 'PWD';
echo ("<script>alert('Password is Wrong !!!')</script>");
echo ("<meta http-equiv='refresh' content='0; url=./index.php?page=login'>");
   }
  }
else {
$msg = 'ID';
echo ("<script>alert('ID is Wrong or Inactive !!!')</script>");
echo ("<meta http-equiv='refresh' content='0; url=./index.php?page=login'>");
}

}
 // 회원가입 및 세션 처리
 //------------------------------------------------------------------------------------------
 else if ($_GET['act'] == 'subscribe') {
	require_once "./bbs/include/dbconn.php";
	$post_id = trim($_POST['nm_id']);
	//$post_pw = md5(trim($_POST['nm_pwd']));
	$post_pw = trim($_POST['nm_pwd']);
	$post_name = trim($_POST['nm_name']);
	$post_email = trim($_POST['nm_email']);
	
	$sql = " select * from member where mb_id = '$post_id' limit 1";
	$result = mysqli_query($link, $sql);
	
	$now = date("Y-m-d H:i:s",time());
	
	if (mysqli_num_rows($result) <= 0) {
	 $sql = " insert into member ( ";
	$sql .= " mb_id, mb_password, mb_name, ";
	$sql .= " mb_type, mb_datetime, mb_email, mb_active ) values ( ";
	$sql .= " '$post_id', '$post_pw', '$post_name', ";
	$sql .= " 1, '$now', '$post_email', 1 ) ";
	$result = mysqli_query($link, $sql);
	
	//echo "SQL: ".$sql."<br>";

if (mysqli_affected_rows($result) == 1) {
		$row = mysqli_fetch_object($result);
		$_SESSION['ss_name'] = $post_name;
		$_SESSION['ss_login_status'] = "logged_in";
		$_SESSION['ss_id'] = $post_id;
		echo ("<meta http-equiv='refresh' content='0; url=./index.php?page=bbslist'>");
}
else {
	echo ("<script>alert('Subscription Error !!!')</script>");
	echo ("<meta http-equiv='refresh' content='0; url=./index.php?page=login'>");
 		}
}
 else {
echo ("<script>alert('The same ID exists !!!')</script>");
echo ("<meta http-equiv='refresh' content='0; url=./index.php?page=login'>");
 }

}
else if ($_GET['act'] == 'logout') { // 로그아웃 및 세션 처리
$_SESSION['ss_login_status'] = "";
$_SESSION['ss_id'] = "";
echo ("<meta http-equiv='refresh' content='0; url=./index.php'>");
}
}
else {
?>
<div class="container-fluid">
<br>
<?php
// 로그인이 아닌경우 처리 (로그인 및 회원가입 창 보여주기)
 //------------------------------------------------------------------------------------------
if ($_SESSION['ss_login_status'] != 'logged_in') {
?>
<h2 style="text-align:center;"><?=$title1?></h2>
<br><br>
<div style="text-align:center;">
<form name="nm_login" class="form-inline" action="./index.php?page=login&act=login" method="post">
<label for="ID">ID:</label>
<input type="text" class="form-control" id="id_id" placeholder="Enter ID" name="nm_id">
<label for="pwd">Password:</label>
<input type="password" class="form-control" id="id_pwd" placeholder="Enter password" name="nm_pwd">
<button type="submit" class="btn btn-primary">Log In</button>
</form>
</div>

<br /><hr />
<h2 style="text-align:center;">Member Subscription</h2>
<form name="frm_subscribe" action="./index.php?page=login&act=subscribe" method="post">
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
<div class="form-group">
<label for="email">Email:</label>
<input type="email" class="form-control" id="id_email2" name="nm_email" required>
</div>
<div style="text-align:center;">
<button type="submit" onClick="return checkPwd();" class="btn btn-primary">Subscribe</button>
</div>
</form>
<br /><br /><br /><br /><br />
<?php
}
 // 로그인한 경우, 로그아웃 창만 보여주가
 //------------------------------------------------------------------------------------------
else {
?>
<h2 style="text-align:center;"><?=$title2?></h2>
<br><br>
<div style="text-align:center;">
<form name="nm_logout" class="form-inline" action="./index.php?page=login&act=logout" method="post">
<input type="hidden" name="nm_id" value="<?=$SESSION['ss_id']?>" />
<button type="submit" class="btn btn-primary">Log Out</button>
</form>
</div>
<?php
} // else
?>
</div>
<?php
} // else
?>

 <script>
function checkPwd() {
let pwd1 = document .getElementById ('id_pwd2').value;
let pwd2 = document.getElementById('id_pwd3').value;

if (pwd1 != pwd2) {
alert ("Passwords Mismatch !!!");
return false;
 }
 return true;
}
