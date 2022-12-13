<?php

session_start();

$bid = $_GET['goods_id'];


$arr = $_SESSION['shop-cart'];
    for($i=0;$i<count($arr[0]);$i++){

      if($arr[0][$i]==$bid){
        //判断是否大于库存
        $servername = "localhost";
        $username = "root";
        $password = "";
           $dbname = "bshop";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
           mysqli_query($conn, 'set names utf8');
        if (mysqli_connect_errno()){
           echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
         $sql="SELECT bamount FROM book where bid='$bid'";
        $result=mysqli_query($conn,$sql);
         $row = mysqli_fetch_assoc($result);
         $amount=implode("-",$row);
       if($arr[1][$i]+1<=$amount){
        $arr[1][$i]=$arr[1][$i]+1;
        echo  "成功增加!";
       }
         else{
         echo "库存不足！";
         }
        

      }
    }

    
    $_SESSION['shop-cart'] = $arr;



  



   
?>
<html><head></head><body><a href='view_shopCart.php' >返回</a></body></html>