<?php
/*
Plugin Name: Accordions - Update Meta
Plugin URI: https://www.pickplugins.com/item/accordions-html-css3-responsive-accordion-grid-for-wordpress/?ref=dashboard
Description: Fully responsive and mobile ready accordion grid for wordpress.
Version: 1.0.0
Author: PickPlugins
Author URI: http://pickplugins.com
Text Domain: accordions-xml
Domain Path: /languages
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


if (!defined('ABSPATH')) exit;  // if direct access


add_shortcode('animation_replace', 'animation_replace');

function animation_replace($atts, $content = null)
{
    $atts = shortcode_atts(
        array(
            'time' => '520',
        ),
        $atts
    );

    $animate_delay = $atts['time'];


    $query_args = array(
        'post_type' => 'accordions',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
    );

    $ddwp_query = new WP_Query($query_args);





    if ($ddwp_query->have_posts()) :
        while ($ddwp_query->have_posts()) :
            $ddwp_query->the_post();

            $post_id = get_the_ID();
            $accordions_options = get_post_meta($post_id, 'accordions_options', true);




            if (isset($accordions_options['accordion'])) {

                $accordions_options['accordion']['animate_delay'] = $animate_delay;
            } else {
                $accordions_options['accordion'] = ['animate_delay' => $animate_delay];
            }

?>
            <p>

                Accoridons #<?php echo $post_id; ?> updated. <br>
            </p>


<?php






            update_post_meta($post_id, 'accordions_options', $accordions_options);




        endwhile;
    endif;
}
