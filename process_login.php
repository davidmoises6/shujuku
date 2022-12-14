<!DOCTYPE html>
<html>

<body>
    <?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bshop";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$userName = $_POST["username"];
	$pwd = $_POST["psw"];

	if (isset($_POST["submit"])) {
		$selected_Charactor = $_POST["character"];
	} else {
		echo "You have choose the wrong charactor!";
		echo "<br>";
	}

	if ($userName == "" || $pwd == "") {
		echo "None of the value can be empty!";
		echo "<br>";
	}

	//判断店员登入
	if ($selected_Charactor == "admin") {
		$wsql = "SELECT wid,wname FROM worker WHERE wname ='$userName' and wpassword='$pwd' ;";
		$wquery_result = mysqli_query($conn, $wsql);
		$arow = mysqli_fetch_assoc($wquery_result);

		if (empty($arow) != "ture") {
			$_SESSION['charactor'] = 'worker';
			$_SESSION['wid'] = $arow["wid"];
			$_SESSION['wname'] = $arow["wname"];
			header('Location:检索页面.php');
		} else {
			echo "Error! Something wrong in your username or password!";
			echo "<br>";
		}
	}	//判断顾客登入
	else {
		if ($selected_Charactor == "user") {
			$sql = "SELECT * FROM customer WHERE caccount= '$userName' and cpassword = '$pwd' ;";
			$query_result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($query_result);
			if (empty($row) != "ture") {
				$_SESSION['charactor'] = 'customer';
				$_SESSION['cid'] = $row["cid"];
				$_SESSION['phone'] = $row["cphone"];
				$_SESSION['address'] = $row["caddress"];
				$_SESSION['cname'] = $row["cname"];
				header('Location:检索页面.php');
			} else {
				echo "Error! Something wrong in your username or password!";
				echo "<br>";
			}
		}
	}
	?>
</body>

</html>