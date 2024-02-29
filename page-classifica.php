<?php
/**
 * Template Name: Classifica
 */
get_header();
global $post;
$post_categories = get_the_category($post->ID);
$post_cat_slug = $post_categories[0]->slug;
$post_cat_term_id = $post_categories[0]->term_id;
$post_cat_name = $post_categories[0]->name;


?>
<section class="scores_table_wrapper">
    <?php
    $page_banner_id = get_option('single_page_banner');
    $page_banner_url = wp_get_attachment_image_src($page_banner_id, 'full');
    $page_banner_image = $page_banner_url[0];
    ?>
    <div class="col-md-12 size-img back-img"
        style='background: url(<?= $page_banner_image ?>) no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'>

        <!-- <div class="col-md-12 size-img back-img"> -->
        <div class="effect-cover">
            <h3 class="txt-advert animated">CLASSIFICA</h3>
            <p class="txt-advert-sub">
                <?= $post_cat_name ?>
            </p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9">

                <div class="score_table_block">
                    <div class="table-responsive">
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
                                            
                        $args_ = array(
                            'post_type'      => 'sp_table', 
                            'post_status'    => 'publish',
                            'posts_per_page' => -1,
                            'orderby'        => 'title', 
                            'order'          => 'ASC',   // Specify ascending order (A to Z)
                        );
                        $spTable_args = array();
                        $postsData = get_posts($args_);

                        foreach ($postsData as $post) {
                            // setup_postdata( $post );
                            $parent_category = get_post_meta($post->ID, 'parent_category', true);
                            if ($parent_category && $parent_category == $post_cat_slug) {
                                $posts_sp = array('ID' => $post->ID, 'title' => $post->post_title);
                                array_push($spTable_args, $posts_sp);
                            }

                        }
                        
                        // Getting pages+-
                        $page_args = array(
                            'post_type' => 'page',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'slug',
                                    'terms' => $cat_slug,
                                ),
                            ),
                        );

                        $pages_query = new WP_Query($page_args);

                        $page_list = array();
                        $risultati_url = null;

                        if ($pages_query->have_posts()) {
                            while ($pages_query->have_posts()) {
                                $pages_query->the_post();
                                $pageID = get_the_ID();
                                $pageData = get_post($pageID);
                                // $page_list[] = $pageData; 
                                if ((strpos($pageData->post_name, 'risultati') !== false) || (strpos(get_the_title(), 'Risultati') !== false)) {
                                    $risultati_url = get_permalink(get_the_ID());
                                }
                                $datas = array(
                                    'post_title' => get_the_title(),
                                    'post_id' => get_the_ID(),
                                    'page_url' => get_permalink(get_the_ID()),
                                    'post_name' => $pageData->post_name,
                                    // 'posat_data' => $pageData
                                );
                                array_push($page_list, $datas);

                            }
                            wp_reset_postdata(); // Reset the post data to the main query
                        }
                        
                        $teams_args = array(
                            'post_type' => 'sp_table',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'sp_league',
                                    'field' => 'slug',
                                    'terms' => strval($cat_slug)
                                )
                            ),
                        );

                        $teams = new WP_Query($teams_args);

                        if ($teams->have_posts()) {
                            while ($teams->have_posts()) {
                                $teams->the_post();
                                $teams_ID = get_the_ID();
                                $teams_title = get_the_title();
                                $teams_post = get_post($teams_ID);
                                $parent_category = get_post_meta($teams_ID, 'parent_category', true);
                                $sub_sp_list = array();
                               
                                if($parent_category){
                                    ?>
                                    <div class="select-box">
                                        <form method="get">
                                            <select id="team-select" name="league_list" class="custom-select" onchange="this.form.submit()">
                                                <?php foreach ($spTable_args as $league) {
                                                    $selected = isset($_GET['league_list']) && $_GET['league_list'] == $league['ID'] ? 'selected' : '';
                                                    ?>
                                                    <option class="league_options" value="<?=$league['ID']?>" <?=$selected?>><?=$league['title']?></option>
                                                <?php } ?>
                                            </select>
                                        </form>
                                    </div>
                                    <?php
                                    if(isset($_GET['league_list'])){
                                        echo do_shortcode('[team_standings ' . $_GET['league_list'] . ']');
                                    } else {
                                        echo do_shortcode('[team_standings ' . get_the_ID() . ']');
                                    }
                                }else {
                                    echo do_shortcode('[team_standings ' . get_the_ID() . ']');
                                }

                            }
                        } ?>
                    </div>
                </div>
                <script>
                    function handleSelectChange(select) {
                        var selectedOption = select.value;
                        // You can use the selected option value to perform further actions
                        console.log('Selected option:', selectedOption);
                        // Assuming you want to change the ID of the select box
                        var newId = 'new-id-' + selectedOption;
                        select.id = newId;
                    }
                </script>

            </div>
            <?php 
            $today = date('Y-m-d');

            $league_category = NULL;
            if(isset($_GET['league_list'])){
                $selected_postID = $_GET['league_list'];
                $sp_league_terms = wp_get_post_terms($selected_postID, 'sp_league', array('fields' => 'slugs'));
                $league_category = $sp_league_terms[0];
               
            } else {
                $league_category = $cat_slug;
            }      

            $lastgame_args = array(
                'post_type' => 'sp_event',
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'sp_league',
                        'field' => 'slug',
                        'terms' => strval($league_category)
                    )
                ),
                'date_query' => array(
                    array(
                        'before' => $today,
                        'inclusive' => true,
                    ),
                ),
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
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
                    // $teamsToCheck = array(1241, 1653, 1759, 1943, 2003, 2010, 2043, 2058);
                    $teamsToCheck = get_option('game_results_list');
                    if (count(array_intersect($teamsToCheck, $post_meta['sp_team'])) > 0) {
                        $sp_result = unserialize($post_meta['sp_results'][0]);
                        $sp_result_team1 = $sp_result[$post_meta['sp_team'][0]];
                        $sp_result_team2 = $sp_result[$post_meta['sp_team'][1]];

                        $team_1 = get_the_title($post_meta['sp_team'][0]);
                        $team_2 = get_the_title($post_meta['sp_team'][1]);
                        $next1_game = wp_get_attachment_image_src(get_post_thumbnail_id($post_meta['sp_team'][0]), 'full');
                        $team_1_log = $next1_game[0];
                        $next2_game = wp_get_attachment_image_src(get_post_thumbnail_id($post_meta['sp_team'][1]), 'full');
                        $team_2_log = $next2_game[0];

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

                        $sp_players = unserialize($post_meta['sp_players'][0]);
                        $post_data = array(
                            'post_id' => $postID,
                            'post_title' => get_the_title(),
                            'team1_name' => $team_1,
                            'team2_name' => $team_2,
                            'team1_logo' => $team_1_log,
                            'team2_logo' => $team_2_log,
                            'sp_result_team1' => $sp_result_team1,
                            'sp_result_team2' => $sp_result_team2,
                            'sp_team' => $post_meta['sp_team'],
                            'sp_players' => $sp_players,
                            'article_url' => $article_url,
                            // Add more data as needed
                        );
                        $nextgame_list[] = $post_data;
                    }
                    // Add the post data to the array
                }
                wp_reset_query();
            } ?>
            <?php if ($nextgame_list) { ?>
                <div class="col-md-3">
                    <div class="top-score-title">
                        <h3>ULTIMI RISULTATI</h3>
                    </div>
                    <div class="teams_scoreboard">
                        <?php $i = 0;
                        foreach ($nextgame_list as $value) {
                            // echo "<prev>";
                            // print_r($value);
                            // echo "</prev>";
                            if ($i == 3) {
                                break;
                            } 
                            ?>
                            <div class="each_team_scores">
                                <a class="classifica-article" href="<?= $value['article_url'] ?>">
                                    <div class="teams_vs">
                                        <span><img src="<?= $value['team1_logo'] ?>" class="TeamImage" alt="TeamImage" /></span>
                                        <h2>VS</h2>
                                        <span><img src="<?= $value['team2_logo'] ?>" class="TeamImage" alt="TeamImage" /></span>
                                    </div>
                                    <div class="team_score_val">
                                        <span>
                                            <?= $value['sp_result_team1']['points'] ?>
                                        </span>
                                        <em>-</em>
                                        <span>
                                            <?= $value['sp_result_team2']['points'] ?>
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <?php $i++;
                        } 
                        ?>
                    </div>
                    <div class="readmore">
                        <a href="<?php echo $risultati_url; ?>" class="sg-more">
                            <button class="btn btn-default read-more-single">ALTRI RISULTATI</button>
                        </a>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
<?php

get_footer();
