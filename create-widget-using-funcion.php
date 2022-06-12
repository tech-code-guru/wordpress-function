<!-----------------------------how to creat widget------------>
<?php

function create_my_widget() {
 register_sidebar(array(
 'name' => __( 'test me', 'mytheme' ), 
 'id' => 'my_sidebar',
 'description' => __( 'The one and only', 'mytheme' ),
 ));
}
add_action( 'widgets_init', 'create_my_widget' );
?>

<!-----------------------------how to call widget------------>

		<?php dynamic_sidebar( 'my_sidebar' ); ?>
