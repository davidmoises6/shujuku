<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
$oid=$_GET['oid'];
$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bshop";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql="UPDATE orders
SET oreminder='1'
WHERE oid=$oid;";
mysqli_query($conn,$sql);

  ?>

    <a  align='center' href='orders.php'>返回订单</a>
    
 
 


</body>
</html>