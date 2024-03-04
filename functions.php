<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if (version_compare($GLOBALS['wp_version'], '5.3', '<')) {
	require get_template_directory() . '/inc/back-compat.php';
}


function custom_admin_js()
{
	wp_enqueue_script('custom_wp_admin_js', get_template_directory_uri() . '/js/admin_section.js', false, '1.0.0');
	wp_enqueue_script('custom_wp_admin_js');
	wp_localize_script('custom_wp_admin_js', 'frontendajax', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('admin_enqueue_scripts', 'custom_admin_js');
add_action('wp_enqueue_scripts', 'custom_admin_js');

if (!function_exists('twenty_twenty_one_setup')) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup()
	{

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support('title-tag');

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1568, 9999);

		register_nav_menus(
			array(
				'primary' => esc_html__('Primary menu', 'twentytwentyone'),
				'footer' => esc_html__('Secondary menu', 'twentytwentyone'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height' => $logo_height,
				'width' => $logo_width,
				'flex-width' => true,
				'flex-height' => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Add support for editor styles.
		add_theme_support('editor-styles');


		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ($is_IE) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style($editor_stylesheet_path);

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name' => esc_html__('Extra small', 'twentytwentyone'),
					'shortName' => esc_html_x('XS', 'Font size', 'twentytwentyone'),
					'size' => 16,
					'slug' => 'extra-small',
				),
				array(
					'name' => esc_html__('Small', 'twentytwentyone'),
					'shortName' => esc_html_x('S', 'Font size', 'twentytwentyone'),
					'size' => 18,
					'slug' => 'small',
				),
				array(
					'name' => esc_html__('Normal', 'twentytwentyone'),
					'shortName' => esc_html_x('M', 'Font size', 'twentytwentyone'),
					'size' => 20,
					'slug' => 'normal',
				),
				array(
					'name' => esc_html__('Large', 'twentytwentyone'),
					'shortName' => esc_html_x('L', 'Font size', 'twentytwentyone'),
					'size' => 24,
					'slug' => 'large',
				),
				array(
					'name' => esc_html__('Extra large', 'twentytwentyone'),
					'shortName' => esc_html_x('XL', 'Font size', 'twentytwentyone'),
					'size' => 40,
					'slug' => 'extra-large',
				),
				array(
					'name' => esc_html__('Huge', 'twentytwentyone'),
					'shortName' => esc_html_x('XXL', 'Font size', 'twentytwentyone'),
					'size' => 96,
					'slug' => 'huge',
				),
				array(
					'name' => esc_html__('Gigantic', 'twentytwentyone'),
					'shortName' => esc_html_x('XXXL', 'Font size', 'twentytwentyone'),
					'size' => 144,
					'slug' => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black = '#000000';
		$dark_gray = '#28303D';
		$gray = '#39414D';
		$green = '#D1E4DD';
		$blue = '#D1DFE4';
		$purple = '#D1D1E4';
		$red = '#E4D1D1';
		$orange = '#E4DAD1';
		$yellow = '#EEEADD';
		$white = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name' => esc_html__('Black', 'twentytwentyone'),
					'slug' => 'black',
					'color' => $black,
				),
				array(
					'name' => esc_html__('Dark gray', 'twentytwentyone'),
					'slug' => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name' => esc_html__('Gray', 'twentytwentyone'),
					'slug' => 'gray',
					'color' => $gray,
				),
				array(
					'name' => esc_html__('Green', 'twentytwentyone'),
					'slug' => 'green',
					'color' => $green,
				),
				array(
					'name' => esc_html__('Blue', 'twentytwentyone'),
					'slug' => 'blue',
					'color' => $blue,
				),
				array(
					'name' => esc_html__('Purple', 'twentytwentyone'),
					'slug' => 'purple',
					'color' => $purple,
				),
				array(
					'name' => esc_html__('Red', 'twentytwentyone'),
					'slug' => 'red',
					'color' => $red,
				),
				array(
					'name' => esc_html__('Orange', 'twentytwentyone'),
					'slug' => 'orange',
					'color' => $orange,
				),
				array(
					'name' => esc_html__('Yellow', 'twentytwentyone'),
					'slug' => 'yellow',
					'color' => $yellow,
				),
				array(
					'name' => esc_html__('White', 'twentytwentyone'),
					'slug' => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name' => esc_html__('Purple to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug' => 'purple-to-yellow',
				),
				array(
					'name' => esc_html__('Yellow to purple', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug' => 'yellow-to-purple',
				),
				array(
					'name' => esc_html__('Green to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug' => 'green-to-yellow',
				),
				array(
					'name' => esc_html__('Yellow to green', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug' => 'yellow-to-green',
				),
				array(
					'name' => esc_html__('Red to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug' => 'red-to-yellow',
				),
				array(
					'name' => esc_html__('Yellow to red', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug' => 'yellow-to-red',
				),
				array(
					'name' => esc_html__('Purple to red', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug' => 'purple-to-red',
				),
				array(
					'name' => esc_html__('Red to purple', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug' => 'red-to-purple',
				),
			)
		);

		/*
		 * Adds starter content to highlight the theme on fresh sites.
		 * This is done conditionally to avoid loading the starter content on every
		 * page load, as it is a one-off operation only needed once in the customizer.
		 */
		if (is_customize_preview()) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support('starter-content', twenty_twenty_one_get_starter_content());
		}

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Add support for custom line height controls.
		add_theme_support('custom-line-height');

		// Add support for link color control.
		add_theme_support('link-color');

		// Add support for experimental cover block spacing.
		add_theme_support('custom-spacing');

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support('custom-units');

		add_theme_support('sportspress');

		// Remove feed icon link from legacy RSS widget.
		add_filter('rss_widget_feed_link', '__return_empty_string');

		//add_filter( 'nav_menu_css_class', '__return_empty_array' );
	}
}
add_action('after_setup_theme', 'twenty_twenty_one_setup');

/**
 * Registers widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init()
{

	register_sidebar(
		array(
			'name' => esc_html__('Footer', 'twentytwentyone'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here to appear in your footer.', 'twentytwentyone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'twenty_twenty_one_widgets_init');

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('twenty_twenty_one_content_width', 750);
}
add_action('after_setup_theme', 'twenty_twenty_one_content_width', 0);

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global bool       $is_IE
 * @global WP_Scripts $wp_scripts
 *
 * @return void
 */
function twenty_twenty_one_scripts()
{
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ($is_IE) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get('Version'));
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
	}

	// RTL styles.
	wp_style_add_data('twenty-twenty-one-style', 'rtl', 'replace');



	// Threaded comment reply styles.
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get('Version'),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get('Version'),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);



}
add_action('wp_enqueue_scripts', 'twenty_twenty_one_scripts');

/**
 * Enqueues block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script()
{

	wp_enqueue_script('twentytwentyone-editor', get_theme_file_uri('/assets/js/editor.js'), array('wp-blocks', 'wp-dom'), wp_get_theme()->get('Version'), true);
}

add_action('enqueue_block_editor_assets', 'twentytwentyone_block_editor_script');

/**
 * Fixes skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 * @deprecated Twenty Twenty-One 1.9 Removed from wp_print_footer_scripts action.
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix()
{

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
			/(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", (function () { var t, e = location.hash.substring(1); /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus()) }), !1);
		</script>
		<?php
	}
}

/**
 * Enqueues non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages()
{
	$custom_css = twenty_twenty_one_get_non_latin_css('front-end');

	if ($custom_css) {
		wp_add_inline_style('twenty-twenty-one-style', $custom_css);
	}
}
add_action('wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages');

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
//require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

require_once get_template_directory() . '/classes/class-walker-nav-menu.php';
new WPDocs_Walker_Nav_Menu();

function twentytwentyone_customize_preview_init()
{
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri('/assets/js/customize-helpers.js'),
		array(),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri('/assets/js/customize-preview.js'),
		array('customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers'),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('customize_preview_init', 'twentytwentyone_customize_preview_init');

/**
 * Enqueues scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts()
{

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri('/assets/js/customize-helpers.js'),
		array(),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts');

/**
 * Calculates classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes()
{
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters('twentytwentyone_html_classes', '');
	if (!$classes) {
		return;
	}
	echo 'class="' . esc_attr($classes) . '"';
}



add_post_type_support('team', 'thumbnail');
add_post_type_support('player', 'thumbnail');
add_post_type_support('news', 'thumbnail');
// function create_posttype()
// {
// 	/*
// 	   register_post_type( 'team',    
// 		   array(
// 			   'labels' => array(
// 				   'name' => __( 'Team' ),
// 				   'singular_name' => __( 'Team' )
// 			   ),
// 			   'public' => true,
// 			   'has_archive' => true,
// 			   'rewrite' => array('slug' => 'team'),
// 			   'show_in_rest' => true,				  
// 		   )
// 	   );

// 	   register_post_type( 'player',    
// 		   array(
// 			   'labels' => array(
// 				   'name' => __( 'Player' ),
// 				   'singular_name' => __( 'Player' )
// 			   ),
// 			   'public' => true,
// 			   'has_archive' => true,
// 			   'rewrite' => array('slug' => 'player'),
// 			   'show_in_rest' => true,				  
// 		   )
// 	   );

// 	   register_post_type( 'result',    
// 		   array(
// 			   'labels' => array(
// 				   'name' => __( 'Result' ),
// 				   'singular_name' => __( 'Result' )
// 			   ),
// 			   'public' => true,
// 			   'has_archive' => true,
// 			   'rewrite' => array('slug' => 'result'),
// 			   'show_in_rest' => true,				  
// 		   )
// 	   );
//    */
// 	register_post_type(
// 		'news',
// 		array(
// 			'labels' => array(
// 				'name' => __('News'),
// 				'singular_name' => __('News')
// 			),
// 			'public' => true,
// 			'has_archive' => true,
// 			'rewrite' => array('slug' => 'news'),
// 			'show_in_rest' => true,
// 			'taxonomies' => array('gm_results'),
// 		)
// 	);

// }
// add_action('init', 'create_posttype');

/**
 * Adds "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class()
{
	?>
	<script>
		if (-1 !== navigator.userAgent.indexOf('MSIE') || -1 !== navigator.appVersion.indexOf('Trident/')) {
			document.body.classList.add('is-IE');
		}
	</script>
	<?php
}
add_action('wp_footer', 'twentytwentyone_add_ie_class');

if (!function_exists('rookie_get_sidebar_setting')) {
	function rookie_get_sidebar_setting()
	{
		// Get theme options
		$options = (array) get_option('themeboy', array());
		$options = array_map('esc_attr', $options);

		// Apply default setting
		if (empty($options['sidebar'])) {
			$options['sidebar'] = is_rtl() ? 'left' : 'right';
		}

		return $options['sidebar'];
	}
}

if (!function_exists('wp_get_list_item_separator')):
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator()
	{
		/* translators: Used between list items, there is a space after the comma. */
		return __(', ', 'twentytwentyone');
	}
endif;
// Register custom post type for photo gallery
function create_photo_gallery_post_type()
{
	register_post_type(
		'photo_gallery',
		array(
			'labels' => array(
				'name' => 'Photo Galleries',
				'singular_name' => 'Photo Gallery',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Photo Gallery',
				'edit_item' => 'Edit Photo Gallery',
				'new_item' => 'New Photo Gallery',
				'view_item' => 'View Photo Gallery',
				'search_items' => 'Search Photo Galleries',
				'not_found' => 'No photo galleries found',
				'not_found_in_trash' => 'No photo galleries found in Trash'
			),
			'public' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
			'capability_type' => 'post',
			'rewrite' => array('slug' => 'photo-gallery'),
			'menu_icon' => 'dashicons-format-gallery', // Change the icon as needed
			'has_archive' => true
		)
	);
}
add_action('init', 'create_photo_gallery_post_type');

// Footer widgets adding custom
function mytheme_widgets_init()
{
	register_sidebar(
		array(
			'name' => 'Footer Widget Area 1',
			'id' => 'footer-widget-area-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name' => 'Footer Widget Area 2',
			'id' => 'footer-widget-area-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => 'Footer Widget Area 3',
			'id' => 'footer-widget-area-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => 'Secondary Widget Area',
			'id' => 'secondary-widget-area',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
}
add_action('widgets_init', 'mytheme_widgets_init');

// Adding Category to page 
function pagecategory_settings()
{
	register_taxonomy_for_object_type('category', 'page');
}

add_action('init', 'pagecategory_settings');

// Register Custom Post Type for News
function custom_post_type_news()
{
	$labels = array(
		'name' => _x('News', 'Post Type General Name', 'text_domain'),
		'singular_name' => _x('News', 'Post Type Singular Name', 'text_domain'),
		'menu_name' => __('News', 'text_domain'),
		'name_admin_bar' => __('News', 'text_domain'),
		'archives' => __('News Archives', 'text_domain'),
		'attributes' => __('News Attributes', 'text_domain'),
		'parent_item_colon' => __('Parent News:', 'text_domain'),
		'all_items' => __('All News', 'text_domain'),
		'add_new_item' => __('Add New News', 'text_domain'),
		'add_new' => __('Add New', 'text_domain'),
		'new_item' => __('New News', 'text_domain'),
		'edit_item' => __('Edit News', 'text_domain'),
		'update_item' => __('Update News', 'text_domain'),
		'view_item' => __('View News', 'text_domain'),
		'view_items' => __('View News', 'text_domain'),
		'search_items' => __('Search News', 'text_domain'),
		'not_found' => __('Not found', 'text_domain'),
		'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
		'featured_image' => __('Featured Image', 'text_domain'),
		'set_featured_image' => __('Set featured image', 'text_domain'),
		'remove_featured_image' => __('Remove featured image', 'text_domain'),
		'use_featured_image' => __('Use as featured image', 'text_domain'),
		'insert_into_item' => __('Insert into News', 'text_domain'),
		'uploaded_to_this_item' => __('Uploaded to this News', 'text_domain'),
		'items_list' => __('News list', 'text_domain'),
		'items_list_navigation' => __('News list navigation', 'text_domain'),
		'filter_items_list' => __('Filter News list', 'text_domain'),
	);
	$args = array(
		'label' => __('News', 'text_domain'),
		'description' => __('News Description', 'text_domain'),
		'labels' => $labels,
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
		'taxonomies' => array('game_results'),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-format-aside',
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'page',
	);
	register_post_type('news', $args);
}
add_action('init', 'custom_post_type_news', 0);

// Add existing category  to custom post type 'news'
function add_category_to_custom_post_type()
{
	register_taxonomy_for_object_type('category', 'news');
}
add_action('init', 'add_category_to_custom_post_type');

// Register Custom Taxonomy
function custom_taxonomy_game_results()
{
	$labels = array(
		'name' => _x('Game Results', 'Taxonomy General Name', 'text_domain'),
		'singular_name' => _x('Game Result', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name' => __('Game Results', 'text_domain'),
		'all_items' => __('All Game Results', 'text_domain'),
		'parent_item' => __('Parent Game Result', 'text_domain'),
		'parent_item_colon' => __('Parent Game Result:', 'text_domain'),
		'new_item_name' => __('New Game Result Name', 'text_domain'),
		'add_new_item' => __('Add New Game Result', 'text_domain'),
		'edit_item' => __('Edit Game Result', 'text_domain'),
		'update_item' => __('Update Game Result', 'text_domain'),
		'view_item' => __('View Game Result', 'text_domain'),
		'separate_items_with_commas' => __('Separate game results with commas', 'text_domain'),
		'add_or_remove_items' => __('Add or remove game results', 'text_domain'),
		'choose_from_most_used' => __('Choose from the most used', 'text_domain'),
		'popular_items' => __('Popular Game Results', 'text_domain'),
		'search_items' => __('Search Game Results', 'text_domain'),
		'not_found' => __('Not Found', 'text_domain'),
		'no_terms' => __('No game results', 'text_domain'),
		'items_list' => __('Game Results list', 'text_domain'),
		'items_list_navigation' => __('Game Results list navigation', 'text_domain'),
	);

}
add_action('init', 'custom_taxonomy_game_results', 0);


// Shortcode for the contact form
add_shortcode('contact_form', 'contact_form_shortcode');
// Register the shortcode for the contact form
function contact_form_shortcode()
{
	?>
	<form id="contactForm" method="post">
		<div class="name">
			<label for="name">* Nome:</label>
			<div class="clear"></div>
			<input id="name" name="name" type="text" value="" placeholder="e.g. Mr. John Doe" required />
		</div>
		<div class="email">
			<label for="email">* Email:</label>
			<div class="clear"></div>
			<input id="email" name="email" type="email" value="" placeholder="example@domain.com" required />
		</div>
		<div class="message">
			<label for="message"> Messaggio:</label>
			<textarea name="message" class="txt-area" id="message" cols="30" rows="4"></textarea>
		</div>

		<div id="loader">
			<input type="submit" id="submitContactForm" name="formSubmit" value="Invia">
		</div>
	</form>
	<div id="feedback" style="margin-top:30px, margin-bottom:30px"></div>
	<script>
		jQuery(document).ready(function ($) {
			$('#contactForm').submit(function (e) {
				console.log('test');
				e.preventDefault(); // Prevent the form from submitting traditionally

				var formData = $(this).serialize();
				console.log(formData);

				$.ajax({
					type: 'POST',
					url: frontendajax.ajaxurl, // WordPress AJAX URL
					data: formData + '&action=send_mail',
					dataType: 'json', // Expect JSON response
					success: function (response) {
						// Update the content on the page based on the response
						console.log(response);
						$('#feedback').html('');
						if (response.success == true) {
							// Show success message or redirect, etc.
							$('#feedback').html('<div class="alert alert-success">' + response.message + '</div>');
							// Optionally, you can delay the reload to give the user time to read the message
							setTimeout(function () {
								// Refresh the page
								location.reload();
								// Clear form inputs
								$('#contactForm')[0].reset();
							}, 2000);
						} else {
							// Show error message or handle accordingly
							$('#feedback').html('<div class="alert alert-danger">' + response.message + '</div>');
						}
					}
				});
			});
		});
	</script>
	<?php
}
function send_mail()
{

	$name = sanitize_text_field($_POST['name']);
	$email = sanitize_email($_POST['email']);
	$message = sanitize_text_field($_POST['message']);

	// $to = 'sreedhanyaeteam@gmail.com'; 
	$to = get_option('admin_email');
	$subject = 'New Message';

	$headers[] = 'Content-Type: text/html; charset=UTF-8';

	$message_body = '<html><body>';
	$message_body .= '<div class="mail-sent">';
	// $message_body .= '<h2>CONTACT FORM</h2>';
	$message_body .= '<table style="width: 100%; border-collapse: collapse;">';
	$message_body .= '<tr>';
	$message_body .= '<td></td><strong>Name</strong></td>';
	$message_body .= '<td>' . esc_html($name) . '</td>';
	$message_body .= '</tr>';
	$message_body .= '<tr>';
	$message_body .= '<td></td><strong>Email</strong></td>';
	$message_body .= '<td>' . esc_html($email) . '</td>';
	$message_body .= '</tr>';
	$message_body .= '<tr>';
	$message_body .= '<td></td><strong>Message</strong></td>';
	$message_body .= '<td>' . nl2br(esc_html($message)) . '</td>';
	$message_body .= '</tr>';
	$message_body .= '</table>';
	$message_body .= '</div></body></html>';

	// Send the email
	$sent = wp_mail($to, $subject, $message_body, $headers);

	if ($sent) {
		// Email sent successfully
		$response['success'] = true;
		$response['message'] = 'Thank you for your message!';
	} else {
		// Email failed to send
		$response['success'] = false;
		$response['message'] = 'Error sending message. Please try again later.';
	}

	wp_send_json($response);

	die(); // Always end with die to prevent extra output
}

add_action('wp_ajax_send_mail', 'send_mail');
add_action('wp_ajax_nopriv_send_mail', 'send_mail');
