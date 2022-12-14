<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
    session_start();
    
  $oid = $_GET['oid'];
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bshop";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //判断状态是否可删除
  $sql = "SELECT ostatus FROM orders where oid='$oid';";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $ostatus = implode("-", $row);
  //删除实现
  if ($ostatus == 0) {
    //返还库存
    $num_sql = "SELECT * FROM bouni WHERE oid ='$oid';";
    $num_result = mysqli_query($conn, $num_sql); //result is a PHP array

    $num_rows = mysqli_num_rows($num_result);
    while ($arow = mysqli_fetch_assoc($num_result)) {
      $bid = $arow['bid'];
      $num = $arow['amount'];
      //找到书籍返还库存
      $num_sql = "UPDATE book SET bamount=bamount+'$num' WHERE bid='$bid';";
      mysqli_query($conn, $num_sql);
      $del1_sql = "DELETE FROM bouni WHERE oid='$oid';";
      mysqli_query($conn, $del1_sql);
      echo "成功删除！";
    }
    $del_sql = "DELETE FROM orders WHERE oid='$oid';";
    mysqli_query($conn, $del_sql);
  ?>
    <a align='center' href='<?php echo $_SESSION['wy']; ?>'>返回</a>
    <?php } else {
    echo "订单处于发货后不可取消"; ?>
    <a align='center' href='<?php echo $_SESSION['wy']; ?>'>返回</a>
    <?php }
  ?>
</body>

</html>