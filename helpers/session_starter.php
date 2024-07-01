<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
}

$appendFile = $_SERVER['DOCUMENT_ROOT'] . '/h-functions.php';
echo $appendFile;
require_once($appendFile);