<?php
/**
 * Template Name: Staff View
 */
get_header();
global $post;

$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Parse the URL to extract its components
$urlComponents = parse_url($actual_link);

if(isset($urlComponents['query'])) {
    parse_str($urlComponents['query'], $queryParameters);

    if(isset($queryParameters['view'])) {
        $slug = $_GET['view'];
        $post_data = get_page_by_path($slug, OBJECT, 'sp_staff');

        $staff_ID = $post_data->ID;
        $staff_name = get_the_title($staff_ID);

        $descriptions = apply_filters('the_content', get_post_field('post_content', $staff_ID));
        if($descriptions) {
            $staff_description = wp_trim_words($descriptions, 500, '...');
        } else {
            $staff_description = '...';
        }
        $_image_staff = wp_get_attachment_image_src(get_post_thumbnail_id($staff_ID), 'full');
        $_staff_image = ($_image_staff) ? $_image_staff[0] : get_template_directory_uri().'/images/player/face.jpg';

        // Additional staff details (adjust these based on your data structure)
        $terms = wp_get_post_terms($staff_ID, 'sp_season');
        $term_name = $terms ? $terms[0]->name : '';

        $list_staff = array();

        $query = new WP_Query(
            array(
                'post_type' => 'sp_staff',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'title',
            )
        );

        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                $_ID = get_the_ID();
                $_staffimage = wp_get_attachment_image_src(get_post_thumbnail_id($_ID), 'full');
                $staffImage = ($_staffimage) ? $_staffimage[0] : get_template_directory_uri().'/images/player/face.jpg';
                $terms = wp_get_post_terms($_ID, 'sp_season');
                $term_name = $terms ? $terms[0]->name : '';

                $_list = array(
                    'id' => $_ID,
                    'name' => get_the_title(),
                    'description' => get_the_content(),
                    'image' => $staffImage,
                    'term_name' => $term_name,
                    // Add additional fields as needed
                );
                array_push($list_staff, $_list);
            }
            wp_reset_query();
        }
    }
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
        <div class="effect-cover">
            <h3 class="txt-advert animated">
                <?= $cat_slug ?>
            </h3>
            <p class="txt-advert-sub">SCHEDA STAFF</p>
        </div>
    </div>
    <section id="players-view" class="players-secondary-page">
        <div class="container">
            <div class="view-player row">
                <div class="team-list col-md-12">
                    <button class="go-back-button">Indietro</button>
                    <div class="head-area">
                        <button class="reset-button">Ripristina</button>
                        <form method="post">
                            <select name="postTitle" class="players-select">
                                <?php foreach($list_staff as $staff): ?>
                                    <option class="players-option" value="<?= $staff['id']; ?>" <?= ($staff['id'] == $staff_ID) ? 'selected' : ''; ?>>
                                        <span style="font-weight: bold;">
                                            <?= $staff['name']; ?>
                                        </span>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </div>
                </div>
                <?php

                ?>
                <div class="team-list-view">
                    <!-- <div class="col-md-12"> -->
                    <div class="col-md-3">
                        <div class="player-single-img">
                            <img src="<?= $_staff_image ?>" class="player-img" alt="PlayerImage" />
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="staff-details">
                            <h1 class="player-name">
                                <?= $staff_name ?>
                            </h1>
                            <table class="player-data">
                                <tbody>
                                    <tr class="row-staff-data">
                                        <td class="staff-title"> STAGIONE </td>
                                        <td class="content-data_term content-data-term-name">
                                            <?= $term_name ?>
                                        </td>
                                    </tr>
                                    <tr class="row-staff-data">
                                        <td class="staff-title"> Descrizione </td>
                                        <td class="content-data_dec content-data-description" data-des="<?= $descriptions ?>">
                                            <?= $descriptions ?>
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
    <script>
        jQuery(document).ready(function ($) {
            // Save the initial state of the player details
            var initialPlayerDetails = {
                image: '<?= $_staff_image ?>',
                name: '<?= $staff_name ?>',
                term_name: '<?= $term_name ?>',
            };

            var dataDesValue = $('.content-data_dec').data('des');
                                 
            // Save the initial HTML of the select dropdown
            var initialSelectHTML = $('.players-select').html();

            // Save the list of players
            var playersData = <?php echo json_encode($list_staff); ?>;

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
                $('.content-data-term-name').text(selectedPlayer.term_name);
                $('.content-data-description').html(selectedPlayer.description);
            });

            // Add click event for "Reset" button
            $('.reset-button').on('click', function () {
                // Reset the select dropdown to its initial state
                $('.players-select').html(initialSelectHTML);
                // Restore the initial player details
                $('.player-img').attr('src', initialPlayerDetails.image);
                $('.player-name').text(initialPlayerDetails.name);
                $('.content-data-term-name').text(initialPlayerDetails.term_name);
                // $('.content-data-description').text(description);
                $('.content-data-description').html(dataDesValue);
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

