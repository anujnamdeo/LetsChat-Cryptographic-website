<?php
function GetPrivilegeLvl($link){
    $result = mysqli_query($link,"SELECT * FROM usertbl WHERE username='".$_SESSION["session_username"]."'");
    $arr = mysqli_fetch_assoc($result);
    
    
    return $arr['privilege_lvl'];
    
}