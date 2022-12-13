<?php        
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="bshop";
        // 书信息
        $bname=$_POST['bname'];
        $bISBN=$_POST['bISBN'];
        $bpubdate=$_POST['bpubdate'];
        $bpage=$_POST['bpage'];
        $bprice=$_POST['bprice'];
        $bsummary=$_POST['bsummary'];
        $bamount=$_POST['bamount'];
        $blanguage=$_POST['blanguage'];
        $btype=$_POST['btype'];
        // 作者信息
        $aname=$_POST['aname'];
        $asex=$_POST['asex'];
        // 出版社信息
        $pname=$_POST['pname'];
        $paddress=$_POST['paddress'];
        $pphone=$_POST['pphone'];       
        //创建连接
        $conn=mysqli_connect($servername,$username,$password,$dbname);
        mysqli_query($conn, 'set names utf8');
        //检测连接
        if(!$conn){
            die("Connection failed:".mysqli_connect_error());
        }
        //录入
        $findbooksql="SELECT bname FROM book WHERE bisbn='.$bISBN.';";
        $findbookresult=mysqli_query($conn,$findbooksql);        
        if($findbookresult){
            die('已经有这本书,无法登录');
        }
        $result=mysqli_query($conn,"SELECT max(bid) FROM book");
        $row=mysqli_fetch_assoc($result);
        $bid=implode("-",$row);   
        $bid+=1;
        $sql="INSERT INTO book(bid,bISBN,bname,bpubdate,bpage,bprice,bsummary,bamount,blanguage,btype) VALUES('$bid','$bISBN','$bname','$bpubdate','$bpage','$bprice','$bsummary','$bamount','$blanguage','$btype')";
        if(mysqli_query($conn,$sql)){
            echo "录书成功！";
            }
         else{
            echo"录书失败！".$conn->error;
        }
        
        $result2=mysqli_query($conn,"SELECT max(aid) FROM author");
        $row2=mysqli_fetch_assoc($result2);
        $aid=implode("-",$row2);  
        $aid+=1;
        $sql2="INSERT INTO author(aid,aname,asex) VALUES('$aid','$aname','$asex')";
        if(mysqli_query($conn,$sql2)){
            echo "录作者成功！";
            }
         else{
            echo"录作者失败！".$conn->error;
        }

        $result3=mysqli_query($conn,"SELECT max(pid) FROM publisher");
        // $result3=="True"?$pid=mysqli_fetch_assoc($result)['aid']:$pid=0;
        $row3=mysqli_fetch_assoc($result3);
        $pid=implode("-",$row3);
        $pid+=1;
        $sql3="INSERT INTO publisher(pid,pname,pphone,paddress) VALUES('$pid','$pname','$pphone','$paddress')";
         if(mysqli_query($conn,$sql3)){
            echo "录出版社成功！";
            }
         else{
            echo"录出版社失败！".$conn->error;
        }
        $sql4="INSERT INTO bauni(aid,bid) VALUES('$aid','$bid')";
        if(mysqli_query($conn,$sql4)){
            echo "录bauni成功！";
            }
         else{
            echo"录bauni失败！".$conn->error;
        }
        $sql5="INSERT INTO bpuni(pid,bid) VALUES('$pid','$bid')";
        if(mysqli_query($conn,$sql5)){
            echo "录bpuni成功！";
        }
         else{
            echo"录bpuni失败！".$conn->error;
        }
        
        mysqli_close($conn);
        // header("Refresh:3;url=管理员_录书.php");
        ?>