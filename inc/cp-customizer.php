<?php
/**
 * Manage Customizer API
 */
add_action( 'customize_register', 'cp_customize_register', 50 );
function cp_customize_register( $wp_customize ) {
	
	// Remove Customizer Objects
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('background_image');
	$wp_customize->remove_panel('nav_menus');
	$wp_customize->remove_panel('widgets');
	$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_section('understrap_theme_layout_options');

	// Add Customizer Objects and Partials
	$wp_customize->selective_refresh->add_partial('custom_logo', array(
    	'selector' => '.navbar-brand.custom-logo-link',
    	'container_inclusive' => true,
    	'render_callback' => 'generate_navbar_brand',
    ));

    $wp_customize->selective_refresh->add_partial('blogname', array(
    	'selector' => '.navbar-brand:not(.custom-logo-link)',
    	'container_inclusive' => true,
    	'render_callback' => 'generate_navbar_brand',
    ));

    $wp_customize->add_section( 'hero_image' , array(
	  'title' => __( 'Hero Image Section', 'understrap' ),
	  'priority' => 170
	) );

	$wp_customize->add_setting('hero_bg_image', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'hero_bg_image', array(
	    'section'     => 'hero_image',
	    'label'       => __( 'Background Image' ),
	    'mime_type'   => 'image',
	) ) );

	$wp_customize->selective_refresh->add_partial('hero_bg_image', array(
    	'selector' => '#hero-background',
    	'container_inclusive' => true,
    	'render_callback' => 'generate_hero_bg_image',
    ));

	$wp_customize->add_setting('hero_heading', array(
		'default' => 'Welcome to our website!',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( 'hero_heading', array(
	  'label' => __( 'Heading' ),
	  'description' => __( 'Maximum 50 characters' ),
	  'type' => 'text',
	  'section' => 'hero_image',
	  'input_attrs' => array(
	    'maxlength' => 50
	  )
	) );

	$wp_customize->selective_refresh->add_partial('hero_heading', array(
    	'selector' => '#hero-heading',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('hero_heading');
        },
    ));

    $wp_customize->add_setting('hero_text', array(
		'default' => 'Check out our products and services',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_textarea_field'
	));

	$wp_customize->add_control( 'hero_text', array(
	  'label' => __( 'Text' ),
	  'description' => __( 'Maximum 200 characters' ),
	  'type' => 'textarea',
	  'section' => 'hero_image',
	  'input_attrs' => array(
	    'maxlength' => 200
	  )
	) );

	$wp_customize->selective_refresh->add_partial('hero_text', array(
    	'selector' => '#hero-text',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('hero_text');
        },
    ));

	$wp_customize->add_setting('hero_button_primary', array(
		'default' => 'Learn more',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( 'hero_button_primary', array(
	  'label' => __( 'Button 1' ),
	  'description' => __( 'Maximum 25 characters. This button redirects to the "About" section.' ),
	  'type' => 'text',
	  'section' => 'hero_image',
	  'input_attrs' => array(
	    'maxlength' => 25
	  )
	) );

	$wp_customize->selective_refresh->add_partial('hero_button_primary', array(
    	'selector' => '#hero-button-primary',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('hero_button_primary');
        },
    ));

	$wp_customize->add_setting('hero_button_secondary', array(
		'default' => 'Contact us',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( 'hero_button_secondary', array(
	  'label' => __( 'Button 2' ),
	  'description' => __( 'Maximum 25 characters. This button redirects to the "Contact" section.' ),
	  'type' => 'text',
	  'section' => 'hero_image',
	  'input_attrs' => array(
	    'maxlength' => 25
	  )
	) );

	$wp_customize->selective_refresh->add_partial('hero_button_secondary', array(
    	'selector' => '#hero-button-secondary',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('hero_button_secondary');
        },
    ));

	$wp_customize->add_section( 'about' , array(
	  'title' => __( 'About Section', 'understrap' ),
	  'priority' => 171
	) );

	$wp_customize->add_setting('about_heading', array(
		'default' => 'About',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( 'about_heading', array(
	  'label' => __( 'Heading' ),
	  'description' => __( 'Maximum 20 characters' ),
	  'type' => 'text',
	  'section' => 'about',
	  'input_attrs' => array(
	    'maxlength' => 20
	  )
	) );

	$wp_customize->selective_refresh->add_partial('about_heading', array(
    	'selector' => '#about-heading',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('about_heading');
        },
    ));

	$wp_customize->add_setting('about_image', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'about_image', array(
	    'section'     => 'about',
	    'label'       => __( 'Image' ),
	    'description' => __( 'Suggested image dimensions: 512 by 384 pixels' ),
	    'flex_width'  => false,
    	'flex_height' => false,
	    'width'       => 512,
	    'height'      => 384,
	) ) );

	$wp_customize->selective_refresh->add_partial('about_image', array(
    	'selector' => '#about-image',
    	'container_inclusive' => false,
    	'render_callback' => 'generate_about_image',
    ));

    $wp_customize->add_setting('about_text', array(
		'default' => 'About us',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_textarea_field'
	));

	$wp_customize->add_control( 'about_text', array(
	  'label' => __( 'Text' ),
	  'type' => 'textarea',
	  'section' => 'about',
	) );

	$wp_customize->selective_refresh->add_partial('about_text', array(
    	'selector' => '#about-text',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('about_text');
        },
    ));

    $wp_customize->add_section( 'testimonials' , array(
	  'title' => __( 'Testimonials Section', 'understrap' ),
	  'description' => __( 'To manage individual testimonials, go to WP Admin > Testimonials' ),
	  'priority' => 172
	) );

    $wp_customize->add_setting('testimonials_enabled', array(
		'default' => 'yes',
		'transport' => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_select'
	));

	$wp_customize->add_control( 'testimonials_enabled', array(
	  'label' => __( 'Show Testimonials section' ),
	  'type' => 'radio',
	  'section' => 'testimonials',
	  'choices' => array(
	    'yes' => 'Yes',
	    'no' => 'No',
	  )
	) );

	$wp_customize->add_setting('testimonials_heading', array(
		'default' => 'Testimonials',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( 'testimonials_heading', array(
	  'label' => __( 'Heading' ),
	  'description' => __( 'Maximum 20 characters' ),
	  'type' => 'text',
	  'section' => 'testimonials',
	  'input_attrs' => array(
	    'maxlength' => 20
	  )
	) );

	$wp_customize->selective_refresh->add_partial('testimonials_heading', array(
    	'selector' => '#testimonials-heading',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('testimonials_heading');
        },
    ));

    $wp_customize->add_section( 'services' , array(
	  'title' => __( 'Services Section', 'understrap' ),
	  'description' => __( 'To manage individual services, go to WP Admin > Services' ),
	  'priority' => 173
	) );

	$wp_customize->add_setting('services_enabled', array(
		'default' => 'yes',
		'transport' => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_select'
	));

	$wp_customize->add_control( 'services_enabled', array(
	  'label' => __( 'Show Services section' ),
	  'type' => 'radio',
	  'section' => 'services',
	  'choices' => array(
	    'yes' => 'Yes',
	    'no' => 'No',
	  )
	) );

	$wp_customize->add_setting('services_heading', array(
		'default' => 'Services',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( 'services_heading', array(
	  'label' => __( 'Heading' ),
	  'description' => __( 'Maximum 20 characters' ),
	  'type' => 'text',
	  'section' => 'services',
	  'input_attrs' => array(
	    'maxlength' => 20
	  )
	) );

	$wp_customize->selective_refresh->add_partial('services_heading', array(
    	'selector' => '#services-heading',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('services_heading');
        },
    ));

    $wp_customize->add_section( 'gallery' , array(
	  'title' => __( 'Gallery Section', 'understrap' ),
	  'description' => __( 'To manage individual gallery items, go to WP Admin > Gallery' ),
	  'priority' => 174
	) );

    $wp_customize->add_setting('gallery_enabled', array(
		'default' => 'yes',
		'transport' => 'refresh',
		'sanitize_callback' => 'theme_slug_sanitize_select'
	));

	$wp_customize->add_control( 'gallery_enabled', array(
	  'label' => __( 'Show Gallery section' ),
	  'type' => 'radio',
	  'section' => 'gallery',
	  'choices' => array(
	    'yes' => 'Yes',
	    'no' => 'No',
	  )
	) );

	$wp_customize->add_setting('gallery_heading', array(
		'default' => 'Gallery',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( 'gallery_heading', array(
	  'label' => __( 'Heading' ),
	  'description' => __( 'Maximum 20 characters' ),
	  'type' => 'text',
	  'section' => 'gallery',
	  'input_attrs' => array(
	    'maxlength' => 20
	  )
	) );

	$wp_customize->selective_refresh->add_partial('gallery_heading', array(
    	'selector' => '#gallery-heading',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('gallery_heading');
        },
    ));

    $wp_customize->add_section( 'contact' , array(
	  'title' => __( 'Contact Section', 'understrap' ),
	  'priority' => 175
	) );

	$wp_customize->add_setting('contact_heading', array(
		'default' => 'Contact',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control( 'contact_heading', array(
	  'label' => __( 'Heading' ),
	  'description' => __( 'Maximum 20 characters' ),
	  'type' => 'text',
	  'section' => 'contact',
	  'input_attrs' => array(
	    'maxlength' => 20
	  )
	) );

	$wp_customize->selective_refresh->add_partial('contact_heading', array(
    	'selector' => '#contact-heading',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('contact_heading');
        },
    ));

    $wp_customize->add_setting('contact_text', array(
		'default' => 'Contact us',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_textarea_field'
	));

	$wp_customize->add_control( 'contact_text', array(
	  'label' => __( 'Text' ),
	  'type' => 'textarea',
	  'section' => 'contact',
	) );

	$wp_customize->selective_refresh->add_partial('contact_text', array(
    	'selector' => '#contact-text',
    	'container_inclusive' => false,
    	'render_callback' => function() {
            echo get_theme_mod('contact_text');
        },
    ));

	$wp_customize->add_setting('address', array(
		'default' => 'Address line 1' . "\r\n" . 'Address line 2' . "\r\n" . 'Address line 3',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_textarea_field'
	));

	$wp_customize->add_control( 'address', array(
		'label' => __( 'Address' ),
		'description' => __( 'Use "Enter" key to add a new line' ),
		'type' => 'textarea',
		'section' => 'contact',
	));

	$wp_customize->selective_refresh->add_partial('address', array(
		'selector' => '#address',
		'container_inclusive' => true,
		'render_callback' => 'generate_address',
	));

	$wp_customize->add_setting('phone', array(
		'default' => 'Phone 1' . "\r\n" . 'Phone 2' . "\r\n" . 'Phone 3',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_textarea_field'
	));

	$wp_customize->add_control( 'phone', array(
		'label' => __( 'Phone' ),
		'description' => __( 'Use "Enter" key to add a new line' ),
		'type' => 'textarea',
		'section' => 'contact',
	));

	$wp_customize->selective_refresh->add_partial('phone', array(
		'selector' => '#phone',
		'container_inclusive' => true,
		'render_callback' => 'generate_phone',
	));

	$wp_customize->add_setting('email', array(
		'default' => 'Email 1' . "\r\n" . 'Email 2' . "\r\n" . 'Email 3',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_textarea_field'
	));

	$wp_customize->add_control( 'email', array(
		'label' => __( 'Email' ),
		'description' => __( 'Use "Enter" key to add a new line' ),
		'type' => 'textarea',
		'section' => 'contact',
	));

	$wp_customize->selective_refresh->add_partial('email', array(
		'selector' => '#email',
		'container_inclusive' => true,
		'render_callback' => 'generate_email',
	));

	$wp_customize->add_section( 'footer' , array(
	  'title' => __( 'Footer', 'understrap' ),
	  'priority' => 176
	) );

	$wp_customize->add_setting('facebook', array(
		'default' => '#',
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control( 'facebook', array(
	  'label' => __( 'Facebook URL' ),
	  'type' => 'url',
	  'section' => 'footer',
	) );

	$wp_customize->selective_refresh->add_partial('facebook', array(
		'selector' => '#facebook',
		'container_inclusive' => true,
		'render_callback' => 'generate_facebook',
	));

	$wp_customize->add_setting('twitter', array(
		'default' => '#',
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control( 'twitter', array(
	  'label' => __( 'Twitter URL' ),
	  'type' => 'url',
	  'section' => 'footer',
	) );

	$wp_customize->selective_refresh->add_partial('twitter', array(
		'selector' => '#twitter',
		'container_inclusive' => true,
		'render_callback' => 'generate_twitter',
	));

	$wp_customize->add_setting('youtube', array(
		'default' => '#',
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control( 'youtube', array(
	  'label' => __( 'YouTube URL' ),
	  'type' => 'url',
	  'section' => 'footer',
	) );

	$wp_customize->selective_refresh->add_partial('youtube', array(
		'selector' => '#youtube',
		'container_inclusive' => true,
		'render_callback' => 'generate_youtube',
	));

	$wp_customize->add_setting('instagram', array(
		'default' => '#',
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control( 'instagram', array(
	  'label' => __( 'Instagram URL' ),
	  'type' => 'url',
	  'section' => 'footer',
	) );

	$wp_customize->selective_refresh->add_partial('instagram', array(
		'selector' => '#instagram',
		'container_inclusive' => true,
		'render_callback' => 'generate_instagram',
	));

	$wp_customize->add_setting('linkedin', array(
		'default' => '#',
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control( 'linkedin', array(
	  'label' => __( 'LinkedIn URL' ),
	  'type' => 'url',
	  'section' => 'footer',
	) );

	$wp_customize->selective_refresh->add_partial('linkedin', array(
		'selector' => '#linkedin',
		'container_inclusive' => true,
		'render_callback' => 'generate_linkedin',
	));
}

/**
 * Sanitization Functions
 */
function theme_slug_sanitize_select( $input, $setting ) {
	// Input must be a slug - only lowercase alphanumeric characters, dashes and underscores are allowed
	$input = sanitize_key($input);

	// Get the list of choices
	$choices = $setting->manager->get_control( $setting->id )->choices;
	                  
	// Return input if valid or return default option
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Partials
 */
function generate_navbar_brand() {
	if ( ! has_custom_logo() ) { ?>

		<?php if ( is_front_page() && is_home() ) : ?>

			<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

		<?php endif; ?>

	<?php } else {
		the_custom_logo();
	}
}

function generate_hero_bg_image() {
	if ( get_theme_mod('hero_bg_image') ) { ?>
	<div class="background-image" id="hero-background" style="background-image: url(<?php echo wp_get_attachment_image_src(get_theme_mod('hero_bg_image'), 'extra_large')[0] ?>);"></div>
	<?php }
}

function generate_about_image() {
	if ( get_theme_mod('about_image') ) {
		echo wp_get_attachment_image(get_theme_mod('about_image'), 'full', false, array(
			'class' => 'img-fluid w-100 mb-3'
		));
	}
}

function generate_address() {
	if ( get_theme_mod('address', true) ) { ?>
	<div id="address">
		<span class="fa-stack fa-lg position-absolute">
			<i class="fas fa-circle fa-stack-2x"></i>
			<i class="fas fa-map-marker-alt fa-stack-1x fa-inverse"></i>
		</span>
		<div class="pl-6 w-100">
			<p class="font-weight-bold mb-0">Address</p>
			<p class="text-break text-prewrap" id="address-text"><?php echo get_theme_mod('address', 'Address line 1' . "\r\n" . 'Address line 2' . "\r\n" . 'Address line 3'); ?></p>
		</div>
	</div>
	<?php }
}

function generate_phone() {
	if ( get_theme_mod('phone', true) ) { ?>
	<div id="phone">
		<span class="fa-stack fa-lg position-absolute">
			<i class="fas fa-circle fa-stack-2x"></i>
			<i class="fas fa-phone-alt fa-stack-1x fa-inverse"></i>
		</span>
		<div class="pl-6 w-100">
			<p class="font-weight-bold mb-0">Phone</p>
			<p class="text-break text-prewrap" id="phone-text"><?php echo get_theme_mod('phone', 'Phone 1' . "\r\n" . 'Phone 2' . "\r\n" . 'Phone 3'); ?></p>
		</div>
	</div>
	<?php }
}

function generate_email() {
	if ( get_theme_mod('email', true) ) { ?>
	<div id="email">
		<span class="fa-stack fa-lg position-absolute">
			<i class="fas fa-circle fa-stack-2x"></i>
			<i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
		</span>
		<div class="pl-6 w-100">
			<p class="font-weight-bold mb-0">Email</p>
			<p class="text-break text-prewrap" id="email-text"><?php echo get_theme_mod('email', 'Email 1' . "\r\n" . 'Email 2' . "\r\n" . 'Email 3'); ?></p>
		</div>
	</div>
	<?php }
}

function generate_facebook() {
	if ( get_theme_mod('facebook', '#') ) { ?>
	<a href="<?php echo get_theme_mod('facebook', '#') ?>" target="_blank" class="text-decoration-none" id="facebook">
		<span class="fa-stack fa-lg zoom-in-sm mx-n1">
			<i class="fas fa-square fa-stack-2x color-facebook"></i>
			<i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
		</span>
	</a>
	<?php }
}

function generate_twitter() {
	if ( get_theme_mod('twitter', '#') ) { ?>
	<a href="<?php echo get_theme_mod('twitter', '#') ?>" target="_blank" class="text-decoration-none" id="twitter">
		<span class="fa-stack fa-lg zoom-in-sm mx-n1">
			<i class="fas fa-square fa-stack-2x color-twitter"></i>
			<i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
		</span>
	</a>
	<?php }
}

function generate_youtube() {
	if ( get_theme_mod('youtube', '#') ) { ?>
	<a href="<?php echo get_theme_mod('youtube', '#') ?>" target="_blank" class="text-decoration-none" id="youtube">
		<span class="fa-stack fa-lg zoom-in-sm mx-n1">
			<i class="fas fa-square fa-stack-2x color-youtube"></i>
			<i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
		</span>
	</a>
	<?php }
}

function generate_instagram() {
	if ( get_theme_mod('instagram', '#') ) { ?>
	<a href="<?php echo get_theme_mod('instagram', '#') ?>" target="_blank" class="text-decoration-none" id="instagram">
		<span class="fa-stack fa-lg zoom-in-sm mx-n1">
			<i class="fas fa-square fa-stack-2x color-instagrammagenta"></i>
			<i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
		</span>
	</a>
	<?php }
}

function generate_linkedin() {
	if ( get_theme_mod('linkedin', '#') ) { ?>
	<a href="<?php echo get_theme_mod('linkedin', '#') ?>" target="_blank" class="text-decoration-none" id="linkedin">
		<span class="fa-stack fa-lg zoom-in-sm mx-n1">
			<i class="fas fa-square fa-stack-2x color-linkedin"></i>
			<i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
		</span>
	</a>
	<?php }
}

/**
 * Setup Preview JS
 */
add_action( 'customize_preview_init', 'cp_customize_preview_js' );
function cp_customize_preview_js() {
	wp_enqueue_script(
		'cp_customize_preview',
		get_template_directory_uri() . '/js/cp-customize-preview.js',
		array( 'customize-preview' ),
		'20190626',
		true
	);
}

/**
 * Setup Controls JS
 */
add_action( 'customize_controls_init', 'cp_customize_controls_js' );
function cp_customize_controls_js() {
	wp_enqueue_script(
		'cp_customize_controls',
		get_template_directory_uri() . '/js/cp-customize-controls.js',
		array( 'customize-preview' ),
		'20190626',
		true
	);
}