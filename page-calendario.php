<?php
/**
 * Template Name: Calendario
 */
get_header();
global $post;
// Set the Italian locale
setlocale(LC_TIME, "it_IT");

$post_categories = get_the_category($post->ID);
$post_cat_slug = $post_categories[0]->slug;
$post_cat_term_id = $post_categories[0]->term_id;
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
            <h3 class="txt-advert animated">Calendario 2023/2024</h3>
            <p class="txt-advert-sub animated">Tutte le partite della stagione</p>
        </div>
    </div>
    <section id="summary" class="container secondary-page">
        <div class="general general-results tournaments">
            <?php
            $months = array('January' => 'GENNAIO', 'February' => 'FEBBRAIO', 'March' => 'MARZO', 'April' => 'APRILE', 'May' => 'MAGGIO', 'June' => 'GIUGNO', 'July' => 'LUGLIO', 'August' => 'AGOSTO', 'September' => 'SETTEMBRE', 'October' => 'OTTOBRE', 'November' => 'NOVEMBRE', 'December' => 'DICEMBRE');
            // Set the date range
            $start_date = '2023-01-01';
            $end_date = '2024-12-31';

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

            $standing_category = array();
            $standing_categories = get_option('standing_categories');

            foreach ($standing_categories as $category) {
                if ($post_cat_slug == $category['parent_standings']) {
                    $standing_category = $category['sub_standing'];
                    array_push($standing_category, $category['parent_standings']);
                }else {
                    array_push($standing_category, $post_cat_slug);
                }
            }
            
            $query = new WP_Query(
                array(
                    'post_type' => 'sp_event',
                    'post_status' => 'future',
                    'posts_per_page' => -1,
                    'order' => 'DESC',
                    'orderby' => array(
                        'date' => 'ASC', // Order by date in ascending order
                        'year' => 'DESC', // Order by year in descending order
                    ),
                    'date_query' => array(
                        'after' => $start_date,
                        'before' => $end_date,
                        'inclusive' => true,
                    ),
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'sp_league',
                            'field' => 'slug',
                            'terms' => $standing_category,
                        ),

                    ),
                )
            );


            $i = 0;
            $calendar_array = array();
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $postID = get_the_ID();

                    $post_meta = get_post_meta($postID);
                    $post_data = get_post($postID);
                    $description = get_the_content();
                    $venue_term = get_the_terms($postID, 'sp_venue');
                    $post_date_time = new DateTime($post_data->post_date);
                    $post_date = $post_date_time->format('j F Y');
                    $formatted_date = strftime('%e %B %Y', strtotime($post_date));
                    $formattedDate = mb_convert_case($formatted_date, MB_CASE_TITLE, "UTF-8");
                    if ($description) {

                        $trimmed_description = substr($description, 0, 100) . '...';
                    } else {
                        $trimmed_description = '____';
                    }
                    $month_name = date('F', strtotime($post_data->post_date));

                    foreach ($months as $key => $value) {
                        // $teamsToCheck = array(1241, 1637, 1653, 1759, 1943, 2003, 2010, 2043, 2058);
                        $teamsToCheck = get_option('game_results_list');
                        if ($post_cat_slug !== 'aquilotti-big' && $post_cat_slug !== 'aquilotti-small' && $post_cat_slug !== 'scoiattoli' && $post_cat_slug !== 'pulcini') {

                            if (count(array_intersect($teamsToCheck, $post_meta['sp_team'])) > 0) {
                                if ($key == $month_name) {
                                    $found = false;
                                    $team_1_title = get_the_title($post_meta['sp_team'][0]);
                                    $team_2_title = get_the_title($post_meta['sp_team'][1]);
                                    $match_day = $post_meta['sp_day'][0];

                                    // Check if the month key already exists in $calendar_array
                                    foreach ($calendar_array as &$existingData) {
                                        $formatted_date = strftime('%e %B %Y', strtotime($post_date));
                                        $formatted_date = ucfirst($formatted_date);
                                        if (array_key_exists($value, $existingData)) {

                                            // Month key already exists, add data to the existing array
                                            $existingData[$value][] = array(
                                                "post_id" => $postID,
                                                "post_title" => get_the_title(),
                                                "post_date" => $formattedDate,
                                                "team_1_title" => $team_1_title,
                                                "team_2_title" => $team_2_title,
                                                "match_day" => $match_day,
                                                "post_time" => get_the_time(),
                                                "post_venue" => $venue_term[0]->name,
                                                "post_content" => $trimmed_description,
                                            );
                                            $found = true;
                                            break;
                                        }
                                    }
                                    if (!$found) {
                                        // Month key doesn't exist, create a new array for the month
                                        $new_data_array = array(
                                            $value => array(
                                                array(
                                                    "post_id" => $postID,
                                                    "post_title" => get_the_title(),
                                                    "post_date" => $formattedDate,
                                                    "postDate" => $post_date,
                                                    "team_1_title" => $team_1_title,
                                                    "team_2_title" => $team_2_title,
                                                    "match_day" => $match_day,
                                                    "post_time" => get_the_time(),
                                                    "post_venue" => $venue_term[0]->name,
                                                    "post_content" => $trimmed_description,
                                                ),
                                            ),
                                        );
                                        array_push($calendar_array, $new_data_array);
                                    }
                                }
                            }
                        } else {
                            if ($key == $month_name) {
                                $found = false;
                                $team_1_title = get_the_title($post_meta['sp_team'][0]);
                                $team_2_title = get_the_title($post_meta['sp_team'][1]);
                                $match_day = $post_meta['sp_day'][0];

                                // Check if the month key already exists in $calendar_array
                                foreach ($calendar_array as &$existingData) {
                                    $formatted_date = strftime('%e %B %Y', strtotime($post_date));
                                    $formatted_date = ucfirst($formatted_date);
                                    if (array_key_exists($value, $existingData)) {

                                        // Month key already exists, add data to the existing array
                                        $existingData[$value][] = array(
                                            "post_id" => $postID,
                                            "post_title" => get_the_title(),
                                            "post_date" => $formattedDate,
                                            "team_1_title" => $team_1_title,
                                            "team_2_title" => $team_2_title,
                                            "match_day" => $match_day,
                                            "post_time" => get_the_time(),
                                            "post_venue" => $venue_term[0]->name,
                                            "post_content" => $trimmed_description,
                                        );
                                        $found = true;
                                        break;
                                    }
                                }
                                if (!$found) {
                                    // Month key doesn't exist, create a new array for the month
                                    $new_data_array = array(
                                        $value => array(
                                            array(
                                                "post_id" => $postID,
                                                "post_title" => get_the_title(),
                                                "post_date" => $formattedDate,
                                                "postDate" => $post_date,
                                                "team_1_title" => $team_1_title,
                                                "team_2_title" => $team_2_title,
                                                "match_day" => $match_day,
                                                "post_time" => get_the_time(),
                                                "post_venue" => $venue_term[0]->name,
                                                "post_content" => $trimmed_description,
                                            ),
                                        ),
                                    );
                                    array_push($calendar_array, $new_data_array);
                                }
                            }

                        }
                    }

                }
                wp_reset_query();
            }

            $current_page_id = get_the_ID();
            $parent_category = get_post_meta($current_page_id, 'parent_category', true);

            ?>
            <div id="c-calend" class="top-score-title right-score col-md-12"
                style="margin-top:60px; margin-bottom:60px">
                <?php if ($calendar_array) { ?>
                    <?php $i = 1;
                    foreach ($calendar_array as $value) { ?>
                        <div class="accordion" id="section<?= $i ?>"><i class="fa fa-calendar-o"></i>
                            <?= key($value) ?><span></span>
                        </div>
                        <div class="acc-content">
                            <div class="col-md-2 acc-title">DATA</div>
                            <div class="col-md-2 acc-title">ORARIO</div>
                            <div class="col-md-2 acc-title">CASA</div>
                            <div class="col-md-2 acc-title">OSPITI</div>
                            <div class="col-md-2 acc-title">LUOGO</div>
                            <div class="col-md-2 acc-title">DESCRIZIONE</div>
                            <?php
                            // Sort the entries by dates
                            // usort($value[key($value)], 'compareDates');
                            foreach ($value[key($value)] as $entry) {
                                ?>
                                <div class="col-md-2 t1">
                                    <p>
                                        <?= $entry['post_date'] ?>
                                    </p>
                                </div>
                                <div class="col-md-2 t2">
                                    <p>
                                        <?= $entry['post_time'] ?>
                                    </p>
                                </div>
                                <div class="col-md-2 t3">
                                    <p>
                                        <?= $entry['team_1_title'] ?>
                                    </p>
                                </div>
                                <div class="col-md-2 t4">
                                    <p>
                                        <?= $entry['team_2_title'] ?>
                                    </p>
                                </div>
                                <div class="col-md-2 t5">
                                    <p>
                                        <!-- <a href="#" target="_blank"> -->
                                        <?= $entry['post_venue'] ?>
                                        <!-- </a> -->
                                    </p>
                                </div>
                                <div class="col-md-2 t6">
                                    <p>
                                        <?= $entry['match_day'] ?>
                                    </p>
                                </div>
                                <div class="acc-footer"></div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php $i++;
                    } ?>
                <?php } else { ?>
                    <div class="col-md-12">
                        <div class="alert alert-danger" style='margin: 70px 0 70px 0;' role="alert">
                            No Result Found!
                        </div>
                    </div>
                <?php } ?>
            </div>
    </section>
    <?php

    get_footer();
    ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.accordion.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(function () {
                "use strict";
                $('.accordion').accordion({ defaultOpen: 'section1' }); //some_id section1 in demo
            });
        });
    </script>