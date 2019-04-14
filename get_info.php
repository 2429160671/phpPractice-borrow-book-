<?php
//用于获取书写获取用户和书本的信息的函数
require "mysql_connect.php";

function get_book_info(){        //获取图书信息
    try{
        $sql ="select *from book;";
        $pdo = $GLOBALS['pdo'];
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);  //设置解析模式
        $book_info = $result->fetchAll();
    }catch (PDOException $e){
        die("书本信息获取失败".$e->getMessage());
    }
    return $book_info;
}

function get_user_info($id){       //根据获取用户信息
    try{
        $sql = "select *from user where id = {$id};";       //连接数据库并获取用户信息
        $pdo = $GLOBALS['pdo'];
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $user_info = $result->fetch();
    }catch(PDOException $e){
        die("用户信息获取失败".$e->getMessage());
    }
    return $user_info;
}

function get_user_lend_info($id){     //获取某一位用户借书信息
    try{
        $sql = "select *from lend_record where user_id={$id};";
        $pdo = $GLOBALS['pdo'];
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $user_lend_info = $result->fetchAll();
    }catch(PDOException $e){
        die("用户借书信息获取失败".$e->getMessage());
    }
    return $user_lend_info;
}

function get_all_user_info(){
    try{
        $sql = "select * from `user`";
        $pdo = $GLOBALS['pdo'];
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $user_info = $result->fetchAll();
    }catch(PDOException $e){
        die('用户信息获取失败');
    }
    return $user_info;
}








