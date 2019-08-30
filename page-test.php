<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' ); ?>

<div class="wrapper mt-5 flex-grow-1" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<main class="site-main" id="main">

			<?php cp_breadcrumbs_page(); ?>

			<div class="row">
				<div class="col-md-6 col-xl-4 mb-4">
					<a data-toggle="modal" href="#smartbrain">
						<img width="512" height="384" src="https://www.cyrilpallasigui.com/wp-content/uploads/2019/07/smartbrain-full.jpg" class="img-fluid w-100 shadow-sm zoom-in-lg" alt="" />
					</a>
					<!-- Modal -->
					<div class="modal fade" id="smartbrain" tabindex="-1" role="dialog" aria-labelledby="modal-title-smartbrain" aria-hidden="true">
						<div class="modal-dialog modal-fs" role="document">
							<div class="modal-content">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<img src="http://barberculture.ca/wp-content/uploads/2018/09/Barber-Culture-Staff_0002_james.jpg" alt="" />
							</div>
						</div>
					</div><!-- .modal -->
				</div>
			</div>

			<div class="carousel slide" id="image-carousel" data-ride="carousel" data-interval="false">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<div class="h-450px h-md-300px d-flex flex-column justify-content-center align-items-center w-lg-75 mx-auto">
							<img src="https://earthinfusionsph.com/wp-content/uploads/2019/08/Zenda-cropped-150x150.jpg" class="object-fit-contain mb-2">
						</div>
					</div>
					<div class="carousel-item">
						<div class="h-450px h-md-300px d-flex flex-column justify-content-center align-items-center w-lg-75 mx-auto">
							<img src="https://www.cyrilpallasigui.com/wp-content/uploads/2019/07/robofriends-full.jpg" class="object-fit-contain mb-2">
						</div>
					</div>
					<div class="carousel-item">
						<div class="h-450px h-md-300px d-flex flex-column justify-content-center align-items-center w-lg-75 mx-auto">
							<img src="https://www.cyrilpallasigui.com/portfolio/couch-fix-salon/wp-content/uploads/2019/07/barber-barbershop-blurred-background-2040189-l.jpg" class="object-fit-contain mb-2">
						</div>
					</div>
				</div>
				<ol class="carousel-indicators carousel-indicators-thumbnail position-relative mb-0">
					<li data-target="#image-carousel" data-slide-to="0" class="active">
						<img src="https://earthinfusionsph.com/wp-content/uploads/2019/08/Zenda-cropped-150x150.jpg" class="object-fit-cover">
					</li>
					<li data-target="#image-carousel" data-slide-to="1">
						<img src="https://www.cyrilpallasigui.com/wp-content/uploads/2019/07/robofriends-full.jpg" class="object-fit-cover">
					</li>
					<li data-target="#image-carousel" data-slide-to="2">
						<img src="https://www.cyrilpallasigui.com/portfolio/couch-fix-salon/wp-content/uploads/2019/07/barber-barbershop-blurred-background-2040189-l.jpg" class="object-fit-cover">
					</li>
				</ol>
			</div><!-- #image-carousel -->

		</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
