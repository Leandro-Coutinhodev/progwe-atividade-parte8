<?php

$senha = "ola";
// $chave = "bswbsbwusuwdwd.wdwhudhdhhwuhd29okqhsakheww.swhs8ws8whd8hw";
// $metodo = "AES-256-CBC";

// // vetor de inicialização
// $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($metodo));

// // criptografar
// $criptografado = openssl_encrypt($senha, $metodo, $chave, 0, $iv);

// echo $criptografado;

echo md5($senha);

?>