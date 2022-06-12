<?php

function manral_customize_register( $wp_customize ) {
	
	/*============HOME PANEL============*/
	$wp_customize->add_panel(
		'sm_home_panel',
		array(
			'title' => __( 'Home Sections', 'manral' ),
			'priority' => 20
		)
	);
	
	/*============ SLIDER SECTION ============*/
	
	$wp_customize->add_section(
		'sm_slider_section',
		array(
			'title' 			=> __( 'Slider Section', 'manral' ),
			'panel'     		=> 'sm_home_panel'
		)
	);

	for($sm=1; $sm<=5; $sm++){

	$wp_customize->add_setting(
		'sm_slider_title'.$sm,
		array(
			'sanitize_callback' => 'manral_sanitize_text',
			'default'			=> __( '', 'manral' )
		)
	);
	
	$wp_customize->add_control(
		'sm_slider_title'.$sm,
		array(
			'settings'		=> 'sm_slider_title'.$sm,
			'section'		=> 'sm_slider_section',
			'type'			=> 'dropdown-pages',
			'label'			=> __( 'Select Page '.$sm, 'manral' ),
		)
	);

	$wp_customize->add_setting(
			'sm_slider_image'.$sm,
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'sm_slider_image'.$sm,
		        array(
		            'section' => 'sm_slider_section',
		            'settings' => 'sm_slider_image'.$sm,
		            'description' => __('Recommended Image Size: 500X600px', 'manral'),
					'label'			=> __( 'Slider Image '.$sm, 'manral' ),

		        )
		    )
		);
	
	} //End loop
		

	
	/*============ WELCOME SECTION ============*/
	
	$wp_customize->add_section(
		'sm_welcome_section',
		array(
			'title' 			=> __( 'Welcome Section', 'manral' ),
			'panel'     		=> 'sm_home_panel'
		)
	);

	
	$wp_customize->add_setting(
		'sm_welcome_title',
		array(
			'sanitize_callback' => 'manral_sanitize_text',
			'default'			=> __( 'Welcome Heading', 'manral' )
		)
	);

	$wp_customize->add_control(
		'sm_welcome_title',
		array(
			'settings'		=> 'sm_welcome_title',
			'section'		=> 'sm_welcome_section',
			'type'			=> 'text',
			'label'			=> __( 'Welcome Heading', 'manral' )
		)
	);

	$wp_customize->add_setting(
		'sm_welcome_content',
		array(
			'sanitize_callback' => 'manral_sanitize_text',
			'default'			=> __( 'Welcome Content Here', 'manral' )
		)
	);

	$wp_customize->add_control(
		'sm_welcome_content',
		array(
			'settings'		=> 'sm_welcome_content',
			'section'		=> 'sm_welcome_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Welcome Content', 'manral' ),
		)
	);
	
	// welcome image and title loop
	for($sm=1; $sm<=3; $sm++){
		
	$wp_customize->add_setting(
		'sm_welcome_image_title'.$sm,
		array(
			'sanitize_callback' => 'manral_sanitize_text',
			'default'			=> __( '', 'manral' )
		)
	);
	
	$wp_customize->add_control(
		'sm_welcome_image_title'.$sm,
		array(
			'settings'		=> 'sm_welcome_image_title'.$sm,
			'section'		=> 'sm_welcome_section',
			'type'			=> 'dropdown-pages',
			'label'			=> __( 'Select Page '.$sm, 'manral' ),
		)
	);
	
    } //end loop
		
	
	/*============== CLIENT SECTION ==============*/
	
	$wp_customize->add_section(
		'sm_client_section',
		array(
			'title' 			=> __( 'Client Section', 'manral' ),
			'panel'				=> 'sm_home_panel'
		)
	);

	$wp_customize->add_setting(
		'sm_client_title',
		array(
			'sanitize_callback' => 'manral_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new manral_Customize_Heading(
			$wp_customize,
			'sm_client_title',
			array(
				'settings'		=> 'sm_client_title',
				'section'		=> 'sm_client_section',
				'label'			=> __( 'Client Title', 'manral' ),
			)
		)
	);

	$wp_customize->add_setting(
		'sm_client_title',
		array(
			'sanitize_callback' => 'manral_sanitize_text',
			'default'			=> __( 'Client Title', 'manral' )
		)
	);

	$wp_customize->add_control(
		'sm_client_title',
		array(
			'settings'		=> 'sm_client_title',
			'section'		=> 'sm_client_section',
			'type'			=> 'text',
			'label'			=> __( 'Client Title', 'manral' )
		)
	);

	$wp_customize->add_setting(
		'sm_client_content1',
		array(
			'sanitize_callback' => 'manral_sanitize_text',
			'default'			=> __( 'Client Content', 'manral' )
		)
	);

	$wp_customize->add_control(
		'sm_client_content1',
		array(
			'settings'		=> 'sm_client_content1',
			'section'		=> 'sm_client_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Client Content', 'manral' ),
		)
	);	 
	//Client Testimonial Loop
	for($sm=1; $sm<=4; $sm++){

	$wp_customize->add_setting(
			'sm_client_image'.$sm,
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'sm_client_image'.$sm,
		        array(
		            'section' => 'sm_client_section',
		            'settings' => 'sm_client_image'.$sm,
		            'description' => __('Recommended Image Size: 500X600px', 'manral'),
					'label'			=> __( 'Client Testimonial Image '.$sm, 'manral' ),

		        )
		    )
		);
	
	
	
	$wp_customize->add_setting(
		'sm_client_testimonial'.$sm,
		array(
			'sanitize_callback' => 'manral_sanitize_text',
			'default'			=> __( 'Client Testimonial Here', 'manral' )
		)
	);

	$wp_customize->add_control(
		'sm_client_testimonial'.$sm,
		array(
			'settings'		=> 'sm_client_testimonial'.$sm,
			'section'		=> 'sm_client_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Client Testimonial '.$sm, 'manral' ),
		)
	);
	} //End loop
		
		/*============== SPONSOR SECTION ==============*/
	
	$wp_customize->add_section(
		'sm_sponsor_section',
		array(
			'title' 			=> __( 'Sponsor Section', 'manral' ),
			'panel'				=> 'sm_home_panel'
		)
	);

	$wp_customize->add_setting(
		'sm_sponsor_title',
		array(
			'sanitize_callback' => 'manral_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new manral_Customize_Heading(
			$wp_customize,
			'sm_sponsor_title',
			array(
				'settings'		=> 'sm_sponsor_title',
				'section'		=> 'sm_sponsor_section',
				'label'			=> __( 'Sponsor Title', 'manral' ),
			)
		)
	);

	$wp_customize->add_setting(
		'sm_sponsor_title',
		array(
			'sanitize_callback' => 'manral_sanitize_text',
			'default'			=> __( 'Sponsor Title', 'manral' )
		)
	);

	$wp_customize->add_control(
		'sm_sponsor_title',
		array(
			'settings'		=> 'sm_sponsor_title',
			'section'		=> 'sm_sponsor_section',
			'type'			=> 'text',
			'label'			=> __( 'Sponsor Title', 'manral' )
		)
	);

	$wp_customize->add_setting(
		'sm_sponsor_content',
		array(
			'sanitize_callback' => 'manral_sanitize_text',
			'default'			=> __( 'Sponsor Content', 'manral' )
		)
	);

	$wp_customize->add_control(
		'sm_client_content',
		array(
			'settings'		=> 'sm_sponsor_content',
			'section'		=> 'sm_sponsor_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sponsor Content', 'manral' ),
		)
	);
	 
	// Sponsor Loop
	for($sm=1; $sm<=5; $sm++){

	$wp_customize->add_setting(
			'sm_sponsor_image'.$sm,
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'sm_sponsor_image'.$sm,
		        array(
		            'section' => 'sm_sponsor_section',
		            'settings' => 'sm_sponsor_image'.$sm,
		            'description' => __('Recommended Image Size: 500X600px', 'manral'),
					'label'			=> __( 'Sponsor Image '.$sm, 'manral' ),

		        )
		    )
		);
	
	} //End loop
		
	

		

}
add_action( 'customize_register', 'manral_customize_register' );


function manral_customizer_script() {
	wp_enqueue_style( 'manral-customizer-style', get_template_directory_uri() .'/inc/css/customizer-style.css');	
}
add_action( 'customize_controls_enqueue_scripts', 'manral_customizer_script' );

if( class_exists( 'WP_Customize_Control' ) ):	




/*------------ start section title -------------*/
class manral_Customize_Heading extends WP_Customize_Control {
	public $type = 'heading';

    public function render_content() {
    	if ( !empty( $this->label ) ) : ?>
            <h3 class="manral-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
        <?php endif;

        if($this->description){ ?>
			<span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
		<?php }
    }
}
/*------------ ///End start section title -------------*/



/*------------ on off section  -------------*/

class manral_Switch_Control extends WP_Customize_Control{
	public $type = 'switch';
	public $on_off_label = array();

	public function __construct($manager, $id, $args = array() ){
        $this->on_off_label = $args['on_off_label'];
        parent::__construct( $manager, $id, $args );
    }

	public function render_content(){
    ?>
	    <span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
		</span>

		<?php if($this->description){ ?>
			<span class="description customize-control-description">
			<?php echo wp_kses_post($this->description); ?>
			</span>
		<?php } ?>

		<?php
			$switch_class = ($this->value() == 'on') ? 'switch-on' : '';
			$on_off_label = $this->on_off_label;
		?>
		<div class="onoffswitch <?php echo $switch_class; ?>">
			<div class="onoffswitch-inner">
				<div class="onoffswitch-active">
					<div class="onoffswitch-switch"><?php echo esc_html($on_off_label['on']) ?></div>
				</div>

				<div class="onoffswitch-inactive">
					<div class="onoffswitch-switch"><?php echo esc_html($on_off_label['off']) ?></div>
				</div>
			</div>	
		</div>
		<input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
		<?php
    }
}
/*------------ ///End on off section  -------------*/



endif;


//SANITIZATION FUNCTIONS
function manral_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function manral_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

function manral_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function manral_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function manral_sanitize_choices_array( $input, $setting ) {
    global $wp_customize;
 	
 	if(!empty($input)){
    	$input = array_map('absint', $input);
    }

    return $input;
} 