<?php
/*

Plugin Name: Gym Fitness - Location with Leaflet
Plugin URI:
Description: Creates a shortcode to display the location
Version:1.0
Author:Clément GARCIN 
Author URI:
Text Domain: gymfitness

*/
if (!defined('ABSPATH')) die();

//Shortcode API 
function gymfitness_location_shortcode()
{
  $location = get_field('location');
?>

  <div class="location">
    <input type="hidden" id="lat" value="<?php echo $location['lat']; ?>" />
    <input type="hidden" id="lng" value="<?php echo $location['lng']; ?>" />
    <input type="hidden" id="address" value="<?php echo $location['address']; ?>" />

    <div id="map"></div>
  </div>

<?php
}

add_shortcode('gymfitness_location', 'gymfitness_location_shortcode');

//Enqueue css and js files
function gymfitness_location_scripts()
{ //Leaflet CSS

  if (is_page('contact-us')) :

    wp_enqueue_style('leafletcss', 'https://unpkg.com/leaflet@1.8.0/dist/leaflet.css', array(), '1.5.1');


    //leaflet JS

    wp_enqueue_script('leafletjs', 'https://unpkg.com/leaflet@1.8.0/dist/leaflet.js', array(), '1.5.1', true);

    //Gymfitness Leaflet

    wp_enqueue_script('gymfitness-leaflet', plugins_url('./js/gymfitness-leaflet.js', __File__), array('leafletjs'), '1.0.0', true);
  endif;
}
add_action('wp_enqueue_scripts', 'gymfitness_location_scripts');
