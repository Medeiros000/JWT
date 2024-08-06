<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
require_once 'helpers/h-functions.php';
require_once 'helpers/validate_token.php';

echo h_head('Home');
echo h_open_body();
echo get_name() == 'Guest' ? h_header() : h_header(get_name());
if ($_SESSION['msg'] ?? null) {
	echo $_SESSION['msg'];
	unset($_SESSION['msg']);
}
echo h_title('Home');
?>

<div class="content">
	<p>Login system that uses jwt token and cookies and checks whether the user is logged in correctly.</p>
	<p>Feel free to test the system.</p>
</div>

<?php
require_once 'footer.php';
echo script();
echo h_close_body();
echo h_close_html();
?>