<?php

// Functions.php
//-----------------------
/**
 * metabox fremewrok .
 */
require get_template_directory() . '/inc/cs-framework/cs-framework.php';
require get_template_directory() . '/inc/metabox-and-options.php';


// theme/stock/inc/metabox-and-options.php
//------------------------------
<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

function stock_theme_metabox(){
	$options = array(); // remove old options
	
	$options[]    = array(
	  'id'        => 'stock_page_options',
	  'title'     => 'Page Options',
	  'post_type' => 'page',
	  'context'   => 'normal',
	  'priority'  => 'high',
	  'sections'  => array(

    // begin: a section
			array(
			  'name'  => 'stock_page_options_meta',
			  'icon'  => 'fa fa-cog',

			  // begin: fields
			  'fields' => array(

				// begin: a field
				array(
				  'id'    => 'enable_title',
				  'type'  => 'switcher',
				  'title' => 'Enable title',
				  'default' => true ,
				  'desc' => esc_html__('If you wnat to enable title, select yes', 'stock-crazyagfe'),
				),
				array(
				  'id'    => 'enable_content',
				  'type'  => 'switcher',
				  'title' => 'Enable content',
				  'default' => false ,
				  'desc' => esc_html__('If you wnat to enable content, select yes', 'stock-crazyagfe'),
				),
				// end: a field
			  ), 
			), 
		   

		  ),
	);
	return $options;
	
}
add_filter('cs_metabox_options','stock_theme_metabox');

?>


//theme/stock/template-parts/content-page.php


<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package First_them
 */
 
 //------------edited--------------
 // if meta then it will show meta
 
	 if(get_post_meta($post->ID, 'stock_page_options', true)){
		  $page_meta = get_post_meta($post->ID, 'stock_page_options', true);
	 }else{													// else array then enble title true
		 $page_meta = array();
	 }
	 
	 if(array_key_exists('enable_title',$page_meta)){
		 $enable_title = $page_meta['enable_title'];
	 }else{
		 $enable_title = true;
	 }
	 if(array_key_exists('enable_content',$page_meta)){
		 $enable_content = $page_meta['enable_content'];
	 }else{
		 $enable_content = false;
	 }
 
 //------------edited--------------
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	    
		<?php //------------edited--------------?>
		<?php if($enable_title == true) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php endif; ?>
	
	<div class="entry-content">
		<?php
		//------------edited--------------
		
		if($enable_content == true){
			the_content();
		}
		
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'first-them' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'first-them' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
