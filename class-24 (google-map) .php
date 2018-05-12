
<?php

// install contact form 7 plugin and edit
//---------------------------------------

1. download gamp from http://gmap3.net/quickstart.html
2. add this to js in plugin folder
3. add link to to stock-toolkit.php stock-toolkit-files function
 wp_enqueue_script('gmap3', plugin_dir_url(__FILE__).'assets/js/gmap3.min.js',array('jquery'),'232323', true);
add this either
require_once(STOCK_ACC_PATH.'theme-shortcodes/styled-map-shortcode.php');

5. make styled-map-shortcode
///////////////////////// gentrate a  api key
<?php

function stock_gmap_shortcode($atts, $content = null){
	
	extract( shortcode_atts( array(
        'title' => '',  
    ), $atts) );
	
	
	
	$stock_gmap_markup = '
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=
AIzaSyASRYEEysVX728251IBbxyTExJfh51tr8c&region=US"></script>
 <div style="width:100%;height:500px" class="map"></div>
  <script>
	JQuery(document).ready(function($){
		 $(".map")
      .gmap3({
        center:[41.850033, -87.650052],
        zoom:12,
        mapTypeId: "shadeOfGrey", // to select it directly
        mapTypeControlOptions: {
          mapTypeIds: [google.maps.MapTypeId.ROADMAP, "shadeOfGrey"]
        }
      })
      .styledmaptype(
        "shadeOfGrey",
        [
          {"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},
          {"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},
          {"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},
          {"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},
          {"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},
          {"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},
          {"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},
          {"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},
          {"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},
          {"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},
          {"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},
          {"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},
          {"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}
        ],
        {name: "Shades of Grey"}
      );
		
	});
   
   
    </script>
	';

	return $stock_gmap_markup;
	
}

add_shortcode('stock_gmap_box', 'stock_gmap_shortcode');  


6. make a map page and voila enable content from page options


?>