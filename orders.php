<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Product information</title>
    <link href="网购模板.css" rel="stylesheet">
</head>
<h2 align='center'>我的订单</h2>

<body class="body">
    <table border="1" class="table" align='center'>
        <tr>
            <th align='center' width="10%">订单号</th>
            <th align='center' width="10%">总价格</th>
            <th align='center' width="10%">地址</th>
            <th align='center' width="10%">下单时间</th>
            <th align='center' width="10%">状态</th>
            <th align='center' width="10%">手机号</th>

            <th align='center' width="10%"></th>
            <th align='center' width="10%"></th>
            <th align='center' width="10%"></th>
        </tr>

        <?php
        session_start();
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bshop";

        // 创建连接
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        mysqli_query($conn, 'set names utf8'); //处理中文乱码

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $cid = $_SESSION['cid']; //找该用户的订单
        $sql = "SELECT * FROM orders where cid='$cid';";
        $result = mysqli_query($conn, $sql); //result is a PHP array

        $num_rows = mysqli_num_rows($result);

        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $oid = $row["oid"];
            $osumprice = $row["osumprice"];
            $oaddress = $row["oaddress"];
            $odate = $row["odate"];
            $ostatus = $row["ostatus"];
            $ophone = $row["ophone"];

            echo "<tr>";
            echo "<td align='center'>" . $oid . "</td>";
            echo "<td align='center'>" . $osumprice . "￥</td>";
            echo "<td align='center'>" . $oaddress . "</td>";
            echo "<td align='center'>" . $odate . "</td>";
            echo "<td align='center'>" . $ostatus . "</td>";
            echo "<td align='center'>" . $ophone . "</td>";
        ?>

        <td><a align='center' href='delorders.php?oid=<?php echo $oid; ?>'>取消订单</a></td>
        <td><a align='center' href='cuiorders.php?oid=<?php echo $oid; ?>'>催单</a></td>
        <td><a align='center' href='xiugai.php?oid=<?php echo $oid; ?>'>修改</a></td>
        <?php

            echo "</tr>";
            $i++;
        }
        mysqli_close($conn);
        ?>
    </table>
    <br><br>
    <a align='right' href='检索页面.php'>返回浏览商品</a>
    <br><br><br>
</body>

</html>