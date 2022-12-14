<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>检索结果</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="网购模板.css" rel="stylesheet">
</head>
<?php
session_start();
$character = $_SESSION['charactor'];
if ($character == "worker") {
  $wname = $_SESSION['wname'];
  echo "<h2>欢迎" . $wname . "进入书店!</h2>";
} else {
  $cname = $_SESSION['cname'];
  echo "<h2>欢迎" . $cname . "进入书店!</h2>";
}
?>

<body>
    <?php
  include("常用的.php");
  templete($character);
  ?>
    <form action='订单检索结果.php' method='get' class='search-box'>
        <select name="search_type" class='search-type' >
            <option value="oid">订单号</option>
            <option value="status">订单状态</option>
            <option value="date">订单时间</option>
            <option value="cid">顾客id</option>
        </select>
        <input class='search-txt' type="text" name='search' size='30' required=required placeholder="请输入" />
        <button class='search-btn' type="submit"><i class="fas fa-search"></i></button>
    </form>
    <table border="1" align="center" width='100%'>
        <tr>
            <th align="center" width="15%">订单号</th>
            <th align="center" width="15%">订单时间</th>
            <th align="center" width="15%">订单顾客id</th>
            <th align="center" width="10%">地址</th>
            <th align="center" width="10%">手机号</th>
            <th align="center" width="10%">留言</th>
            <th align="center" width="10%">状态</th>
            <th align="center" width="10%">催单</th>
            <th align="center" width="15%">功能</th>
        </tr>

        <?php

    $type = $_GET['search_type']; //订单号、订单时间、订单id、顾客id
    $search = $_GET['search']; //搜索内容}

    $server = 'localhost';
    $username = 'root';
    $pw = '';
    $db = 'bshop';

    $conn = mysqli_connect($server, $username, $pw, $db);
    mysqli_query($conn, 'set names utf8'); //处理中文乱码
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL:" . mysqli_connect_error();
    }
    function query($sql)
    {
      global $conn;
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        die("Failed to query '" . $sql . "'");
      }
      return $result;
    }

    function template($result)
    { //$result是
      global $character;
      while ($row = mysqli_fetch_assoc($result)) {
        $oid = $row['oid'];
        $odate = $row['odate'];
        $cid=$row['cid'];
        $oaddress = $row['oaddress'];
        $ophone = $row['ophone'];
        $omessage = $row['omessage'];
        $ostatus = $row['ostatus'];
        $oreminder = $row['oreminder'];
        $anamearr = array();
        $ct = 0;
        
        echo "<tr>";
     
      echo "<td align='center'>" . $oid . "</td>";
      echo "<td align='center'>" . $odate . "</td>";
      echo "<td align='center'>" . $cid . "</td>";
      echo "<td align='center'>" . $oaddress . "</td>";
      echo "<td align='center'>" . $ophone . "</td>";
      echo "<td align='center'>" . $omessage . "</td>";
      echo "<td align='center'>" .$ostatus. "</td>";
      echo "<td align='center'>" . $oreminder . "</td>";
      echo "<td align='center'>";
         echo "<a href='订单详情.php?oid=" . $oid . "'>订单详情</a>";
         echo "<br>";
        echo "<a href='删除订单.php?oid=" . $oid . "'>删除订单</a>";
        echo "<br>";
        echo "<a href='发货.php?oid=" . $oid . "'>发货</a>";
        
        echo "</td>";
        echo "</tr>";
      }
    }


    echo '‘' . $type . '’为‘' . $search . '’的搜索结果'; //字大一点，加粗
    if ($type == 'oid') {
      $sql = "SELECT * FROM orders WHERE oid like '%" . $search . "%';";
      template(query($sql));
    } else if ($type == 'status') {
      // 找aid
      $sql = "SELECT * FROM orders WHERE ostatus like '%" . $search . "%';";
      template(query($sql));
      }
    else if ($type == 'date') {
      $sql = "SELECT * FROM orders WHERE odate like '" . $search . "%';";
      template(query($sql));
    } 
    else if ($type == 'cid') {
        $sql = "SELECT * FROM orders WHERE cid like '" . $search . "%';";
        template(query($sql));
      }else {
      die("TYPE ERROR!");
    }
    mysqli_close($conn);
    ?>