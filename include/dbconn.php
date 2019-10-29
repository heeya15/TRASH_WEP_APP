<?php
   //DB연결 
   $link = mysqli_connect("localhost","root","asddsa123","iccc");
   if(mysqli_connect_errno()){
      echo "Error: Unable to connect to MySQL.". PHP_EOL;
      echo "Debugging errno:".mysqli_connect_errno().PHP_EOL;
      echo "Debugging error:".mysqli_connect_error().PHP_EOL;
      exit;
   }
   else{
      //echo "Link 연결 성공 !!!"."<br>";
   }
   
 
   
?>