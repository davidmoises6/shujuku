<?php
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Shop cart</title>
</head>
<h1>View your shop cart here.</h1>

<body>
    <table border="1" width="100%">
        <tr>
            <th>书名</th>
            <th>ISBN</th>
            <th>价格</th>
            <th>库存</th>
            <th>作者</th>
            <th>出版社</th>
            <th>数量</th>

            <th>功能1</th>
            <th>功能2</th>
            <th>功能3</th>
        </tr>
        <?php
		$totalPrice = 0;
		$totalItem = 0;

		if(isset($_SESSION['shop-cart'])){
			$arr=$_SESSION['shop-cart'];
			for($i=0;$i<count($arr[0]);$i++){
				$bid = $arr[0][$i];
				$goods_num = $arr[1][$i];
			
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "bshop";

				$conn = mysqli_connect($servername, $username, $password, $dbname);
				mysqli_query($conn, 'set names utf8');
				if (mysqli_connect_errno()){
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
				       
				$sql = "SELECT * FROM book WHERE bid =".$bid.";";
				$result=mysqli_query($conn,$sql);//result is a PHP array

				$num_rows=mysqli_num_rows($result);
				//echo $num_rows;

				


				while ($row = mysqli_fetch_assoc($result)){
					$bname=$row["bname"];
					$bISBN=$row["bISBN"];
					$bpubdate=$row["bpubdate"];
					$bprice=$row["bprice"];
					$bid1=$row["bid"];
					$bamount=$row["bamount"];
					//找出版社与作者
			         $aselect_sql = "SELECT aname FROM author, bauni WHERE author.aid=bauni.aid and bauni.bid='$bid'";
			          $aselect_result=mysqli_query($conn,$aselect_sql); 
			          $arow = mysqli_fetch_assoc($aselect_result);
		              $aname=implode("-",$arow); 
	       
                          $pselect_sql = "SELECT pname FROM publisher, bpuni WHERE publisher.pid=bpuni.pid and bpuni.bid='$bid'";
                       $pselect_result=mysqli_query($conn,$pselect_sql); 
                        $prow = mysqli_fetch_assoc($pselect_result);
                   $pname=implode("-",$prow); 
              
	               
                   
					echo "<tr>";
					echo "<td>".$bname."</td>";
					echo "<td>".$bISBN."</td>";
					echo "<td>".$bprice."元</td>";
					echo "<td>".$bamount."</td>";
					echo "<td>".$aname."</td>";
					echo "<td>".$pname."</td>";
					echo "<td>".$goods_num."</td>";
					
					
					
				
					mysqli_close($conn);
			?>
        <td>
            <a href='process_shopCart1.php?goods_id=<?php echo $bid; ?>'>+1</a>
        </td>
        <td>
            <a href='process_shopCart2.php?goods_id=<?php echo $bid; ?>'>-1</a>
        </td>
        <td><a href='delCart.php?goods_id=<?php echo $bid; ?>'>删除</a>
        </td>



        <?php
					echo "</tr>";
					$singlePrice = $bprice * $goods_num;
					$totalPrice = $totalPrice + $singlePrice;
					$totalItem = $totalItem + $goods_num;
					$_SESSION['osumprice']=$totalPrice;
				}
			}
			
		?>
        <tr>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><a href='clearCart.php'>清空购物车</a></td>
            <td>
                <?php
				echo "".$totalItem."   Items. ";
				echo "Totol prize: ".$totalPrice." 元";
				?>
            </td>
        </tr>
    </table style="border-style: solid;border-width: 5px;">
    <div style="float:left;">
        <form action="process_order.php" method="get" name="form2" style="float:left;">

            <table width="100%" border="0" cellpadding="0" cellspacing="0">

                <tr>

                    <td style=“float:left;”>

                        修改手机号:<input type="text" name="phone" size="20">

                        修改地址:<input type="text" name="address" size="50">
                        备注：<input type="text" name="message" size="50">
                        <input type="submit" name="submit" value="确认下单">

                    </td>

                </tr>

            </table>

        </form>
        <div class="xialan" style="float:left; border-style: solid;border-width: 1px;"><a href='检索页面_顾客.php'>返回</a>
        </div>
    </div>

    <?php
}else{
	echo "The shop cart is empty!";
	?>
    <br><br>

    <a href='检索页面_顾客.php'>
        <div style="border-style: solid;border-width: 2px; float:left; margin-right:10px;">返回检索</div>
    </a>
    <a align='right' href='orders.php'>
        <div style="border-style: solid;border-width: 2px; float:left;">查看订单</div>
    </a>
    <?php
}

?>


</body>

</html>