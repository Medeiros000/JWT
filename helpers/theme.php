<?php
session_start();
ob_start();

$theme = $_POST['theme'];

$_SESSION['theme'] = $theme;

$response = array(
	'status' => 'success'
);

echo json_encode($response);
