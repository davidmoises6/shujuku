<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php  
    session_start();
$oid=$_GET['oid'];
$_SESSION['newoid']=$oid;

 ?>
    <form action="gaiorders.php" method="get" name="form1">
        <table>
            <tr>

                <td>
                    修改手机号:<input type="text" name="phone" size="20">
                    修改地址:<input type="text" name="address" size="50">
                    备注：<input type="text" name="message" size="50">
                    <input type="submit" name="submit" value="确认修改">
                </td>

            </tr>
        </table>
    </form>
</body>

</html>