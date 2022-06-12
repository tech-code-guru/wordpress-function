<?php
function total_customize_register( $wp_customize ) {


	/*============GENERAL SETTINGS PANEL============*/
	$wp_customize->add_panel(
		'total_general_settings_panel',
		array(
			'title' => __( 'General Settings', 'total' ),
			'priority' => 10
		)
	);

	//STATIC FRONT PAGE
	$wp_customize->add_section( 'static_front_page', array(
	    'title' => __( 'Static Front Page', 'total' ),
	    'panel' => 'total_general_settings_panel',
	    'description' => __( 'Your theme supports a static front page.', 'total'),
	) );

	//TITLE AND TAGLINE SETTINGS
	$wp_customize->add_section( 'title_tagline', array(
	     'title' => __( 'Site Logo/Title/Tagline', 'total' ),
	     'panel' => 'total_general_settings_panel',
	) );

	//BACKGROUND IMAGE
	$wp_customize->add_section( 'background_image', array(
	     'title' => __( 'Background Image', 'total' ),
	     'panel' => 'total_general_settings_panel',
	) );

	//COLOR SETTINGS
	$wp_customize->add_section( 'colors', array(
	     'title' => __( 'Colors' , 'total'),
	     'panel' => 'total_general_settings_panel',
	) );
	}
add_action( 'customize_register', 'total_customize_register' );

?>