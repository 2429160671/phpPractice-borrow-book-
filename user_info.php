<html>
<head>
    <title>用户信息查看</title>
    <?php
    require "get_info.php";
    $user_info = get_all_user_info();
    ?>
</head>
<body background="./timg.jpg">
<center>
    <br>
    <br>
    <h1>用户信息查看</h1>
    <hr>
    <h2><a href="manager.php">返回</a></h2>
    <table border="1">
        <tr>
            <th>id</th>
            <th>用户名</th>
            <th>性别</th>
            <th>电话</th>
            <th>邮箱</th>
        </tr>
        <?php   //获取图书信息并进行显示
        foreach ($user_info as $row){
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['gender']}</td>";
            echo "<td>{$row['tel']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</center>
</body>
</html>