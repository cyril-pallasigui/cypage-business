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

			<h1 class="display-6 display-lg-5 text-center my-4"><?php echo $gallery_category->name; ?></h1>

			<!-- Show gallery subcategories only on the first page -->
			<?php if ( ! is_paged() ) {
				$gallery_subcategories = get_terms(array(
					'taxonomy' => 'cp_gallery_category',
					'parent' => $gallery_category->term_id,
					'number' => 0,
					'meta_key' => 'gallery_category_priority',
					'orderby' => 'meta_value_num',
					'order' => 'ASC',
				));
				if ( $gallery_subcategories ) { ?>
					<h2 class="display-lg-6 mb-3">Subcategories</h2>
					<div class="row mb-3">
					<?php foreach ($gallery_subcategories as $gallery_subcategory) {
						$gallery_subcategory_link = get_term_link($gallery_subcategory);
						// If there was an error, continue to the next term
						if (is_wp_error($gallery_subcategory_link)) {
						    continue;
						} ?>
						<div class="col-6 col-md-4 col-xl-3 mb-3 px-2">
							<a href="<?php echo esc_url($gallery_subcategory_link); ?>" class="position-relative d-flex flex-column justify-content-end overflow-hidden">
								<h3 class="position-absolute z-index-1 pointer-events-none w-100 text-center text-white bg-black-translucent py-1"><?php echo $gallery_subcategory->name; ?></h3>
								<?php echo wp_get_attachment_image(get_field('gallery_category_image', $gallery_subcategory), 'gallery_thumbnail', false, array(
									'class' => 'img-fluid w-100 shadow-sm zoom-in-lg'
								)); ?>
							</a>
						</div>
					<?php } ?>
					</div>
				<?php }
			} ?>

			<?php if ( have_posts() ) { ?>
				<h2 class="display-lg-6 mb-3">Gallery Items</h2>
				<div class="row">
					<?php while( have_posts() ) {
						the_post(); ?>
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

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
