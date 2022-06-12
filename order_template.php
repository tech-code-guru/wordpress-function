<?php
/* Template Name: Order Temp */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
<?php
// Get order ids.
$args = array(
    'return' => 'ids',
   // 'date_created' => '2018-07-19',
    'date_created' => '>' . ( time() - DAY_IN_SECONDS ),
    'status' => 'completed',
);
$orders = wc_get_orders( $args );
    

    foreach ($orders as $orders_id) {

        //echo '<div class="col-md-3">'.$orders_id.'</div>';
    }

?>
<?php
global $wpdb;

/*
$sql="SELECT * FROM wp_posts WHERE post_type = 'shop_order' AND post_status IN ('wc-completed') AND post_date BETWEEN '2018-07-19 10:00:00' AND '2018-07-19 22:00:00'";
*/
//wp-content/plugins/woocommerce/includes/abstracts/abstract-wc-product.php

//$date_from = date('Y-m-d');

$date_from =date('Y-m-d');

 $result = $wpdb->get_results( "SELECT * FROM $wpdb->posts 
            WHERE post_type = 'shop_order'
            AND post_status IN ('wc-completed')
            AND post_date BETWEEN '{$date_from}  10:00:00' AND '{$date_from} 22:00:00'
        ");


//echo "<pre>";
//print_r($result);

   foreach ($result as $orders_id) {

       
echo '<div class="col-md-3">'.$orders_id->ID.'</div>';

    }
?>
        </main><!-- #main -->
    </div><!-- #primary -->
<style type="text/css">
    .col-md-3 {
    float: LEFT;
    PADDING: 20PX;
    BACKGROUND: #dedede;
    MARGIN: 11PX;
}
</style>
<?php
//get_footer();
