<?php

$original_ciphertext_with_tag = file_get_contents('./hello_world_encrypted.csv');
$key = base64_decode('LxF1TpVosbTVXKKpzRjsOZsqh8+OrQIDBMI7xls+YFw=');
$iv = base64_decode('ajZhaWQ1VEx2QW5wcUdjYQ==');

$cipher = 'aes-256-gcm';

$tag_length = 16;
$tag = substr($original_ciphertext_with_tag, strlen($original_ciphertext_with_tag) - $tag_length, $tag_length);
$original_ciphertext = substr($original_ciphertext_with_tag, 0, strlen($original_ciphertext_with_tag) - $tag_length);
$ciphertext_raw = openssl_decrypt($original_ciphertext, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $tag);
echo 'Hasil decrypt : ' . $ciphertext_raw . PHP_EOL;
