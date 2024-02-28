<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
// Getting only next game and upcoming game by our team "Basekt College Novara" in league Serie C postID. Not the next game for all the teams calendar
$post_title = 'Basket College Novara';
$post_type = 'sp_team';
$args_ = array(
  'name' => sanitize_title($post_title),
  'post_type' => $post_type,
  'post_status' => 'publish',
  'numberposts' => 1
);

$posts_ = get_posts($args_);

if ($posts_) {
  $gamepost_id = $posts_[0]->ID;
} else {
  $gamepost_id = null;
}

$today = date('Y-m-d');

$game_args = array(
  'post_type' => 'sp_event',
  'post_status' => 'future',
  'tax_query' => array(
    array(
      'taxonomy' => 'sp_league',
      'field' => 'slug',
      'terms' => 'serie-c'
    )
  ),
  'date_query' => array(
    array(
      'after' => $today,
      // Retrieve posts from the current date onward
      'inclusive' => true,
      // Include posts on the current date
    ),
  ),
  'posts_per_page' => -1,
  'orderby' => 'publish_date',
  'order' => 'ASC',
);

$latest_game = new WP_Query($game_args);

$nextgame_list = array(); // Initialize an empty array to store post data
$upcomming_gameID = null;

if ($latest_game->have_posts()) {
  while ($latest_game->have_posts()) {
    $latest_game->the_post();
    $postID = get_the_ID();

    // Get the post data you need and store it in an array
    $post_meta = get_post_meta($postID);
    $post_data = array(
      'post_id' => $postID,
      'post_title' => get_the_title(),
      'post_meta' => $post_meta,
      // Add more data as needed
    );
    // Add the post data to the array
    $nextgame_list[] = $post_data;
  }
}
?>
<!--SECTION CONTAINER SLIDER-->
<section id="summary-slider">
  <div class="general">
    <?php
    $image_id = get_option('banner_image');
    $image_url = wp_get_attachment_image_src($image_id, 'full');
    $banner_image = $image_url[0];
    ?>
    <?php
    $i = 0;
    foreach ($nextgame_list as $gamelist) {
      if (in_array($gamepost_id, $gamelist['post_meta']['sp_team'])) {
        if ($i == 1) {
          break;
        } // show only 1 items   
        $game_postID = $gamelist['post_id'];
        $post_data = get_post($game_postID);
        $post_date_time = new DateTime($post_data->post_date);
        $post_time = $post_date_time->format('H:i');
        ?>
        <div class="content-result content-result-news col-md-12"
          style='background: url(<?= $banner_image ?>) no-repeat 100% 100%; background-position: center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;  background-size: cover'>
          <div id="textslide" class="effect-backcolor">
            <div class="container">
              <div class="col-md-12 slide-txt">
                <p class='sub-result aft-little welcome linetheme-left'>
                  <?= get_option('banner_title') ?>
                </p>
                <div class="col-xs-6 col-md-6">
                  <?php $next1_game = wp_get_attachment_image_src(get_post_thumbnail_id($gamelist['post_meta']['sp_team'][0]), 'thumbnail'); ?>
                  <img src="<?php echo $next1_game[0]; ?>" class='banner-logo-view' alt="" />
                </div>
                <div class="col-xs-6 col-md-6">
                  <?php $next2_game = wp_get_attachment_image_src(get_post_thumbnail_id($gamelist['post_meta']['sp_team'][1]), 'thumbnail'); ?>
                  <img src="<?php echo $next2_game[0]; ?>" class='banner-logo-view' alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="slidematch" class="col-xs-12 col-md-12">
          <div class="content-match-team-wrapper">
            <span class="gdlr-left">
              <?= get_the_title($gamelist['post_meta']['sp_team'][0]); ?>
            </span>
            <span class="gdlr-upcoming-match-versus">VS</span>
            <span class="gdlr-right">
              <?= get_the_title($gamelist['post_meta']['sp_team'][1]); ?>
            </span>
          </div>
          <div class="content-match-team-time">
            <span class="gdlr-left">
              <?php echo get_the_date('j F Y', $game_postID); ?> -
              <?php echo $post_time; ?>
            </span>
            <!--span class="gdlr-right">other text</span-->
          </div>
        </div>
        <?php $i++;
      }
    } ?>
  </div>
</section>
<!-- SECTION NEWS SLIDER -->
<section class="news_slide-over-color">
  <div class="news_slide-over"></div>
  <div class="container">
    <!--<div class="col-xs-12 col-md-12 top-first-info">
               <div class="col-md-4">
                     <section class="slider">
                            <div id="slider" class="flexslider flexslider-attachments">
                                <ul class="slides">
                                    <li data-thumb="<?php echo get_template_directory_uri(); ?>/images/slider/mini-slider/thumb1.jpg"><img src="http://placehold.it/1024x700" alt=""/></li>
                                  <li data-thumb="<?php echo get_template_directory_uri(); ?>/images/slider/mini-slider/thumb2.jpg"><img src="http://placehold.it/1024x700" alt=""/></li>
                                  <li data-thumb="<?php echo get_template_directory_uri(); ?>/images/slider/mini-slider/thumb3.jpg"><img src="http://placehold.it/1024x700" alt=""/></li>
                                </ul>
                            </div>
                            <div class="slide-news-bottom"><a href="#">Lo staff</a><a class="i-ico" href="#"><i class="fa fa-angle-double-right"></i></a></div>
                     </section>
                </div>
                <div class="col-md-4">
                     <img src="http://placehold.it/1024x700" alt=""/>
                     <div class="slide-news-bottom"><a href="#">La squadra</a><a class="i-ico" href="#"><i class="fa fa-angle-double-right"></i></a></div>
                </div>
                <div class="col-md-4">
                     <img src="http://placehold.it/1024x700" alt=""/>
                     <div class="slide-news-bottom"><a href="#">La storia</a><a class="i-ico" href="#"><i class="fa fa-angle-double-right"></i></a></div>
                </div>
             </div>-->
    <div class="col-xs-12 col-md-12 top-slide-info">
      <?php
      $query = new WP_Query(
        array(
          'post_type' => 'news',
          'post_status' => 'publish',
          'posts_per_page' => 6,
          'order' => 'DESC',
        )
      );
      $i = 0;
      while ($query->have_posts()) {
        $query->the_post();
        $description = get_the_content();
        $trimmed_description = substr($description, 0, 100) . '...';
        ?>
        <div class="col-xs-6 col-md-6 home-news-list">
          <div class="col-md-4 slide-cont-img">
            <a href="<?php echo get_permalink(get_the_ID()); ?>">
              <?php $news_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail'); ?>
              <img class="scale_image" src="<?php echo $news_image[0]; ?>" alt="" />
            </a>
          </div>
          <?php $news_date = get_the_date('j F, Y'); ?>
          <div class="event_date dd-date">
            <?php echo $news_date; ?>
          </div>
          <h4>
            <?php the_title(); ?>
          </h4>
          <p>
            <?php echo $trimmed_description; ?>
          </p>
        </div>
        <?php
      }
      wp_reset_query();
      ?>
    </div>
  </div>
</section>

<!--SECTION SPONSOR-->
<section class="container">
  <div class="client-sport client-sport-nomargin home-pg">
    <div class="content-banner">
      <ul class="sponsor second" id="owl-sponsor">
        <?php
        foreach (get_uf_repeater('sponser_image_files', 'option') as $sponser_images):
          extract($sponser_images);
          ?>
          <li><a href="#"><img src="<?php echo $image ?>" alt="" /></a></li>
          <?php
        endforeach;
        ?>
      </ul>
    </div>
  </div>
</section>

<section id="parallaxTraining">
  <!-- <div class="black-shad">
        <div class="container">
            <div class="col-md-12">
                <div class="txt-training">
                  <!--p>start your</p-->
  <!--<h2>LA CLASSIFICA</h2>
                    <a href="#">Serie B</a>
                    <a href="#">Promozione</a>
                    <a href="#">U 18 Eccellenza</a>
                    <a href="#">U 16 Eccellenza</a>
                    <a href="#">U 15 </a>
                    <a href="#">U 14</a>
                    <a href="#">U 13</a>
                    <a href="#">U Femminile</a>
                </div>
            </div>
        </div>
      </div>-->
</section>
<!--SECTION Match TOP SCORE-->
<?php
$lastmatch_image_id = get_option('lastmatch_section_background_image');
$lastmatch_image_url = wp_get_attachment_image_src($lastmatch_image_id, 'full');
$lastmatch_bg_img = $lastmatch_image_url[0];
?>
<section id="atp-match"
  style='background: url(<?= $lastmatch_bg_img ?>)  no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover;  -o-background-size: cover;  background-size: cover;'>
  <div class="container">
    <div id="people-top" class="top-match col-xs-12 col-md-12">
      <h3 class="news-title n-match">Ultima <span>Partita</span><span class="point-little">.</span></h3>
      <!--p class="subtitle">A small creative team, trying to enrich the lives of others and build brands 
                                    that a normal humans can understand.</p-->
      <!--SECTION ATP MATCH-->
      <div class="next-match-co col-xs-12 col-md-12">
        <div id="nextmatch-content" class="experience">
          <div class="col-xs-12 atphead">
            <div class="match-sing-title"><img src="<?php echo get_template_directory_uri(); ?>/images/sub-ball.png"
                alt="" />Lega Nazionale Pallacanestro | Serie C</div>
          </div>
          <?php
          $lastgame_args = array(
            'post_type' => 'sp_event',
            'post_status' => 'publish',
            'tax_query' => array(
              array(
                'taxonomy' => 'sp_league',
                'field' => 'slug',
                'terms' => 'serie-c'
              )
            ),
            'date_query' => array(
              array(
                'before' => $today,
                // Retrieve posts before the current date
                'inclusive' => true,
                // Include posts on the current date
              ),
            ),
            'posts_per_page' => -1,
            'orderby' => 'date',
            // Order by date
            'order' => 'DESC',
            // Order in descending order to get the latest posts first
          );

          $last_game = new WP_Query($lastgame_args);

          $nextgame_list_last = array(); // Initialize an empty array to store post data
          

          if ($last_game->have_posts()) {
            while ($last_game->have_posts()) {
              $last_game->the_post();
              $postID = get_the_ID();

              // Get the post data you need and store it in an array
              $post_meta = get_post_meta($postID);
              $post_data = array(
                'post_id' => $postID,
                'post_title' => get_the_title(),
                'post_meta' => $post_meta,
                // Add more data as needed
              );
              // Add the post data to the array
              $nextgame_list_last[] = $post_data;
            }
          }
          // echo "<pre>";
          // print_r($nextgame_list_last);
          // echo "</pre>";
          $i = 0;
          foreach ($nextgame_list_last as $gamelist) {
            if (in_array($gamepost_id, $gamelist['post_meta']['sp_team'])) {
              $game_result = get_post_meta($gamelist['post_id'], 'sp_results', true);
              $first_team_ID = $gamelist['post_meta']['sp_team'][0];
              $second_team_ID = $gamelist['post_meta']['sp_team'][1];
              $game_postID = $gamelist['post_id'];
              $post_data = get_post($game_postID);
              $post_date_time = new DateTime($post_data->post_date);
              $post_time = $post_date_time->format('H:i');
              if ($i == 1) {
                break;
              } // show only 1 items?>
              <div class="col-xs-4 pht-1 pht-left">
                <div class="img-face-home">
                  <?php $next1_game = wp_get_attachment_image_src(get_post_thumbnail_id($gamelist['post_meta']['sp_team'][0]), 'full'); ?>
                  <img src="<?php echo $next1_game[0]; ?>" alt="" />
                  <p class="name-mc">
                    <?= get_the_title($gamelist['post_meta']['sp_team'][0]) ?>
                  </p>
                </div>
              </div>
              <div class="col-xs-4 pl-point ">
                <p class="col-xs-12 name-mc-title">Risultato</p>
                <div class="col-xs-4 nm-result">
                  <?php $sp_result1 = get_post_meta($gamelist['post_meta']['sp_team'][0], 'sp_results', true); ?>
                  <p class="nr1 ris1">
                    <?= $game_result[$first_team_ID]['points'] ?>
                  </p>
                  <!--p class="nr2"> 0% </p-->
                </div>
                <div class="col-xs-4 nm-result-vs">
                  <p class="nrvs">- VS -</p>
                </div>
                <div class="col-xs-4 nm-result">
                  <?php $sp_result2 = get_post_meta($gamelist['post_meta']['sp_team'][1], 'sp_results', true); ?>
                  <p class="nr1 ris2">
                    <?= $game_result[$second_team_ID]['points'] ?>
                  </p>
                  <!--p class="nr2"> 100% </p-->
                </div>

              </div>
              <div class="col-xs-4 pht-1 pht-right">
                <div class="img-face-home">
                  <?php $next2_game = wp_get_attachment_image_src(get_post_thumbnail_id($gamelist['post_meta']['sp_team'][1]), 'thumbnail'); ?>
                  <img src="<?php echo $next2_game[0]; ?>" alt="" />
                  <p class="name-mc">
                    <?= get_the_title($gamelist['post_meta']['sp_team'][1]) ?>
                  </p>
                </div>

              </div>
              <div class="col-xs-12 atphead">
                <div class="match-sing-title inf-bottom">
                  <p class='sub-result'>
                    <?php echo get_the_date('j F Y', $gamelist['post_id']); ?> -
                    <?php echo $post_time; ?>
                  </p>
                  <!--i class="fa fa-map-marker"></i> London Brion Stadium</p-->
                </div>
              </div>
            </div>
          </div>
          <?php $i++;
            }
          }
          ?>
      <!--div class="col-md-4 home-page">
                   <div class="main">
                                <div class="tabs animated-slide-2">
                                 <div class="result-filter">
                                    <ul class="tab-links">
                                        <li class="active"><a href="#tab1111">ATP</a></li>
                                        <li><a href="#tab2222">WTA</a></li>
                                        <li><a href="#tab3333">DBL</a></li>
                                    </ul>
                                    </div>
                                    <div class="tab-content-point">
                                        <div id="tab1111" class="tab active">
                                        <table class="tab-score">
                                          <tr class="top-scrore-table"><td class="score-position">POS.</td><td>PLAYER</td><td>NAT.</td><td>POINTS</td></tr>
                                          <tr><td class="score-position">1.</td><td><a href="single_player.html">Nicol Dorian</a></td><td><img src="images/flags/serbia.png" alt="" /></td><td>12770</td></tr>
                                          <tr><td class="score-position">2.</td><td><a href="single_player.html">Rafael Milk</a></td><td><img src="images/flags/argentina.png" alt="" /></td><td>10670</td></tr>
                                          <tr><td class="score-position">3.</td><td><a href="single_player.html">Roger Figo</a></td><td><img src="images/flags/uk.png" alt="" /></td><td>7490</td></tr>
                                          <tr><td class="score-position">4.</td><td><a href="single_player.html">St. Waiker</a></td><td><img src="images/flags/brazil.png" alt="" /></td><td>5985</td></tr>
                                          <tr><td class="score-position">5.</td><td><a href="single_player.html">David Ruby</a></td><td><img src="images/flags/japan.png" alt="" /></td><td>4765</td></tr>
                                          
                                         </table>
                                        </div>
                                        <div id="tab2222" class="tab">
                                        <table class="tab-score">
                                        <tr class="top-scrore-table"><td class="score-position">POS.</td><td>PLAYER</td><td>NAT.</td><td>POINTS</td></tr>
                                          <tr><td class="score-position">1.</td><td><a href="single_player.html">Serena Brain</a></td><td><img src="images/flags/usa.png" alt="" /></td><td>1234</td></tr>
                                          <tr><td class="score-position">2.</td><td><a href="single_player.html">Simona Figo</a></td><td><img src="images/flags/uk.png" alt="" /></td><td>1234</td></tr>
                                          <tr><td class="score-position">3.</td><td><a href="single_player.html">Nio Red</a></td><td><img src="images/flags/italy.png" alt="" /></td><td>1234</td></tr>
                                          <tr><td class="score-position">4.</td><td><a href="single_player.html">Petra Curt</a></td><td><img src="images/flags/denmark.png" alt="" /></td><td>1234</td></tr>
                                          <tr><td class="score-position">5.</td><td><a href="single_player.html">Ag. Rader</a></td><td><img src="images/flags/uk.png" alt="" /></td><td>1234</td></tr>
                                         </table>
                                        </div>
                                        <div id="tab3333" class="tab">
                                        <table class="tab-score">
                                        <tr class="top-scrore-table"><td class="score-position">POS.</td><td>PLAYER</td><td>NAT.</td><td>POINTS</td></tr>
                                          <tr><td class="score-position">1.</td><td><a href="single_player.html">name1</a></td><td>-</td><td>1234</td></tr>
                                          <tr><td class="score-position">2.</td><td><a href="single_player.html">name2</a></td><td>-</td><td>1234</td></tr>
                                          <tr><td class="score-position">3.</td><td><a href="single_player.html">name3</a></td><td>-</td><td>1234</td></tr>
                                          <tr><td class="score-position">4.</td><td><a href="single_player.html">name4</a></td><td>-</td><td>1234</td></tr>
                                          <tr><td class="score-position">5.</td><td><a href="single_player.html">name5</a></td><td>-</td><td>1234</td></tr>
                                         </table>
                                        </div>
                                    </div>
                                    <div class="score-view-all"><a class="pl-point-button" href="results.html">View All</a></div>
                                </div>
                            </div>
                </div-->
    </div><!--Close Top Match-->
  </div>
</section>
<!--SECTION NEXT MATCH-->
<section id="next-match">
  <div class="container">
    <div class="next-match-news top-match col-xs-12 col-md-12">
      <h3 class="news-title n-match">Prossima <span>Partita</span><span class="point-little">.</span></h3>
      <!--p class="subtitle">A small creative team, trying to enrich the lives of others and build brands 
                                      that a normal humans can understand.</p-->
      <div class="other-match col-md-4">
        <div class="score-next-time">
          <div class="circle-ico">
            <p>SERIE C</p>
          </div>
        </div>
        <!--div id="getting-started"></div-->
        <?php
        $i = 0;
        foreach ($nextgame_list as $gamelist) {
          if (in_array($gamepost_id, $gamelist['post_meta']['sp_team'])) {
            if ($i == 1) {
              break;
            } // show only 1 items
            $game_postID = $gamelist['post_id'];
            $post_data = get_post($game_postID);
            $post_date_time = new DateTime($post_data->post_date);
            $post_time = $post_date_time->format('H:i');
            $upcomming_gameID = $gamelist['post_id'];
            ?>
            <div class="col-xs-5 col-md-5 match-team">
              <?php $next1_game = wp_get_attachment_image_src(get_post_thumbnail_id($gamelist['post_meta']['sp_team'][0]), 'thumbnail'); ?>
              <img src="<?php echo $next1_game[0]; ?>" alt="" />
              <p>
                <?php echo get_the_title($gamelist['post_meta']['sp_team'][0]); ?>
              </p>
            </div>
            <div class="col-xs-2 col-md-2 match-team-vs">
              <span class="txt-vs">- vs -</span>
            </div>
            <div class="col-xs-5 col-md-5 match-team">
              <?php $next2_game = wp_get_attachment_image_src(get_post_thumbnail_id($gamelist['post_meta']['sp_team'][1]), 'thumbnail'); ?>
              <img src="<?php echo $next2_game[0]; ?>" alt="" />
              <p>
                <?php echo get_the_title($gamelist['post_meta']['sp_team'][1]); ?>
              </p>
            </div>
            <div class="next-match-place">
              <p class='sub-result'>
                <?php echo get_the_date('j F Y', $gamelist['post_id']); ?> -
                <?php echo $post_time; ?>
              </p>
              <!-- <p class="dd-news-date">2° giornata del girone di andata</p> -->
            </div>
            <?php
            $i++;
          }
        }
        ?>
      </div>
      <div class="other-match col-md-4">
        <?php
        $i = 0;
        foreach ($nextgame_list as $gamelist) {
          if (in_array($gamepost_id, $gamelist['post_meta']['sp_team']) && $upcomming_gameID != $gamelist['post_id']) {
            if ($i == 3) {
              break;
            } // show only 3 items
            $game_postID = $gamelist['post_id'];
            $post_data = get_post($game_postID);
            $post_date_time = new DateTime($post_data->post_date);
            $post_time = $post_date_time->format('H:i');
            $nextgame1 = wp_get_attachment_image_src(get_post_thumbnail_id($gamelist['post_meta']['sp_team'][0]), 'thumbnail');
            $nextgame2 = wp_get_attachment_image_src(get_post_thumbnail_id($gamelist['post_meta']['sp_team'][1]), 'thumbnail');
            ?>
            <div class="match-team-list">
              <img class="t-img1" src="<?= $nextgame1[0] ?>" width="74" height="74" alt="" />
              <span class="txt-vs"> - vs - </span>
              <img class="t-img2" src="<?= $nextgame2[0] ?>" width="74" height="75" alt="" />
              <p>
                <?php echo get_the_date('j F Y', $gamelist['post_id']); ?> -
                <?php echo $post_time; ?>
              </p>
            </div>
            <?php
            $i++;
          }
        }
        ?>

        <div class="team-view-all">
          <p><a class="vai_calendario" href="#">Guarda il calendario</a></p>
        </div>
        <?php
        // } 
        wp_reset_postdata();
        ?>
      </div>
      <!--<div class="other-match col-md-4 other-last">
                      <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/adwertise.jpg" alt="" /></a>
                  </div>-->
    </div>
  </div>
</section>
<!-- PARALLAX BLACK TENNIS-->
<?php
$md_image_id = get_option('media_section_background_image');
$md_image_url = wp_get_attachment_image_src($md_image_id, 'full');
$md_bg_img = $md_image_url[0];
?>
<section class="bbtxt-content"
  style='background: url(<?= $md_bg_img ?>)  no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'>
  <div class="container">
    <div class="col-xs-12 bbtxt-box">
      <h4><!--i class="fa fa-quote-left"--></i>COLLEGE<span class="middle-txt"> Media<span
            class="point-little">.</span></span><!--i class="fa fa-quote-right"></i--></h4>
      <p class="subin">Foto e video delle ultime partite</p>
      <div class="col-md-12 homevideo-top">
        <h3 class="home-video-title">Photo Gallery</h3>
        <div class="col-md-12 homevideo">
          <?php

          $gallery_list = new WP_Query(
            array(
              'post_type' => 'photo_gallery',
              'post_status' => 'publish',
              'posts_per_page' => 6,
              'order' => 'DESC',
            )
          );

          if ($gallery_list->have_posts()) {
            while ($gallery_list->have_posts()) {
              $gallery_list->the_post();
              $postID = get_the_ID();
              $slug = basename(get_permalink($postID));
              $gallery_des = get_the_content();
              $post_meta = get_post_meta($postID);
              $gallery_images = unserialize($post_meta['gallery'][0]);

              if (!empty($gallery_images)) {
                $single_imdID = $gallery_images[0]['gallery_image'];
                $single_image_url = wp_get_attachment_image_src($single_imdID, 'thumbnail');
                $single_image = $single_image_url[0];
              } else {
                $single_image = 'http://placehold.it/624x428';
              }
              $trimmed_des = substr($gallery_des, 0, 100) . '...';
              ?>
              <div class="col-md-6 homevideo">
                <div class="col-md-5 it-video">
                  <a href="<?php echo site_url(); ?>/photogallery?view=<?= $slug ?>"><img class="scale_image"
                      src="<?= $single_image ?>" width="150px" height="150px" alt="" />
                    <i class="fa fa-video-camera"></i></a>
                </div>
                <div class="video-txt">
                  <div class="event_date_video">
                    <?= get_the_date('j F, Y') ?>
                  </div>
                  <h3>
                    <?= get_the_title() ?>
                  </h3>
                  <p>
                    <?= $trimmed_des ?>
                  </p>
                </div>

              </div>
              <?php
            }
            wp_reset_query();
          }
          ?>
        </div>
      </div>
</section>

<!--SECTION STATISTIC RESULTS-->
<!--section id="resultsPoint">
           <div class="container">
                    <div class="top-match col-xs-12 col-md-12">
                     <div class="top-score-title">
                        <h3>Statistics<span class="point-little">.</span></h3>
                        <p class="subtitle">A small creative team, trying to enrich the lives of others and build brands 
                                    that a normal humans can understand.</p>
                        <div class="col-xs-12 circle-percentage">
                          <div class="col-xs-3">
                            <div class="pie_progress" role="progressbar" data-goal="83" data-barcolor="#f59123" data-barsize="10">
                             <div class="pie_content">
                                <div class="pie_progress__number">0%</div>
                                <div class="pie_progress__content">Super-Senior</div>
                             </div>
                            </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="pie_progress" role="progressbar" data-goal="65" data-barcolor="#2c333b" data-barsize="10">
                             <div class="pie_content">
                                <div class="pie_progress__number">0%</div>
                                <div class="pie_progress__content">Senior</div>
                             </div>
                            </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="pie_progress" role="progressbar" data-goal="32" data-barcolor="#f59123" data-barsize="10">
                             <div class="pie_content">
                                <div class="pie_progress__number">0%</div>
                                <div class="pie_progress__content">Pro</div>
                             </div>
                            </div>
                          </div>
                          <div class="col-xs-3">
                            <div class="pie_progress" role="progressbar" data-goal="73" data-barcolor="#2c333b" data-barsize="10">
                             <div class="pie_content">
                                <div class="pie_progress__number">0%</div>
                                <div class="pie_progress__content">Junior</div>
                             </div>
                            </div>
                          </div>
                        </div>
                        <div class="clear"></div>
                       
                      </div>
                    </div>
                </div>
     </section-->

<!--section id="parallax-info">
        <div class="clearfix">
          <div class="col-md-6 yoga-desc title">
                    <h1>Robert Doe</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed ligula odio. Sed id metus felis. Ut pretium nisl non justo condimentum id tincidunt nunc faucibus. Ut neque eros, pulvinar eu blandit quis, lacinia nec ipsum. Etiam vel orci ipsum. Sed eget velit ipsum. 
                    Duis in tortor scelerisque felis mattis imperdiet. Donec at libero tellus. Suspendisse consectetur consectetur bibendum.</p>

                    <p class="txt-break">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sed ligula odio. Sed id metus felis. Ut pretium nisl non justo condimentum id tincidunt nunc faucibus. Ut neque eros, pulvinar eu blandit quis, lacinia nec ipsum. Etiam vel orci ipsum. Sed eget velit ipsum. 
                    Duis in tortor scelerisque felis mattis imperdiet. Donec at libero tellus. Suspendisse consectetur consectetur bibendum.</p>
                    <img class="signature" src="images/signature.png" alt=""/>
               </div>
               <div class="col-md-6 cup-img" style="padding:0;">
                     <img src="images/people.jpg" alt=""/>
               </div>		
          </div>
    </section-->
<!-- SECTION SUBSCRIPTIONS-->
<!--section class="bbtxt-content-subscription">
           <div class="container">
                    <div class="col-xs-12 bbtxt-box">
                        <h4><i class="fa fa-quote-left"></i><span class="middle-txt">Enter in</span> <span class="point-big">WT</span> Tennis<i class="fa fa-quote-right"></i></h4>
                        <p class="subin">The best tennis tour around the europe step by step.</p>
                        <div class="subscription-content">
                            <div class="col-md-4">
                                <div class="subscription-tennis">
                                     
                                     <h3>subscription<span> Free</span></h3>
                                     
                                     <p class="desc-subscription">A Responsive Online Shopping website can attract its more is buyers as the user.</p>
                                     <a class="pl-point-button" href="">Read more</a>
                                 </div>
                             </div>
                             <div class="col-md-4">
                                <div class="subscription-tennis">
                                   
                                  <h3>subscription<span> Gold</span></h3>
                                  
                                  <p class="desc-subscription">A Responsive Online Shopping website can attract its more is buyers as the user.</p>
                                  <a class="pl-point-button" href="">Read more</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="subscription-tennis">
                                  
                                  <h3>subscription<span> Premium</span></h3>
                                  
                                  <p class="desc-subscription">A Responsive Online Shopping website can attract its more is buyers as the user.</p>
                                  <a class="pl-point-button" href="">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
     </section-->
<!--SECTION LAST PHOTO-->
<!--section id="news-section">
           <div class="container">
                   <div class="top-match col-xs-12 col-md-12">
                      <div class="news-content">
                       <h3 class="news-title">Latest <span>Photo</span><span class="point-little">.</span></h3>
                       <p class="subtitle">A small creative team, trying to enrich the lives of others and build brands 
                                    that a normal humans can understand.</p>
                       <div id="container-vert-n">
                        <dl class="group">
                            <dt></dt>
                        <dd>
                          <ul class="filter group albumFilter"> 
                            <li data-filter="*" class="current"><a  href="#">ALL</a></li> 
                            <li data-filter=".cat1"><a  href="#">ATP</a></li> 
                            <li data-filter=".cat2"><a  href="#">WTP</a></li> 
                            <li data-filter=".cat3"><a  href="#">BEAUTY</a></li> 
                            <li data-filter=".cat4"><a  href="#">MEETING</a></li> 
                          </ul> 
                        </dd>
                      </dl>
                        <div class="clear"></div>
                        </div>
                    </div>
                  </div>
            </div>
            
         <ul class="portfolio group albumContainer"> 
                    <li class="item block cat2 col-xs-3">
                      <a href="http://placehold.it/1600x1000" data-gal="prettyPhoto[portfolio]"><img src="http://placehold.it/1280x800"  alt="Yulia Gorbachenko, Hannah 1" /></a>
                        </li> 
                    <li class="item block cat1 col-xs-3">
                      <a href="http://placehold.it/1600x1000" data-gal="prettyPhoto[portfolio]"><img src="http://placehold.it/1280x800"  alt="Yulia Gorbachenko, Hair 1" /></a>
                        </li>
                    <li class="item block cat1 col-xs-3">
                      <a href="http://placehold.it/1600x1000" data-gal="prettyPhoto[portfolio]"><img src="http://placehold.it/1280x800"  alt="Yulia Gorbachenko, Hair 2" /></a>
                        </li>
                    <li class="item block cat3 col-xs-3">
                      <a href="http://placehold.it/1600x1000" data-gal="prettyPhoto[portfolio]"><img src="http://placehold.it/1280x800"  alt="Yulia Gorbachenko, Traction 1" /></a>
                        </li>
                    <li class="item block cat1 cat3 col-xs-3">
                      <a href="http://placehold.it/1600x1000" data-gal="prettyPhoto[portfolio]"><img src="http://placehold.it/1280x800"  alt="Yulia Gorbachenko, Traction 1" /></a>
                        </li>
                    <li class="item block cat2 col-xs-3">
                      <a href="http://placehold.it/1600x1000" data-gal="prettyPhoto[portfolio]"><img src="http://placehold.it/1280x800"  alt="Yulia Gorbachenko, Beauty 2" /></a>
                        </li>
                        <li class="item block cat1 col-xs-3">
                      <a href="http://placehold.it/1600x1000" data-gal="prettyPhoto[portfolio]"><img src="http://placehold.it/1280x800"  alt="Yulia Gorbachenko, Hair 1" /></a>
                        </li>
                        <li class="item block cat1 cat3 col-xs-3">
                      <a href="http://placehold.it/1600x1000" data-gal="prettyPhoto[portfolio]"><img src="http://placehold.it/1280x800"  alt="Yulia Gorbachenko, Traction 1" /></a>
                        </li>
                  </ul>         
     </section-->
<!--SECTION CLIENTS-->
<!--section class="container">
           <div class="top-video col-xs-12 col-md-12">
             <h3>OUR <span>CLIENT</span><span class="point-little">.</span></h3>
             <p class="subtitle">A small creative team, trying to enrich the lives of others and build brands 
                                    that a normal humans can understand.</p>

                 <div id="testimonials">
                   
                          <div id="owl-demo" class="owl-carousel">
                            <div class="item">
                                 <img src="http://placehold.it/235x224" alt="" />
                                 <div class="testimon-desc">
                                      <p>Fusce risus metus, placerat in <span>consectetur</span> eu, porttitor a est sed sed dolor lorem cras adipiscing</p>
                                      <p>A small <span>creative</span> team, trying to enrich the lives of others</p>
                                      <p class="nm-name">- Brian Rood</p>
                                </div>
                            </div>
                            <div class="item">
                                 <img src="http://placehold.it/235x224" alt="" />
                                 <div class="testimon-desc">
                                      <p>Fusce risus metus, placerat in <span>consectetur</span> eu, porttitor a est sed sed dolor lorem cras adipiscing</p>
                                      <p>A small <span>creative</span> team, trying to enrich the lives of others</p>
                                      <p class="nm-name">- Miki Rood</p>
                                 </div>
                           </div>
                            <div class="item">
                                <img src="http://placehold.it/235x224" alt="" />
                                <div class="testimon-desc">
                                    <p>Fusce risus metus, placerat in <span>consectetur</span> eu, porttitor a est sed sed dolor lorem cras adipiscing</p>
                                      <p>A small <span>creative</span> team, trying to enrich the lives of others</p>
                                      <p class="nm-name">- Robert Rood</p>
                                </div>
                            </div>
                          </div>
                    </div>
            </div>
     </section-->
<!--SECTION TOP PRODUCTS-->
<!--section class="top-product top-product-news">
        
           <div class="container">
           <div class="col-xs-12 col-md-12">
             <h3>Top <span>Product</span><span class="point-little">.</span></h3>
             <p class="subtitle ground">A small creative team, trying to enrich the lives of others and build brands 
                                    that a normal humans can understand.</p>
             <ul id="product" class="bxslider">
              <li>
                <div class="jm-item second">
          <div class="jm-item-wrapper">
            <div class="jm-item-image">
                            <img src="http://placehold.it/460x460" alt="" />
                            <div class="jm-item-description">
                                    <div class="jm-item-button">
                                        <a href="details_prod.html"><i class="fa fa-chain-broken"></i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                 </div>
                 <div class="product-title"><a href="details_prod.html" >ENVY <span>100L</span></a><p class="prod-ts-price">$256.00</p></div>
                 <div class="tshirt-buy"><a href="#" class="tshirt-cart"><i class="fa fa-shopping-cart"></i>Add</a></div>
               </li>
              <li>
                  <div class="jm-item second">
          <div class="jm-item-wrapper">
            <div class="jm-item-image">
                            <img src="http://placehold.it/460x460" alt="" />
                            <div class="jm-item-description">
                                    <div class="jm-item-button">
                                        <a href="details_prod.html"><i class="fa fa-chain-broken"></i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                 </div>
                  <div class="product-title"><a href="details_prod.html" >BIRTOL <span>PRO</span></a><p class="prod-ts-price">$168.00</p></div>
                 <div class="tshirt-buy"><a href="#" class="tshirt-cart"><i class="fa fa-shopping-cart"></i>Add</a></div>
              </li>
              <li>
                  <div class="jm-item second">
          <div class="jm-item-wrapper">
            <div class="jm-item-image">
                            <img src="http://placehold.it/460x460" alt="" />
                            <div class="jm-item-description">
                                    <div class="jm-item-button">
                                        <a href="details_prod.html"><i class="fa fa-chain-broken"></i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                 </div>
                  <div class="product-title"><a href="details_prod.html" >JUICE <span>100L</span></a><p class="prod-ts-price">$256.00</p></div>
                 <div class="tshirt-buy"><a href="#" class="tshirt-cart"><i class="fa fa-shopping-cart"></i>Add</a></div>
              </li>
              <li>
                 <div class="jm-item second">
          <div class="jm-item-wrapper">
            <div class="jm-item-image">
                            <img src="http://placehold.it/460x460" alt="" />
                            <div class="jm-item-description">
                                    <div class="jm-item-button">
                                        <a href="details_prod.html"><i class="fa fa-chain-broken"></i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                 </div>
                 <div class="product-title"><a href="details_prod.html" >MORBEL</a><p class="prod-ts-price">$126.00</p></div>
                 <div class="tshirt-buy"><a href="#" class="tshirt-cart"><i class="fa fa-shopping-cart"></i>Add</a></div>
              </li>
              <li>
                 <div class="jm-item second">
          <div class="jm-item-wrapper">
            <div class="jm-item-image">
                            <img src="http://placehold.it/460x460" alt="" />
                            <div class="jm-item-description">
                                    <div class="jm-item-button">
                                        <a href="details_prod.html"><i class="fa fa-chain-broken"></i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                 </div>
                 <div class="product-title"><a href="details_prod.html" >BRT <span>100L</span></a><p class="prod-ts-price">$86.00</p></div>
                 <div class="tshirt-buy"><a href="#" class="tshirt-cart"><i class="fa fa-shopping-cart"></i>Add</a></div>
              </li>
              <li>
                 <div class="jm-item second">
          <div class="jm-item-wrapper">
            <div class="jm-item-image">
                            <img src="http://placehold.it/460x460" alt="" />
                            <div class="jm-item-description">
                                    <div class="jm-item-button">
                                        <a href="details_prod.html"><i class="fa fa-chain-broken"></i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                 </div>
                    <div class="product-title"><a href="details_prod.html" >ICE <span>500R</span></a><p class="prod-ts-price">$312.00</p></div>
                 <div class="tshirt-buy"><a href="#" class="tshirt-cart"><i class="fa fa-shopping-cart"></i>Add</a></div>
              </li>
              <li>
                 <div class="jm-item second">
          <div class="jm-item-wrapper">
            <div class="jm-item-image">
                            <img src="http://placehold.it/460x460" alt="" />
                            <div class="jm-item-description">
                                    <div class="jm-item-button">
                                        <a href="details_prod.html"><i class="fa fa-chain-broken"></i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                 </div>
                 <div class="product-title"><a href="details_prod.html" >JUICE <span>100L</span></a><p class="prod-ts-price">$256.00</p></div>
                 <div class="tshirt-buy"><a href="#" class="tshirt-cart"><i class="fa fa-shopping-cart"></i>Add</a></div>
              </li>
              <li>
                 <div class="jm-item second">
          <div class="jm-item-wrapper">
            <div class="jm-item-image">
                            <img src="http://placehold.it/460x460" alt="" />
                            <div class="jm-item-description">
                                    <div class="jm-item-button">
                                        <a href="details_prod.html"><i class="fa fa-chain-broken"></i></a>
                                    </div>
                                </div>
                        </div>
                    </div>
                 </div>
                 <div class="product-title"><a href="details_prod.html" >JUICE <span>100L</span></a><p class="prod-ts-price">$256.00</p></div>
                 <div class="tshirt-buy"><a href="#" class="tshirt-cart"><i class="fa fa-shopping-cart"></i>Add</a></div>
              </li>
            </ul>
           </div>
        </div>
     </section-->
<!--SECTION SPONSOR-->
<!--section class="container">
           <div class="client-sport client-sport-nomargin home-pg">
               <div class="content-banner">
                     <ul class="sponsor second">
                      <li><img src="images/sponsor/01-mamy-eu.jpg" alt="" /></li>
                      <li><img src="images/sponsor/02-banca_popolare_di_novara.jpg" alt="" /></li>
                      <li><img src="images/sponsor/03-tvh.jpg" alt="" /></li>
                      <li><img src="images/sponsor/04-farmacie_celesia.jpg" alt="" /></li>
                      <li><img src="images/sponsor/05-mg.jpg" alt="" /></li>
                      <li><img src="images/sponsor/06-nordcom_vodafone.jpg" alt="" /></li>
                      <li><img src="images/sponsor/07-icorip_coatings.jpg" alt="" /></li>
                      <li><img src="images/sponsor/08-vc_engineering.jpg" alt="" /></li>
                      <li><img src="images/sponsor/09-color_box_center.jpg" alt="" /></li>
                    </ul>
                </div>
          </div>
     </section-->


<?php
get_footer();
