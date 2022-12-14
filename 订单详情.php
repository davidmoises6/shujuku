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
$oid=$_GET['oid'];
echo "<h2>订单" . $oid. "</h2>"; 
?>

<body>
<a align='center' href='<?php echo $_SESSION['wy']; ?>' style="position:absolute; top:48px; left:120px;"><h2>返回<h2></a>
    <?php
  include("常用的.php");
  templete($character);
  ?>
    
    <table border="1" align="center" width='100%'>
        <tr>
            <th align="center" width="15%">图片</th>
            <th align="center" width="15%">书名</th>
            <th align="center" width="15%">作者</th>
            <th align="center" width="10%">出版时期</th>
            <th align="center" width="10%">页数</th>
            <th align="center" width="10%">价格</th>
            <th align="center" width="10%">数量</th>
            
        </tr>

        <?php

   

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
          $bamount = $row['amount'];
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
          
          echo "</td>";
          echo "</tr>";
        }
      }
  
  
     
      
        $sql = "SELECT * FROM book,bouni WHERE oid='$oid'and book.bid=bouni.bid;";
        template(query($sql));
      
    mysqli_close($conn);
    ?>