<?php

// Clean redirect buffer
ob_start();

include_once 'helpers/h-functions.php';
require_once 'helpers/validate_token.php';

// Delet cookie
setcookie('token');

// Message to user
if (isset($_COOKIE['token'])) {
	setcookie('token');
	$_SESSION['msg'] = h_alert('You have been logged out...', 'warning-subtle');
} else {
	$_SESSION['msg'] = h_alert('You are not logged in...');
}

// Redirect to index
header('Location: index.php');
