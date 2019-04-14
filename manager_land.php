<html>
<head><title>管理员登录界面</title></head>
<body background="./timg.jpg">
    <center>
        <h1>管理员登录界面</h1>
        <br/>
        <hr>
        <form action="action.php?action=manage_land" method = "post">
            <table>
                <tr>
                    <td>用户名</td>  没有实现管理员的增删改查，所以这里直接输入验证码登陆就行了
                    <td><input type="text" name="username" value='root'/></td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td><input type="password" name="password" value='wen52010'/></td>
                </tr>
                <tr>
                   <td>&nbsp;</td>
                   <td>
                       <input type="submit" value="登陆"/>
                       <input type="reset" value="重置"/>
                   </td>
                </tr>
            </table>
        </form>
    </center>
    </body>
</html>