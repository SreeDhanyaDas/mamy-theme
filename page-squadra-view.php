<?php
/**
 * Template Name: Squadra View
 */
get_header();
global $post;
$post_categories = get_the_category($post->ID);
$post_cat_slug = $post_categories[0]->slug;
$post_cat_term_id = $post_categories[0]->term_id;
$post_cat_name = $post_categories[0]->name;

$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// Parse the URL to extract its components
$urlComponents = parse_url($actual_link);
if (isset($urlComponents['query'])) {
    // Split the query string into key-value pairs
    parse_str($urlComponents['query'], $queryParameters);
    // Check if the desired value exists in the parameters
    if (isset($queryParameters['view'])) {

        $slug = $_GET['view'];
        $cat_slug = $_GET['type'];
        $sp_league_term = get_term_by('slug', $cat_slug, 'sp_league');
        $sp_league_name = $sp_league_term->name;

        $post_data = get_page_by_path($slug, OBJECT, 'sp_player');

        $player_ID = $post_data->ID;
        $player_name = get_the_title($player_ID);
        $player_meta = get_post_meta($player_ID);

        $sp_metrics = unserialize($player_meta['sp_metrics'][0]);

        $player_height = $sp_metrics['height'];

        $_year = get_field('birthday_year', $player_ID);
        $player_byear = date('Y', strtotime($_year));

        $taxonomy = 'sp_position';
        $player_terms = get_the_terms($player_ID, $taxonomy);
        if ($player_terms && !is_wp_error($player_terms)) {
            $player_term = reset($player_terms);
            $player_term_name = $player_term->name;
        }

        $_image_player = wp_get_attachment_image_src(get_post_thumbnail_id($player_ID), 'full');
        if ($_image_player) {
            $_player_image = $_image_player[0];
        } else {
            $_player_image = get_template_directory_uri() . '/images/player/face.jpg';
        }


        if ($player_height) {
            $_height = $player_height . ' cm';
        } else {
            $_height = 'VUOTA';
        }

        if ($player_byear) {
            $_year = $player_byear;
        } else {
            $_year = 'VUOTA';
        }

        $player_team = $player_meta['sp_current_team'];

        // list based on selected player
        $query = new WP_Query(
            array(
                'post_type' => 'sp_player',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'meta_value_num',
                'meta_key' => 'sp_number',
                'meta_query' => array(
                    array(
                        'key' => 'sp_current_team',
                        'value' => (array) $player_team,  // Assuming $player_team is an array of team IDs
                        'compare' => 'IN',
                    ),
                ),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'sp_league',
                        'field' => 'slug',
                        'terms' => $cat_slug
                    )
                )
            )
        );

        $list_player = array();
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $_ID = get_the_ID();
                $_postData = get_post_meta($_ID);
                $sp_current_team = $_postData['sp_current_team'];
                $post_meta = get_post_meta(get_the_ID());
                $sp_number = $post_meta['sp_number'][0];

                $_playerimage = wp_get_attachment_image_src(get_post_thumbnail_id($_ID), 'full');
                if ($_playerimage) {
                    $playerImage = $_playerimage[0];
                } else {
                    $playerImage = get_template_directory_uri() . '/images/player/face.jpg';
                }
                $_birthyear = get_field('birthday_year', $_ID);
                $player_birthyear = date('Y', strtotime($_birthyear));

                $_sp_metrics = unserialize($post_meta['sp_metrics'][0]);

                $_player_height = $_sp_metrics['height'];

                if ($_player_height) {
                    $height = $_player_height . ' cm';
                } else {
                    $height = 'VUOTA';
                }

                $taxonomy = 'sp_position';
                $terms = get_the_terms($_ID, $taxonomy);
                if ($terms && !is_wp_error($terms)) {
                    $term = reset($terms);
                    $term_name = $term->name;
                }

                $_list = array(
                    'id' => get_the_ID(),
                    'name' => get_the_title(),
                    'number' => $sp_number,
                    'image' => $playerImage,
                    'year' => $player_birthyear,
                    'height' => $height,
                    'term_name' => $term_name,
                    'team' => $sp_current_team,
                    'cat_slug' => $cat_slug,
                );

                array_push($list_player, $_list);
            }
            wp_reset_query();
        }
        
        ?>
        <section class="player-view-details">
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
                        <?= $sp_league_name ?>
                    </h3>
                    <p class="txt-advert-sub">DETTAGLIO SCHEDA</p>
                </div>
            </div>
            <section id="players-view" class="players-secondary-page">
                <div class="container">
                    <div class="view-player row">
                        <div class="team-list col-md-12">
                            <button class="go-back-button">Indietro</button>
                            <div class="head-area">
                                <button class="reset-button">Ripristina</button>
                                <select class="players-select">
                                    <?php foreach ($list_player as $player): ?>
                                        <option class="players-option" value="<?= $player['id']; ?>" <?php echo ($player['id'] == $player_ID) ? 'selected' : ''; ?>>
                                            <span style="font-weight: bold;">
                                                <?= $player['number']; ?>.
                                            </span>
                                            <span style="font-weight: bold;">
                                                <?= $player['name']; ?>
                                            </span>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>
                        <div class="team-list-view">
                            <!-- <div class="col-md-12"> -->
                            <div class="col-md-3">
                                <div class="player-single-img">
                                    <img src="<?= $_player_image ?>" class="player-img" alt="PlayerImage" />
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="player-details">
                                    <h1 class="player-name">
                                        <?= $player_name ?>
                                    </h1>
                                    <table class="player-data">
                                        <tbody>
                                            <tr class="players_details">
                                                <td class="title"> NUMERO </td>
                                                <td class="content-data content-data-number">
                                                    <?= $player_meta['sp_number'][0] ?>
                                                </td>
                                            </tr>
                                            <tr class="players_details">
                                                <td class="title"> ANNO DI NASCITA </td>
                                                <td class="content-data content-data-year">
                                                    <?= $_year ?>
                                                </td>
                                            </tr>
                                            <tr class="players_details">
                                                <td class="title"> ALTEZZA </td>
                                                <td class="content-data content-data-height">
                                                    <?= $_height ?>
                                                </td>
                                            </tr>
                                            <tr class="players_details">
                                                <td class="title"> RUOLO </td>
                                                <td class="content-data content-data-team">
                                                    <?= $player_term_name ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </section>
        <?php }
} ?>
    <script>
        jQuery(document).ready(function ($) {
            // Save the initial state of the player details
            var initialPlayerDetails = {
                image: '<?= $_player_image ?>',
                name: '<?= $player_name ?>',
                number: '<?= $player_meta['sp_number'][0] ?>',
                year: '<?= $_year ?>',
                height: '<?= $_height ?>',
                term_name: '<?= $player_term_name ?>',
            };

            // Save the initial HTML of the select dropdown
            var initialSelectHTML = $('.players-select').html();

            // Save the list of players
            var playersData = <?php echo json_encode($list_player); ?>;

            // Add change event for "players-select" dropdown
            $('.players-select').on('change', function () {
                // Get the selected player ID
                var selectedPlayerId = $(this).val();

                // Find the index of the selected player in the playersData array
                var selectedIndex = playersData.findIndex(function (player) {
                    return player.id == selectedPlayerId;
                });

                // Log the selected index
                console.log('Selected Index:', selectedIndex);

                // Rest of your code to update player details based on the selected index
                var selectedPlayer = playersData[selectedIndex];
                console.log(selectedPlayer);

                // Update the player details
                $('.player-img').attr('src', selectedPlayer.image);
                $('.player-name').text(selectedPlayer.name);
                $('.content-data-number').text(selectedPlayer.number);
                $('.content-data-year').text(selectedPlayer.year);
                $('.content-data-height').text(selectedPlayer.height);
                $('.content-data-team').text(selectedPlayer.term_name);
            });

            // Add click event for "Reset" button
            $('.reset-button').on('click', function () {
                // Reset the select dropdown to its initial state
                $('.players-select').html(initialSelectHTML);

                // Restore the initial player details
                $('.player-img').attr('src', initialPlayerDetails.image);
                $('.player-name').text(initialPlayerDetails.name);
                $('.content-data-number').text(initialPlayerDetails.number);
                $('.content-data-year').text(initialPlayerDetails.year);
                $('.content-data-height').text(initialPlayerDetails.height);
                $('.content-data-team').text(initialPlayerDetails.term_name);
            });

            // Add click event for "Go Back" button
            $('.go-back-button').on('click', function () {
                // Use JavaScript to go back to the previous page in the browser's history
                window.history.back();
            });
        });
    </script>
</section>

<?php
get_footer();
