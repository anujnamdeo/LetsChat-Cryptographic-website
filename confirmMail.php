<?php
var_dump($_GET, isset($_GET['hash']) && isset($_GET['username']),$_GET['hash'] === hash('ripemd160', $_GET['username']) );
if (isset($_GET['hash']) && isset($_GET['username'])){
    if ($_GET['hash'] === hash('ripemd160', $_GET['username'])){
        require_once "include/connection.php";
        $username = $_GET['username'];
        $sql="UPDATE `usertbl` SET `privilege_lvl` = ".DB_USER_PRIVILEGE_LVL." WHERE `usertbl`.`username` = '$username'";
        $query=mysqli_query($link,$sql);

    } 
}
header("location:Dashboard.php"); 