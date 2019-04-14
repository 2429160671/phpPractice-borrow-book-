<html>
<head><title>用户登陆界面</title></head>
<center>
    <body background="./timg.jpg">
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1>用户登陆界面</h1>
    <form action="action.php?action=user_land" method="post">
        <table>
            <tr>
                <td>用户名</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>验证码</td>
                <td><input type="text" name="code" maxlength="4"/></td>
                <td><img src="verify.php"></td>
            </tr>
            <tr>
                <td><input type="submit" value="提交"></td>
               <td><input type="reset" value="重置"></td>
                <td>&nbsp</td>
                <td><h3><a href = 'user_add.php'>新用户注册</a></h3></td>
            </tr>
        </table>
    </form>
    </body>
</center>
</html>





