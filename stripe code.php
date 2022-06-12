<?php 
// stripe code 
//ajax get single coupon product price page 


// Stripe Library
require_once 'stripe-php/init.php';

$site_url=site_url();

$api_key= $_POST['api_key'];
$single_product_sku= $_POST['single_product_sku'];
$coupon= $_POST['coupon'];

//die();
\Stripe\Stripe::setApiKey($api_key);

if(!empty($coupon))
{
	// if coupon apply 	
	$session = \Stripe\Checkout\Session::create([
  'billing_address_collection' => 'required',
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price' => $single_product_sku,
    'quantity' => 1,
  ],
  ],
  'mode' => 'subscription',
  'subscription_data' => [
  'coupon' => $coupon,
  ],
  'success_url' => $site_url.'/payment-success',
  'cancel_url' => $site_url.'/pricing/',
]);
	
	echo $session->id;
}
die();

?>