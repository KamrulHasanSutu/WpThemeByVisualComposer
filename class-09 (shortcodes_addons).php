<?php
/*
Plugin Name: Stock Toolkit
*/

//custom post

add_action( 'init', 'my_theme_custom_post' );
function my_theme_custom_post() {
    register_post_type( 'Testimonial',
        array(
            'labels' => array(
                'name' => __( 'Testimonials' ),
                'singular_name' => __( 'Testimonial' )
            ),
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'public' => false,
			'show_ui' => true, 
        )
    );
}


function post_list_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => -1,   // if -1 then all post will come
        'type' => 'post' ,
        'color' => '#D54E21', 
        'icon' => '' 
    ), $atts) );
     
    $q = new WP_Query(
			array('posts_per_page' => $count,
				'post_type' => 'page',
				'post_type' => $type
				)
			);      
         
    $list = '<ul>';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $custom_field = get_post_meta($idd, 'custom_field', true);
        $post_content = get_the_content();
      //  $list .= '<li><a style="'.$color.'" href="'.get_permalink().'">'.get_the_title().'</a></li>'; 
        
		$list .= '<li><a style="color:'.$color.'" href="'.get_permalink().'">';
			
			if(!empty($icon)){
				$list .='<i class="'.$icon.'"></i>';
				
			}
			
		$list.=''.get_the_title().'</a></li>'; 
		
    endwhile;
    $list.= '</ul>';
    wp_reset_query();
    return $list;
}
add_shortcode('post_list', 'post_list_shortcode');  
	
	
	
	function stock_vc_postlist_addon(){
		vc_map( array(
			  "name" => __( "Post list", "my-text-domain" ),
			  "base" => "post_list",              // which shortcode do i want to integrate
			 // "class" => "",
			  "category" => __( "Stock", "my-text-domain"),
			 // 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),  // if we dont want css in admin
			 // 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
			  "params" => array(
				 array(
					"type" => "textfield",
					//"holder" => "div",
					//"class" => "",
					"heading" => __( "Post type", "my-text-domain" ),
					"param_name" => "type",                                                // attributes name
					"value" => __( "post", "my-text-domain" ),                          // default value  // std dile def asbe
					"description" => __( "Type post here", "my-text-domain" )
				 ),
				 array(
					"type" => "textfield",
					"heading" => __( "Post count", "my-text-domain" ),
					"param_name" => "count",
					"value" => __( "-1", "my-text-domain" ),  					
					"description" => __( "how many item do you want to show. -1 for unlimited ", "my-text-domain" )
				 ),
				 array(
					"type" => "colorpicker",
					"heading" => __( "Link color", "my-text-domain" ),
					"param_name" => "color",
					"value" => __( "#D54E21", "my-text-domain" ),  					     // default value shold be in shordcode also
					"description" => __( "Choose your color", "my-text-domain" )
				 ),
				 array(
					"type" => "iconpicker",
					"heading" => __( "Icon", "my-text-domain" ),
					"param_name" => "icon",
					//"value" => __( "fa fa-link", "my-text-domain" ),  					     // default value shold be in shordcode also
					"description" => __( "Choose your icon very carefully ", "my-text-domain" )
				 )
			  )
		   )
		 );
		
	}
	add_action('vc_before_init','stock_vc_postlist_addon');
	


https://github.com/kamrulhasan777/TestProject/blob/master/class-08%20(shortcodes).php




?>