<?php
if (getenv('SERVERNAME') ?? null) {
	$servername = getenv('SERVERNAME');
	$username = getenv('USERNAME');
	$port = getenv('PORT');
	$password = getenv('PASSWORD');
	$dbname = getenv('DBNAME');
} else {
	$servername = "127.0.0.1";
	$username = "root";
	$port = "3306";
	$password = "";
	$dbname = "login";
}
// echo $dbname;
// Create connection
$conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
// Check connection
if (!$conn) {
	die("Connection failed: ");
}
