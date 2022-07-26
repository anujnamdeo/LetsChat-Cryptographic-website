<?php
require_once 'include/connection.php';
include_once 'include/constants.php';
    
$query=mysqli_query($link,"SELECT * FROM usertbl WHERE privilege_lvl BETWEEN ".DB_BLOCKED_USER_PRIVILEGE_LVL." AND ".DB_USER_PRIVILEGE_LVL);
$numrows=mysqli_num_rows($query);
//$_POST["numrows"] = $numrows;
echo '<input type="text" style="display:none;" name="numrows" value='.$numrows.' checked>';
for ($i=0; $i < $numrows; $i++): 
    $row=mysqli_fetch_assoc($query)?>
    <tr>
        <td>
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="checkbox" class="select-item form-control-default" value="<?php echo $row['username']; ?>" name="chbx<?php echo $i; ?>" aria-describedby="inputGroup-sizing-lg">
                </div>
            </div>
        </td>
        <td>
            <span class="input-group-text"><?php echo $row['username']; ?></span>
        </td>
        <td>
            <span class="input-group-text"><?php printUserInfoOrBlocked($row, $row['regdate']); ?></span>
        </td>
        <td>
            <span class="input-group-text"><?php printUserInfoOrBlocked($row, $row['last_online_date']); ?></span>
        </td>
    </tr> 
<?php 
 endfor;

 function printUserInfoOrBlocked($row, $userinfo){
    if ($row['privilege_lvl'] > DB_BLOCKED_USER_PRIVILEGE_LVL)//'=' sign added by me
        echo $userinfo;
    else
        echo BLOCKED_USER_MSG;
  }


?>
   