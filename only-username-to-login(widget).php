<?php

class No_Password_Widget extends WP_Widget 
{
    public function __construct() {
        parent::__construct("no-password-widget", "No Password Login Form", array("description" => __("Displays a Login form which allows to login without password")));
        }
        
    public function widget($args, $instance) 
    {
        if(is_user_logged_in())
        {
            echo "You are logged in";
        }
        else
        {
            ?>
                <form method="get" action="<?php echo get_site_url() . '/wp-admin/admin-ajax.php'; ?>">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="text" name="action" value="login" style="display: none">
                    <input type="submit">
                </form>
            <?php
        }
    }
}

register_widget("No_Password_Widget");

function redirect_to_home()
{
    header("Location: " . get_site_url());
}

function login()
{
    if(isset($_GET["username"]))
    {
        //now login user 
        $user = get_user_by("login", $_GET["username"] );
        if($user != "FALSE")
        {
            wp_set_auth_cookie($user->ID);
        }
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    die();
}

add_action("wp_ajax_login", "redirect_to_home");
add_action("wp_ajax_nopriv_login", "login");
?>