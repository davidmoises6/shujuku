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

			if (mysqli_connect_errno()){
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

	       $userName = $_POST["username"];
	       $pwd = $_POST["psw"];

	if(isset($_POST["submit"])){
		$selected_Charactor = $_POST["character"];	
	    }
	else{
		echo "You have choose the wrong charactor!";
		echo "<br>";
	    }

	if($userName == ""||$pwd == ""){
		echo "None of the value can be empty!";
		echo "<br>";
	    }

	    //判断店员登入
	if($selected_Charactor == "admin"){
		$wsql = "SELECT wid FROM worker WHERE wname ='$userName' and wpassword='$pwd' ;" ;
		$wquery_result=mysqli_query($conn,$wsql);
		$arow=$wquery_result;
		
		if (empty($arow)!="ture") {
			
			header('Location:AdminMainPage.php');
		}
		
	     else {
			echo "Error! Something wrong in your username or password!";
			echo "<br>";
		}
	    }	//判断顾客登入
	else {if($selected_Charactor == "user"){
		$sql = "SELECT * FROM customer WHERE caccount= '$userName' and cpassword = '$pwd' ;" ;
		$query_result=mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query_result);
		if(empty($row)!="ture"){
			
					$u_id=$row["cid"];
					$phone=$row["cphone"];
					$address=$row["caddress"];
					$cname=$row["cname"];
					$_SESSION['cid']=$u_id;
					$_SESSION['phone']=$phone;
					$_SESSION['address']=$address;
					$_SESSION['cname']=$cname;
					header('Location:检索页面_顾客.php');
			
			
		}
		else{
			echo "Error! Something wrong in your username or password!";
			echo "<br>";
		}
	    }}
?>
</body>

</html>