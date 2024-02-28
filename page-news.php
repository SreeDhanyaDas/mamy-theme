<?php
/**
 * Template Name: News
 */
get_header();
?>
  <section class="drawer">
  <?php
      $page_banner_id = get_option('single_page_banner');
      $page_banner_url = wp_get_attachment_image_src($page_banner_id, 'full');
      $page_banner_image = $page_banner_url[0];
    ?>
    <div class="col-md-12 size-img back-img" style='background: url(<?= $page_banner_image ?>) no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;' >
        
    <!-- <div class="col-md-12 size-img back-img"> -->
        <div class="effect-cover">
            <h3 class="txt-advert animated">Ufficio stampa</h3>
            <p class="txt-advert-sub">news e comunicati</p>
        </div>
    </div>
    
    <section id="players" class="container">
        <div class="general general-results players">
           <div class="top-score-title right-score col-md-12">
                <h3>News <span>e</span> comunicati<span class="point-little">.</span></h3>
                <!-- Add filter dropdown for taxonomy -->
                <form class="select-dropdown" method="get" action="">
                    <?php
                    $terms = get_terms(
                        array(
                            'taxonomy' => 'category', // Replace 'your_taxonomy' with the actual taxonomy slug
                            'hide_empty' => false,
                        )
                    );
                    $selected = $_GET['news_category'];
                   
                    ?>
                    <div class="select_option">
                        <select name="news_category" class="dropdown">
                            <option value="">Tutti i campionati</option>
                            <?php foreach ($terms as $term): ?>
                                <option id="<?= $term->slug ?>" value="<?php echo $term->slug; ?>" <?php echo ($selected == $term->slug) ? 'selected' : ''; ?>>
                                    <?php echo $term->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" class="btn btn-default filter-btn" value="Filtra">
                    </div>

                </form>
                <?php
                $no_articles_post = get_page_by_path('no-articles', OBJECT, 'news');
                // Check if the post with the slug 'no-articles' exists
                if ($no_articles_post) {
                    $no_articles_post_id = $no_articles_post->ID;
                    $args = array(
                        'post_type' => 'news',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'order' => 'DESC',
                        'post__not_in' => array($no_articles_post_id),
                    );
                    
                    // Filter by taxonomy if selected
                    if (isset($_GET['news_category']) && $_GET['news_category'] != '') {
                       $args['tax_query'] = array(
                           array(
                               'taxonomy' => 'category', // Replace 'your_taxonomy' with the actual taxonomy slug
                               'field' => 'slug',
                               'terms' => $_GET['news_category'],
                           ),
                       );
                   }
                   $query = new WP_Query($args);
                $i = 0;
                }

                while ($query->have_posts()) 
                {
                    $query->the_post();	
                    $postID = get_the_ID();
                    $post_data = get_post($postID);		
                    $post_date_time = new DateTime($post_data->post_date);
                    $post_date = $post_date_time->format('j F Y');
                    $formatted_date = strftime('%e %B %Y', strtotime($post_date));
                    $formattedDate = mb_convert_case($formatted_date, MB_CASE_TITLE, "UTF-8");
				?>
                  <div class="col-md-12 news-page">
                    <?php if (has_post_thumbnail( get_the_ID() ) ): ?>
						<?php 
                        $news_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'full' ); 
                        $post_categories = get_the_category(get_the_ID());
                        $post_cat_slug = $post_categories[0]->slug;
                        ?>	
                        <a href="<?php echo get_permalink(get_the_ID()); ?>?type=<?= $post_cat_slug?>" target="_self"><img class="img_news" src="<?php echo $news_image[0]; ?>" alt="" /></a> 										  
						<?php endif; ?>
                                     
                    <div class="col-md-10 data-news-pg">
                      <?php $news_date = get_the_date( 'F j, Y' ); ?>
                      <!-- <p class="news-dd"><?php// echo $formattedDate; ?> <?php //the_time( 'H:i' ); ?></p> -->
                      <p class="news-dd"><?php echo $formattedDate; ?></p>
                      <h3><?php the_title();?></h3>
                      <?php echo wp_trim_words( get_the_content(), 50, '...' ); ?>
                      <div class="col-md-12 news-more"><a href="<?php echo get_permalink(get_the_ID()); ?>?type=<?= $post_cat_slug?>" class="ca-more"><i class="fa fa-angle-double-right"></i>CONTINUA...</a></div>
                    </div>
                  </div>
                <?php			
                } 
                wp_reset_query();
                ?>
                <!--<div class="col-md-12 news-page-page">
                  <span class="news-page-active">1</span><span>2</span><span>3</span><span class="page-point">....</span><span>10</span>
                </div>-->
           </div>
        </div>
        </section>
        <section id="sponsor" class="container">
            <!--SECTION SPONSOR-->
           <div class="client-sport client-sport-nomargin">
               <div class="content-banner">
                     <ul class="sponsor second" id="owl-sponsor">
                      <?php 									
							foreach( get_uf_repeater('sponser_image_files','option') as $sponser_images ): extract( $sponser_images ); 
						?>
							<li><a href="#"><img src="<?php echo $image ?>" alt="" /></a></li>
						<?php 										
							endforeach; 
						?>
                    </ul>
                </div>
          </div>
       </section>

<?php 
get_footer();
