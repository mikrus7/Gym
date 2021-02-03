<?php
    $key = '!ej$$il%vf)o9n(d-pumb83#4pev7$hmz1k7=g-a8-$pb-_%d&';

    function encryption($data, $key){
        $encrpytion_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encrpytion_key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }
    function decrypted($data, $key){
        $encryption_key = base64_decode($key);
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }