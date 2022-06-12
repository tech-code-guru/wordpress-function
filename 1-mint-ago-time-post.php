<!---------------add function.php ------------------>
<?php
	add_filter( 'the_content', 'time_ago' );

	function time_ago ( $content ) {

		$content .= "
" . __( 'Posted ', 'test' ) . human_time_diff( get_the_time('U'), current_time('timestamp') ) . __( ' ago', 'test' );

		return $content;

	} 
?>