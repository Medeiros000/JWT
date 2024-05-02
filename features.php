<?php
session_start();
ob_start();

include_once 'helpers/validate_token.php';
include_once 'helpers/h-functions.php';

token();
echo h_head('Features');
echo h_open_body();
echo h_header(get_name());
echo h_title('Features');
echo footer_theme();
echo script();
echo h_close_body();
echo h_close_html();
