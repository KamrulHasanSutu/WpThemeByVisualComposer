<?php

//stock-toolkit.php
//-----------------------
wp_enqueue_style('stock-toolkit', plugin_dir_url(__FILE__).'assets/css/stock-toolkit.css');


//slider-shortcode.php
//------------------------

function stock_slides_shortcodes($atts){
    extract( shortcode_atts( array(
        'count' => '',
    ), $atts) );
     
    $q = new WP_Query(
        array('posts_per_page' => -1, 'post_type' => 'slide',)
        );      
         
    $list = '
	<script>
		jQuery(window).load(function($){
			jQuery(".stock-slides").owlCarousel({
				items : 1,
				loop : true,
				autoplay : false,
				nav : true,
				dots : true,
				navText : ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]
			});
		});
	</script>
	<div class="stock-slides">';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $slide_meta = get_post_meta($idd, 'stock_slide_options', true);
        $post_content = get_the_content();
        $list .= '
        <div style="background-image:url('.get_the_post_thumbnail_url($idd, 'large').')" class="single_slide_item">
            <div class="stock-slide-table">
				<div class="stock-slide-tablecell">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<h2>'.get_the_title($idd).'</h2>
								'.wpautop($post_content).'';
								
								if(!empty($slide_meta['buttons'])){
									$list.='<div class="stock-slide-buttons">';										
										foreach($slide_meta['buttons'] as $button){
											if($button['link_type']==1){
												$btn_link = get_page_link($button['link_to_page']);
											}else{
												$btn_link = $button['link_to_external'];
											}
											$list.='<a href="'.$btn_link.'" class="'.$button['type'].'-btn stock-slide-btn">'.$button['text'].'</a>';
										}
										
									$list.='</div>';
									
								}	
								$list.='
							</div>
						</div>
					</div>
				</div>
			</div>			
        </div>
        ';        
    endwhile;
    $list.= '</div>';
    wp_reset_query();
    return $list;
}
add_shortcode('stock_slides', 'stock_slides_shortcodes');  

// metabox-and-options.php
// -------------------------
<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

function stock_theme_metabox(){
	$options = array(); // remove old options
	
	//-----------------------------
	// Slide Options
	//-----------------------------
	
	
	$options[]    = array(
	  'id'        => 'stock_slide_options',
	  'title'     => 'Slide Options',
	  'post_type' => 'slide',
	  'context'   => 'normal',
	  'priority'  => 'high',
	  'sections'  => array(

    // begin: a section
			array(
			  'name'  => 'stock_page_options_meta',
		
			  // begin: fields
			  'fields' => array(

							array(
				  'id'              => 'buttons',
				  'type'            => 'group',
				  'title'           => 'Slide buttons',
				  'button_title'    => 'Add New',
				  'accordion_title' => 'Add New Field',
				  'fields'          => array(
							array(
							  'id'    => 'type',
							  'type'  => 'select',
							  'title' => 'Button type',
							  'desc' => 'Select Button type',
							   'options'        => array(
									'bodered'     => 'Borderend Button',
									'filled'      => 'Filled Button',
									
								  ),
							),
							array(
							  'id'    => 'text',
							  'type'  => 'text',
							  'title' => 'Button text',
							  'desc' => 'Type button text',
							  'default' => 'Get free consultaion',
							),
							array(
							  'id'    => 'link_type',
							  'type'  => 'select',
							  'title' => 'Link type',
							   'options'        => array(
									'1'          => 'WordPress page',
									'2'          => 'External  link',
								  ),
							),
							array(
							  'id'    => 'link_to_page',
							  'type'  => 'select',
							  'title' => 'Select page',
							   'options'        => 'page',
								 'dependency'	=> array('link_type','==','1'),
							),
							array(
							  'id'    => 'link_to_external',
							  'type'  => 'text',
							  'title' => 'Type URL',
								 'dependency'	=> array('link_type','==','2'),
							),
					
					
				  ),
				),
				
				array(
					'id' => 'enable_overlay',
					'type' => 'switcher',
					'default' => true,
					'title' => 'Enable overlay ?',
				),
				array(
					'id' => 'overlay_percentage',
					'type' => 'text',
					'default' => '70',
					'title' => 'Overlay percentage',
					'desc' => 'Type overlay percentage in numver',
				),
				array(
					'id' => 'overlay_color',
					'type' => 'color_picker',
					'title' => 'Enable overlay ?',
					'default' => '#181a1f',
				),

				
				
				// end: a field
			  ), 
			), 
		  ),
	);
	
	


	return $options;
	
}
add_filter('cs_metabox_options','stock_theme_metabox');


//   page.php
// -----------------------

     <div class="stock-internal-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				   
           <?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
			?>
				
				</div>
			</div>
		</div>
	  </div>


?>

//  stock-toolkit.css
//-------------------------


.single_slide_item {
  height: 730px;
  background-size: cover;
  background-position: center;
  background-color: #ddd;
  position: relative;
  z-index: 1;
  color: #fff;
  font-size: 20px;
  line-height: 26px;
}
.stock-slide-table {
  display: table;
  height: 100%;
  width: 100%;
}
.stock-slide-tablecell {
  display: table-cell;
  vertical-align: middle;
}
.single_slide_item:after {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  content: "";
  background: #333;
  z-index: -1;
  opacity: .33;
  /*! color: #fff; */
}
.stock-slide-buttons {
  font-size: 30px;
}
.single_slide_item h2 {
  font-size: 50px;
  margin-bottom: 20px;
}
.stock-slides .owl-nav div {
  position: absolute;
  height: 60px;
  width: 60px;
  left: 50px;
  top: 50%;
  /*! background: #fff; */
  z-index: 1;
  font-size: 35px;
  line-height: 60px;
  text-align: center;
  border-radius: 50%;
  opacity: 0;
  visibility: hidden;
  transition: .3s;
}
.stock-slides .owl-nav div:after {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  background: #fff;
  content: "";
  opacity: .5;
  z-index: -1;
  border-radius: 50%;
}
.stock-slides .owl-nav div.owl-next {
  left: auto;
  right: 50px;
}
.stock-slides .owl-nav div i {
  background: #fff;
  margin: 5px;
  height: 50px;
  width: 50px;
  display: block;
  line-height: 50px;
  border-radius: 50%;
}
.stock-slides:hover .owl-nav div {
  opacity: 1;
  visibility: visible;
}

  /*! background: blue; */

.stock-slide-buttons {
  margin-top: 30px;
}

.stock-slide-buttons a {
  color: #fff;
  position: relative;
}
.bodered-btn:after {
  position: absolute;
  background: #FFE943;
  content: "";
  width: 40%;
  height: 8px;
  left: 0;
  bottom: 0;
  transition: .3s;
}
.bodered-btn {
  padding-bottom: 19px;
}

.bodered-btn:hover:after {
  width: 100%;
}
a:hover {
  text-decoration: none;
}

.bodered-btn.stock-slide-btn {
}
.stock-slides .owl-nav div:hover i.fa {
  background: #278cc1;
  color: #fff;
}


