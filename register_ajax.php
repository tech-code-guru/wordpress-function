<?php
header("Access-Control-Allow-Origin: *");

  require_once($_SERVER['DOCUMENT_ROOT'] . '/heartfilebooks/wp-load.php' );
  global $wpdb;

$error='';
//echo '<pre>';
//print_r($_POST);
$user_name=isset($_POST["user_name"]) ? $_POST["user_name"] : '';
$father_name=isset($_POST["father_name"]) ? $_POST["father_name"] : '';
$age=isset($_POST["age"]) ? $_POST["age"] : '';
$gender=isset($_POST["gender"]) ? $_POST["gender"] : '';
$occupation=isset($_POST["occupation"]) ? $_POST["occupation"] : '';
$user_login=isset($_POST["user_login"]) ? $_POST["user_login"] : '';
$user_email=isset($_POST['user_email']) ? $_POST['user_email'] : '';
$phoneno=isset($_POST['phoneno']) ? $_POST['phoneno'] : '';
$user_pass=isset($_POST['user_pass']) ? $_POST['user_pass'] : '';
$mobile_code=isset($_POST['mobile_code']) ? $_POST['mobile_code'] : '';

if(empty($user_name))
{
	$error='Please enter your name';
}
elseif(empty($age))
{
	$error='Please enter your age';
}
elseif(!preg_match('/^[0-9]{2}+$/', $age))
{
    $error = "Please enter only digit";  
}
elseif(empty($gender))
{
	$error='Please select your gender';
}
elseif(empty($occupation))
{
	$error='Please enter your occupation';
}
elseif(empty($user_login))
{
	$error='Please enter your username';
}
elseif( username_exists( $user_login ) ) 
{  
$error= "Username already exists, please try another";  
} 
/* 
elseif(empty($user_email))
{
	$error='Please enter your email address';

}
/*
elseif(!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
  $error = "Invalid email address"; 
}
elseif(!is_email($user_email)) 
{
    $error='Please enter a valid email';  
}
elseif( email_exists($user_email) ) 
{
	    $error='email exit';  

}
*/

elseif(empty($phoneno))
{
	$error='Please enter your phone no';

}
elseif(!preg_match('/^[0-9]{10}+$/', $phoneno))
{
    $error = "Please enter 10 digit mobile no";  
}
/*
$phone_args = array(
		'meta_key'     => 'phoneno',
		'meta_value'   => $phoneno,
		'meta_compare' => '='
		);
	$phone_query = new WP_User_Query( $phone_args );
	// Get the results
	$phone_exit = $phone_query->get_results();
	// Check for results
	if ( ! empty( $phone_exit ) )
	{
	       $error = "phone already used";  
    }
*/

else{
$user=array(
'user_login'=> $user_login,
'first_name'=> $user_name,
'user_email'=> $user_email,
'user_pass' =>$user_pass
);
$user_id = wp_insert_user( $user ) ;

//On success
if( !is_wp_error($user_id) ) {
 
 add_user_meta( $user_id, 'phoneno', $phoneno, true );
 add_user_meta( $user_id, 'mobile_code','bbsj_'.$mobile_code, true );
 add_user_meta( $user_id, 'father_name', $father_name, true );
 add_user_meta( $user_id, 'age', $age, true );
 add_user_meta( $user_id, 'gender', $gender, true );
 add_user_meta( $user_id, 'occupation', $occupation, true );
$sucess='';

$sucess=array('status'=>'1','error'=>'0','msg'=>'User register sucessfuly');
//wp_redirect('https://smsapi.engineeringtgr.com/send/?Mobile=9041778804&Password=ssmuha&Key=sanjavjcEmwuNBFnO28sUXVatAR0&Message=dsds&To=9041778804');

 echo json_encode($sucess);

}
}
echo $error;
?>