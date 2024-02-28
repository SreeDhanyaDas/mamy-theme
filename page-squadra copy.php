<?php
/**
 * Template Name: Squadra
 */
get_header();
?>
  <section class="drawer">
    <div class="col-md-12 size-img back-img">
        <div class="effect-cover">
            <h3 class="txt-advert animated">Serie C</h3>
            <p class="txt-advert-sub">Squadra</p>
        </div>
    </div>
    
    <section id="players" class="container secondary-page">
      <div class="general general-results players">
              
           <div class="top-score-title right-score col-md-9">
               
                
                <div class="content-wtp-player">
                    <h3>Squadra<span class="point-little">.</span></h3> 
					<?php 
					  $query = new WP_Query(array(
						'post_type' => 'sp_player',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'order' => 'ASC',
						'orderby' => 'title',
						'tax_query' => array(
										array(
											'taxonomy' => 'sp_league',
											'field'    => 'slug',
											'terms' => 'serie-c'
										)
									)
					  ));
					  $i = 0;
					  while ($query->have_posts()) 
					  {
						$query->the_post();			
					?>
						<div class="col-md-3 atp-player">
						  <a href="<?php echo get_permalink(get_the_ID()); ?>">
							<?php if ( has_post_thumbnail() ) : ?>								
								<?php $news_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>
								<img class="" src="<?php echo $news_image[0]; ?>" alt=""/>
							<?php else : ?>
								<img src="<?php echo get_template_directory_uri();?>/images/player/face.jpg" alt="" />
							<?php endif; ?>							
						   <p><?php the_title();?></p></a>
						</div>
                    <?php			
					 } 
					 wp_reset_query();
					?>
				</div>
			</div><!--Close Top Match-->
			<div class="col-md-3 right-column">                   
			</div>
	</section>
        

<?php 
get_footer();
