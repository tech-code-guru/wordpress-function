<?php
  

if(function_exists('get_field')) {
    $terms_on = get_field('enable_terms_conditions_single_product', 'option');
    $comment_on = get_field('enable_comment_single_product', 'option');
    if ($terms_on){


//Term and condition Field for Products
    /**
     * Display the custom text field
     * @since 1.0.0
     */
    /*function terms_create_custom_field() {
        $args = array(
            'id' => 'comment_field',
            'label' => __( 'Comments', 'comments' ),
            'class' => 'terms-custom-field',
            'desc_tip' => true,
            'description' => __( 'Enter the title of your custom text field.', 'ctwc' ),
        );
        woocommerce_wp_text_input( $args );
    }
    add_action( 'woocommerce_product_options_general_product_data', 'terms_create_custom_field' );*/
    /**
     * Save the custom field
     * @since 1.0.0
     */
    function terms_save_custom_field($post_id)
    {

        $product = wc_get_product($post_id);
        $title = isset($_POST['comment_field']) ? $_POST['comment_field'] : '';
        $product->update_meta_data('comment_field', sanitize_text_field($title));
        $product->save();
    }

    add_action('woocommerce_process_product_meta', 'terms_save_custom_field');
    /**
     * Display custom field on the front end
     * @since 1.0.0
     */
    function terms_display_custom_field()
    {
        global $post;
        // Check for the custom field value
        $product = wc_get_product($post->ID);
        $title = $product->get_meta('comment_field');
//    if( $title ) {
        // Only display our field if we've got a value for the field title
        printf(
            '<div class="form-group mb-0 mt-3"> <label class="form-label">Terms & Conditions<span class="required">*</span></label> </div> <div class="form-group form-check mb-4"> <label class="form-check-label" for="terms-title-field">I have read the equipment repair agreement <input type="checkbox" class="form-check-input" id="terms-title-field" name="terms-title-field"> <span class="checkmark"></span> </label> </div>',
            esc_html($title)
        );
//    }
    }

    add_action('woocommerce_before_add_to_cart_button', 'terms_display_custom_field');
    /**
     * Validate the text field
     * @param Array $passed Validation status.
     * @param Integer $product_id Product ID.
     * @param Boolean $quantity Quantity
     * @since 1.0.0
     */
    function terms_validate_custom_field($passed, $product_id, $quantity)
    {
        if (empty($_POST['terms-title-field'])) {
            // Fails validation
            $passed = false;
            wc_add_notice(__('You must accept our terms and conditions!', 'comments'), 'error');
        }
        return $passed;
    }

    add_filter('woocommerce_add_to_cart_validation', 'terms_validate_custom_field', 10, 3);
    /**
     * Add the text field as item data to the cart object
     * @param Array $cart_item_data Cart item meta data.
     * @param Integer $product_id Product ID.
     * @param Integer $variation_id Variation ID.
     * @param Boolean $quantity Quantity
     * @since 1.0.0
     */
    function terms_add_custom_field_item_data($cart_item_data, $product_id, $variation_id, $quantity)
    {
		$enable_vendor_options=get_field('enable_vendor_options', $product_id);
		$advance_price_product=get_field('advance_price_for_advance_repair_product', 'option');

		if($enable_vendor_options == 'yes') {
            // Add the item data
            $cart_item_data['title_field'] = $_POST['terms-title-field'];
            $product = wc_get_product($product_id); // Expanded function
            $price = $product->get_price(); // Expanded function
            $cart_item_data['total_price'] = $price + $advance_price_product; // Expanded function
        }
		
        return $cart_item_data;
    }

    add_filter('woocommerce_add_cart_item_data', 'terms_add_custom_field_item_data', 10, 4);
    /**
     * Update the price in the cart
     * @since 1.0.0
     */
    function terms_before_calculate_totals($cart_obj)
    {
        if (is_admin() && !defined('DOING_AJAX')) {
            return;
        }
        // Iterate through each cart item
        foreach ($cart_obj->get_cart() as $key => $value) {
            if (isset($value['total_price'])) {
                $price = $value['total_price'];
                $value['data']->set_price(($price));
            }
        }
    }

    add_action('woocommerce_before_calculate_totals', 'terms_before_calculate_totals', 10, 1);
    /**
     * Display the custom field value in the cart
     * @since 1.0.0
     */
    function terms_cart_item_name($name, $cart_item, $cart_item_key)
    {
        if (isset($cart_item['title_field'])) {
            $name .= sprintf(
                '<div class="term_agree term_hide_on_cart"><label>Terms & Conditions:</label>I have read the equipment repair agreement.</div>',
                esc_html($cart_item['title_field'])
            );
        }
       return $name;
    }

    add_filter('woocommerce_cart_item_name', 'terms_cart_item_name', 10, 3);
    /**
     * Add custom field to order object
     */
    function terms_add_custom_data_to_order($item, $cart_item_key, $values, $order)
    {
        foreach ($item as $cart_item_key => $values) {
            if (isset($values['title_field'])) {
                $item->add_meta_data(__('Terms & Conditions', 'comments'), 'I have read the equipment repair agreement.', true);
            }
        }
    }

    add_action('woocommerce_checkout_create_order_line_item', 'terms_add_custom_data_to_order', 10, 4);

}
if($comment_on){
    $comment_limit = get_field('comment_character_limit_single_product', 'option');
    if($comment_limit){
        $comment_limit = $comment_limit;
    } else{
        $comment_limit = 1000;
    }
    $aggrement_link_option = get_field('aggrement_link_single_product', 'option');

    if($aggrement_link_option) {
        $aggrement_link_option_url = $aggrement_link_option['url'];
        $aggrement_link_option_title = $aggrement_link_option['title'];
        if($aggrement_link_option['target']){
            $aggrement_link_option_target = "target=_blank";
        } else{
            $aggrement_link_option_target = '';
        }

        $aggrement_link = '<a href="'.$aggrement_link_option_url.'" '.$aggrement_link_option_target.' class="agree-link">'.$aggrement_link_option_title.'</a>';
    }
//Comment Fields in Single Products
    /**
     * Display the custom text field
     * @since 1.0.0
     */
    /*function comments_create_custom_field() {
        $args = array(
            'id' => 'comment_field',
            'label' => __( 'Comments', 'comments' ),
            'class' => 'comments-custom-field',
            'desc_tip' => true,
            'description' => __( 'Enter the title of your custom text field.', 'ctwc' ),
        );
        woocommerce_wp_text_input( $args );
    }
    add_action( 'woocommerce_product_options_general_product_data', 'comments_create_custom_field' );*/
    /**
     * Save the custom field
     * @since 1.0.0
     */
    function comments_save_custom_field($post_id)
    {
        $product = wc_get_product($post_id);
        $title = isset($_POST['comment_field']) ? $_POST['comment_field'] : '';
        $product->update_meta_data('comment_field', sanitize_text_field($title));
        $product->save();
    }

    add_action('woocommerce_process_product_meta', 'comments_save_custom_field');
    /**
     * Display custom field on the front end
     * @since 1.0.0
     */
    function comments_display_custom_field()
    {
        global $post, $aggrement_link, $comment_limit;
        // Check for the custom field value
        $product = wc_get_product($post->ID);
        $title = $product->get_meta('comment_field');
//    if( $title ) {
        // Only display our field if we've got a value for the field title
        printf(
            '<div class="form-group"> <label class="form-label">Comments<span class="required">*</span></label> <textarea class="form-control mb-3" id="comments-title-field" name="comments-title-field" data-length="'.$comment_limit.'" maxlength="'.$comment_limit.'"></textarea> <p id="comment_count_product">Characters left: '.$comment_limit.'</p> '.$aggrement_link.' </div>',
            esc_html($title)
        );
//    }
    }

    add_action('woocommerce_before_add_to_cart_button', 'comments_display_custom_field');
    /**
     * Validate the text field
     * @param Array $passed Validation status.
     * @param Integer $product_id Product ID.
     * @param Boolean $quantity Quantity
     * @since 1.0.0
     */
    function comments_validate_custom_field($passed, $product_id, $quantity)
    {
        if (empty($_POST['comments-title-field'])) {
            // Fails validation
            $passed = false;
            wc_add_notice(__('Please enter comments.', 'comments'), 'error');
        }
        return $passed;
    }

    add_filter('woocommerce_add_to_cart_validation', 'comments_validate_custom_field', 10, 3);
    /**
     * Add the text field as item data to the cart object
     * @param Array $cart_item_data Cart item meta data.
     * @param Integer $product_id Product ID.
     * @param Integer $variation_id Variation ID.
     * @param Boolean $quantity Quantity
     * @since 1.0.0
     */
	 /*
    function comments_add_custom_field_item_data($cart_item_data, $product_id, $variation_id, $quantity)
    {
        if (!empty($_POST['comments-title-field'])) {
            // Add the item data
            $cart_item_data['title_field'] = $_POST['comments-title-field'];
            $product = wc_get_product($product_id); // Expanded function
            $price = $product->get_price(); // Expanded function
            $cart_item_data['total_price'] = $price; // Expanded function
        }
        return $cart_item_data;
    }

    add_filter('woocommerce_add_cart_item_data', 'comments_add_custom_field_item_data', 10, 4);
	*/
    /**
     * Update the price in the cart
     * @since 1.0.0
     */
    function comments_before_calculate_totals($cart_obj)
    {
        if (is_admin() && !defined('DOING_AJAX')) {
            return;
        }
        // Iterate through each cart item
        foreach ($cart_obj->get_cart() as $key => $value) {
            if (isset($value['total_price'])) {
                $price = $value['total_price'];
                $value['data']->set_price(($price));
            }
        }
    }

    add_action('woocommerce_before_calculate_totals', 'comments_before_calculate_totals', 10, 1);
    /**
     * Display the custom field value in the cart
     * @since 1.0.0
     */
    function comments_cart_item_name($name, $cart_item, $cart_item_key)
    {
        if (isset($cart_item['title_field'])) {
            $name .= sprintf(
                '<div class="product_comment"><label>Comments:</label>%s</div>',
                esc_html($cart_item['title_field'])
            );
        }
        return $name;
    }

    add_filter('woocommerce_cart_item_name', 'comments_cart_item_name', 10, 3);
    /**
     * Add custom field to order object
     */
    function comments_add_custom_data_to_order($item, $cart_item_key, $values, $order)
    {
        foreach ($item as $cart_item_key => $values) {
            if (isset($values['title_field'])) {
                $item->add_meta_data(__('Comments', 'comments'), $values['title_field'], true);
            }
        }
    }

    add_action('woocommerce_checkout_create_order_line_item', 'comments_add_custom_data_to_order', 10, 4);
}
}




