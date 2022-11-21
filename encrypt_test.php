<?php
$key = base64_decode('LxF1TpVosbTVXKKpzRjsOZsqh8+OrQIDBMI7xls+YFw=');

$iv = base64_decode('ajZhaWQ1VEx2QW5wcUdjYQ==');
$cipher = 'aes-256-gcm';

$tag_length = 16;
$tag = ''; // tag will be filled by openssl_encrypt
 
$plaintext = file_get_contents('./hello_world.csv');
$ciphertext = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv, $tag, '', $tag_length);
$ciphertext_with_tag = $ciphertext . $tag;

// echo base64_encode($ciphertext_with_tag) . PHP_EOL; // di base64 biar keliatan stringnya

$encrypted_file = fopen('hello_world_encrypted.csv', 'w') or die('Unable to open file!');
// $txt = base64_encode($ciphertext_with_tag);
$txt = $ciphertext_with_tag;
fwrite($encrypted_file, $txt);
fclose($encrypted_file);

