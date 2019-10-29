<ul class="nav nav-tabs">
  <li class="nav-item <?php if($_SERVER["PHP_SELF"] == "/page/mypage/my_info.php") echo "active"; ?>">
    <a class="nav-link" data-toggle="tab" href="/page/mypage/my_info.php">내정보</a>
  </li>
  
  <li class="nav-item <?php if($_SERVER["PHP_SELF"] == "/page/mypage/garbage_upload_list.php") echo "active"; ?>">
    <a class="nav-link" data-toggle="tab" href="/page/mypage/garbage_upload_list.php">업로드한 쓰레기목록</a>
  </li>
</ul>