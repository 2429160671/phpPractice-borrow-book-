<html>
<head><title>管理员-图书增加</title></head>
<body background="./timg.jpg">
<center>
    <h1>管理员图书增加操作</h1>
    <hr>
    <form action="action.php?action=book_add" method="post">
        <table border="0">
            <tr>
                <td>书名</td>
                <td><input type="text" name="name"/></td>
            </tr>
            <tr>
                <td>isbn</td>
                <td><input type="text" name="isbn" maxlength="12"/></td>
            </tr>
            <tr>
                <td>库存数</td>
                <td><input type="text" name="total_number"/></td>
            </tr>
            <tr>
                <td>可借数</td>
                <td><input type="text" name="leave_number"/></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="提交"/>
                    <input type="reset" value="重置"/>
                </td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>





