<?php 

require './vendor/autoload.php';

use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\Random;
use phpseclib3\Crypt\RSA;

// $pubKey = file_get_contents('./rsa_kopnus.pub');
// $privateKey = file_get_contents('./rsa_kopnus');

// $pubKey = file_get_contents('./new_seabank_key/rsa-prod.pub');
// $privateKey = file_get_contents('./new_seabank_key/rsa-prod');

// $iv = file_get_contents('./new_seabank_key/ciphertext_for_iv');
// $oi = file_get_contents('./20220428_ciphertext_for_iv');

/** sec key untuk prod */
// $oi = file_get_contents('./20220408_ciphertext_for_aes256_secrt_key');

// gak di pakai
// $newciper = file_get_contents('./new-ciphertext.txt');

// $rsa = new Pikirasa\RSA($pubKey, $privateKey);

// $data = 'test';
// $encrypted = $rsa->encrypt($data);
// $decrypted = $rsa->decrypt($encrypted);
// var_dump($decrypted); // 'abc123'

$pub = file_get_contents('./newkey/rsa_kopnus_prod.pub');
$private = file_get_contents('./newkey/rsa_kopnus_prod');

$aes256 = file_get_contents('./newkey/ciphertext_for_aes256_secret_key_v4');

$iv = file_get_contents('./newkey/ciphertext_for_iv_v4');

/** hasil aes256 = P8y4L04aZhtz/xxaAMX9CIH/lHnN3Tbpe6qHUq5Xs3w= */
/** hasil iv = dGhRdjlMZlkzZ0JubkJMNg== */

$test = 'This is the message to encrypt';

$key = PublicKeyLoader::load($pub);
$key = $key->withPadding(RSA::ENCRYPTION_PKCS1);
$encrypted = base64_encode($key->encrypt($test));
// $encrypted = openssl_public_encrypt($test, $encrypted, $pubKey, OPENSSL_NO_PADDING);
echo $encrypted;
echo '<br>';

// $myfile = fopen("new-ciphertext.txt", "w") or die("Unable to open file!");
// $txt = "$encrypted";
// fwrite($myfile, $txt);
// fclose($myfile);

// $txt = file_get_contents('./ciphertext.txt');

$privateKey = openssl_get_privatekey($private);
openssl_private_decrypt(base64_decode($iv), $plaintext, $privateKey);
// openssl_private_decrypt(base64_decode($secKeyPord), $plaintext, $privateKey);

echo $plaintext;

?>