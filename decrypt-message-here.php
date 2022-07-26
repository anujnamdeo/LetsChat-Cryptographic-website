<?php

// $simple_string = "jo";

// // echo "Original String: " . $simple_string;

$ciphering = "AES-128-CTR";
// $iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;

// $encryption_iv = '1234567891011121';
// $encryption_key = "anujnamdeo";
// $encryption = openssl_encrypt($simple_string, $ciphering,$encryption_key, $options, $encryption_iv);
// // echo "Encrypted String: " . $encryption . "\n";

// $decryption_iv = '1234567891011121';
// $decryption_key = "anujnamdeo";
// $decryption=openssl_decrypt ("qx3jesPrukt+H+q35Q8OW8WqfenxFkcs4g==", $ciphering,$decryption_key, $options, $decryption_iv);
// // echo "Decrypted String: " . $decryption;

?>

<?php

//Enter the message to decrypt
$encrypted_message = " ";

$decryption_iv = '1234567891011121';
$decryption_key = "anujnamdeo";
$decryption=openssl_decrypt ($encrypted_message, $ciphering,$decryption_key, $options, $decryption_iv);
echo "Decrypted String: " . $decryption;

?>
