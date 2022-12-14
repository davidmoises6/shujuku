<?php
// 地址
$login = 'login.php';
$sign = 'sign.php';
// sql
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bshop";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_query($conn, 'set names utf8');
function executeSql($sql)
{
    global $conn;
    $flag = false;
    $feedback = array();
    if ($sql == "") {
        echo "Error! Sql content is empty!";
    } else {
        mysqli_query($conn, 'set names utf8');
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $query_result = mysqli_query($conn, $sql);
        if ($query_result) {
            $flag = true;
            $feedback = $query_result;
            $ct = mysqli_num_rows($feedback);
        }
        return array($flag, $ct, $feedback);
    }
}
function templete($character)
{
    if ($character == 'worker') {
        print "
        <div id='addbook' style='        
        position:absolute;
        top:10px;
        right:180px;'>
    <div>
        <a href='管理顾客.php'>管理顾客</a>
    </div>
</div>

<div id='logout' style='       
        position:absolute;
        top:10px;
        right:30px;'>
    <div>
        <a href='login.php'>注销</a>
    </div>
</div>";
    } else {
        print "
<div id='addbook' style=' 
        position:absolute;
        top:10px;
        right:95px;'>
    <div>
        <a href='view_shopCart.php'>购物车</a>
    </div>
</div>
<div id='addbook' style='        
        position:absolute;
        top:10px;
        right:180px;'>
    <div>
        <a href='orders.php'>我的订单</a>
    </div>
</div>

<div id='logout' style='       
        position:absolute;
        top:10px;
        right:30px;'>
    <div>
        <a href='login.php'>注销</a>
    </div>
</div>";
    }
}