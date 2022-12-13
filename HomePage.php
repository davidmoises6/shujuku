<?php session_start(); 
$cname=$_SESSION['cname'];
echo "欢迎".$cname."进入书店!"; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>HomePage</title>
        <meta charset="utf-8">
    </head>
    <body>
           <!--连接数据库并生成随机显示的书籍-->
        <?php
        $conn=mysqli_connect('localhost','root','',"bshop");
        mysqli_query($conn, 'set names utf8');
        if(mysqli_connect_errno()){
            echo "Failed to connect to MySQL:".mysqli_connect_error(); 
        }
        $query = "SELECT * FROM book;";
        $result=mysqli_query($conn,$query);
        $num_of_rows=count(mysqli_fetch_all($result));
        $row = range(1,$num_of_rows);
        shuffle($row);
        ?>
        <!--搜索框模块-->
        <div id="search" style="
        width:400px;
        height:100px;
        margin:0px 40% auto;
        "><!--如果有更简便的页面居中方法可以改一下，顺便告诉我-->
        <div style="padding-left:100px;">
        <h3>搜索</h3>
        </div>
        <form action="检索结果_顾客.php" method="get">
        <select name="search_type">
                <option value="bname">书名</option>
                <option value="aname">作者</option>
                <option value="ISBN">ISBN</option>
            </select>
            <input type="text" name="search" placeholder="请输入关键词">
            <input type="submit" value="搜索">
        </form>
        </div>
      
        </div>
        <!--购物车模块-->
        <div id="addbook" style="
        width:75px;
        height:40px;
        background-color:grey;
        position:absolute;
        top:10px;
        right:95px;">
        <a href="view_shopCart.php">购物车</a><!--这里写购物车页面的链接-->
        </div>

        <!--我的订单-->
        <div id="addbook" style="
        width:75px;
        height:40px;
        background-color:grey;
        position:absolute;
        top:10px;
        right:180px;">
        <a href="orders.php">我的订单</a><!--这里写添加书籍页面的链接-->
        </div>
        
        <!--注销模块-->
        <div id="logout" style="
        width:75px;
        height:40px;
        background-color:grey;
        position:absolute;
        top:10px;
        right:10px;">
        <a href="login.php">注销</a><!--这里写登录页面的链接-->
        </div>

    </body>
</html>
