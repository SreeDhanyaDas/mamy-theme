<?php
/**
 * Template Name: Photogallery
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
            <h3 class="txt-advert animated">Galleria foto</h3>
            <p class="txt-advert-sub">le foto di tutte le partite</p>
        </div>
    </div>
    <?php
    $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // Parse the URL to extract its components
    $urlComponents = parse_url($actual_link);
    if (isset($urlComponents['query'])) {
        // Split the query string into key-value pairs
        parse_str($urlComponents['query'], $queryParameters);
        // Check if the desired value exists in the parameters
        if (isset($queryParameters['view'])) {
            $slug = $_GET['view'];
            $post_data = get_page_by_path($slug, OBJECT, 'photo_gallery');
            $post_id = $post_data->ID;
            $post_title = get_the_title($post_id);
            $post_meta = get_post_meta($post_id);
            $gallery_images = unserialize($post_meta['gallery'][0]);
            $updated_gallery_images = array();

            foreach ($gallery_images as $images) {
                $imageID = $images['gallery_image'];
                $image_url = wp_get_attachment_image_src($imageID, 'full');
                $image = $image_url[0];
                $imageList = array('image_url' => $image);
                $updated_image_data = array_merge($images, $imageList);
                // $display_images =  $imageList;
                array_push($updated_gallery_images, $updated_image_data);
            }

            $columnsToShow = 8;

            // Display images up to the specified limit
            $displayedImages = array_slice($updated_gallery_images, 0, $columnsToShow);
            ?>
            <div id="video photo-gallery" class="container secondary-page" style="margin-bottom:30px">
                <div class="general general-results">
                    <div class="top-score-title">
                        <h3>
                            <?= $post_title ?>
                        </h3>
                        <div class="gallery">
                            <div class="container">
                                <div class="row d-flex">
                                    <?php foreach ($displayedImages as $image): ?>
                                        <div class="col-md-3 col-xs-3 other-video" style="margin-bottom:30px">
                                            <div class="lightbox_img_wrap">
                                                <img class="lightbox-enabled" src="<?= $image['image_url'] ?>"
                                                    data-imgsrc="<?= $image['image_url'] ?>">
                                                <i class="fa fa-camera"></i>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="lightbox-container">
                            <span class="material-symbols-outlined material-icons lightbox-btn left" id="left">
                                <i class="fa fa-chevron-left"></i>
                            </span>
                            <span class="material-symbols-outlined material-icons lightbox-btn right" id="right">
                                <i class="fa fa-chevron-right"></i>
                            </span>
                            <span id="close" class="close material-icons material-symbols-outlined">
                                <i class="fa fa-times"></i>
                            </span>
                            <div class="lightbox-image-wrapper">
                                <img alt="lightboximage" class="lightbox-image">
                            </div>
                        </div>

                        <?php if (count($gallery_images) > $columnsToShow): ?>
                            <div id="loadMoreButton" class="text-center">
                                <button class='load-more' id="loadMore">Mostra altre</button>
                                <!-- <button class='load-more' id="loadMore" onclick="loadMoreImages()">Load More</button> -->
                            </div>
                            <script>
                                jQuery(document).ready(function ($) {
                                    // Load More functionality
                                    var lightboxContainer = $('.lightbox-container');
                                    var lightboxEnabled = $('.lightbox-enabled');
                                    var lightboxImage = $('.lightbox-image');
                                    var lightboxBtns = $('.lightbox-btn');
                                    var lightboxBtnRight = $('#right');
                                    var loadMoreBtn = $('#loadMore');
                                    var close = $('#close');
                                    let activeImage;

                                    if (loadMoreBtn.length) {
                                        loadMoreBtn.on('click', function (e) {
                                            e.preventDefault();
                                            loadMoreImages();
                                        });
                                    }

                                    // Functions
                                    const showLightBox = () => { lightboxContainer.addClass('active'); }

                                    const hideLightBox = () => { lightboxContainer.removeClass('active'); }

                                    const setActiveImage = (image) => {
                                        lightboxImage.attr('src', image.data('imgsrc'));
                                        activeImage = lightboxEnabled.index(image);

                                        console.log('activeImage ' + activeImage);
                                    }

                                    console.log('length ' + lightboxEnabled.length);

                                    const transitionSlides = (direction) => {
                                        lightboxImage.addClass(direction === 'left' ? 'slideright' : 'slideleft');
                                        setTimeout(function () {
                                            const newIndex = (activeImage + (direction === 'left' ? -1 : 1) + lightboxEnabled.length) % lightboxEnabled.length;
                                            setActiveImage(lightboxEnabled.eq(newIndex));
                                        }, 250);

                                        setTimeout(function () {
                                            lightboxImage.removeClass('slideright slideleft');
                                        }, 500);
                                    }

                                    const transitionSlideHandler = (moveItem) => {
                                        moveItem.includes('left') ? transitionSlides('left') : transitionSlides('right');
                                    }

                                    // Event Listeners
                                    $(document).on('click', '.lightbox-enabled', function (e) {
                                        e.preventDefault();
                                        showLightBox();
                                        setActiveImage($(this));
                                    });

                                    lightboxContainer.on('click', function () { hideLightBox(); });

                                    close.on('click', function () { hideLightBox(); });

                                    lightboxBtns.on('click', function (e) {
                                        e.stopPropagation();
                                        transitionSlideHandler($(this).attr('id'));
                                    });

                                    lightboxImage.on('click', function (e) {
                                        e.stopPropagation();
                                    });

                                    // Refresh lightbox after loading more images
                                    function refreshLightbox() {
                                        lightboxEnabled = $('.lightbox-enabled');
                                        lastImage = lightboxEnabled.length - 1;
                                    }

                                    var galleryImages = <?= json_encode($updated_gallery_images) ?>;
                                    function loadMoreImages() {
                                        var additionalColumns = 8;
                                        var currentColumns = $('.other-video').length;
                                        var remainingImages = galleryImages.length - currentColumns;
                                        var columnsToShow = Math.min(currentColumns + additionalColumns, currentColumns + remainingImages);

                                        for (var i = currentColumns; i < columnsToShow; i++) {
                                            var image = galleryImages[i];
                                            var image_url = image['image_url'];

                                            var newImage = $('<div class="col-md-3 col-xs-3 other-video">\
                                                                    <div class="lightbox_img_wrap">\
                                                                        <img class="lightbox-enabled" src="' + image_url + '" data-imgsrc="' + image_url + '">\
                                                                        <i class="fa fa-camera"></i>\
                                                                    </div>\
                                                                    <div class="lightbox-image-wrapper">\
                                                                        <img alt="lightboximage" class="lightbox-image">\
                                                                    </div>\
                                                                </div>');

                                            $('.row.d-flex').append(newImage);

                                            // Add the new image to the lightbox
                                            lightboxEnabled = $('.lightbox-enabled');
                                        }

                                        if (columnsToShow === galleryImages.length) {
                                            if (loadMoreBtn.length) {
                                                loadMoreBtn.hide();
                                            }
                                        }
                                    }

                                    // Call this function after loading more images
                                    refreshLightbox();
                                });


                            </script>
                        <?php endif; ?>
                    </div><!--Close Top Match-->
                </div>
        </section>
        <?php
        }
    } else {
        ?>
    <section id="video" class="container secondary-page">
        <div class="general general-results">
            <div class="top-score-title col-md-9">
                <!-- <h3>SERIE C</h3> -->

                <?php
                $no_articles_gallery = get_page_by_path('no-gallery', OBJECT, 'photo_gallery');
                // Check if the post with the slug 'no-articles' exists
                if ($no_articles_gallery) {
                    $no_articles_gallery_id = $no_articles_gallery->ID;

                    $gallery_list = new WP_Query(
                        array(
                            'post_type' => 'photo_gallery',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'order' => 'DESC',
                            'post__not_in' => array($no_articles_gallery_id),
                        )
                    );
                    // Rest of your loop or processing logic here
                }

                $gallery_post = array();

                if ($gallery_list->have_posts()) {
                    while ($gallery_list->have_posts()) {
                        $gallery_list->the_post();
                        $postID = get_the_ID();
                        $slug = basename(get_permalink($postID));
                        $gallery_des = get_the_content();
                        $post_meta = get_post_meta($postID);
                        $gallery_images = unserialize($post_meta['gallery'][0]);

                        if (!empty($gallery_images)) {
                            $single_imdID = $gallery_images[0]['gallery_image'];
                            $single_image_url = wp_get_attachment_image_src($single_imdID, 'full');
                            $single_image = $single_image_url[0];
                        } else {
                            $single_image = 'http://placehold.it/624x428';
                        }
                        $trimmed_title = wp_trim_words(get_the_title(), 3, '...');

                        $gallery_post_viewURl = site_url() . "/photogallery?view=$slug";

                        $postData = array(
                            'id' => get_the_ID(),
                            'title' => get_the_title(),
                            'trimmed_title' => $trimmed_title,
                            'single_image' => $single_image,
                            'post_date' => get_the_date('j F, Y'),
                            'gallery_post_viewURl' => $gallery_post_viewURl,
                        );
                        array_push($gallery_post, $postData);
                    }
                    wp_reset_query();
                }
                $columnsToShowList = 6;
                // Display images up to the specified limit
            
                $displayedImagesList = array_slice($gallery_post, 0, $columnsToShowList);
                ?>

                <div class="video-desc-gallery">
                    <?php foreach ($displayedImagesList as $value): ?>
                        <div class="col-md-4 gallery-lists">
                            <div class="photogallery_list row">
                                <div class="col-md-12 other-videotitle">
                                    <p class="othervideo-date">
                                        <?= $value['post_date'] ?>
                                    </p>
                                    <p id="tooltip">
                                        <?= $value['trimmed_title'] ?>
                                    </p>
                                    <span class="tooltiptext">
                                        <?= $value['title'] ?>
                                    </span>
                                </div>
                                <a href="<?= $value['gallery_post_viewURl'] ?>">
                                    <div class="col-md-12 other-video">
                                        <img src="<?= $value['single_image'] ?>" class="gallery-image" />
                                        <i class="fa fa-camera"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if (count($gallery_post) > $columnsToShowList): ?>
                        <div id="loadMoreButtonList" class="text-center">
                            <button class='load-more' id='gallery_loadmore'>Mostra altre</button>
                        </div>

                        <script>
                            var galleryImagesList = <?= json_encode($gallery_post) ?>;


                            function LoadMoreGallery() {
                                console.log(galleryImagesList);
                                var additionalColumns = 6;
                                var currentColumns = document.querySelectorAll('.photogallery_list').length;
                                var remainingImages = galleryImagesList.length - currentColumns;
                                var columnsToShowList = Math.min(currentColumns + additionalColumns, currentColumns + remainingImages);

                                for (var i = currentColumns; i < columnsToShowList; i++) {
                                    var data = galleryImagesList[i];

                                    var newImageList = document.createElement("div");
                                    newImageList.className = "col-md-4 gallery-lists";
                                    newImageList.style.marginBottom = "30px";
                                    newImageList.innerHTML = '<div class="photogallery_list row"> <div class="col-md-12 other-videotitle">'
                                        + '<p class="othervideo-date">' + data['post_date'] + ' </p>'
                                        + '<p>' + data['trimmed_title'] + '</p>'
                                        + '<span  class="tooltiptext">' + data['title'] + '</span> </div>'
                                        + '<a href="' + data['gallery_post_viewURl'] + '">'
                                        + '<div class="col-md-12 other-video">'
                                        + '<img src="' + data['single_image'] + '" class="gallery-image" />'
                                        + '<i class="fa fa-camera"></i></div></a>'
                                        + '</div></div>';
                                    document.querySelector(".video-desc-gallery").appendChild(newImageList);
                                }

                                if (columnsToShowList === galleryImagesList.length) {
                                    document.getElementById("loadMoreButtonList").style.display = "none";
                                }
                            }

                            document.getElementById("gallery_loadmore").onclick = LoadMoreGallery;
                        </script>
                    <?php endif; ?>
                </div>


            </div><!--Close Top Match-->
            <div class="col-md-3 right-column">
                <div class="top-score-title col-md-12 right-title">
                    <h3>Ultime News</h3>
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

                    while ($query->have_posts()) {
                        $query->the_post();
                        $description = get_the_content();
                        $trimmed_description = wp_trim_words($description, 15, '...');
                        $news_categories = get_the_category(get_the_ID());
                        $news_cat_slug = $news_categories[0]->slug;
                        ?>
                        <div class="right-content">
                            <p class="news-title-right">
                                <?= get_the_title() ?>
                            </p>
                            <p class="txt-right">
                                <?= $trimmed_description ?>
                            </p>
                            <a href="<?php echo get_permalink(get_the_ID()); ?>?type=<?= $news_cat_slug ?>" class="ca-more"><i
                                    class="fa fa-angle-double-right"></i>continua...</a>
                        </div>
                        <?php
                    }
                    wp_reset_query();
                    ?>
                </div>
            </div>
    </section>
    <section id="sponsor" class="container">
        <!--SECTION SPONSOR-->
        <div class="client-sport client-sport-nomargin">
            <div class="content-banner">
                <ul class="sponsor second" id="owl-sponsor">
                    <?php
                    foreach (get_uf_repeater('sponser_image_files', 'option') as $sponser_images):
                        extract($sponser_images);
                        ?>
                        <li><a href="#"><img src="<?php echo $image ?>" alt="" /></a></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
    </section>
    <?php
    }
    ?>
</section>

<?php
get_footer();
?>