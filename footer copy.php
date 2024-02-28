<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!--FOOTER-->
<section id="footer-tag">
  <div class="container">
    <div id="footer-sidebar" class="secondary">
      <div class="col-md-12" id="footer-area">
        <div id="footer-sidebar1" class="col-md-4">
          <?php
          if (is_active_sidebar('footer-widget-area-1')) {
            dynamic_sidebar('footer-widget-area-1');
          }
          ?>
        </div>
        <div id="footer-sidebar2" class="col-md-4">
          <?php
          if (is_active_sidebar('footer-widget-area-2')) {
            dynamic_sidebar('footer-widget-area-2');
          }
          ?>
        </div>
        <div class="col-md-4">
          <h4 class="ultime_news">Ultime News</h3>
            <?php
            $query = new WP_Query(
              array(
                'post_type' => 'news',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'order' => 'DESC',
              )
            );
            $i = 0;
            while ($query->have_posts()) {
              $query->the_post();
              $description = get_the_content();
              $trimmed_description = substr($description, 0, 80) . '...';
              ?>
              <ul class="footer-last-news">
                <?php if (has_post_thumbnail(get_the_ID())): ?>
                  <li>
                    <?php $news_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail'); ?>
                    <a href="<?php echo get_permalink(get_the_ID()); ?>" target="_self">
                      <img class="img-djoko" src="<?php echo $news_image[0]; ?>" alt="" width="100px" height="60px" /></a>
                  <?php endif; ?>
                  <p>
                    <?= $trimmed_description ?>
                  </p>
                </li>

              </ul>
              <?php
            }
            wp_reset_query();
            ?>
        </div>

      </div>
    </div>
    <div class="col-xs-12 footer-social-link">
      <ul class="social">
        <?php
        if (is_active_sidebar('footer-widget-area-3')) {
          dynamic_sidebar('footer-widget-area-3');
        }
        ?>

      </ul>
    </div>
  </div>
  </div>
</section>
<footer>
  <div class="col-md-12 content-footer">
    <?php
    if (is_active_sidebar('secondary-widget-area')) {
      dynamic_sidebar('secondary-widget-area');
    }
    ?>
  </div>
</footer>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.transit.min.js" type="text/javascript"></script>

<!--MENU-->
<script src="<?php echo get_template_directory_uri(); ?>/js/menu/modernizr.custom.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/menu/cbpHorizontalMenu.js" type="text/javascript"></script>
<!--END MENU-->
<!--Mini Flexslide-->
<script src="<?php echo get_template_directory_uri(); ?>/js/minislide/jquery.flexslider.js"
  type="text/javascript"></script>
<!-- Percentace circolar -->
<script src="<?php echo get_template_directory_uri(); ?>/js/circle/jquery-asPieProgress.js"
  type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/circle/rainbow.min.js" type="text/javascript"></script>

<!--Gallery-->
<script src="<?php echo get_template_directory_uri(); ?>/js/gallery/jquery.prettyPhoto.js"
  type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/gallery/isotope.js" type="text/javascript"></script>

<!-- Button Anchor Top-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.ui.totop.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.bxslider.js" type="text/javascript"></script>

<!--Carousel News-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mousewheel.js" type="text/javascript"></script>

<!--Carousel Clients-->
<script src="<?php echo get_template_directory_uri(); ?>/js/own/owl.carousel.js" type="text/javascript"></script>

<!--Count down-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.countdown.js" type="text/javascript"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/custom_ini.js" type="text/javascript"></script>

<?php wp_footer(); ?>

</body>

</html>