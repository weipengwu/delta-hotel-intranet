<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';

if($_POST){

    $message = 'Name: '.$_POST['yourname']."\n";
    $message .= 'Email: '.$_POST['youremail']."\n";
    $message .= 'Message: '.$_POST['message']."\n";

wp_mail('dhr.denissues.grp@deltahotels.com', 'Contact an administrator', $message);

    echo "success";
}
