<?php
session_start();
$p_id = $_GET["goods_id"];
echo $p_id;

if(isset($_SESSION['shop-cart'])){
	echo "destroy session";
	echo "<br>";
	echo "<br>";
	$result = session_destroy();
}else{
	echo "There is no goods in shop cart!";
}

echo "<br>";
echo $result;
echo "<br>";
echo "<br>";
var_dump($_SESSION);
header("location:orders.php");
?>


