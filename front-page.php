<?php
/**
 * The front page template file.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="wrapper position-relative d-flex flex-column justify-content-center align-items-center vh-100 min-h-500px" id="hero-wrapper">
	<?php if ( get_theme_mod('hero_bg_image') ) { ?>
	<div class="background-image parallax-background" id="hero-background" style="background-image: url(<?php echo wp_get_attachment_image_src(get_theme_mod('hero_bg_image'), 'extra_large')[0] ?>);"></div>
	<?php } ?>
	<div class="container position-relative py-3 w-md-75 w-xl-50 text-center" id="hero-body">
		<div class="background-overlay"></div>
		<h2 class="display-6 display-lg-5 text-white" id="hero-heading"><?php echo get_theme_mod('hero_heading', 'Welcome to our website!'); ?></h2>
		<p class="text-white" id="hero-text"><?php echo get_theme_mod('hero_text', 'Check out our products and services'); ?></p>
		<a class="btn btn-primary btn-lg d-block mx-auto w-100 max-w-360px mb-2" id="hero-button-primary" href="#about"><?php echo get_theme_mod('hero_button_primary', 'Learn more'); ?></a>
		<a class="btn btn-secondary btn-lg d-block mx-auto w-100 max-w-360px" id="hero-button-secondary" href="#contact"><?php echo get_theme_mod('hero_button_secondary', 'Contact us'); ?></a>
	</div>
</div><!-- #hero-wrapper -->

<div class="zebra-striped bg-white">
	<div class="wrapper" id="about-wrapper">
		<a class="target-offset" id="about"></a>
		<div class="container">
			<div class="row flex-row">
				<div class="col-md-6 col-lg-7">
					<h2 class="display-6 display-lg-5 mb-3" id="about-heading"><?php echo get_theme_mod('about_heading', 'About'); ?></h2>
					<p id="about-text" class="text-prewrap"><?php echo get_theme_mod('about_text', 'About us'); ?></p>
				</div>
				<div class="col-md-6 col-lg-5" id="about-image">
				<?php if ( get_theme_mod('about_image') ) {
					echo wp_get_attachment_image(get_theme_mod('about_image'), 'full', false, array(
						'class' => 'img-fluid w-100'
					));
				} ?>
				</div>
			</div>
		</div>
	</div><!-- #about-wrapper -->

	<?php if (get_theme_mod('testimonials_enabled', 'yes') === 'yes') { ?>
	<div class="wrapper" id="testimonials-wrapper">
		<a class="target-offset" id="testimonials"></a>
		<div class="container">
			<h2 class="display-6 display-lg-5 text-center mb-3" id="testimonials-heading"><?php echo get_theme_mod('testimonials_heading', 'Testimonials'); ?></h2>
			<div class="carousel slide" id="testimonials-carousel" data-ride="carousel">
				<div class="carousel-inner">
					<?php $testimonials = new WP_Query(array(
						'post_type' => 'cp_testimonial',
						'posts_per_page' => 10,
						'meta_key' => 'testimonial_priority',
						'orderby' => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
					));
					$slide = 0;
					while($testimonials->have_posts()) {
						$testimonials->the_post(); ?>
						<div class="carousel-item<?php if ($slide === 0) echo ' active'; ?>">
							<div class="h-450px h-md-300px d-flex flex-column justify-content-center align-items-center w-lg-75 mx-auto">
								<?php echo wp_get_attachment_image(get_field('testimonial_photo'), 'testimonial_photo', false, array(
									'class' => 'rounded-circle mb-2'
								)); ?>
								<blockquote class="blockquote text-center blockquote-normalized">
									<p class="wrap-quotes mb-0"><?php the_field('testimonial_text'); ?></p>
									<footer class="blockquote-footer"><?php the_field('testimonial_author'); ?></footer>
								</blockquote>
							</div>
						</div>
					<?php $slide++;
					} wp_reset_postdata(); ?>
				</div>
				<ol class="carousel-indicators position-relative mb-0">
					<?php $slide = 0;
					while($testimonials->have_posts()) {
						$testimonials->the_post(); ?>
						<li data-target="#testimonials-carousel" data-slide-to="<?php echo $slide ?>"<?php if ($slide === 0) echo ' class="active"'; ?>></li>
					<?php $slide++;
					} wp_reset_postdata(); ?>
				</ol>
			</div><!-- #testimonials-carousel -->
		</div>
	</div><!-- #testimonials-wrapper -->
	<?php } ?>

	<?php if (get_theme_mod('recognitions_enabled', 'yes') === 'yes') { ?>
	<div class="wrapper" id="recognitions-wrapper">
		<a class="target-offset" id="recognitions"></a>
		<div class="container">
			<h2 class="display-6 display-lg-5 text-center mb-5" id="recognitions-heading"><?php echo get_theme_mod('recognitions_heading', 'Recognitions'); ?></h2>
			<div class="row text-center">
				<?php $recognitions = new WP_Query(array(
					'post_type' => 'cp_recognition',
					'posts_per_page' => 12,
					'meta_key' => 'recognition_priority',
					'orderby' => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
				));
				while($recognitions->have_posts()) {
					$recognitions->the_post(); ?>
					<div class="col-md-6 col-lg-4 d-flex flex-column justify-content-center align-items-center mb-4">
						<?php if ( get_field('recognition_image') ) {
							if ( get_field('recognition_link') ) { ?>
								<a class="mb-3" href="<?php the_field('recognition_link'); ?>" target="_blank">
									<?php echo wp_get_attachment_image(get_field('recognition_image'), 'recognition_image'); ?>
								</a>
							<?php } else {
								echo wp_get_attachment_image(get_field('recognition_image'), 'recognition_image', false, array(
									'class' => 'mb-3'
								));
							}
						} ?>
						<p><?php the_field('recognition_text'); ?></p>
					</div>
				<?php } wp_reset_postdata(); ?>
			</div>
		</div>
	</div><!-- #recognitions-wrapper -->
	<?php } ?>

	<?php if (get_theme_mod('services_enabled', 'yes') === 'yes') { ?>
	<div class="wrapper" id="services-wrapper">
		<a class="target-offset" id="services"></a>
		<div class="container">
			<h2 class="display-6 display-lg-5 text-center mb-5" id="services-heading"><?php echo get_theme_mod('services_heading', 'Services'); ?></h2>
			<div class="row">
				<?php $services = new WP_Query(array(
					'post_type' => 'cp_service',
					'posts_per_page' => 12,
					'meta_key' => 'service_priority',
					'orderby' => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
				));
				while($services->have_posts()) {
					$services->the_post(); ?>
					<div class="col-md-6 col-xl-4 mb-4">
						<div class="card h-100">
							<?php if ( get_field('service_image') ) {
								echo wp_get_attachment_image(get_field('service_image'), 'service_image', false, array(
									'class' => 'card-img-top'
								));
							} ?>
							<div class="card-body">
								<h3 class="card-title">
									<?php if (get_field('service_icon')) { ?>
										<i class="<?php the_field('service_icon'); ?> fa-fw"></i>&nbsp;
									<?php }
									the_field('service_title'); ?>
								</h3>
								<p class="card-text text-prewrap"><?php the_field('service_text'); ?></p>
								<?php if (get_field('service_link_enabled')) { ?>
									<a
										href="<?php the_field('service_link_page'); ?>"
										class="btn btn-primary">
										<?php the_field('service_link_text'); ?>
									</a>
								<?php } ?>
								<?php if (get_field('service_cta_enabled')) { ?>
									<a
										href="<?php switch (get_field('service_cta_target')) {
											case 'contact_details': echo '#contact'; break;
											case 'contact_form': echo '#contact-form'; break;
											default: echo '#'; break;
										} ?>"
										class="btn btn-secondary"
										id="cta-<?php echo get_post_field('post_name'); ?>"
										data-cta-message="<?php the_field('service_cta_message'); ?>">
										<?php the_field('service_cta_text'); ?>
									</a>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } wp_reset_postdata(); ?>
			</div>
		</div>
	</div><!-- #services-wrapper -->
	<?php } ?>

	<?php if ( get_theme_mod('gallery_enabled', 'yes') === 'yes' ) { ?>
	<div class="wrapper" id="gallery-wrapper">
		<a class="target-offset" id="gallery"></a>
		<div class="container">
			<h2 class="display-6 display-lg-5 text-center mb-5" id="gallery-heading"><?php echo get_theme_mod('gallery_heading', 'Gallery'); ?></h2>
			
			<!-- Homepage displays Gallery as Gallery Items -->
			<?php if ( get_theme_mod('gallery_displays', 'gallery_items') === 'gallery_items' ) { ?>
			<div class="row">
				<?php $gallery_items = new WP_Query(array(
					'post_type' => 'cp_gallery',
					'posts_per_page' => 12,
					'meta_key' => 'gallery_priority',
					'orderby' => array( 'meta_value_num' => 'ASC', 'date' => 'DESC' ),
				));
				while($gallery_items->have_posts()) {
					$gallery_items->the_post(); ?>
					<div class="col-md-6 col-xl-4 mb-4">
						<a data-toggle="modal" href="#<?php echo get_post_field('post_name'); ?>">
							<?php echo wp_get_attachment_image(get_field('gallery_image'), 'gallery_thumbnail', false, array(
								'class' => 'img-fluid w-100 shadow-sm zoom-in-lg'
							)); ?>
						</a>
						<!-- Modal -->
						<div class="modal fade" id="<?php echo get_post_field('post_name'); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-title-<?php echo get_post_field('post_name'); ?>" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title" id="modal-title-<?php echo get_post_field('post_name'); ?>"><?php the_field('gallery_title'); ?></h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<a href="<?php echo wp_get_attachment_url(get_field('gallery_image')); ?>" target="_blank">
										<?php echo wp_get_attachment_image(get_field('gallery_image'), 'gallery_full', false, array(
											'class' => 'img-fluid w-100'
										)); ?>
									</a>
									<?php if (get_field('gallery_text')) { ?>
									<div class="modal-body">
										<p class="expandable-text-block text-prewrap mb-0 collapsed"><span class="preview-text"><?php the_field('gallery_text'); ?></span></p>
									</div>
									<?php } ?>
									<div class="modal-footer">
										<?php if (get_field('gallery_link')) { ?>
										<a class="btn btn-primary" href="<?php the_field('gallery_link'); ?>" target="_blank"><i class="fas fa-external-link-alt"></i> Link</a>
										<?php } ?>
										<a class="btn btn-primary" href="<?php echo wp_get_attachment_url(get_field('gallery_image')); ?>" target="_blank"><i class="far fa-image"></i> Image</a>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div><!-- .modal -->
					</div>
				<?php } wp_reset_postdata(); ?>
			</div>
			<?php } ?>

			<!-- Homepage displays Gallery as Gallery Gategories -->
			<?php if ( get_theme_mod('gallery_displays', 'gallery_items') === 'gallery_categories' ) { ?>
			<div class="row">
			<?php $gallery_categories = get_terms(array(
				'taxonomy' => 'cp_gallery_category',
				'number' => 12,
				'meta_key' => 'gallery_category_priority',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
			));
			foreach ($gallery_categories as $gallery_category) {
				$gallery_category_link = get_term_link($gallery_category);
				// If there was an error, continue to the next term
				if (is_wp_error($gallery_category_link)) {
				    continue;
				} ?>
				<div class="col-md-6 col-xl-4 mb-4">
					<a href="<?php echo esc_url($gallery_category_link); ?>" class="position-relative d-flex flex-column justify-content-end overflow-hidden">
						<h3 class="position-absolute z-index-1 pointer-events-none w-100 text-center text-white bg-black-translucent py-1"><?php echo $gallery_category->name; ?></h3>
						<?php echo wp_get_attachment_image(get_field('gallery_category_image', $gallery_category), 'gallery_thumbnail', false, array(
							'class' => 'img-fluid w-100 shadow-sm zoom-in-lg'
						)); ?>
					</a>
				</div>
			<?php } ?>
			</div>
			<?php } ?>

		</div>
	</div><!-- #gallery-wrapper -->
	<?php } ?>

	<div class="wrapper" id="contact-wrapper">
		<a class="target-offset" id="contact"></a>
		<div class="container">
			<div class="row flex-row-reverse">
				<div class="col-md-6 col-lg-7">
					<h2 class="display-6 display-lg-5 mb-3" id="contact-heading"><?php echo get_theme_mod('contact_heading', 'Contact'); ?></h2>
					<p class="text-prewrap mb-3" id="contact-text"><?php echo get_theme_mod('contact_text', 'Contact us'); ?></p>
					<div class="mb-4" id="contact-details">
						<?php if ( get_theme_mod('address', true) ) { ?>
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
						<?php } ?>
						<?php if ( get_theme_mod('phone', true) ) { ?>
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
						<?php } ?>
						<?php if ( get_theme_mod('email', true) ) { ?>
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
						<?php } ?>
					</div>

					<?php if ( get_theme_mod('facebook') || get_theme_mod('twitter') || get_theme_mod('youtube') || get_theme_mod('instagram') || get_theme_mod('linkedin') ) { ?>
					<h3 id="social-heading"><?php echo get_theme_mod('social_heading', 'Social Accounts'); ?></h3>
					<div class="mb-4" id="social-links">
						<?php if ( get_theme_mod('facebook') ) { ?>
						<a href="<?php echo get_theme_mod('facebook') ?>" target="_blank" class="text-decoration-none" id="facebook">
							<span class="fa-stack fa-lg zoom-in-sm mx-n1">
								<i class="fas fa-square fa-stack-2x color-facebook"></i>
								<i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<?php } ?>
						<?php if ( get_theme_mod('twitter') ) { ?>
						<a href="<?php echo get_theme_mod('twitter') ?>" target="_blank" class="text-decoration-none" id="twitter">
							<span class="fa-stack fa-lg zoom-in-sm mx-n1">
								<i class="fas fa-square fa-stack-2x color-twitter"></i>
								<i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<?php } ?>
						<?php if ( get_theme_mod('youtube') ) { ?>
						<a href="<?php echo get_theme_mod('youtube') ?>" target="_blank" class="text-decoration-none" id="youtube">
							<span class="fa-stack fa-lg zoom-in-sm mx-n1">
								<i class="fas fa-square fa-stack-2x color-youtube"></i>
								<i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<?php } ?>
						<?php if ( get_theme_mod('instagram') ) { ?>
						<a href="<?php echo get_theme_mod('instagram') ?>" target="_blank" class="text-decoration-none" id="instagram">
							<span class="fa-stack fa-lg zoom-in-sm mx-n1">
								<i class="fas fa-square fa-stack-2x color-instagrammagenta"></i>
								<i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<?php } ?>
						<?php if ( get_theme_mod('linkedin') ) { ?>
						<a href="<?php echo get_theme_mod('linkedin') ?>" target="_blank" class="text-decoration-none" id="linkedin">
							<span class="fa-stack fa-lg zoom-in-sm mx-n1">
								<i class="fas fa-square fa-stack-2x color-linkedin"></i>
								<i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<?php } ?>
					</div><!-- #social-links -->
					<?php } ?>

				</div>
				<div class="col-md-6 col-lg-5">
					<a class="target-offset" id="contact-form"></a>
					<div class="card bg-gray-200 shadow-sm">
						<div class="card-body">
							<form class="needs-validation" method="post" action="#contact-form" novalidate>
								<div class="form-group">
									<label for="message_name" class="required">Name</label>
									<input type="text" class="form-control<?php echo $response_name; ?>" name="message_name" id="message_name" value="<?php echo esc_attr($message_name); ?>" required>
									<div class="invalid-feedback">Please supply all information.</div>
								</div>
								<div class="form-group">
									<label for="message_email" class="required">Email</label>
									<input type="email" class="form-control<?php echo $response_email; ?>" name="message_email" id="message_email" value="<?php echo esc_attr($message_email); ?>" required>
									<div class="invalid-feedback">Email address is invalid.</div>
								</div>
								<div class="form-group">
									<label for="message_text" class="required">Message</label>
									<textarea class="form-control<?php echo $response_text; ?>" name="message_text" id="message_text" rows="5" required><?php echo esc_textarea($message_text); ?></textarea>
									<div class="invalid-feedback">Please supply all information.</div>
								</div>
								<div class="form-group">
									<label for="message_human" class="required">Human Verification</label><br>
									<span>2 + 3 = </span><input type="text" class="form-control d-inline<?php echo $response_human; ?>" style="width: 80px;" name="message_human" id="message_human" value="<?php echo esc_attr($message_human); ?>" required>
									<div class="invalid-feedback">Human verification is incorrect.</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary w-100 rounded-pill d-block mx-auto">Send message</button>
									<input type="text" class="form-control d-none<?php echo $response_submitted; ?>" name="submitted" id="submitted" value="1" autocomplete="off">
									<div class="invalid-feedback">Message was not sent. Please try again.</div>
									<div class="valid-feedback">Thanks! Your message has been sent.</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- #contact-wrapper -->
</div><!-- .zebra-striped -->

<?php get_footer(); ?>