/*Disable update and hide plugin update notifcation */
function disable_any_plugin_updates($value) {
    $Disableplugins = ['cashfree/woocommerce-cashfree.php','woo-checkout-field-editor-pro/checkout-form-designer.php']; 

    if (isset($value) && is_object($value)) {
        foreach($Disableplugins as $plugin) {
            if (isset($value->response[$plugin])) {
                unset($value->response[$plugin]);
            }
        }
    }
    return $value;
}
add_filter('site_transient_update_plugins', 'disable_any_plugin_updates');

/*code ends */