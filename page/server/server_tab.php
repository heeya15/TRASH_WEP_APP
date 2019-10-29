<ul class="nav nav-tabs">
 <li class="nav-item <?php if($_SERVER["PHP_SELF"] == "/page/server/garbage_type.php") echo "active"; ?>">
    <a class="nav-link" data-toggle="tab" href="/page/server/garbage_type.php">쓰레기 종류 관리</a>
  </li>
  
  <li class="nav-item <?php if($_SERVER["PHP_SELF"] == "/page/server/member_list.php") echo "active"; ?>">
    <a class="nav-link" data-toggle="tab" href="/page/server/member_list.php">회원관리</a>
  </li>
  
  <li class="nav-item <?php if($_SERVER["PHP_SELF"] == "/page/server/garbage_upload_list.php") echo "active"; ?>">
    <a class="nav-link" data-toggle="tab" href="/page/server/garbage_upload_list.php">쓰레기 업로드 관리</a>
  </li>
</ul>