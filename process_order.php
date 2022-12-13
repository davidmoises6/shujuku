<?php
session_start();
time();
//$_SESSION['phone']=1;
//$_SESSION['address']=2;//暂时无登录,应该在登录处理进程定义
$address = $_GET["address"];
$phone = $_GET["phone"];
$message = $_GET["message"];
$cid=$_SESSION['cid'];
if ($message == "") {
  $message = 0;
}
if ($address == "") {
  $address = $_SESSION['address'];
}

if ($phone == "") {
  $phone = $_SESSION['phone'];
} //看是否修改了地址、手机号，没修改则获取之前存在session中的（！！！！得叫他们做！！！！！）
$osumprice = $_SESSION['osumprice'];
$date = date('Ymd');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bshop";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn, 'set names utf8');
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//插入订单

$sql = "insert into orders (odate,cid,osumprice,oaddress,oreminder,omessage,ostatus,ofinishdate,ophone)
                      values ('$date','$cid','$osumprice','$address','0','$message','0','1','$phone');";
$result = mysqli_query($conn, $sql);
//获取插入的订单号
$o_sql = "select max(oid) from orders;";
$result = mysqli_query($conn, $o_sql);
$row = mysqli_fetch_assoc($result);
$oid = implode("-", $row);
//添加订单与书名的连接表
$arr = $_SESSION['shop-cart'];
for ($i = 0; $i < count($arr[0]); $i++) {
  $a = $arr[0][$i];
  $b = $arr[1][$i];
  $bouni_sql = "insert into bouni values('$a','$oid',$b);";
  $result = mysqli_query($conn, $bouni_sql);
  //找书删库存
  $num_sql = $sql = "UPDATE book
  SET bamount=bamount-'$b'
  WHERE bid='$a';";
  $result = mysqli_query($conn, $num_sql);
}
$arr = $_SESSION['shop-cart'];

//插入书与订单连接表
$_SESSION['shop-cart'] = 0;
mysqli_close($conn);
header('location:clearCart.php');