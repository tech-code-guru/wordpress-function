<?php
function my_acf_init() {

    acf_update_setting('google_api_key', 'AIzaSyDDJF5Q_fLPcCpVjJM1xvZrslLNn2MExNo');
}

add_action('acf/init', 'my_acf_init');
/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();

    ?>
    <a class="cart-link" href="<?php echo esc_url(wc_get_cart_url()); ?>"
       title="<?php _e('View your shopping cart', 'woothemes'); ?>"><img class="pos-icon cart-icon"
                                                                         src="<?php echo get_template_directory_uri() . '/images/cart.svg' ?>"
                                                                         alt="Cart"><span
                class="cart_count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?></span></a>
    <?php
    $fragments['a.cart-link'] = ob_get_clean();
    return $fragments;
}

//Brand Taxonomy

add_action('init', 'brand_taxonomy_woo');
function brand_taxonomy_woo()
{
    $labels = array(
        'name' => 'Brands',
        'singular_name' => 'Brands',
        'menu_name' => 'Brands',
        'all_items' => 'All Brands',
        'parent_item' => 'Parent Brand',
        'parent_item_colon' => 'Parent Brand:',
        'new_item_name' => 'New Brand Name',
        'add_new_item' => 'Add New Brand',
        'edit_item' => 'Edit Brand',
        'update_item' => 'Update Brand',
        'separate_items_with_commas' => 'Separate Brand with commas',
        'search_items' => 'Search Brands',
        'add_or_remove_items' => 'Add or remove Brands',
        'choose_from_most_used' => 'Choose from the most used Brands',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('brand', 'product', $args);
    register_taxonomy_for_object_type('brand', 'product');
}

require get_template_directory() . '/inc/woo/upload-image-taxnomy.php';


// Pagination


add_filter('woocommerce_pagination_args', 'woo_pagination_args');
function woo_pagination_args($args)
{
    $args['prev_text'] = __('Prev');
    $args['next_text'] = __('Next');
    return $args;
}

//Description


// define the woocommerce_archive_description callback
function woocommerce_taxonomy_archive_description()
{
    $page_id = get_the_ID();

    echo '<div class="term-description">' . strip_tags(apply_filters('the_content', term_description()) ). '</div>';
}

add_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);

// Change the breadcrumb separator

add_filter('woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter');
function wcc_change_breadcrumb_delimiter($defaults)
{
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults['delimiter'] = '<span class="breadcrumb_delimiter">&gt;</span>';
    return $defaults;
}


/**Convert Quantity to Dropdown**/

/**
 * @snippet       Add to Cart Quantity drop-down - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

function woocommerce_quantity_input($args = array(), $product = null, $echo = true)
{

    if (is_null($product)) {
        $product = $GLOBALS['product'];
    }

    $defaults = array(
        'input_id' => uniqid('quantity_'),
        'input_name' => 'quantity',
        'input_value' => '1',
        'classes' => apply_filters('woocommerce_quantity_input_classes', array('input-text', 'qty', 'text'), $product),
        'max_value' => apply_filters('woocommerce_quantity_input_max', -1, $product),
        'min_value' => apply_filters('woocommerce_quantity_input_min', 0, $product),
        'step' => apply_filters('woocommerce_quantity_input_step', 1, $product),
        'pattern' => apply_filters('woocommerce_quantity_input_pattern', has_filter('woocommerce_stock_amount', 'intval') ? '[0-9]*' : ''),
        'inputmode' => apply_filters('woocommerce_quantity_input_inputmode', has_filter('woocommerce_stock_amount', 'intval') ? 'numeric' : ''),
        'product_name' => $product ? $product->get_title() : '',
    );

    $args = apply_filters('woocommerce_quantity_input_args', wp_parse_args($args, $defaults), $product);

    // Apply sanity to min/max args - min cannot be lower than 0.
    $args['min_value'] = max($args['min_value'], 0);
    // Note: change 20 to whatever you like
    $args['max_value'] = 0 < $args['max_value'] ? $args['max_value'] : 20;

    // Max cannot be lower than min if defined.
    if ('' !== $args['max_value'] && $args['max_value'] < $args['min_value']) {
        $args['max_value'] = $args['min_value'];
    }

    $options = '';

    for ($count = $args['min_value']; $count <= $args['max_value']; $count = $count + $args['step']) {

        // Cart item quantity defined?
        if ('' !== $args['input_value'] && $args['input_value'] >= 1 && $count == $args['input_value']) {
            $selected = 'selected';
        } else $selected = '';

        $options .= '<option value="' . $count . '"' . $selected . '>' . $count . '</option>';

    }

    $string = '<label class="quantity-label">Quantity</label><div class="quantity"><select name="' . $args['input_name'] . '">' . $options . '</select></div>';

    if ($echo) {
        echo $string;
    } else {
        return $string;
    }

}

//before add to cart
add_action('woocommerce_after_add_to_cart_quantity', 'pos_before_add_to_cart_btn');

function pos_before_add_to_cart_btn()
{
    echo '<div class="add-to-cart-outter">';



}

//after add to cart
add_action('woocommerce_after_add_to_cart_button', 'pos_after_add_to_cart_btn');

function pos_after_add_to_cart_btn()
{
    //Add to Wishlist
    if (shortcode_exists('yith_wcwl_add_to_wishlist')) {

        echo do_shortcode('[yith_wcwl_add_to_wishlist]');
    }
    echo '</div>';
    echo '<div class="clearfix"></div>';
}


/***Custom Fields For Term and condition and Comments***/

require get_template_directory() . '/inc/woo/single-product-custom_field.php';
//Checkouot Field
require get_template_directory() . '/inc/woo/checkout-fields.php';

//after add to cart

add_action('woocommerce_after_add_to_cart_button', 'pos_after_add_to_cart_btn_last');
function pos_after_add_to_cart_btn_last()
{
    echo '<div class="clearfix"></div>';
    // Comapire link


    if (class_exists('woocommerce')) {
        if (is_user_logged_in()) {
            if (shortcode_exists('yith_compare_button')) {

                echo do_shortcode('[yith_compare_button]');

            }
        } else { ?>
            <div class="woocommerce product compare-button"><a
                        href=" <?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"  rel="nofollow">Add to Compare</a></div>
        <?php }


    }
}

//Compare popup

    function woocompare_compare_popup()
    {
        $classes = get_body_class();
        if (in_array('yith-woocompare-popup', $classes)) {
            // your markup
        } else {
            echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/compare-iframe.css"/>';
        }

    }

    add_action('yith_woocompare_popup_head', 'woocompare_compare_popup', 10, 0);




// Check the password and confirm password fields match before allow checkout to proceed.

add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
    global $woocommerce;
    extract( $_POST );
    if ( strcmp( $password, $password2 ) !== 0 ) {
        return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
    }
    return $reg_errors;
}

add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
function wc_register_form_password_repeat() {
    ?>
    <p class="form-row form-row-wide">
        <label for="reg_password2" class="sr-only">><?php _e( 'Password Repeat', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="password" required placeholder="Confirm Password"  class="form-control input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
    </p>
    <?php
}


//Name Field on Registeration

function wooc_extra_register_fields() {?>

    <p class="form-row form-row-wide">
        <label for="reg_billing_first_name" class="sr-only">><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" placeholder="Name" required class="form-control input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
    <?php
    $enable_phone_lastname = false;
    if($enable_phone_lastname == true){
    ?>
    <p class="form-row form-row-wide">
        <label for="reg_billing_last_name" class="sr-only">><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" required name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
    <p class="form-row form-row-wide">
        <label for="reg_billing_phone" class="sr-only">><?php _e( 'Phone', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" required name="billing_phone" id="reg_billing_phone" value="<?php esc_attr_e( $_POST['billing_phone'] ); ?>" />
    </p>
<?php } ?>
    <div class="clear"></div>
    <?php
}
add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    $enable_phone_lastname = false;
    if($enable_phone_lastname == true) {
        if (isset($_POST['billing_last_name']) && empty($_POST['billing_last_name'])) {
            $validation_errors->add('billing_last_name_error', __('<strong>Error</strong>: Last name is required!.', 'woocommerce'));
        }
        if (isset($_POST['billing_phone']) && empty($_POST['billing_phone'])) {
            $validation_errors->add('billing_phone_error', __('<strong>Error</strong>: Phone is required!.', 'woocommerce'));
        }
    }
    return $validation_errors;
}
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );


function wooc_save_extra_register_fields( $customer_id ) {

    if ( isset( $_POST['billing_first_name'] ) ) {
        //First name field which is by default
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        // First name field which is used in WooCommerce
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    }

    $enable_phone_lastname = false;
    if($enable_phone_lastname == true) {

        if (isset($_POST['billing_last_name'])) {
            // Last name field which is by default
            update_user_meta($customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']));
            // Last name field which is used in WooCommerce
            update_user_meta($customer_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
        }
        if ( isset( $_POST['billing_phone'] ) ) {
            // Phone input filed which is used in WooCommerce
            update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
        }
    }
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );



add_action( 'woo_before_filter', 'pro_selectbox', 25 );
function pro_selectbox() {
    $per_page = filter_input(INPUT_GET, 'perpage', FILTER_SANITIZE_NUMBER_INT);
    if(!empty($per_page)){
        $per_page_val = $per_page;
    } else{
        $per_page_val = 16;
    }
    echo '<div class="woocommerce-ordering-outter">';
    echo '<label>Sort By</label>';
woocommerce_catalog_ordering();
    echo '</div>';
    echo '<div class="woocommerce-perpage-outter">';
    echo '<label>Show</label><div class="woocommerce-perpage"
><select onchange="if (this.value) window.location.href=this.value">';
    $orderby_options = array(
        '16' => '16 items per page',
        '32' => '32 items per page',
        '64' => '64 items per page',
        '128' => '128 items per page',
        '-1' => 'All items'
    );
    foreach( $orderby_options as $value => $label ) {
        echo "<option ".selected( $per_page_val, $value )." value='?swoof=1&perpage=$value'>$label</option>";
    }
    echo '</select></div>';
    echo '</div>';
}


add_action( 'pre_get_posts', 'pro_pre_get_products_query' );
function pro_pre_get_products_query( $query )
{
    $per_page = filter_input(INPUT_GET, 'perpage', FILTER_SANITIZE_NUMBER_INT);
    if ($query->is_main_query() && !is_admin() && is_post_type_archive('product')) {
        $query->set('posts_per_page', $per_page);
    }
}

if (shortcode_exists('yith_wcwl_add_to_wishlist')) {

add_filter ( 'woocommerce_account_menu_items', 'wishlist_link' );
function wishlist_link( $menu_links ){

    // we will hook "anyuniquetext123" later
    $new = array( 'whishlist' => 'Wishlist' );

    // or in case you need 2 links
    // $new = array( 'link1' => 'Link 1', 'link2' => 'Link 2' );

    // array_slice() is good when you want to add an element between the other ones
    $menu_links = array_slice( $menu_links, 0, 2, true )
        + $new
        + array_slice( $menu_links, 1, NULL, true );


    return $menu_links;


}

add_filter( 'woocommerce_get_endpoint_url', 'wishlist_hook_endpoint', 10, 4 );
function wishlist_hook_endpoint( $url, $endpoint, $value, $permalink ){

    if( $endpoint === 'whishlist' ) {

        // ok, here is the place for your custom URL, it could be external
        $url = get_permalink(get_option( 'yith_wcwl_wishlist_page_id'));

    }
    return $url;

}

}
function wishlist_view_price_heading($title)
{
    return 'Price';
}
add_filter('yith_wcwl_wishlist_view_price_heading', 'wishlist_view_price_heading');


add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
    if ( is_user_logged_in() ) {
        $classes[] = 'user-login';
    } else{
        $classes[] = 'none-login';
    }

    return $classes;

}


function advance_repair_badge_fu(){
    if(function_exists('get_field')){
        $product_advance_badge = get_field('enable_advance_products');
        if($product_advance_badge){
            $product_advance_badge = get_field('product_advance_badge');
            if($product_advance_badge){
                ?>
                <img src="<?php echo $product_advance_badge['url'] ?>" class="advance_repair_badge" alt="Advance Repair">
                <?php
            } else{
                $product_advance_badge_option = get_field('product_advance_badge','option');
                if($product_advance_badge_option) {
                    ?>
                    <img src="<?php echo $product_advance_badge_option['url'] ?>" class="advance_repair_badge" alt="Advance Repair">
                    <?php
                }

            }
        }

    }
}

//add_action('advance_repair_badge','advance_repair_badge_fu')


//Vendor Role

$result = add_role(
    'vendor',
    __( 'Vendor', 'pos' )
);
/*
if ( null !== $result ) {
    echo "Success: {$result->name} user role created.";
}
else {
    echo 'Failure: user role already exists.';
} */



if ( ! function_exists( 'cor_remove_personal_options' ) ) {
    function cor_remove_personal_options( $subject ) {
        $subject = preg_replace('#<h2>'.__("Personal Options").'</h2>#s', '', $subject, 1); // Remove the "Personal Options" title
        $subject = preg_replace('#<tr class="user-rich-editing-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Visual Editor" field
        $subject = preg_replace('#<tr class="user-comment-shortcuts-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Keyboard Shortcuts" field
        $subject = preg_replace('#<tr class="show-admin-bar(.*?)</tr>#s', '', $subject, 1); // Remove the "Toolbar" field
        $subject = preg_replace('#<h2>'.__("Name").'</h2>#s', '', $subject, 1); // Remove the "Name" title
        $subject = preg_replace('#<tr class="user-display-name-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Display name publicly as" field
        //$subject = preg_replace('#<h2>'.__("Contact Info").'</h2>#s', '', $subject, 1); // Remove the "Contact Info" title
        $subject = preg_replace('#<tr class="user-url-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Website" field
        $subject = preg_replace('#<h2>'.__("About Yourself").'</h2>#s', '', $subject, 1); // Remove the "About Yourself" title
        $subject = preg_replace('#<tr class="user-description-wrap(.*?)</tr>#s', '', $subject, 1); // Remove the "Biographical Info" field
        $subject = preg_replace('#<tr class="user-profile-picture(.*?)</tr>#s', '', $subject, 1); // Remove the "Profile Picture" field
        return $subject;
    }

    function cor_profile_subject_start() {
        if ( ! current_user_can('manage_options') ) {
            ob_start( 'cor_remove_personal_options' );
        }
    }

    function cor_profile_subject_end() {
        if ( ! current_user_can('manage_options') ) {
            ob_end_flush();
        }
    }
}
add_action( 'admin_head', 'cor_profile_subject_start' );
add_action( 'admin_footer', 'cor_profile_subject_end' );
 