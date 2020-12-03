<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ./');
    }else{
        $user = $_SESSION['user'];
    }

    $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
?>