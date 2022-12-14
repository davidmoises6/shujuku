<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
$oid=$_GET['oid'];
$wy=$_SESSION['wy'];
$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bshop";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  mysqli_query($conn, 'set names utf8');
  if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
  $select_sql="select ostatus from orders where oid='$oid'";
  $row=mysqli_query($conn,$select_sql);
  $status= mysqli_fetch_assoc($select_result);
if($status==0){
  
    $sql="UPDATE orders
    SET ostatus='已发货'
    WHERE oid='$oid';";
  $result=mysqli_query($conn,$sql);
?>
<a align='center' href='<?php echo $_SESSION['wy']; ?>'>返回</a><?php
}

?>
</body>
</html>