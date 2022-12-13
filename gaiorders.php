<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
$oid=$_SESSION['newoid'];
$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bshop";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  mysqli_query($conn, 'set names utf8');
  if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $address=$_GET["address"];
  $phone=$_GET["phone"];
  $message=$_GET["message"];
  if( $address!=""){
    $sql="UPDATE orders
    SET oaddress='$address'
    WHERE oid='$oid';";
  $result=mysqli_query($conn,$sql);

  }
  if( $phone!=""){
    $sql="UPDATE orders
    SET ophone='$phone'
    WHERE oid='$oid';";
  $result=mysqli_query($conn,$sql);

  }
  if( $message!=""){
    $sql="UPDATE orders
    SET omessage='$message'
    WHERE oid='$oid';";
  $result=mysqli_query($conn,$sql);

  }
  mysqli_close($conn);
  
 echo "修改成功!";
 
?>
<a href='orders.php'>返回</a>
</body>
</html>