<?php
/**
 * Template Name: Contact
 */
get_header();
?>
<section class="drawer">
  <section id="contact" class="secondary-page">
    <div class="general">
      <!--Google Maps-->
      <div id="map_container">
        <div id="map_canvas">
          <?php echo do_shortcode('[wpgmza id="1"]'); ?>
        </div>
      </div>
      <div class="container">
        <div class="content-link col-md-12">
          <div id="contact_form" class="top-score-title col-md-9 align-center">
            <h3>CONTATTACI <span>form</span><span class="point-little">.</span></h3>
            <?php echo do_shortcode('[contact_form]'); ?>
          </div>
          <div id="info-company" class="top-score-title col-md-3 align-center">
            <h3>Info</h3>
            <div class="col-md-12 contact-details">
              <?php
              $postId = get_the_ID();
              $postmeta = get_post_meta($postId, "", true);
              ?>
              <p><i class="fa fa-phone"></i>
                <?= $postmeta['phone_number'][0] ?>
              </p>
              <p><i class="fa fa-envelope-open"></i>
                <?= $postmeta['emailid'][0] ?>
              </p>
              <p><i class="fa fa-globe"></i>
                <?= $postmeta['address_1'][0] ?>
              </p>
              <p><i class="fa fa-map-marker"></i>
                <?= $postmeta['address_2'][0] ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- <section id="sponsor" class="container"> -->
  <!--SECTION SPONSOR-->
  <!-- <div class="client-sport client-sport-nomargin">
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


  get_footer();
