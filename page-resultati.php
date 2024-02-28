<?php
/**
 * Template Name: Resultati
 */
get_header();
global $post;
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
            <h3 class="txt-advert animated">RISULTATI</h3>
            <p class="txt-advert-sub">
                <?= $post_cat_name ?>
            </p>
        </div>
    </div>

    <section class="scores_table_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8 risultati-area">
                    <div class="top-score-title title_align_left">
                        <h3>RISULTATI PARTITE</h3>
                    </div>
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
                    
                    
                    $today = date('Y-m-d');
                    $lastgame_args = array(
                        'post_type' => 'sp_event',
                        // 'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'sp_league',
                                'field' => 'slug',
                                'terms' => $cat_slug
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


                    $nextgame_list = array(); // Initialize an empty array to store post data
                    

                    if ($last_game->have_posts()) {
                        while ($last_game->have_posts()) {
                            $last_game->the_post();
                            $postID = get_the_ID();
                            $post_data = get_post($postID);
                            $post_date_time = new DateTime($post_data->post_date);
                            $post_date_formatted = $post_date_time->format('d/m/y');

                            // Get the post data you need and store it in an array
                            $post_meta = get_post_meta($postID);
                            // $teamsToCheck = array(1241, 1637, 1653, 1759, 1943, 2003, 2010, 2043, 2058);
                            $teamsToCheck = get_option('game_results_list');
                            if (count(array_intersect($teamsToCheck, $post_meta['sp_team'])) > 0) {
                                $sp_result = unserialize($post_meta['sp_results'][0]);
                                $sp_result_team1 = $sp_result[$post_meta['sp_team'][0]];
                                $sp_result_team2 = $sp_result[$post_meta['sp_team'][1]];

                                $team_1 = get_the_title($post_meta['sp_team'][0]);
                                $team_2 = get_the_title($post_meta['sp_team'][1]);
                                $next1_game = wp_get_attachment_image_src(get_post_thumbnail_id($post_meta['sp_team'][0]), 'full');
                                $team_1_logo = $next1_game[0];
                                $next2_game = wp_get_attachment_image_src(get_post_thumbnail_id($post_meta['sp_team'][1]), 'full');
                                $team_2_logo = $next2_game[0];

                                $ar_id = $post_meta['articles'][0];
                                $ar_slug = basename(get_permalink($ar_id));


                                if ($ar_id && $ar_slug != "no-articles") {
                                    $article_categories = get_the_category($ar_id);
                                    $article_cat_slug = $article_categories[0]->slug;
                                    $article_url = get_permalink($ar_id) . "?type=$article_cat_slug";
                                } elseif ($ar_slug == "no-articles") {
                                    $article_url = "#";
                                } else {
                                    $article_url = "#";
                                }

                                // Get terms from the 'news_category' taxonomy
                                $terms = get_terms(
                                    array(
                                        'taxonomy' => 'gm_results',
                                        'hide_empty' => false,
                                    )
                                );
                                // Check if terms were retrieved successfully
                                if (!empty($terms) && !is_wp_error($terms)) {
                                    foreach ($terms as $term) {
                                        $team_1_slug = get_post_field('post_name', $post_meta['sp_team'][0]);
                                        $team_2_slug = get_post_field('post_name', $post_meta['sp_team'][1]);
                                        if ($term->slug == $team_1_slug) {
                                            $category_slug = $term->slug;
                                        } else if ($term->slug == $team_2_slug) {
                                            $category_slug = $term->slug;
                                        }
                                    }
                                } else {
                                    $category_slug = "";
                                }

                                $match_day = $post_meta['sp_day'][0];

                                $post_data = array(
                                    'post_id' => $postID,
                                    'post_title' => get_the_title(),
                                    'post_meta' => $post_meta,
                                    'post_date' => $post_date_formatted,
                                    'team1_name' => $team_1,
                                    'team2_name' => $team_2,
                                    'team1_logo' => $team_1_logo,
                                    'team2_logo' => $team_2_logo,
                                    'sp_result_team1' => $sp_result_team1,
                                    'sp_result_team2' => $sp_result_team2,
                                    'sp_team' => $post_meta['sp_team'],
                                    'category_slug' => $category_slug,
                                    'article_url' => $article_url,
                                    'match_day' => $match_day,
                                    // Add more data as needed
                                );
                                $nextgame_list[] = $post_data;
                                // }
                            }
                            // Add the post data to the array
                        }
                        wp_reset_query();
                    }

                    $columnsToShow = 3;

                    // echo "<pre>";
                    // print_r($nextgame_list);
                    // echo "<pre>";
                    
                    // Display images up to the specified limit
                    $displayedList = array_slice($nextgame_list, 0, $columnsToShow);
                    ?>

                    <div class="group_table_block">
                        <?php if ($displayedList) {
                            foreach ($displayedList as $gamelist) {
                                $game_result = get_post_meta($gamelist['post_id'], 'sp_results', true);
                                ?>
                                <div class="each_group_tbl" style="margin-bottom:50px">
                                    <div class="head_block">
                                        <h2>
                                            <?= $gamelist['match_day'] ?>
                                        </h2>
                                        <span>
                                            <?= $gamelist['post_date'] ?>
                                        </span>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2"></th>
                                                <th>1&#176;Q</th>
                                                <th>2&#176;Q</th>
                                                <th>3&#176;Q</th>
                                                <th>4&#176;Q</th>
                                                <th>TOT.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?= $gamelist['team1_name'] ?>
                                                </td>
                                                <td class="logo-imag"><img src="<?= $gamelist['team1_logo'] ?>"
                                                        class='TeamImage_logo' alt="TeamImage" /></td>
                                                <td class="cont-numbers">
                                                    <?= $gamelist['sp_result_team1']['one'] ?>
                                                </td>
                                                <td class="cont-numbers">
                                                    <?= $gamelist['sp_result_team1']['two'] ?>
                                                </td>
                                                <td class="cont-numbers">
                                                    <?= $gamelist['sp_result_team1']['three'] ?>
                                                </td>
                                                <td class="cont-numbers">
                                                    <?= $gamelist['sp_result_team1']['four'] ?>
                                                </td>
                                                <td class="cont-points">
                                                    <?= $gamelist['sp_result_team1']['points'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?= $gamelist['team2_name'] ?>
                                                </td>
                                                <td class="logo-imag"><img src="<?= $gamelist['team2_logo'] ?>"
                                                        class='TeamImage_logo' alt="TeamImage" /></td>
                                                <td class="cont-numbers">
                                                    <?= $gamelist['sp_result_team2']['one'] ?>
                                                </td>
                                                <td class="cont-numbers">
                                                    <?= $gamelist['sp_result_team2']['two'] ?>
                                                </td>
                                                <td class="cont-numbers">
                                                    <?= $gamelist['sp_result_team2']['three'] ?>
                                                </td>
                                                <td class="cont-numbers">
                                                    <?= $gamelist['sp_result_team2']['four'] ?>
                                                </td>
                                                <td class="cont-points">
                                                    <?= $gamelist['sp_result_team2']['points'] ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div class="sec_bottom">
                                        <a class="i-ico" href="<?= $gamelist['article_url'] ?>">
                                            <i class="fa fa-angle-double-right"></i>
                                            DETTAGLI
                                        </a>
                                    </div>
                                </div>

                            <?php }
                        } else { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" style='margin: 70px 0 70px 0;' role="alert">
                                        No Result Found!
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Add the following script to your page or enqueue it in your theme -->
                        <script>
                            jQuery(document).ready(function ($) {
                                var columnsToShow = 3;
                                var totalItems = <?php echo count($nextgame_list); ?>;
                                var itemsDisplayed = <?php echo $columnsToShow; ?>;

                                $('.load_more_btn').on('click', function (e) {
                                    e.preventDefault();

                                    var displayLimit = itemsDisplayed + columnsToShow;
                                    var displayedItems = <?php echo json_encode($nextgame_list); ?>.slice(itemsDisplayed, displayLimit);

                                    if (displayedItems.length > 0) {
                                        $.each(displayedItems, function (index, gamelist) {
                                            console.log(gamelist)
                                            console.log(gamelist['post_title'])
                                            $('.group_table_block').append('<div class="each_group_tbl" style="margin-bottom:50px"><div class="head_block">'
                                                // + '<h2>' + gamelist['post_date'] + '</h2> '
                                                + '<h2>' + gamelist['match_day'] + '</h2> <span>' + gamelist['post_date'] + ' </span> </h2> '
                                                + '</div><table class="table">'
                                                + '<thead>'
                                                + '<tr>'
                                                + '<th colspan="2"></th>'
                                                + '<th>1&#176;Q</th>'
                                                + '<th>2&#176;Q</th>'
                                                + '<th>3&#176;Q</th>'
                                                + '<th>4&#176;Q</th>'
                                                + '<th>TOT.</th>'
                                                + '</tr>'
                                                + '</thead>'
                                                + '<tbody>'
                                                + '    <tr>'
                                                + '        <td>' + gamelist['team1_name'] + '</td>'
                                                + '        <td class="logo-imag" ><img src="' + gamelist['team1_logo'] + '" class="TeamImage_logo" alt="TeamImage" /></td>'
                                                + '        <td class="cont-numbers">' + gamelist['sp_result_team1']['one'] + '</td>'
                                                + '        <td class="cont-numbers">' + gamelist['sp_result_team1']['two'] + '</td>'
                                                + '        <td class="cont-numbers">' + gamelist['sp_result_team1']['three'] + '</td>'
                                                + '        <td class="cont-numbers">' + gamelist['sp_result_team1']['four'] + '</td>'
                                                + '        <td class="cont-points">' + gamelist['sp_result_team1']['points'] + '</td>'
                                                + '    </tr>'
                                                + '    <tr>'
                                                + '        <td>' + gamelist['team2_name'] + '</td>'
                                                + '        <td class="logo-imag"><img src="' + gamelist['team2_logo'] + '" class="TeamImage_logo" alt="TeamImage" /></td>'
                                                + '        <td class="cont-numbers">' + gamelist['sp_result_team2']['one'] + '</td>'
                                                + '        <td class="cont-numbers">' + gamelist['sp_result_team2']['two'] + '</td>'
                                                + '        <td class="cont-numbers">' + gamelist['sp_result_team2']['three'] + '</td>'
                                                + '        <td class="cont-numbers">' + gamelist['sp_result_team2']['four'] + '</td>'
                                                + '        <td class="cont-points">' + gamelist['sp_result_team2']['points'] + '</td>'
                                                + '    </tr>'
                                                + '    </tbody>'
                                                + '    </table>'
                                                + '<div class="sec_bottom">'
                                                + '    <a class="i-ico" href="' + gamelist['article_url'] + '">'
                                                + '        <i class="fa fa-angle-double-right"></i>'
                                                + '        MORE'
                                                + '    </a>'
                                                + '</div>'
                                                + '</div>');
                                        });

                                        itemsDisplayed = displayLimit;

                                        if (itemsDisplayed >= totalItems) {
                                            $('.load_more_btn').hide();
                                        }
                                    }
                                });
                            });
                        </script>

                    </div>
                    <?php if ($nextgame_list && count($nextgame_list) > 3) { ?>
                        <button class="load_more_btn">ALTRI RISULTATI</button>
                    <?php } ?>
                </div>
                <div class="col-md-3">
                    <div class="top-score-title title_align_left">
                        <h3>ULTIME NEWS</h3>
                    </div>
                    <?php
                   
                    $no_articles_post = get_page_by_path('no-articles', OBJECT, 'news');
                    // Check if the post with the slug 'no-articles' exists
                    if ($no_articles_post) {
                        $no_articles_post_id = $no_articles_post->ID;

                        $query = new WP_Query(
                            array(
                                'post_type' => 'news',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'order' => 'DESC',
                                'post__not_in' => array($no_articles_post_id),
                            )
                        );
                        // Rest of your loop or processing logic here
                    }
                    ?>
                    <div class="news_lists">
                        <?php $i = 0;
                        while ($query->have_posts()) {
                            $query->the_post();
                            $description = get_the_content();
                            $trimmed_description = wp_trim_words($description, 15, '...');
                            $news_categories = get_the_category(get_the_ID());
                            $news_cat_slug = $news_categories[0]->slug;

                            ?>
                            <div class="each_news">
                                <h3>
                                    <?= get_the_title() ?>
                                </h3>
                                <p>
                                    <?= $trimmed_description ?>
                                </p>
                                <a href="<?php echo get_permalink(get_the_ID()); ?>?type=<?= $news_cat_slug ?>"> <i
                                        class="fa fa-angle-double-right"></i> CONTINUA...</a>
                            </div>

                            <?php
                        }
                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<?php
get_footer();
