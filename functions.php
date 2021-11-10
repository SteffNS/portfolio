<?php
/**
 * Steffen-Portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Steffen-Portfolio
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'steffen_portfolio_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function steffen_portfolio_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Steffen-Portfolio, use a find and replace
		 * to change 'steffen-portfolio' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'steffen-portfolio', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );


		// Image Size support
		add_image_size( 'portrait-blog', 200, 250, true );
		add_image_size( 'landscape-blog', 400, 200, true );
		add_image_size( 'cube-work', 300, 300, true );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'steffen-portfolio' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'steffen_portfolio_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'steffen_portfolio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function steffen_portfolio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'steffen_portfolio_content_width', 640 );
}
add_action( 'after_setup_theme', 'steffen_portfolio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function steffen_portfolio_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'steffen-portfolio' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'steffen-portfolio' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'steffen_portfolio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function steffen_portfolio_scripts() {
	wp_enqueue_style('steffen-portfolio-google-fonts', "https://fonts.googleapis.com/css2?family=Inter&family=Playfair+Display&display=swap", array(), null);
	wp_enqueue_style( 'steffen-portfolio-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'steffen-portfolio-style', 'rtl', 'replace' );

	wp_enqueue_script( 'steffen-portfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	//swiper enqueue
	if ( is_front_page() || is_singular('portfolio_work')) {
		wp_enqueue_style( 'swiper-styles', get_template_directory_uri() .'/css/swiper-bundle.css', array(), '6.5.6' );
		wp_enqueue_script( 'swiper-scripts', get_template_directory_uri() .'/js/swiper-bundle.min.js', array(), '6.5.6', true );
		wp_enqueue_script( 'swiper-settings', get_template_directory_uri() .'/js/swiper-settings.js', array( 'swiper-scripts' ), _S_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'steffen_portfolio_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// Custom Post Type Registration
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function portfolio_excerpt_length($length){
	$length = 50;
	return $length;
}
add_filter('excerpt_length', 'portfolio_excerpt_length', 999);
function portfolio_excerpt_more($more){
	$more = '... <a class="read-more" href="'.get_permalink().'">More About Project</a>';
	return $more;
}
add_filter('excerpt_more', 'portfolio_excerpt_more');