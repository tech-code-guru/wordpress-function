
<?php
// Add term page
function sm_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[custom_term_meta]"><?php _e( 'meta field'); ?></label>
		<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
		<p class="description"><?php _e( 'Enter a description'); ?></p>
	</div>
<?php
}
add_action( 'product_cat_add_form_fields', 'sm_taxonomy_add_new_meta_field', 12, 2 );


// Edit term page
function sm_taxonomy_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'meta field', 'tutorialshares' ); ?></label></th>
		<td>
			<input type="text" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter a description' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'product_cat_edit_form_fields', 'sm_taxonomy_edit_meta_field', 10, 2 );


function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_product_cat', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_product_cat', 'save_taxonomy_custom_meta', 10, 2 );
?>