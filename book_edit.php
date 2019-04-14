<html>
<head>
    <title>管理员-图书信息修改</title>
    <?php
    //获取这一本的图书信息
    require "mysql_connect.php";
    try{
        $sql = "select *from book where id={$_GET['id']};";
        $stmt = $pdo->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
    }catch(PDOException $e){
        die("获取失败".$e->getMessage());
    }
    ?>
</head>

<body background="./timg.jpg">
<center>
    <h3>修改图书</h3>
    <form action="action.php?action=book_edit" method="post">
        <input type="hidden" name="id" value ="<?php echo $result['id'];?>">
        <table>
            <tr>
                <td>书名</td>
                <td><input type="text" name="name" value="<?php echo $result['name'];?>"/></td>
            </tr>
            <tr>
                <td>isbn</td>
                <td><input type="text" name="isbn" value="<?php echo $result['isbn'];?>"/></td>
            </tr>
            <tr>
                <td>总数</td>
                <td><input type="text" name="total_number" value="<?php echo $result['total_number'];?>"/></td>
            </tr>
            <tr>
                <td>可借数</td>
                <td><input type="text" name="leave_number" value="<?php echo $result['leave_number'];?>"/></td>
            </tr>
            <tr>
                <td>上一次借出时间</td>
                <td><?php echo $result['last_lend_time']==null ? "null"."----不可更改":$row['last_borrow_time']."----不可更改";?></td>
            </tr>
            <tr>
                <td>归还时间</td>
                <td><?php echo $result['return_time']==null ? "null"."----不可更改":$row['return_time']."----不可更改";?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type = "submit" value = "提交"/>
                    <input type = "reset" value = "重置"/>
                </td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>



