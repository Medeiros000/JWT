<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
require_once 'logs.php';
write_logs(json_encode($_POST));

$theme = $_POST['theme'];

$_SESSION['theme'] = $theme;

$response = array(
	'status' => 'success'
);

echo json_encode($response);
