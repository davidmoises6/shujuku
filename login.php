<?php session_start();
session_unset();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Login in to phone website</title>
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
        align-self: right;
    }

    .zc {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 50px 4px 2px;
        cursor: pointer;
        align-self: right;

    }

    .body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 20px;
    }
    </style>

</head>

<body class="body">
    <h2>登录</h2>
    <br>
    <br>

    <div style=" top:43%; left:40%; position:absolute; ">

        <form action="process_login.php" method="post" ">

			<select name=" character">
            <option value="user">user</option>
            <option value="admin">admin</option>

            </select>
            <div>
                账户:<input type="text" name="username" size="29"><br>
                密码:<input type="password" name="psw" size="30"><br>
                <a href="sign.html" class="zc">注册</a>
                <input type="submit" class="button" name="submit" value="登录">

            </div>
        </form>
    </div>
</body>

</html>