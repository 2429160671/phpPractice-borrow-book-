<html>
<head>
    <title>管理员操作页面</title>
    <script>
        function doDel(id){
            if(confirm("确定删除吗")){
                window.location="action.php?action=book_del&id="+id;
            }else{
                window.location="manager.php";
            }
        }
    </script>
</head>
<body background="./timg.jpg">
<center>
      <br>
      <br>
      <br>
    <br>
    <br>
    <h1>管理员操作界面</h1>
    <hr>
    <h3><a href="index.php">返回主界面</a></h3>
    <h3><a href="book_add.php">增加图书</a></h3>
    <h3><a href="user_info.php">查看所有用户信息</a></h3>
    <table border="1">
        <tr>
            <th>id</th>
            <th>书名</th>
            <th>isbn</th>
            <th>总数</th>
            <th>可借数目</th>
            <th>上次借出时间</th>
            <th>归还时间</th>
            <th>操作</th>
        </tr>
        <?php   //获取图书信息并进行显示
        require "get_info.php";
        $book_info = get_book_info();
        foreach ($book_info as $row){
           echo "<tr>";
           echo "<td>{$row['id']}</td>";
           echo "<td>{$row['name']}</td>";
           echo "<td>{$row['isbn']}</td>";
           echo "<td>{$row['total_number']}</td>";
           echo "<td>{$row['leave_number']}</td>";
           echo $row['last_lend_time']==null?"<td>暂无</td>":"<td>{$row['last_lend_time']}</td>";   //三元运算符
           echo $row['return_time']==null?"<td>暂无</td>":"<td>{$row['return_time']}</td>";
           echo "<td>
           <a href='javascript:doDel({$row['id']})'>删除</a>
           <a href='book_edit.php?id={$row['id']}'>修改</a> 
           </td>";
           echo "</tr>";
        }
        ?>
    </table>
</center>
</body>
</html>