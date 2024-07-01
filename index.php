<?php
echo $_SERVER['DOCUMENT_ROOT'];
echo h_head('Home');
echo h_open_body();
echo h_header();
if (isset($_SESSION['msg'])) {
	echo $_SESSION['msg'];
	unset($_SESSION['msg']);
}
echo h_title('Home');
echo footer_theme();
echo script();
echo h_close_body();
echo h_close_html();
