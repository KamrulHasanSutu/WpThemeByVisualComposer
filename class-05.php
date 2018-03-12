
<?php
// header.php
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
		
		<div class="header-area">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="site-logo">
							<h2><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo( 'name' ); ?></a></h2>
						</div>
					</div>
					
					<div class="col-md-9">
							<div class="header-right-content">
								<a href="mailto:contact@stock.com" class="stock-cotact-box">
									<i class="fa fa-envelop"></i>
									Send us an email
									<h3>Contact@stock.com</h3>
								</a>
								<div class="stock-cotact-box">
									<i class="fa fa-phone"></i>
									Give us a call
									<h3>_014-343-343-343</h3>
								</div>
								<a href="mailto:contact@stock.com" class="stock-cotact-box">
									<i class="fa fa-marker"></i>
									Send us an email
									<h3>Contact@stock.com</h3>
								</a>
								<a href="" class="stock-cart"><i class="fa fa-sopping-cart"></i><span class="stock-cart-count">3</span></a>
								
							</div>
					</div>
					
				</div>
				
				<div class="row">
						<div class="mainmenu">
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						</div>
				</div>
				
			</div>
		</div>

<?php  // footer.php   ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<div class="container">
		
			<?php if(is_active_sidebar('stock_footer')) : ?>
			<div class="row">
				<?php dynamic_sidebar('stock_footer'); ?>
			</div>
			<?php endif; ?>
			
			<div class="row">
				<div class="col-md-12">
					<div class="stock-footer-bottom">
						<div class="row">
							<div class="col-md-4">
								<?php esc_html_e('Cpyright @ 2017 Faridealbab - All right reserve','stock-crazycafe');?>
							</div>
							<div class="col-md-4">
								<?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?>
							</div>
							<div class="col-md-4">
								<div class="social-icons">
									<a href=""><i class="fa fa-facebook"></i></a>
									<a href=""><i class="fa fa-linkedin"></i></a>
									<a href=""><i class="fa fa-twitter"></i></a>
									<a href=""><i class="fa fa-youtube"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>


<?php  // functions.php ?>
<?php
/**
 * First them functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package First_them
 */

if ( ! function_exists( 'first_them_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function first_them_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on First them, use a find and replace
	 * to change 'first-them' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'first-them', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'first-them' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'first_them_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'first_them_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function first_them_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'first_them_content_width', 640 );
}
add_action( 'after_setup_theme', 'first_them_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function first_them_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'first-them' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'first-them' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widgets', 'first-them' ),
		'id'            => 'stock_footer',
		'description'   => esc_html__( 'Add footer widgets here.', 'first-them' ),
		'before_widget' => '<div class="col-md-3"> <div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'first_them_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function first_them_scripts() {

	wp_enqueue_style('stock-default',get_template_directory_uri().'/assets/css/default.css',array(),'1.1.0');
	wp_enqueue_style('bootstrap',get_template_directory_uri().'/assets/css/bootstrap.min.css',array(),'3.3.7');
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/css/font-awesome.min.css',array(),'4.7.0');

	wp_enqueue_style( 'first-them-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'first_them_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


?>