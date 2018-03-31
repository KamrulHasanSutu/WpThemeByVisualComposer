<?php
 // stock-toolkit below PATH
 //-------------------------
 // function of list of slides
 // Function to braing all slides / pages etc
function stock_toolkit_get_slide_as_list(){
	
		$args = wp_parse_args(array(
			'post_type' => 'slide',
			'numberposts' => -1,
		) );
		$posts = get_posts( $args );
		
		$post_options = array(esc_html__('-- Select slide --', 'stock-toolkit')=>'');
		
		if($posts){
			foreach($posts as $post){
				$post_options[ $post->post_title] = $post->ID;
			}
			
		}
		return $post_options;
	
} 

// vc-slies.php
//-------------------------
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
					"heading" => __( "Select slide", "my-text-domain" ),
					"param_name" => "slide_id",                                                             
					"value"     => stock_toolkit_get_slide_as_list(),
					"description" => __( "", "my-text-domain" ),
					"dependency"  => array(
						"element" => "count",
						"value"   =>array("1"), // if select 1 then it will appear
					)
				   ),
				   array(
					"type" => "textfield",
					"heading" => __( "Slide Height", "my-text-domain" ),
					"param_name" => "height",                               
					"std" => __( "730", "my-text-domain" ),
					"description" => __( "select your slide height", "my-text-domain" )
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
					"description" => __( "(loop)", "my-text-domain" ),
					"dependency"  => array(
						"element" => "count",
						"value"   =>array("2","3","4","5","6","7","8","9","10","11","12","13","14","15"),
					)
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
					"description" => __( "(autoplay)", "my-text-domain" ),
					"dependency"  => array(
						"element" => "count",
						"value"   =>array("2","3","4","5","6","7","8","9","10","11","12","13","14","15"),
					)
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
					"description" => __( "(description)", "my-text-domain" ),
					"dependency"  => array(
						"element" => "count",
						"value"   =>array("2","3","4","5","6","7","8","9","10","11","12","13","14","15"),
					)
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
					"description" => __( "(description)", "my-text-domain" ),
					"dependency"  => array(
						"element" => "count",
						"value"   =>array("2","3","4","5","6","7","8","9","10","11","12","13","14","15"),
					)
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
					"description" => __( "(description)", "my-text-domain" ),
					"dependency"  => array(
						"element" => "count",
						"value"   =>array("2","3","4","5","6","7","8","9","10","11","12","13","14","15"),
					)
				  )
				
			    )
		    )
	    );

		
// slide-shortcode.php
//-------------------------

function stock_slides_shortcodes($atts){
    extract( shortcode_atts( array(
        'count' => 3,
        'slide_id' => '',
        'height' => '730',
        'loop' => 'true',
        'autoplay' => 'true',
        'autoplayTimeout' => 5000,
        'nav' => 'true',
        'dots' => 'true',
    ), $atts) );
     // if count =1 slected by user  // slider_id =1 which slider comes here
	 if($count == 1){
		  $q = new WP_Query( array('posts_per_page' => $count, 'post_type' => 'slide','p'=> 'slider_id'));      
	 }else{
		  $q = new WP_Query( array('posts_per_page' => $count, 'post_type' => 'slide',));      
	 }
    
	// if 1 then no scrip load
	if($count == 1){
		$list = '';
	}else{
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
	</script>';
		
	}

	
	$list.='
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
        <div style="background-image:url('.get_the_post_thumbnail_url($idd, 'large').');height:'.$height.'px" class="single_slide_item">';
		
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



?>