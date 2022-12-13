<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sign in sucess!</title>
    <style>
    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .table {
        border-style: solid;
        border-color: #98bf21;
        align-self: center;
        align-items: center;
    }

    /*.divcss5-right{width:320px; height:120px;border:1px solid #F00;float:right} */
    .divcss5-right {
        float: right;
    }

    /* css注释：对divcss5-right设置float:right即可让对象靠右浮动 */
    </style>
</head>

<body>
    <?php
	function executeSql($sql){
		$flag = false;
		$feedback = array();
		if($sql == ""){
			echo "Error! Sql content is empty!";
		}else{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "bshop";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (mysqli_connect_errno()){
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			$query_result=mysqli_query($conn,$sql);//query_result is a PHP array
			if($query_result){
				$flag = true;
				$feedback = $query_result;
				//$num_rows=mysqli_num_rows($query_result);
			}
		return array($flag,$feedback);
		}
	}

	$userName = $_POST["username"];
    $account=$_POST["account"];
    $sex=$_POST["sex"];
	$pwd = $_POST["psw"];
	$cofPsw = $_POST["cofpsw"];
	$phone = $_POST["phone"];
	$address = $_POST["ad"];

	if($userName == "" || $pwd == "" || $cofPsw == "" || $phone == "" || $address == ""|| $account == ""){
		echo "None of the value can be empty!";
	}
	else if($pwd != $cofPsw){
		echo "The password entered for two time is not same!";
	}else if ($pwd == $cofPsw){
		$sql = "INSERT INTO customer (caccount,cpassword,cphone,caddress,csex,cname) VALUES('" .$account ."','" . $pwd ."','" . $phone . "','" . $address . "','" . $sex. "','" . $userName . "');";
		$result = executeSql($sql);
		if($result){
			$select_sql = "SELECT u_id FROM user_info WHERE u_name = '".$userName."';";
			$result = executeSql($select_sql);
			if($result[0]){						
				header("location:login.php");
			}
		}
	}
	?>
</body>

</html>