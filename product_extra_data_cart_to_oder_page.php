<?php
/* step by step 5 step to follow */ 

/* show field on product page step 1 */ 

	function adw_display_custom_field()
    {
        global $post;
        // Check for the custom field value
        $product = wc_get_product($post->ID);
        $title = $product->get_meta('adw-check-field');

        printf(
            '<div style="display:none;" class="all_data"><div class="form-group mb-0 mt-3"> <label class="form-label">Acknowledge Advance Repair Deposit Amount<span class="required">*</span></label> </div> <div class="form-group form-check mb-4"> <label class="form-check-label" for="adw-check-field">Security Deposit : To be returned to you once we receive your device. *See Advance repair details below +$67.00 <input type="checkbox" class="form-check-input" id="adw-check-field" name="adw-check-field"> <span class="checkmark"></span> </label> </div></div>',
            esc_html($title)
        );
    }

    add_action('woocommerce_before_add_to_cart_button', 'adw_display_custom_field');
	
/* Save data step 2 */ 
		 function adw_save_custom_field($post_id)
    {

        $product = wc_get_product($post_id);
        $title = isset($_POST['adw-check-field']) ? $_POST['adw-check-field'] : '';
        $product->update_meta_data('adw-check-field', sanitize_text_field($title));
        $product->save();
    }

    add_action('woocommerce_process_product_meta', 'adw_save_custom_field');

/* add to cart object items step 3 */ 
  function terms_add_custom_field_item_data($cart_item_data, $product_id, $variation_id, $quantity)
    {
		// Add the item data
		$cart_item_data['adw_title_field'] = $_POST['adw-check-field'];
		$product = wc_get_product($product_id); // Expanded function
		$price = $product->get_price(); // Expanded function
		$cart_item_data['total_price'] = $price + $advance_price_product; // for add extra price $advance_price_product
		
        return $cart_item_data;
    }
    add_filter('woocommerce_add_cart_item_data', 'terms_add_custom_field_item_data', 10, 4);
	
/* add/display to cart page step 4 */ 
	function adw_cart_item_name($name, $cart_item, $cart_item_key)
    {
        if (isset($cart_item['adw_title_field'])) {
            $name .= sprintf(
                '<div class="term_agree22"><label>Acknowledge Advance Repair Deposit Amount:</label>Security Deposit : To be returned to you once we receive your device. *See Advance repair details below +$67.00</div>',
                esc_html($cart_item['adw_title_field'])
            );
        }
       return $name;
    }

    add_filter('woocommerce_cart_item_name', 'adw_cart_item_name', 10, 3);

/* add/data to checkout/order/bakend page step 5 */ 
	
function adw_add_custom_data_to_order($item, $cart_item_key, $values, $order)
    {
        foreach ($item as $cart_item_key => $values) {
            if (isset($values['adw_title_field'])) {
                $item->add_meta_data(__('Acknowledge Advance Repair Deposit Amount', 'comments'), 'Security Deposit : To be returned to you once we receive your device. *See Advance repair details below +$67.00', true);
				 
				 //step another if input filed
				//$item->add_meta_data(__('Comments', 'comments'), $values['title_field'], true);

            }
        }
    }

    add_action('woocommerce_checkout_create_order_line_item', 'adw_add_custom_data_to_order', 10, 4);
?>