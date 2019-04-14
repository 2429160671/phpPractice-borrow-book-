<?php
//连接数据库文件
//----------------------------需要修改
$sql_username="root";      //mysql用户名，需要修改为你的
$sql_password="wen52010";  //密码，需要修改为你的
//----------------------------需要修改

$dsn = "mysql:host=localhost;dbname=mysql";
try{
    $pdo = new PDO($dsn,$sql_username,$sql_password);
}catch(PDOException $e){
    die("连接失败".$e->getMessage());
}

