<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
require_once 'h-functions.php';

echo h_head('Admin');
echo h_header('Admin');

if (isset($_COOKIE['msg_token'])) {
	$_COOKIE['msg'] = $_COOKIE['msg_token'];
	unset($_COOKIE['msg_token']);
} else {
	$_COOKIE['msg'] = h_alert('You must log in first.');
}
debug_jr($_SERVER);
echo footer_theme();
