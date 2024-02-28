<?php
/**
 * Template Name: Sponsor
 */
get_header();
$post = get_post(get_the_ID());
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
            <h3 class="txt-advert animated">Sponsor</h3>
            <p class="txt-advert-sub animated">
                <?php echo wp_strip_all_tags($post->post_content); ?>
            </p>
        </div>
    </div>
    <?php

    $displayedSponsors = array(); // Array to keep track of displayed sponsors
    
    foreach (get_uf_repeater('sponser_image_files', 'option') as $sponser_images):
        extract($sponser_images);

        // Check if the sponsor has already been displayed
        if (!in_array($select_sponsor, array_column($displayedSponsors, 'sponsor_type')) && $select_sponsor != 'select') {

            $data_sponsor = array(
                'sponsor_type' => $select_sponsor,
                'sponsor_name' => get_sponsor_name($select_sponsor),
                'images' => array(), // Array to store images for the current sponsor
            );

            // Add the current image information to the sponsor's images array
            $data_sponsor['images'][] = array(
                'image' => $image,
                'sponsor_url' => $sponsor_url
            );

            // Add the entire sponsor data to the displayedSponsors array
            $displayedSponsors[] = $data_sponsor;
        } else {
            // Find the sponsor data in the displayedSponsors array
            $index = array_search($select_sponsor, array_column($displayedSponsors, 'sponsor_type'));

            // Add the current image information to the existing sponsor's images array
            $displayedSponsors[$index]['images'][] = array(
                'image' => $image,
                'sponsor_url' => $sponsor_url
            );
        }

    endforeach;

    // Function to get the sponsor name based on the sponsor type
    function get_sponsor_name($sponsor_type)
    {
        switch ($sponsor_type) {
            case "platinum-sponsor":
                return "Platinum";
            case "gold-sponsor":
                return "Gold";
            case "silver-sponsor":
                return "Silver";
            case "media-sponsor":
                return "Media";
            case "sponsor-tecnico":
                return "Tecnico";
            // Handle other cases if needed
        }
    }

    // Sort the array based on the desired order
    $order = array("Platinum", "Gold", "Tecnico", "Silver", "Media");
    usort($displayedSponsors, function ($a, $b) use ($order) {
        return array_search($a['sponsor_name'], $order) - array_search($b['sponsor_name'], $order);
    });
    // echo "<pre>";
    // print_r($displayedSponsors);
    // echo "</pre>";
    
    foreach ($displayedSponsors as $sponsor):
        ?>
        <div id="c-calend" class="top-score-title right-score col-md-12">
            <?php if ($sponsor['sponsor_type'] != 'sponsor-tecnico'): ?>
                <h3><span>
                        <?= $sponsor['sponsor_name'] ?>
                    </span> Sponsor<span class="point-little">.</span></h3>
            <?php endif; ?>
            <?php if ($sponsor['sponsor_type'] == 'sponsor-tecnico'): ?>
                <h3><span>Sponsor</span>
                    <?= $sponsor['sponsor_name'] ?><span class="point-little">.</span>
                </h3>
            <?php endif; ?>
        </div>
        <section id="sponsor" class="container">
            <!-- SECTION SPONSOR -->
            <div class="client-sport client-sport-nomargin">
                <div class="content-banner">
                    <ul class="sponsor second" id="owl-sponsor">
                        <?php
                        foreach ($sponsor['images'] as $image_data):
                            ?>
                            <li><a href="<?= $image_data['sponsor_url'] ?>" target="_blank"><img
                                        src="<?= $image_data['image'] ?>" alt="" /></a></li>
                            <?php

                        endforeach;
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    <?php endforeach; ?>

    <!-- <div id="c-calend" class="top-score-title right-score col-md-12"> -->
    <!-- <h3><span>ALL</span> Sponsors<span class="point-little">.</span></h3> -->
    <!-- </div> -->
    <!-- <section id="sponsor" class="container"> -->
    <!--SECTION SPONSOR-->
    <!-- <div class="client-sport client-sport-nomargin">
            <div class="content-banner">
                <ul class="sponsor second" id="owl-sponsor-normal">
                    <?php
                    // foreach (get_uf_repeater('sponser_image_files', 'option') as $sponser_images):
                    //     extract($sponser_images);
                    // if($select_sponsor == "normal-sponsor") {
                    ?>
                        <li><a href="<?php // echo $sponsor_url ?>" target="_blank"><img src="<?php //echo $image ?>"
                                    alt="" /></a></li>
                        <?php
                        // }						
                        // endforeach;
                        ?>
                </ul>
            </div>
        </div> -->
    <!-- </section> -->

    <?php
    get_footer();
