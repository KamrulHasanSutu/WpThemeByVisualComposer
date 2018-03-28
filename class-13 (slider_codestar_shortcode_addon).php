<?php

// vc-slides.php
//----------------

vc_map( array(
			  "name" => __( "Stock Slider", "my-text-domain" ),
			  "base" => "stock_slides",              // which shortcode do i want to integrate
			  "category" => __( "Stock", "my-text-domain"),
			  "params" => array(
				 array(
					"type" => "textfield",
					"heading" => __( "Count", "my-text-domain" ),
					"param_name" => "count",                                     // attributes name
					"value" => __( "3", "my-text-domain" ),                // default value  // std dile def asbe
					"description" => __( "Select slides count. Want unlimited select -1", "my-text-domain" )
				   ),
				   array(
					"type" => "dropdown",
					"heading" => __( "Enable loop ?", "my-text-domain" ),
					"param_name" => "loop",                               
					"std" => __( "true", "my-text-domain" ),
					"value" => array(
						'yes' => 'true',
						'no'  => 'false',
					),
					"description" => __( "(loop)", "my-text-domain" )
				   ),
				   array(
					"type" => "dropdown",
					"heading" => __( "Enable autoplay ?", "my-text-domain" ),
					"param_name" => "autoplay",                               
					"std" => __( "true", "my-text-domain" ),
					"value" => array(
						'yes' => 'true',
						'no'  => 'false',
					),
					"description" => __( "(autoplay)", "my-text-domain" )
				   ),
				   array(
					"type" => "dropdown",
					"heading" => __( "Slidetime", "my-text-domain" ),
					"param_name" => "autoplayTimeout",                               
					"std" => __( "5000", "my-text-domain" ),
					"value" => array(
						'1 Second' => '1000',
						'2 Seconds' => '2000',
						'3 Seconds' => '3000',
						'4 Seconds' => '4000',
						'5 Seconds' => '5000',
						'6 Seconds' => '6000',
						'7 Seconds' => '7000',
						'8 Seconds' => '8000',
						'9 Seconds' => '9000',
						'10 Seconds' => '10000',
						'11 Seconds' => '11000',
						'12 Seconds' => '12000',
						'13 Seconds' => '13000',
						'14 Seconds' => '14000',
						'15 Seconds' => '15000',
						
					),
					"description" => __( "(description)", "my-text-domain" )
				   ),
				   array(
					"type" => "dropdown",
					"heading" => __( "Enable navigation icon ?", "my-text-domain" ),
					"param_name" => "nav",                               
					"std" => __( "true", "my-text-domain" ),
					"value" => array(
						'yes' => 'true',
						'no'  => 'false',
					),
					"description" => __( "(description)", "my-text-domain" )
				  ),
				   array(
					"type" => "dropdown",
					"heading" => __( "Enable dots ? ", "my-text-domain" ),
					"param_name" => "dots",                               
					"std" => __( "true", "my-text-domain" ),
					"value" => array(
						'yes' => 'true',
						'no'  => 'false',
					),
					"description" => __( "(description)", "my-text-domain" )
				  )
				
			    )
		    )
	    );

		
// metabox-and-options.php edited
//--------------------------------------


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
					'default' => '.7',
					'title' => 'Overlay percentage put some floting number',
					'desc' => 'Type overlay percentage in number',
					 'dependency'	=> array('enable_overlay','==','true'),
				),
				array(
					'id' => 'overlay_color',
					'type' => 'color_picker',
					'title' => 'Enable overlay ?',
					'default' => '#181a1f',
					'dependency'	=> array('enable_overlay','==','true'),
				),

				
				
				// end: a field
			  ), 
			), 
		  ),
	);

// Slide-shortcode.php
//---------------------------
<?php

function stock_slides_shortcodes($atts){
    extract( shortcode_atts( array(
        'count' => 3,
        'loop' => 'true',
        'autoplay' => 'true',
        'autoplayTimeout' => 5000,
        'nav' => 'true',
        'dots' => 'true',
    ), $atts) );
     
    $q = new WP_Query(
        array('posts_per_page' => $count, 'post_type' => 'slide',)
        );      
         
    $list = '
	<script>
		jQuery(window).load(function($){
			jQuery(".stock-slides").owlCarousel({
				items : 1,
				loop : '.$loop.',
				autoplay : '.$autoplay.',
				autoplayTimeout : '.$autoplayTimeout.',
				nav : '.$nav.',
				dots : '.$dots.',
				navText : ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]
			});
		});
	</script>
	<div class="stock-slides">';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
		
		if(get_post_meta($idd, 'stock_slide_options', true)){
			$slide_meta = get_post_meta($idd, 'stock_slide_options', true);
		}else{
			$slide_meta = array();
		}
		if(array_key_exists('enable_overlay', $slide_meta)){
			$enable_overlay = $slide_meta['enable_overlay'];
		}else{
			$enable_overlay = true;
		}
		if(array_key_exists('overlay_percentage', $slide_meta)){
			$overlay_percentage = $slide_meta['overlay_percentage'];
		}else{
			$overlay_percentage = .7;
		}
		if(array_key_exists('overlay_color', $slide_meta)){
			$overlay_color = $slide_meta['overlay_color'];
		}else{
			$overlay_color = '#181a1f';
		}
		$post_content = get_the_content();
        $list .= '
        <div style="background-image:url('.get_the_post_thumbnail_url($idd, 'large').')" class="single_slide_item">';
		
		if($enable_overlay == true){
			
			$list.='<div style="opacity:'.$overlay_percentage.';background-color:'.$overlay_color.'" class="slide-overlay"></div>';
		}
		
		$list.='
		
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


// stock-toolkit.css
//---------------------
.stock-slide-table {
  display: table;
  height: 100%;
  width: 100%;
  position:relative;
  z-index:2;
}

.slide-overlay{
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  background: #333;
  z-index: 1;
  opacity: .33;

}
	
	

	
	
?>