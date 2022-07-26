<?php

if (isset($username) && isset($email)){
    require_once "include/constants.php";
    ini_set('SMTP','localhost'); //localhost nemo123.ddns.net
    ini_set('smtp_port',25);

    $config['smtp_charset'] = "utf-8";
    $config['service_mail'] = 'TheSaddestManEver@yandex.by';
    $config['service_name'] = 'VladislavCorporation';
    $message = CONFIRMATION_MSG.CONFIRMATION_HREF."?username=".$username."&hash=".hash('ripemd160', $username);
    $message = str_replace("\n.", "\n..", $message);
    $message = wordwrap($message, 70, "\r\n");
    $headers = "Content-Type: text/html; charset=\"" . $config['smtp_charset'] . "\"\r\n";
    $headers .= "Content-Transfer-Encoding: 8bit\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Reply-To: " . $config['service_mail'] . "\r\n";
    $headers .= "From:  <" . $config['service_mail'] . ">\r\n";//\"=?".$config['smtp_charset']."?B?".$config['service_name']."=?=\" <".$_POST["src_mail"].">
    $headers .= 'To: "=?' . $config['smtp_charset'] . '?B?receiver=?=" <' . $email . '>\r\n';
    $headers .= "X-Priority: 3\r\n\r\n";
    mail($email, CONFIRMATION_SUBJ, $message, $headers);
    // if ()
    //     echo '<div class="ok">' . 'Message send' . '</div>';
    // else
    //     $err = 'Message was not sent';
    // if (isset($err))
    //     echo '<div class="error">'.$err.'</div>';
}
