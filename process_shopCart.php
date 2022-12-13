<?php

session_start();

$bid = $_GET['bid'];
echo $bid;
if(empty($_SESSION['shop-cart']))

{

  //1.购物车是空的，第一次点击添加购物车

  $arr = array(

    array($bid),array(1)

  );

  $_SESSION['shop-cart']=$arr;

}

else

{

  //不是第一次点击

  //判断购物车中是否存在该商品

  $arr = $_SESSION['shop-cart']; //先存一下

  $chuxian = false;

  for($i=0;$i<count($arr[0]);$i++)

  {

    if($arr[0][$i]==$bid)

    {

      $chuxian = true;

    }

  }

  if($chuxian==true)

  {

    //3.如果购物车中有该商品

    for($i=0;$i<count($arr[0]);$i++)

    {

      if($arr[0][$i]==$bid)

      {

        $arr[1][$i]=$arr[1][$i]+1;

      }

    }

    $_SESSION['shop-cart'] = $arr;

  }

  else

  {

    //2.如果购物车中没有该商品

    $asg = array(array($bid),array(1));

    $arr[0][] = $asg[0][0];
    $arr[1][] = $asg[1][0];


    $_SESSION['shop-cart'] = $arr;

  }

}

header('location:检索页面_顾客.php');
?>