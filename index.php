<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
require_once 'helpers/h-functions.php';
require_once 'helpers/validate_token.php';

echo h_head('Home');
echo h_open_body();
echo get_name() == 'Guest' ? h_header() : h_header(get_name());
if (isset($_SESSION['msg'])) {
	echo $_SESSION['msg'];
	unset($_SESSION['msg']);
}
echo h_title('Home');
echo footer_theme();
echo script();
echo h_close_body();
echo h_close_html();
