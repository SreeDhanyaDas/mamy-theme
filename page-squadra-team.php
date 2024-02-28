<?php
/**
 * Template Name: Squadra Team
 */
get_header();
global $post;
$post_categories = get_the_category($post->ID);
$post_cat_slug = $post_categories[0]->slug;
$post_cat_name = $post_categories[0]->name;
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
            <h3 class="txt-advert animated">
                <?= $post_cat_name ?>
            </h3>
            <p class="txt-advert-sub">Squadra</p>
        </div>
    </div>

    <section id="players" class="secondary-page">
        <div class="general general-results players">

            <div class="top-score-title right-score row">
                <div class="container">
                    <div class="team-image">
                        <img src="https://placehold.it/820x360" alt="" />
                    </div>
                    <div class="players-container">
                        <?php
                        // Getting terms of the page for displaying corresponding sp_league
                        $terms = get_terms(
                            array(
                                'taxonomy' => 'category',
                                'hide_empty' => false,
                            )
                        );

                        foreach ($terms as $term) {
                            if ($post_cat_slug == $term->slug) {
                                $cat_slug = $post_cat_slug;
                            }
                        }

                        $query = new WP_Query(
                            array(
                                'post_type' => 'sp_player',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'order' => 'ASC',
                                'orderby' => 'meta_value_num',
                                'meta_key' => 'sp_number',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'sp_league',
                                        'field' => 'slug',
                                        'terms' => $cat_slug
                                    )
                                )
                            )
                        );

                        $i = 0;

                        if ($query->have_posts()) { ?>
                            <?php while ($query->have_posts()) {
                                $query->the_post();
                                if (has_post_thumbnail()) {
                                    $news_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                    $player_image = $news_image[0];
                                } else {
                                    $player_image = get_template_directory_uri() . '/images/player/face.jpg';
                                }
                                $post_meta = get_post_meta(get_the_ID());
                                $post_id = get_the_ID();

                                $post_slug = get_post_field('post_name', $post_id);

                                $taxonomy = 'sp_position';
                                $terms = get_the_terms($post_id, $taxonomy);
                                if ($terms && !is_wp_error($terms)) {
                                    $term = reset($terms);
                                    $term_name = $term->name;
                                } ?>

                                <div class="players-data col-md-3">
                                    <div class="players-list">
                                        <div class="player-rank">
                                            <span>
                                                <?= $post_meta['sp_number'][0] ?>
                                            </span>
                                        </div>
                                        <div class="player-name ">
                                            <span class="player_name">
                                                <?= the_title() ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            <?php }
                            wp_reset_query();
                        } else { ?>
                            <div class="col-md-12">
                                <div class="alert alert-danger" style='margin: 70px 0 70px 0;' role="alert">
                                    No Result Found!
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div><!--Close Top Match-->
            <div class="col-md-3 right-column">
            </div>
    </section>

    <?php
    get_footer();
