<!DOCTYPE html>
<php session_start(); ?>
<html>
    <head>
        <title>Main</title>
        <meta charset="utf-8">
    </head>
    <body>
        <!--搜索框模块-->
        <div id="search" style="
        width:400px;
        height:100px;
        position:absolute;
        left:47%; 
        top:20%;
        transform:translate(-20%,-70%);
        "><!--如果有更简便的页面居中方法可以改一下，顺便告诉我-->
        <div style="padding-left:70px;">
        <h3>搜索</h3>
        </div>
        <form action="检索结果_店员.php" method="get">
            <select name="search_type">
                <option value="bname">书名</option>
                <option value="aname">作者</option>
                <option value="ISBN">ISBN</option>
            </select>
            <input type="text" name="search" placeholder="请输入关键词"size="20">
            <input type="submit" value="搜索">
        </form>
        </div>

        <!--添加书籍模块-->
        <div id="addbook" style="
        width:75px;
        height:40px;
        background-color:grey;
        position:absolute;
        top:10px;
        right:95px;">
        <a href="">添加书籍</a><!--这里写添加书籍页面的链接-->
        </div>
        
        <!--注销模块-->
        <div id="logout" style="
        width:75px;
        height:40px;
        background-color:grey;
        position:absolute;
        top:10px;
        right:10px;">
        <a href="">注销</a><!--这里写登录页面的链接-->
        </div>

    </body>
</html>