<html>
<head>
    <title>用户界面</title>
    <?php
    //require "mysql_connect.php";               //mysql连接文件
    require "get_info.php";                     //获取信息函数文件
    session_start();   //获取用户id
    $id = $_SESSION['id'];
    //session_destroy();
    $user_info = get_user_info($id);  //获取用户信息
    $book_info = get_book_info();     //获取图书信息
    $user_lend_info = get_user_lend_info($id);  //获取用户所借信息
    ?>
</head>
<body background="./timg.jpg">
<center>
    <br><br>
    <h2>用户操作界面</h2>
    <hr/>
    <p><?php echo "用户信息：{$id}---{$user_info['name']}---{$user_info['gender']}---{$user_info['tel']}---{$user_info['email']}"; ?></p>

    <h3><a href='borrow.php'>查看已借图书并进行还书操作</a></h3>
    <h3><a href='action.php?action=user_out'>退出登陆(销毁session)</a></h3>
    <table border="1" width="%60" high="%50">
     <caption align="top">所有图书信息</caption>
     <tr>
         <th>书本id</th>
         <th>书名</th>
         <th>isbn</th>
         <th>总数</th>
         <th>可借数目</th>
         <th>最后一次借出时间</th>
         <th>应归还时间/已归还时间</th>
         <th>操作(借书)</th>
     </tr>
    <?php
    foreach($book_info as $row) {//输出图书信息
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['isbn']}</td>";
        echo "<td>{$row['total_number']}</td>";
        echo "<td>{$row['leave_number']}</td>";
        echo $row['last_lend_time']==null?"<td>暂无</td>":"<td>{$row['last_lend_time']}</td>";   //三元运算符
        echo $row['return_time']==null?"<td>暂无</td>":"<td>{$row['return_time']}</td>";
        if($row['leave_number'] == 0){
            echo "<td>暂时不可借</td>";
        }else {
            echo "<td><a href='action.php?action=book_lend&book_id={$row['id']}&book_name={$row['name']}'>借书</a></td>";
        }
    }
    ?>
    </table>
</center>
</body>
</html>