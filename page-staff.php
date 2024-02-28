<?php
/**
 * Template Name: Staff
 */
get_header();
?>
<section class="drawer">
	<?php
	$page_banner_id = get_option('single_page_banner');
	$page_banner_url = wp_get_attachment_image_src($page_banner_id, 'full');
	$page_banner_image = $page_banner_url[0];
	?>
	<div class="col-md-12 size-img back-img"
		style='background: url(<?= $page_banner_image ?>) no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'>

		<!-- <div class="col-md-12 size-img back-img"> -->
		<div class="effect-cover">
			<h3 class="txt-advert animated">Staff</h3>
			<!-- <h3 class="txt-advert animated">Serie C</h3> -->
			<!-- <p class="txt-advert-sub">Staff</p> -->
		</div>
	</div>

	<section id="players" class="secondary-page">
		<div class="general general-results players">

			<div class="top-score-title right-score row">
				<!-- <h3>Staff<span class="point-little">.</span></h3> -->
				<?php
				$query = new WP_Query(
					array(
						'post_type' => 'sp_staff',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'order' => 'ASC',
						'orderby' => 'title',
						// 'tax_query' => array(
						// 	array(
						// 		'taxonomy' => 'sp_league',
						// 		'field' => 'slug',
						// 		'terms' => 'serie-c'
						// 	)
						// )
					)
				);
				$i = 0;
				while ($query->have_posts()) {
					$query->the_post();
					if (has_post_thumbnail()) {
						$news_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
						$staff_image = $news_image[0];
					} else {
						$staff_image = get_template_directory_uri() . '/images/player/face.jpg';
					}
					$post_slug = get_post_field('post_name', get_the_ID());
					?>

					<div class="wrapper column">
						<div class="card">
							<a href="<?php echo site_url(); ?>/staff-details?view=<?= $post_slug ?>">
								<div class="card__thumbnail">
									<img class="player_image" src="<?= $staff_image ?>">
									<div class="card__title col-md-12">
										<div class="player_name col-md-6">
											<span class="player_name">
												<?= the_title() ?>
											</span>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<?php
				}
				wp_reset_query();
				?>
			</div><!--Close Top Match-->
			<div class="col-md-3 right-column">
			</div>
	</section>


	<?php
	get_footer();
