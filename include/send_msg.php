<?php
session_start();
if(isset($_POST['msg']) && trim($_POST['msg']) !== '')
{
  
  $msg=$_POST['msg'];
  $username=$_SESSION['session_username'];
  $dateTimeJSON= json_encode(new DateTime(), JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_PRETTY_PRINT);
  require_once "connection.php";

  //Encryption by me

  $simple_string = $msg;//original message
  
  $ciphering = "AES-128-CTR";
  $iv_length = openssl_cipher_iv_length($ciphering);
  $options = 0;
  
  $encryption_iv = '1234567891011121';
  $encryption_key = "anujnamdeo";
  $encryption = openssl_encrypt($simple_string, $ciphering,$encryption_key, $options, $encryption_iv);//encrypted message
  
  $decryption_iv = '1234567891011121';
  $decryption_key = "anujnamdeo";
  $decryption=openssl_decrypt ($encryption, $ciphering,$decryption_key, $options, $decryption_iv);//decrypted messsage
  


  //encryption ends


  $res=mysqli_query($link,"INSERT INTO `messages` (`username`,`message`,`encrypted_message`,`dateTime`) VALUES ('$username','$msg','$encryption','$dateTimeJSON') ");
}
