<?php
session_start();

$bid = $_GET['goods_id'];
echo implode("-", $_SESSION['shop-cart'][1]);

$arr = $_SESSION['shop-cart'];
for ($i = 0; $i < count($arr[0]); $i++) {
  if ($arr[0][$i] == $bid) {
    if ($arr[1][$i] > 1) {
      $arr[1][$i] = $arr[1][$i] - 1;
    }
  }
}

$_SESSION['shop-cart'] = $arr;
//header('location:view_shopCart.php');