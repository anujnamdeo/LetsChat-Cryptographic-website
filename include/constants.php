<?php
// Константы базы данных
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "lab5");
define("DB_MAIL_PATTERN","/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/");
define("DB_MAX_LEN",32);


define("DB_GUEST_NAME","guest");
define("DB_GUEST_PRIVILEGE_LVL",0);
define("DB_BLOCKED_USER_PRIVILEGE_LVL",1);
define("DB_USER_PRIVILEGE_LVL",2);
define("DB_ADMIN_PRIVILEGE_LVL",10);

define("BLOCKED_USER_MSG","BLOCKED");
define("OPERATION_NUMBER","OPERATION_NUMBER");
define("CONFIRMATION_MSG", "Please go over this reference to confirm Your email for example.com web-site: ");
define("CONFIRMATION_SUBJ", "Email confirmation");
define("CONFIRMATION_HREF", "http://localhost:8080/task2/confirmMail.php");

define("UI_MSGS_NUM_PRINT",10);
?>