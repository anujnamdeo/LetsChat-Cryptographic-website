<?php
session_start();
require_once 'include/header.php';
require_once 'include/constants.php';
require_once 'include/connection.php';
require_once 'include/getPrivilegeLvl.php';

// session_start();
if (!isset($_SESSION["session_username"]) || GetPrivilegeLvl($link) < DB_USER_PRIVILEGE_LVL) :
    //var_dump($_SESSION); 
    header("location:login.php");
endif;
?>
<!-- <base href="/"> -->
<script type="text/javascript" src="http://www.google.com/jsapi/"></script>
<link rel="stylesheet" href="messaging2.css">

<style>
    body {
        /* background-color: yellow; */
        background-image: url("images/bg1.jpg");
    }

    #messages {
        background-color: whitesmoke;
        margin-top: 1em;
        border-radius: 10px;
    }

    #chat {
        background-color: whitesmoke;
        border-radius: 10px;
        margin-bottom: 5em;
        padding-bottom: 5em;
        border: 1px solid lightskyblue;
    }

    #chat ul {
        width: 100%;
        max-height: 85%;
        list-style-type: none;
        padding: 18px;
        bottom: 32px;
        display: flex;
        flex-direction: column;

    }
</style>


<p>
    <?php
    $uu = $_SESSION["session_username"];
    echo "You are logged in as: " . $uu;

    ?>
</p>

<div class="col-sm-4 col-sm-offset-4 frame" id="chat">
    <ul id="messages" class="overflow-auto"></ul>
    <div>
        <div class="msj macro" id="msg-container">
            <div class="text text-r">
                <input class="mytext" id="msg_to_send" placeholder="Type a message" />
            </div>
            <i class="fas fa-paper-plane fa-2x" id="send_msg"></i>
        </div>

    </div>
</div>

<div id="debug"></div>

<?php
include("include/footer.php");
?>
<script src="js/messaging2.js"></script>