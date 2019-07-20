<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper bg-secondary" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="mb-3" id="social-links">
						<?php if ( get_theme_mod('facebook', '#') ) { ?>
						<a href="<?php echo get_theme_mod('facebook', '#') ?>" target="_blank" class="text-decoration-none" id="facebook">
							<span class="fa-stack fa-lg zoom-in-sm mx-n1">
								<i class="fas fa-square fa-stack-2x color-facebook"></i>
								<i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<?php } ?>
						<?php if ( get_theme_mod('twitter', '#') ) { ?>
						<a href="<?php echo get_theme_mod('twitter', '#') ?>" target="_blank" class="text-decoration-none" id="twitter">
							<span class="fa-stack fa-lg zoom-in-sm mx-n1">
								<i class="fas fa-square fa-stack-2x color-twitter"></i>
								<i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<?php } ?>
						<?php if ( get_theme_mod('youtube', '#') ) { ?>
						<a href="<?php echo get_theme_mod('youtube', '#') ?>" target="_blank" class="text-decoration-none" id="youtube">
							<span class="fa-stack fa-lg zoom-in-sm mx-n1">
								<i class="fas fa-square fa-stack-2x color-youtube"></i>
								<i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<?php } ?>
						<?php if ( get_theme_mod('instagram', '#') ) { ?>
						<a href="<?php echo get_theme_mod('instagram', '#') ?>" target="_blank" class="text-decoration-none" id="instagram">
							<span class="fa-stack fa-lg zoom-in-sm mx-n1">
								<i class="fas fa-square fa-stack-2x color-instagrammagenta"></i>
								<i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<?php } ?>
						<?php if ( get_theme_mod('linkedin', '#') ) { ?>
						<a href="<?php echo get_theme_mod('linkedin', '#') ?>" target="_blank" class="text-decoration-none" id="linkedin">
							<span class="fa-stack fa-lg zoom-in-sm mx-n1">
								<i class="fas fa-square fa-stack-2x color-linkedin"></i>
								<i class="fab fa-linkedin-in fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<?php } ?>
					</div><!-- #social-links -->

					<div class="site-info">

						<?php understrap_site_info(); ?>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

