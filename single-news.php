<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

/* Start the Loop */
while(have_posts()):
    the_post();
    $newsID = get_the_ID();
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
            <!-- <div class="col-md-12 size-img back-img-shop"> -->
            <!-- <div class="effect-cover">
                <h3 class="txt-advert animated">The best news ATP WTP</h3>
                <p class="txt-advert-sub">News - Match - Player</p>
            </div> -->
            <div class="effect-cover">
                <h3 class="txt-advert animated">
                    <?= get_the_title() ?>
                </h3>
                <p class="txt-advert-sub">
                    <?= $post_cat_name ?>
                </p>
            </div>
        </div>
        <?php
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $urlComponents = parse_url($actual_link);
        if(isset($urlComponents['query'])) {
            $urlComponents = parse_url($actual_link);
            parse_str($urlComponents['query'], $queryParameters);

            if(isset($queryParameters['type'])) {
                $cat_slug = $_GET['type'];

                ?>

                <section id="single_news" class="container secondary-page">
                    <div class="general general-results">
                        <div class="top-score-title col-md-9">
                            <!-- <h3>
                        <?php the_title(); ?><span class="point-little">.</span>
                    </h3> -->
                            <?php $main_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full'); ?>
                            <div class="main-news" id="main-news" style="font-size: 20px; line-height: 30px;">
                                <div class="main-news-left" id="main-news-left">
                                    <img src="<?php echo $main_image[0]; ?>" class="single-news-mainimg"
                                        alt="<?= get_the_title() ?>" />
                                </div>

                                <?php the_content(); ?>
                            </div>

                            <!-- <p class="desc_news important_news data">by ATP Staff <i class="fa fa-calendar"></i>May 7, 2014 -
                        London, England</p>

                    <div class="tab_news"><i class="fa fa-tag"></i><span>TAGS:</span><a href="index.html"
                            class="tag">SPORT</a><a href="news.html" class="tag">TENNIS</a><a href="players.html"
                            class="tag">PLAYERS</a></div> -->

                            <div class="other-news">
                                <h3>Altre <span>notizie</span><span class="point-little">.</span></h3>
                                <?php
                                $no_articles_post = get_page_by_path('no-articles', OBJECT, 'news');
                                // Check if the post with the slug 'no-articles' exists
                                if($no_articles_post) {
                                    $no_articles_post_id = $no_articles_post->ID;

                                    $query = new WP_Query(
                                        array(
                                            'post_type' => 'news',
                                            'post_status' => 'publish',
                                            'posts_per_page' => 6,
                                            'order' => 'DESC',
                                            'post__not_in' => array($no_articles_post_id),
                                        )
                                    );
                                    // Rest of your loop or processing logic here
                                }

                                ?>
                                <ul id="product" class="bxslider">
                                    <?php

                                    while($query->have_posts()) {
                                        $query->the_post();
                                        $description = get_the_content();
                                        $trimmed_description = wp_trim_words($description, 10, '...');
                                        $news_title = get_the_title();
                                        $trimmed_title = wp_trim_words($news_title, 8, '...');

                                        ?>
                                        <li>
                                            <div class="news-latestList">
                                                <div>
                                                    <?php $news_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full'); ?>
                                                    <img src="<?php echo $news_image[0]; ?>" class="single-news-img"
                                                        alt="<?= get_the_title() ?>" />
                                                </div>
                                                <div>
                                                    <p class="product-title">
                                                        <?= $trimmed_title ?>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="txt-other-news">
                                                        <?= $trimmed_description ?>
                                                    </p>
                                                </div>
                                                <div>
                                                    <a href="<?php echo get_permalink(get_the_ID()); ?>?type=<?= $cat_slug ?>"
                                                        class="ready-news">Leggi</a>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    wp_reset_query();
                                    ?>
                                </ul>
                            </div>

                            <!-- <div class="top-score-title l-comment">
                        <h3>LEAVE A <span>COMMENT</span><span class="point-little">.</span></h3>
                        <div class="col-md-12 login-page">
                            <form method="post" class="register-form">

                                <div class="name">
                                    <label for="name">* Name:</label>
                                    <div class="clear"></div>
                                    <input id="Text2" name="name" type="text" placeholder="e.g. Mr. John" required="" />
                                </div>
                                <div class="name">
                                    <label for="email">* Email:</label> 
                                    <div class="clear"></div>
                                    <input id="email" name="email" type="text" placeholder="e.g. Mr. Doe" required="" />
                                </div>
                                <div class="message">
                                    <label for="message"> Message:</label>
                                    <textarea name="messagetext" class="txt-area" id="message" cols="30"
                                        rows="4"></textarea>
                                </div>
                                <div id="register-submit">
                                    <input type="submit" value="Submit" />
                                </div>
                            </form>

                        </div>

                    </div> -->
                            <!--Close comment-->

                        </div><!--Close Top Match-->
                        <div class="col-md-3 right-column">
                            <?php
                            $meta_news = get_post_meta($newsID);
                            $galleryID = $meta_news['gallery'][0];
                            $gallery_imgID = wp_get_attachment_image_src($galleryID, 'full');
                            $gallery_imageURL = $gallery_imgID[0];
                            $gallery_meta = get_post_meta($galleryID);
                            $galleryslug = basename(get_permalink($galleryID));

                            $array_gallery = unserialize($gallery_meta['gallery'][0]);

                            $single_galleryID = $array_gallery[0]['gallery_image'];
                            $single_gallery_image = wp_get_attachment_image_src($single_galleryID, 'full');
                            $single_gallery_imageURL = $single_gallery_image[0];

                            if(!$gallery_imageURL) {
                                $photogallery = $single_gallery_imageURL;
                            } else {
                                $photogallery = $gallery_imageURL;
                            }

                            if($photogallery) {
                                ?>
                                <div class="photogallery col-md-12">
                                    <h5 class="gallery-title">PHOTOGALLERY DEL MATCH</h5>
                                    <div class="lightbox_img_wrap other-video">
                                        <a href="<?php echo site_url(); ?>/photogallery?view=<?= $galleryslug ?>">
                                            <img class="single-gallery-image" src="<?= $photogallery ?>"
                                                alt="<?= get_the_title($galleryID) ?>" data-imgsrc="<?= $photogallery ?>">
                                            <i class="fa fa-camera"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="top-score-title col-md-12 right-title">
                                <h3>ULTIME News</h3>
                                <?php
                                $no_articles_post = get_page_by_path('no-articles', OBJECT, 'news');
                                // Check if the post with the slug 'no-articles' exists
                                if($no_articles_post) {
                                    $no_articles_post_id = $no_articles_post->ID;

                                    $query = new WP_Query(
                                        array(
                                            'post_type' => 'news',
                                            'post_status' => 'publish',
                                            'posts_per_page' => 3,
                                            'order' => 'DESC',
                                            'post__not_in' => array($no_articles_post_id),
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'category',
                                                    'field' => 'slug',
                                                    'terms' => $cat_slug
                                                )
                                            ),
                                        )
                                    );
                                    // Rest of your loop or processing logic here
                                }

                                while($query->have_posts()) {
                                    $query->the_post();
                                    $description = get_the_content();
                                    $trimmed_description = wp_trim_words($description, 15, '...');
                                    if($newsID !== get_the_id()) {
                                        ?>
                                        <div class="right-content">
                                            <p class="news-title-right">
                                                <?= get_the_title() ?>
                                            </p>
                                            <p class="txt-right">
                                                <?= $trimmed_description ?>
                                            </p>
                                            <a href="<?php echo get_permalink(get_the_ID()); ?>?type=<?= $cat_slug ?>" class="ca-more"><i
                                                    class="fa fa-angle-double-right"></i>Continua...</a>
                                        </div>
                                        <?php
                                    }
                                }
                                wp_reset_query();
                                ?>
                            </div>
                            <div class="readmore">
                                <a href="<?php echo site_url(); ?>" class="sg-more">
                                    <!-- <a href="<?php // echo site_url(); ?>/news-2" class="sg-more"> -->
                                    <button class="btn btn-default read-more-single">Altri risultati</button>
                                </a>
                            </div>
                        </div>
                </section>
            <?php }
        } ?>
        <!-- <section id="sponsor" class="container">
           
            <div class="client-sport client-sport-nomargin">
                <div class="content-banner">
                    <ul class="sponsor second">
                        <li><img src="http://placehold.it/273x133" alt="" /></li>
                        <li><img src="http://placehold.it/273x133" alt="" /></li>
                        <li><img src="http://placehold.it/273x133" alt="" /></li>
                        <li><img src="http://placehold.it/273x133" alt="" /></li>
                        <li><img src="http://placehold.it/273x133" alt="" /></li>
                        <li><img src="http://placehold.it/273x133" alt="" /></li>
                    </ul>
                </div>
            </div>
        </section> -->
        <?php

endwhile; // End of the loop.
get_footer();
