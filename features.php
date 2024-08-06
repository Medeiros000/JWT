<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
require_once 'helpers/h-functions.php';
require_once 'helpers/validate_token.php';

token();
echo h_head('Features');
echo h_open_body();
echo h_header(get_name());
echo h_title('Features');
?>
<div class="content">
    <p>This content only appears if you are logged in.</p>
    <p>Feel free to test the system.</p>
</div>
<?php
require_once 'footer.php';
echo script();
echo h_close_body();
echo h_close_html();
