<?php
include_once 'helpers/validate_token.php';

token();
echo h_head('Contact');
echo h_open_body();
echo h_header(get_name());
echo h_title('Contact');
echo footer_theme();
echo script();
echo h_close_body();
echo h_close_html();
