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
    <form action='检索结果.php' method='get' class='search-box'>
        <select name="search_type" class='search-type'>
            <option value="bname">书名</option>
            <option value="aname">作者</option>
            <option value="ISBN">ISBN</option>
        </select>
        <input class='search-txt' type="text" name='search' size='20' required=required placeholder="请输入" />
        <button class='search-btn' type="submit"><i class="fas fa-search"></i></button>
    </form>
    </form>
    <table border="1" align="center" width='100%'>
        <tr>
            <th align="center" width="15%">图片</th>
            <th align="center" width="15%">书名</th>
            <th align="center" width="15%">作者</th>
            <th align="center" width="10%">出版时期</th>
            <th align="center" width="10%">页数</th>
            <th align="center" width="10%">价格</th>
            <th align="center" width="10%">库存</th>
            <th align="center" width="15%">功能</th>
        </tr>

        <?php

    $type = $_GET['search_type']; //bname,aname,ISBN
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
        $bid = $row['bid'];
        $bname = $row['bname'];
        $bamount = $row['bamount'];
        $bpicture = $row['bpicture'];
        $bprice = $row['bprice'];
        $bpage = $row['bpage'];
        $bpubdate = $row['bpubdate'];
        $anamearr = array();
        $ct = 0;
        // 找作者名 +链表
        $sql = "SELECT aname FROM bauni JOIN author USING (aid) WHERE bid=" . $bid . ";";
        $result1 = query($sql);
        while ($row1 = mysqli_fetch_assoc($result1)) {
          $anamearr[$ct] = $row1['aname'];
          $ct++;
        }
        $aname = implode(",", $anamearr);
        echo "<tr>";
        echo '<td><img style="display:block;margin-left:auto;margin-right:auto;"src="data:image/jpeg;base64,' . base64_encode($bpicture) . '"text-align="center" alt="Not ready" height="200px"/></td>';
        echo "<td align='center'>" . $bname . "</td>";
        echo "<td align='center'>" . $aname . "</td>";
        echo "<td align='center'>" . $bpubdate . "年</td>";
        echo "<td align='center'>" . $bpage . "页</td>";
        echo "<td align='center'>" . $bprice . "元</td>";
        echo "<td align='center'>" . $bamount . "本</td>";
        echo "<td align='center'>";
        if ($character == "worker") {
          echo "<a href='bookinfo.php?bid=" . $bid . "'>修改书籍";
          echo "<br>";
          echo "<a href='delbook.php?bid=" . $bid . "'>删除书籍";
        } else {
          echo "<a href='bookinfo.php?bid=" . $bid . "'>书籍页面";
          echo "<br>";
          if ($bamount >= 1) {
            echo "<a href='process_shopCart.php?bid=" . $bid . "'>加入购物车";
          }
        }
        echo "</td>";
        echo "</tr>";
      }
    }


    echo '‘' . $type . '’为‘' . $search . '’的搜索结果'; //字大一点，加粗
    if ($type == 'bname') {
      $sql = "SELECT * FROM book WHERE bname like '%" . $search . "%';";
      template(query($sql));
    } else if ($type == 'aname') {
      // 找aid
      $sql = "SELECT aid FROM author WHERE aname like '%" . $search . "%';";
      $result = query($sql);
      // 若有多个aid（模糊检索，作者会出现若干个）
      while ($row1 = mysqli_fetch_assoc($result)) {
        $aid = $row1['aid'];
        // 找bid
        $sql1 = "SELECT bid FROM bauni WHERE aid=" . $aid . ";";
        $result1 = query($sql1);
        while ($row2 = mysqli_fetch_assoc($result1)) {
          $bid = $row2['bid'];
          // 找书名和库存
          $sql2 = "SELECT * FROM book WHERE bid=" . $bid . ";";
          template(query($sql2));
        }
      }
    } else if ($type == 'ISBN') {
      $sql = "SELECT * FROM book WHERE bISBN like '" . $search . "%';";
      template(query($sql));
    } else {
      die("TYPE ERROR!");
    }
    mysqli_close($conn);
    ?>