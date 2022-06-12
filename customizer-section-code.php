<?php

function total_customize_register( $wp_customize ) {
	
	//ENABLE/DISABLE STICKY HEADER
	$wp_customize->add_setting(
		'total_sticky_header_enable',
		array(
			'sanitize_callback' => 'total_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new Total_Switch_Control(
			$wp_customize,
			'total_sticky_header_enable',
			array(
				'settings'		=> 'total_sticky_header_enable',
				'section'		=> 'total_header_settings',
				'label'			=> __( 'Sticky Header', 'total' ),
				'on_off_label' 	=> array(
					'on' => __( 'Enable', 'total' ),
					'off' => __( 'Disable', 'total' )
					)	
			)
		)
	);

	/*============HOME PANEL============*/
	$wp_customize->add_panel(
		'total_home_panel',
		array(
			'title' => __( 'Home Sections', 'total' ),
			'priority' => 20
		)
	);




	/*============ABOUT US SECTION============*/
	$wp_customize->add_section(
		'total_about_section',
		array(
			'title' 			=> __( 'About Us Section', 'total' ),
			'panel'     		=> 'total_home_panel'
		)
	);

	//ENABLE/DISABLE ABOUT US PAGE
	$wp_customize->add_setting(
		'total_about_page_disable',
		array(
			'sanitize_callback' => 'total_sanitize_text',
			'default' => 'off'
		)
	);

	$wp_customize->add_control(
		new Total_Switch_Control(
			$wp_customize,
			'total_about_page_disable',
			array(
				'settings'		=> 'total_about_page_disable',
				'section'		=> 'total_about_section',
				'label'			=> __( 'Disable Section', 'total' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'total' ),
					'off' => __( 'No', 'total' )
					)	
			)
		)
	);


	

		$wp_customize->add_setting(
			'total_about_image',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'total_about_image',
		        array(
		            'section' => 'total_about_section',
		            'settings' => 'total_about_image',
		            'description' => __('Recommended Image Size: 500X600px', 'total')
		        )
		    )
		);


		


	/*============FEATURED SECTION PANEL============*/
	$wp_customize->add_section(
		'total_featured_section',
		array(
			'title' 			=> __( 'Featured Section', 'total' ),
			'panel'				=> 'total_home_panel'
		)
	);

	//ENABLE/DISABLE FEATURED SECTION
	$wp_customize->add_setting(
		'total_featured_section_disable',
		array(
			'sanitize_callback' => 'total_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Total_Switch_Control(
			$wp_customize,
			'total_featured_section_disable',
			array(
				'settings'		=> 'total_featured_section_disable',
				'section'		=> 'total_featured_section',
				'label'			=> __( 'Disable Section', 'total' ),
				'on_off_label' 	=> array(
					'on' => __( 'Yes', 'total' ),
					'off' => __( 'No', 'total' )
					),
			)
		)
	);

	$wp_customize->add_setting(
		'total_featured_title_sub_title_heading',
		array(
			'sanitize_callback' => 'total_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new Total_Customize_Heading(
			$wp_customize,
			'total_featured_title_sub_title_heading',
			array(
				'settings'		=> 'total_featured_title_sub_title_heading',
				'section'		=> 'total_featured_section',
				'label'			=> __( 'Section Title & Sub Title', 'total' ),
			)
		)
	);

	$wp_customize->add_setting(
		'total_featured_title',
		array(
			'sanitize_callback' => 'total_sanitize_text',
			'default'			=> __( 'Featured Section', 'total' )
		)
	);

	$wp_customize->add_control(
		'total_featured_title',
		array(
			'settings'		=> 'total_featured_title',
			'section'		=> 'total_featured_section',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'total' )
		)
	);

	$wp_customize->add_setting(
		'total_featured_sub_title',
		array(
			'sanitize_callback' => 'total_sanitize_text',
			'default'			=> __( 'Featured Section SubTitle', 'total' )
		)
	);

	$wp_customize->add_control(
		'total_featured_sub_title',
		array(
			'settings'		=> 'total_featured_sub_title',
			'section'		=> 'total_featured_section',
			'type'			=> 'textarea',
			'label'			=> __( 'Sub Title', 'total' ),
		)
	);
	
	
		$wp_customize->add_setting(
			'total_feature_image',
			array(
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'total_feature_image',
		        array(
		            'section' => 'total_featured_section',
		            'settings' => 'total_feature_image',
		            'description' => __('Recommended Image Size: 500X600px', 'total')
		        )
		    )
		);


		

}
add_action( 'customize_register', 'total_customize_register' );


function total_customizer_script() {
	wp_enqueue_style( 'total-customizer-style', get_template_directory_uri() .'/inc/css/customizer-style.css');	
}
add_action( 'customize_controls_enqueue_scripts', 'total_customizer_script' );

if( class_exists( 'WP_Customize_Control' ) ):	




/*------------ start section title -------------*/
class Total_Customize_Heading extends WP_Customize_Control {
	public $type = 'heading';

    public function render_content() {
    	if ( !empty( $this->label ) ) : ?>
            <h3 class="total-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
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

class Total_Switch_Control extends WP_Customize_Control{
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
function total_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function total_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

function total_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function total_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function total_sanitize_choices_array( $input, $setting ) {
    global $wp_customize;
 	
 	if(!empty($input)){
    	$input = array_map('absint', $input);
    }

    return $input;
} 