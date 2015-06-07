<?php

/* utility functions for index.php */

function logStr($str) {
    $folder = getcwd(); //current directory
    $file = $folder . '\index.log.txt';
    file_put_contents($file, $str . PHP_EOL, FILE_APPEND);
}

if (get_magic_quotes_gpc()) {

    function stripslashes_deep($value) {
        $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);
        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

function showError($str) {
    $error = $str . "; exiting";
    include 'error.html.php';
    exit();
}

function hsc($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
