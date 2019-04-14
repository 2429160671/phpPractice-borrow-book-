<html>
<head>
    <title>用户已借图书信息以及借书操作</title>
    <?php
    require "get_info.php";
    session_start();
    $id = $_SESSION['id'];
    $user_land_info = get_user_lend_info($id);   //获取用户的借书信息
    ?>
</head>
<body background="./timg.jpg">
<center>
    <br><br><br><br>
    <table border="1" width="60%" high="%50">
        <h1>用户已借图书信息以及借书操作</h1>
        <caption align="top">所有已借图书信息</caption>
        <h2><a href="user.php">返回上一级界面</a></h2>
        <?php
        if($user_land_info==null){      //判断是否有借书信息
            echo "<h2>暂无任何借书信息</h2>";
        }else {
            echo " <tr>" .
                "<th>书本id</th>" .
                "<th>书名</th>" .
                "<th>借书时间</th>" .
                "<th>应该还书时间</th>" .
                "<th>操作</th>" .
                "</tr>";
            foreach ($user_land_info as $row) {      //循环输出借书信息
                echo "<tr>";
                echo "<td>{$row['book_id']}</td>";
                echo "<td>{$row['book_name']}</td>";
                echo "<td>{$row['lend_time']}</td>";
                echo "<td>{$row['return_time']}</td>";
                echo "<td><a href='action.php?action=user_return&record_id={$row['id']}'>还书</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</center>
</body>
</html>