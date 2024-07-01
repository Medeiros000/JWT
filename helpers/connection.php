<?php
if (getenv('SERVERNAME') ?? null) {
	$servername = getenv('SERVERNAME');
	$username = getenv('USERNAME');
	$port = getenv('PORT');
	$password = getenv('PASSWORD');
	$dbname = getenv('DBNAME');
} else {
	require_once 'config.php';
	$servername = $config_servername;
	$username = $config_username;
	$port = $config_port;
	$password = $config_password;
	$dbname = $config_dbname;
}
echo $dbname;
// Create connection
// $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
// Check connection
// if (!$conn) {
// 	die("Connection failed: ");
// }
