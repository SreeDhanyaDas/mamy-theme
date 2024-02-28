<?php
/**
 * Template Name: Videogallery
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
            <h3 class="txt-advert animated">Video gallery</h3>
            <p class="txt-advert-sub">i video di tutte le partite</p>
        </div>
    </div>

    <section id="video" class="container secondary-page">
        <div class="general general-results">
            <div class="top-score-title col-md-9">
                <h3>SERIE B</h3>
                <div class="video-desc">

                    <div class="col-md-4 other-videotitle">
                        <p class="othervideo-date">04.09.2014</p>
                        <p>Emr ATP Rankings</p>
                    </div>
                    <div class="col-md-4 other-videotitle">
                        <p class="othervideo-date">12.02.2014</p>
                        <p>ATP CONFERENCE</p>
                    </div>
                    <div class="col-md-4 other-videotitle otv-last">
                        <p class="othervideo-date">05.11.2014</p>
                        <p>US Open 2014</p>
                    </div>
                    <div class="col-md-4 other-video">
                        <img src="http://placehold.it/320x213" />
                        <i class="fa fa-video-camera"></i>
                    </div>
                    <div class="col-md-4 other-video">
                        <img src="http://placehold.it/320x213" />
                        <i class="fa fa-video-camera"></i>
                    </div>
                    <div class="col-md-4 other-video otv-last">
                        <img src="http://placehold.it/320x213" />
                        <i class="fa fa-video-camera"></i>
                    </div>
                </div>

                <div class="video-content">
                    <a href="photogallery_det.html" target="" class="col-md-4 other-videotitle">
                        <p class="othervideo-date">04.09.2014</p>
                        <p>Emr ATP Rankings</p>
                    </a>
                    <div class="col-md-4 other-videotitle">
                        <p class="othervideo-date">12.02.2014</p>
                        <p>ATP CONFERENCE</p>
                    </div>
                    <div class="col-md-4 other-videotitle otv-last">
                        <p class="othervideo-date">05.11.2014</p>
                        <p>US Open 2014</p>
                    </div>
                    <div class="clear"></div>
                    <div class="col-md-4 other-video">
                        <img src="http://placehold.it/320x213" />
                        <i class="fa fa-video-camera"></i>
                    </div>
                    <div class="col-md-4 other-video">
                        <img src="http://placehold.it/320x213" />
                        <i class="fa fa-video-camera"></i>
                    </div>
                    <div class="col-md-4 other-video otv-last">
                        <img src="http://placehold.it/320x213" />
                        <i class="fa fa-video-camera"></i>
                    </div>
                </div>
            </div><!--Close Top Match-->
            <div class="col-md-3 right-column">
                <div class="top-score-title col-md-12 right-title">
                    <h3>Ultime News</h3>
                    <div class="right-content">
                        <p class="news-title-right">A New Old Life</p>
                        <p class="txt-right">Simon, who’s seeded just a lowly 26th here, was in many ways to man for
                            this grueling assignment</p>
                        <a href="single_news.html" class="ca-more"><i
                                class="fa fa-angle-double-right"></i>continua...</a>
                    </div>
                    <div class="right-content">
                        <p class="news-title-right">A New Old Life</p>
                        <p class="txt-right">Simon, who’s seeded just a lowly 26th here, was in many ways to man for
                            this grueling assignment</p>
                        <a href="single_news.html" class="ca-more"><i
                                class="fa fa-angle-double-right"></i>continua...</a>
                    </div>
                    <div class="right-content">
                        <p class="news-title-right">A New Old Life</p>
                        <p class="txt-right">Simon, who’s seeded just a lowly 26th here, was in many ways to man for
                            this grueling assignment</p>
                        <a href="single_news.html" class="ca-more"><i
                                class="fa fa-angle-double-right"></i>continua...</a>
                    </div>
                </div>
                <!--div class="top-score-title col-md-12">
            <img src="http://placehold.it/1000x475" alt="" />
          </div-->
                <!--div class="top-score-title col-md-12 right-title">
                <h3>Photos</h3> 
                <ul class="right-last-photo">
                        <li>
                            <div class="jm-item second">
                                <div class="jm-item-wrapper">
                                    <div class="jm-item-image">
                                        <img src="http://placehold.it/320x213" alt="" />
                                        <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="jm-item second">
                                <div class="jm-item-wrapper">
                                    <div class="jm-item-image">
                                        <img src="http://placehold.it/320x213" alt="" />
                                        <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="jm-item second">
                                <div class="jm-item-wrapper">
                                    <div class="jm-item-image">
                                        <img src="http://placehold.it/320x213" alt="" />
                                        <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="jm-item second">
                                <div class="jm-item-wrapper">
                                    <div class="jm-item-image">
                                        <img src="http://placehold.it/320x213" alt="" />
                                        <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="jm-item second">
                                <div class="jm-item-wrapper">
                                    <div class="jm-item-image">
                                        <img src="http://placehold.it/320x213" alt="" />
                                        <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="jm-item second">
                                <div class="jm-item-wrapper">
                                    <div class="jm-item-image">
                                        <img src="http://placehold.it/320x213" alt="" />
                                        <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="jm-item second">
                                <div class="jm-item-wrapper">
                                    <div class="jm-item-image">
                                        <img src="http://placehold.it/320x213" alt="" />
                                        <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="jm-item second">
                                <div class="jm-item-wrapper">
                                    <div class="jm-item-image">
                                        <img src="http://placehold.it/320x213" alt="" />
                                        <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="jm-item second">
                                <div class="jm-item-wrapper">
                                    <div class="jm-item-image">
                                        <img src="http://placehold.it/320x213" alt="" />
                                        <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </li>
                </ul>
          </div-->
            </div>
    </section>
    <section id="sponsor" class="container">
        <!--SECTION SPONSOR-->
        <div class="client-sport client-sport-nomargin">
            <div class="content-banner">
                <ul class="sponsor second">
                    <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/sponsor/01-mamy-eu.jpg"
                                alt="" /></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/images/sponsor/02-banca_popolare_di_novara.jpg"
                                alt="" /></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/sponsor/03-tvh.jpg"
                                alt="" /></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/images/sponsor/04-farmacie_celesia.jpg"
                                alt="" /></a></li>
                    <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/sponsor/05-mg.jpg"
                                alt="" /></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/images/sponsor/06-nordcom_vodafone.jpg"
                                alt="" /></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/images/sponsor/07-icorip_coatings.jpg"
                                alt="" /></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/images/sponsor/08-vc_engineering.jpg"
                                alt="" /></a></li>
                    <li><a href="#"><img
                                src="<?php echo get_template_directory_uri(); ?>/images/sponsor/09-color_box_center.jpg"
                                alt="" /></a></li>
                </ul>
            </div>
        </div>
    </section>

    <?php
    get_footer();
    ?>