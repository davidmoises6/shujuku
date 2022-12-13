<?php
include("常用的.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
	$userName = $_POST["username"];
	$account = $_POST["account"];
	$sex = $_POST["sex"];
	$pwd = $_POST["psw"];
	$cofPsw = $_POST["cofpsw"];
	$phone = $_POST["phone"];
	$address = $_POST["ad"];
	//确认密码过程
	if ($pwd != $cofPsw) {
		echo "The password entered for two time is not same!";
	} else {
		// 检查是否是已有的账号
		$sql = "SELECT cid FROM customer WHERE caccount='" . $account . "';";
		$result = executeSql($sql);
		if ($result[1]) {
			echo "<script>alert('已绑定的账号')</script>";
		} else {
			$sql = "SELECT cid FROM customer WHERE cphone='" . $phone . "';";
			$result = executeSql($sql);
			if ($result[1]) {
				echo "<script>alert('已绑定的手机号')</script>";
			} else {
				$sql = "INSERT INTO customer (caccount,cpassword,cphone,caddress,csex,cname) VALUES('" . $account . "','" . $pwd . "','" . $phone . "','" . $address . "','" . $sex . "','" . $userName . "');";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo "<script>alert('注册成功')</script>";
					header("Refresh:1; url=" . $login);
				}
			}
		}
	}
	?>
</body>

</html>