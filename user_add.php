<html>
<head>
    <title>用户注册界面</title>
    <script type="text/javascript">
        function checkForm() {     //检查参数是否输入数据是否正确(用户注册阶段的)
            if(form_user.name.value==''){
                alert('用户名不能为空');
                return false;
            }
            if(form_user.password.value==''){
                alert('密码不能为空');
                return false;
            }
            if(form_user.password2.value ==''){
                alert('确认密码不能为空');
                return false;
            }
            if(form_user.password.value != form_user.password2.value){
                alert('两次密码不一致');
                return false;
            }
            if(form_user.gender.value == ''){
                alert('性别不能为空');
                return false;
            }
            if(form_user.tel.value == ''){
                alert('电话不能为空');
                return false;
            }
            if(form_user.email.value==''){
                alert('邮箱不能为空');
                return false;
            }
        }
    </script>
</head>
<body background="./timg.jpg">
<center>
    <br><br><br><br><br><br>
    <h2>用户注册页面</h2>
    <hr/>
    <form name="form_user" action="action.php?action=user_add" method="post" onsubmit="return checkForm()" >
        <table>
            <tr>
                <td>用户名</td>
                <td><input type="text" maxlength="15" name="name" value=""/></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password"  name="password" value=""/></td>
            </tr>
            <tr>
                <td>确定密码</td>
                <td><input type="password"  name="password2"/></td>
            </tr>
            <tr>
                <td>性别</td>
                <td>
                    <input type = "radio" name = "gender" value = '男'/>  男
                    <input type = "radio" name = "gender" value = '女'/>  女
                    <input type = "radio" name = "gender" value = '保密'/>  保密
                </td>
            </tr>
            <tr>
                <td>电话</td>
                <td><input type="number"  maxlength="12" name="tel"/></td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td><input type="email"  name="email"/></td>
            </tr>
            <tr>
                <td><input type="submit" value="提交"/></td>
                <td><input type="reset" value="重置"/></td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>