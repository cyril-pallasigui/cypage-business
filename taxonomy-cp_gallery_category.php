<?php
/**
 * The template for displaying Gallery Category archive pages.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

// get the current taxonomy term
$gallery_category = get_queried_object();

$container = get_theme_mod( 'understrap_container_type' ); ?>

<div class="wrapper mt-5 flex-grow-1" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php cp_breadcrumbs_gallery_category($gallery_category); ?>

			<h1 class="display-6 display-lg-5 text-center mb-5 mt-4"><?php echo $gallery_category->name; ?></h1>
			<div class="row">
				<?php $gallery_items = new WP_Query(array(
					'post_type' => 'cp_gallery',
					'tax_query' => array(
						array(
							'taxonomy' => 'cp_gallery_category',
							'field' => 'slug',
							'terms' => $gallery_category->slug,
						),
					),
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
										<h2 class="modal-title" id="modal-title-<?php echo get_post_field('post_name'); ?>"><?php the_field('gallery_title'); ?></h2>
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

		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
