<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
include_once 'h-functions.php';

echo h_head('Admin');
echo h_header('Admin');

if (isset($_SESSION['msg_token'])) {
	$_SESSION['msg'] = $_SESSION['msg_token'];
	unset($_SESSION['msg_token']);
} else {
	$_SESSION['msg'] = h_alert('You must log in first.');
}

foreach ($_SERVER as $key => $value) {
	echo $key . ' => ' . $value . '<br>';
}
echo footer_theme();
