<?php
/*
Plugin Name: 99 Bottles of Beer Shortcode
Plugin URI: https://mangoinnovation.com/plugins/99-bottles-of-beer
Description: Adds a shortcode to display the lyrics of "99 Bottles of Beer on the Wall"
Version: 1.0
Author: Derrick Boddie
Author URI: https://mangoinnovation.com
License: GPL2
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo '99 Bottles of Beer';
    exit;
}

function bottles_of_beer_shortcode($atts = [], $content = null) {
    // Extract shortcode attributes
    $a = shortcode_atts( array(
        'start' => 99,
        'item' => 'bottles',
        'contents' => 'beer'
    ), $atts );

    $output = '';
    $start = intval($a['start']);
    $item = sanitize_text_field($a['item']);
    $contents = sanitize_text_field($a['contents']);

    for ($i = $start; $i > 0; $i--) {
        $current = ($i != 1) ? "$i $item" : "1 " . rtrim($item, 's');
        $next = ($i - 1 != 1) ? ($i - 1) . " $item" : "1 " . rtrim($item, 's');
        
        $output .= "<p>$current of $contents on the wall, $current of $contents.<br>";
        $output .= "Take one down, pass it around, ";
        
        if ($i - 1 > 0) {
            $output .= "$next of $contents on the wall.<br><br>";
        } else {
            $output .= "No more $item of $contents on the wall.</p><br>";
        }
    }

    return $output;
}
add_shortcode('bottles_of_beer', 'bottles_of_beer_shortcode');
