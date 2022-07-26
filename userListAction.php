<?php
require_once 'include/connection.php';

if(isset($_POST["operation"]) && isset($_POST['numrows'])){
    
    for ($i=0; $i < intval($_POST['numrows']); $i++) { 
        if (isset($_POST["chbx".$i])){
            $username = $_POST["chbx".$i];    
            if ($_POST['operation']=='block'){
                $sql="UPDATE `usertbl` SET `privilege_lvl` = ".DB_BLOCKED_USER_PRIVILEGE_LVL." WHERE `usertbl`.`username` = '$username'";
            }elseif ($_POST['operation']=='unblock'){
                $sql="UPDATE `usertbl` SET `privilege_lvl` = ".DB_USER_PRIVILEGE_LVL." WHERE `usertbl`.`username` = '$username'";
            }elseif ($_POST['operation']=='delete') {
                $sql = "DELETE FROM `usertbl` WHERE `usertbl`.`username` = '$username'";
            }
            $query=mysqli_query($link,$sql);
        }
    }
}