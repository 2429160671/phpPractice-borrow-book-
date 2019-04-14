<?php
require "mysql_connect.php";  //引入数据库连接文件

//对于管理员的相关操作进行处理

switch($_GET['action']){
    case "manage_land":                 //管理员登陆
         try{
             $sql = "select * from manage where username='root' and password='wen52010';";
             $result = $pdo->query($sql);
             $result->setFetchMode(PDO::FETCH_ASSOC);
             $row = $result->fetch();
         }catch(PDOException $e){
             die("获取失败".$e->getMessage());
         }
        if($row){
            echo "<script>alert('登陆成功');window.location='manager.php' </script>";
        }else{
            echo "<script>alert('登陆失败');window.location='manager_land.php' </script>";
        }
        break;
    case 'user_land':                      //用户登陆验证
        $name = $_POST['name'];
        $password = $_POST['password'];
        $sql = "select * from `user` where `name`='{$name}' and password='{$password}';";
        $result=$pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        session_start();     //开启session获取验证码存储以及Id
        $code = $_POST['code'];
        $auth = $_SESSION['auth'];
        $_SESSION['id'] = $row['id'];
        if($code != $auth){
            echo "<script>alert('验证码错误');window.location='user_land.php'</script>";
        }
        if($result->rowCount()){
            echo "<script>alert('登陆成功');window.location='user.php'</script>";
        }else{
            echo "<script>alert('用户名或者密码错误');window.location='user_land.php'</script>";
        }
        break;

    case 'user_add':           //用户注册
        $name=$_POST['name'];
        $password=$_POST['password'];
        $tel=$_POST['tel'];
        $email=$_POST['email'];
        $gender=$_POST['gender'];
        try{
            $sql="insert into `user` (`name`,password,tel,email,gender) values(?,?,?,?,?);";  //sql语句，预处理
            $stmt=$pdo->prepare($sql);
            $row = $stmt->execute(array($name,$password,$tel,$email,$gender));
        }
         catch(PDOException $e){
            die('pdo错误'.$e->getMessage());
         }
         $sql = "select id from user where name='{$name}';";
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $userid= $result->fetch();
        session_start();                     //添加session，用户注册结束直接进入user界面
        $_SESSION['id'] = $userid['id'];
        if($row > 0){
            echo "<script>alert('注册成功');window.location='user.php'</script>";
        }else{
            echo "<script>alert('注册失败');window.location='user_add.php'</script>";
        }
        break;

    case "book_del":            //删除书本
        $id = $_GET['id'];
        $sql="delete from book where id={$id};";
        $row = $pdo->exec($sql);
        if($row>0){
            echo "<script>alert('删除成功');window.location='manager.php'</script>";
        }else{
            echo "<script>alert('删除失败');window.location='manager.php'</script>";
        }
        break;

    case "book_add":               //增加图书
        $name=$_POST['name'];    //其余信息均为默认的，不用输入
        $isbn=$_POST['isbn'];
        $leave_number=$_POST['leave_number'];
        $total_number=$_POST['total_number'];
        try{
            $sql="insert into book (`name`,isbn,total_number,leave_number) values(?,?,?,?)";
            $stmt=$pdo->prepare($sql);
            $row = $stmt->execute(array($name,$isbn,$total_number,$leave_number));
        }catch(PDOException $e){
            die("失败".$e->getMessage());
        }
        if($row){
            echo "<script>alert('添加成功');window.location='manager.php'</script>";
        }else{
            echo "<script>alert('添加失败，请从新输出');window.location='book_add.php'</script>";
        }
        break;

    case "book_edit":               //图书信息修改
        $id = $_POST['id'];
        $name = $_POST['name'];
        $isbn = $_POST['isbn'];
        $total_number = $_POST['total_number'];
        $leave_number = $_POST['leave_number'];
        try{
            $sql = "update book set `name`=?,isbn=?,total_number=?,leave_number=? where id={$id};";
            $stmt = $pdo->prepare($sql);
            $row = $stmt->execute(array($name,$isbn,$total_number,$leave_number));
        }catch(PDOException $e){
            die("pdo错误失败".$e->getMessage());
        }
        if($row>0){
            echo "<script>alert('修改成功');window.location='manager.php'</script>";
        }else{
            echo "<script>alert('修改失败');window.location='manager.php'</script>";
        }
        break;

    case 'book_lend':          //执行借书操作，更新lend_record表以及book表
        session_start();        //获取相关变量值
        $id = $_SESSION['id'];
        $book_id = $_GET['book_id'];
        $book_name = $_GET['book_name'];
        date_default_timezone_set("PRC");       //setting
        $lend_time =date('Y-m-d H:i:s',strtotime('now'));   //计算时间
        $return_time = date('Y-m-d H:i:s',strtotime('+30days'));


        $sql = "update book set leave_number=leave_number-1,last_lend_time='{$lend_time}',return_time='{$return_time}' where id={$book_id}";  //更改book表
        $row = $pdo->exec($sql);

        //将借书记录插入到lend_record当中
        $sql = "insert into lend_record (book_id,book_name,lend_time,return_time,".
                "user_id) values('{$book_id}','{$book_name}','{$lend_time}','{$return_time}','{$id}');";
        $row = $pdo->exec($sql);
        if($row){
            echo "<script>alert('借书成功');window.location='user.php'</script>";
        }else{
            echo "<script>alert('借书失败');window.location='user.php'</script>";
        }
    break;

    case 'user_out':   //用户退出登陆
        session_start();
        session_destroy();  //销毁该用户的session,
        echo "<script>alert('退出成功');window.location='index.php'</script>";  //返回登陆界面
        break;

    case 'user_return':  //用户执行还书操作
        session_start();
        $user_id = $_SESSION['id'];
        $record_id = $_GET['record_id'];
        //书写sql语句                                   //执行book表库存+1操作
        $sql = "update book set leave_number=leave_number+1 where id=(select book_id from lend_record where id='{$record_id}');";
        $row = $pdo->exec($sql);
        if(!$row){
            die("库存+1失败");
        }
        $sql = "delete from lend_record where id='{$record_id}';";   //删除借书记录
        $row = $pdo->exec($sql);
        if(!$row){
            die("删除借书记录失败");
        }

        echo "<script>alert('还书成功');window.location='borrow.php'</script>";
    /*
        //判断是否需要更改还书时间，即看还书记录的lend_time和book的last_lend_time是否相等
        $sql = "select last_lend_time from book where id = (select book_id from lend_record where id='{$record_id}');";
        $last_lend_time = $pdo->query($sql);
        $last_lend_time->setFetchMode(PDO::FETCH_ASSOC);
        $last_lend_time = $last_lend_time->fetch();

        $sql = "select lend_time from lend_record where id='{$record_id}';";
        $lend_time = $pdo->query($sql);
        $lend_time->setFetchMode(PDO::FETCH_ASSOC);
        $lend_time = $lend_time->fetch();

        date_default_timezone_set("PRC");       //setting
        $return_time =date('Y-m-d H:i:s',strtotime('now'));   //计算时间
        $sql = "update book as b set b.return_time = '{$return_time}' where b.id= ".
        "(select book_id from lend_record as a where a.id='{$record_id}') and b.last_lend_time = '{$lend_time['lend_time']}';";
        $row = $pdo->exec($sql);
    */
        break;
    case 'out':
        //session_start();
        //session_destroy();
        echo"<script>alert('退出成功');window.location='http://www.baidu.com '</script>";
        break;
}