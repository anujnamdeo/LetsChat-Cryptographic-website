<?php
//Warning: dont print anything! it will cause json parse error on client side
require_once 'constants.php';

$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$res=mysqli_query($link,"SELECT * FROM(SELECT * FROM `messages` ORDER BY `id` DESC LIMIT 10) as foo ORDER BY foo.`id` ASC");//"SELECT * FROM `messages` ORDER BY `id`"
$i = 0;
while(($row=mysqli_fetch_assoc($res)) && ($i++ < UI_MSGS_NUM_PRINT))
{  
    $msgs[$i] = array('message' => $row['message'], 'id'=> $row['id'], 'username'=>$row['username'], 'dateTimeJSON'=>$row['dateTime']);
}
//var_dump($msgs,json_encode($msgs, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_PRETTY_PRINT ));//,json_encode($msgs)
echo json_encode($msgs, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_PRETTY_PRINT);
?>
