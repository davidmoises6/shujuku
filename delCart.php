

<?php
session_start();


$bid = $_GET["goods_id"];
$goods_num = 1;


function id_inarray($findID, $cart_array)
{
    $flag = false;
    $counter = 0;
    for ($i=0;$i<count($cart_array[0]);$i++) {
        if (strcmp($cart_array[0][$i], $findID) == 0) {
            $flag = true;
            break;
        }
        $counter++;
    }
    return array($flag, $counter);
}



$result = id_inarray($bid,$_SESSION['shop-cart']);
$arr=$_SESSION['shop-cart'];
$a=count($arr[0])-1;
if($result[0]){
	//如果存在该项,从session中删除
	if(isset($result[1])){
        for($i=$result[1];$i<$a;$i++){

            $b=$arr[0][$i+1];
            $arr[0][$i]=$b;
            $b=$arr[1][$i+1];
            $arr[1][$i]=$b;
        }
        unset($arr[0][$a]);
        unset($arr[1][$a]);
        $_SESSION['shop-cart']=array_values($arr);
	}
}
else{
	echo "Cannot delete non-existent items!";
}

//$_SESSION['shop-cart']=0;
echo implode("--",$_SESSION['shop-cart'][0]);
header("location:view_shopCart.php");
?>
<a  align='right' href='view_shopCart.php'>Enough adding, click here to shopcart.</a>