<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/cp-customizer.php',                   // Custom customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

/**
 * Load custom theme files
 */
add_action('wp_enqueue_scripts', 'cp_files');
function cp_files() {
	wp_enqueue_style('cp-google-fonts', '//fonts.googleapis.com/css?family=Open+Sans&display=swap');
	wp_enqueue_style('cp-font-awesome', '//use.fontawesome.com/releases/v5.9.0/css/all.css');
}

/**
 * Register theme-related image sizes
 * For post type-related (must-use) image sizes, see function cp_mu_image_sizes
 */
add_action('after_setup_theme', 'cp_theme_image_sizes');
function cp_theme_image_sizes() {
	add_image_size('extra_large', 1920, 9999);
}

/**
 * Validate and send contact form message
 */
if (filter_var($_POST['submitted'], FILTER_SANITIZE_STRING) === '1') { // checks if the form has been submitted and the hidden value was not modified

	// Sanitize user-posted variables	
	$message_name = filter_var($_POST['message_name'], FILTER_SANITIZE_STRING);
	$message_email = filter_var($_POST['message_email'], FILTER_SANITIZE_EMAIL);
	$message_text = filter_var($_POST['message_text'], FILTER_SANITIZE_STRING);
	$message_human = filter_var($_POST['message_human'], FILTER_SANITIZE_STRING);
	$ajax_request = filter_var($_POST['ajax_request'], FILTER_SANITIZE_STRING);
	 
	// PHP mailer variables
	$to = get_option('admin_email');
	$subject = 'New message received from '. get_bloginfo('name');
	$headers = 'From: '. 'noreply@' . $_SERVER['HTTP_HOST'] . "\r\n" . 'Reply-To: ' . $message_email . "\r\n";
	
	// Initialize response variables
	$is_valid = ' ' . 'is-valid';
	$is_invalid = ' ' . 'is-invalid';
	$response_name = $response_email = $response_text = $response_human = $response_submitted = $is_valid;

	if (empty($message_name)) { // validate presence of name
		$response_name = $response_submitted = $is_invalid;
	}
	if (!filter_var($message_email, FILTER_VALIDATE_EMAIL)) { // validate email
		$response_email = $response_submitted = $is_invalid;
	}
	if (empty($message_text)) { // validate presence of message text
		$response_text = $response_submitted = $is_invalid;
	}
	if ($message_human !== '5') { // check if an incorrect human verification was provided
		$response_human = $response_submitted = $is_invalid;
	}
	if ($response_submitted === $is_valid) { // check if form is valid
		$sent = wp_mail($to, $subject, strip_tags($message_text), $headers);
		if ($sent) { // mail was sent
			$message_name = $message_email = $message_text = $message_human = $response_name = $response_email = $response_text = $response_human = ''; // Reset the variables
			if ($ajax_request === '1') wp_send_json_success();
		} else { // mail wasn't sent
			$response_submitted = $is_invalid;
			if ($ajax_request === '1') wp_send_json_error();
		}
	}
}

/**
 * Breadcrumbs for Pages
 */
function cp_breadcrumbs_page() {
	global $post;
	$home_url = get_bloginfo('url'); ?>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">

			<!-- Create the breadcrumb for the homepage -->
			<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<a itemtype="https://schema.org/Thing" itemprop="item" href="<?php echo $home_url ?>">
					<i class="fas fa-home mr-1"></i><span itemprop="name">Home</span>
				</a>
				<meta itemprop="position" content="1" />
			</li>

			<?php
			// Store the parent pages' IDs in an array (if any)
			$parent_id = $post->post_parent;
			$parents = array();
			while ($parent_id) {
				$parents[] = $parent_id;
				$parent_page = get_post($parent_id);
				$parent_id = $parent_page->post_parent;
			}

			$position = 2;

			// Create the breadcrumbs for the parent pages
			if ($parents) {
				$parents = array_reverse($parents);
				foreach ($parents as $parent) { ?>
					<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<a itemtype="https://schema.org/Thing" itemprop="item" href="<?php echo get_permalink($parent); ?>">
							<span itemprop="name"><?php echo get_the_title($parent); ?></span>
						</a>
						<meta itemprop="position" content="<?php echo $position++; ?>" />
					</li>
				<?php }
			} ?>

			<!-- Create the breadcrumb for the current page -->
			<li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<span itemprop="name"><?php the_title(); ?></span>
				<meta itemprop="position" content="<?php echo $position; ?>" />
			</li>

		</ol>
	</nav>
<?php }

/**
 * Customize site info content
 */
add_filter( 'understrap_site_info_content', 'cp_site_info' );
function cp_site_info() {
	
	// Custom website copyright
	$site_info = sprintf(
		esc_html__('&copy; %1$s %2$s', 'understrap'),
		get_bloginfo('name'),
		date('Y')
	);

	// Privacy Policy link
	if (get_privacy_policy_url()) {
		$site_info = $site_info . sprintf(
			'<span class="sep"> | </span>%1$s',
			sprintf(
				esc_html__('%1$s'),
				'<a href="' . esc_url(get_privacy_policy_url()) . '">Privacy Policy</a>'
			)
		);
	}

	// Append attribution text
	$site_info = $site_info . sprintf(
		'<span class="sep"> | </span>%1$s',
		sprintf(
			esc_html__('Website by %1$s'),
			'<a href="' . esc_url('https://www.cyrilpallasigui.com/') . '" target="_blank">Cyril Pallasigui</a>'
		)
	);

	return $site_info;
}