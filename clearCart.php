<?php
session_start();
$p_id = $_GET["goods_id"];
echo $p_id;
$servername = "localhost";
$username = 'root';
$password = '';
$dbname = 'bshop';

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn, 'set names utf8');
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL:" . mysqli_connect_error();
}
$u_id = $_SESSION['cid'];
$sql1 = "SELECT * FROM customer WHERE cid='$u_id' ;";
$query_result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($query_result); {

	$phone = $row["cphone"];
	$address = $row["caddress"];
	$cname = $row["cname"];
	$_SESSION['cid'] = $u_id;
	$_SESSION['phone'] = $phone;
	$_SESSION['address'] = $address;
	$_SESSION['cname'] = $cname;
}
if (isset($_SESSION['shop-cart'])) {
	echo "destroy session";
	echo "<br>";
	echo "<br>";
	$result = session_destroy();;
} else {
	echo "There is no goods in shop cart!";
}

echo "<br>";
echo $result;
echo "<br>";
echo "<br>";
var_dump($_SESSION);
session_start();
$_SESSION['charactor'] = "customer";
$_SESSION['cid'] = $u_id;
$_SESSION['phone'] = $phone;
$_SESSION['address'] = $address;
$_SESSION['cname'] = $cname;
header("location:view_shopCart.php");?>