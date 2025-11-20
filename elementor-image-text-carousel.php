<?php

/**
 * Plugin Name: Image Text Carousel for Elementor
 * Description: Custom Elementor widget allowing users to create image + text carousel sliders with full Elementor design controls.
 * Version: 1.0.0
 * Author: Praveen Malviya
 * Text Domain: image-text-carousel-for-elementor
 */

if (! defined('ABSPATH')) exit; // Exit if accessed directly

// Define plugin paths
define('ITC_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('ITC_PLUGIN_URL', plugin_dir_url(__FILE__));

// Autoload / includes
require_once ITC_PLUGIN_PATH . 'includes/class-itc-loader.php';

/*
=== Image Text Carousel for Elementor ===
Contributors: yourusername
Tags: elementor, carousel, slider, image slider, text slider
Requires at least: 5.5
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A custom Elementor widget that creates a responsive Image + Text Carousel with full design controls, autoplay, arrows, dots, and templates support.

== Description ==

Image Text Carousel for Elementor is a free Elementor widget that allows you to create beautiful image + text carousels easily.  
Users can add images, titles, descriptions, buttons, templates, custom HTML, and full responsive settings directly from Elementor editor.

**Features:**
* Image + Title + Description support  
* Elementor Template (shortcode / ID) support  
* Autoplay, speed, arrows, dots  
* 1–6 slides per view  
* Responsive controls: Desktop / Tablet / Mobile  
* Overlay opacity control  
* Content left / center / right  
* Custom HTML inside slide  
* Lightweight — no external libraries  
* 100% free — GPL compliant  

== Installation ==

1. Upload the plugin ZIP file to `/wp-content/plugins/`  
2. Activate the plugin through the “Plugins” menu  
3. Open Elementor page editor  
4. Search for “Image Text Carousel” widget  
5. Drag & drop it into your page  

== Frequently Asked Questions ==

= Does this work with Elementor free version? =  
Yes, it works with Elementor free.

= Does it load external libraries? =  
No, everything is built with native WordPress + Elementor scripts.

== Screenshots ==
1. Carousel widget in Elementor editor  
2. Frontend preview example  
3. Settings panel  

== Changelog ==

= 1.0.0 =
* Initial release  

== Upgrade Notice ==
Initial stable release.

*/


class Simple_Elementor_Carousel
{

    public function __construct()
    {
        add_action('elementor/widgets/register', [$this, 'register_widget']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_scripts()
    {
        wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper@8/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', [], '8.4.4', true);
    }

    public function register_widget($widgets_manager)
    {
        require_once __DIR__ . '/widget.php';
        $widgets_manager->register(new Simple_Carousel_Widget());
    }
}

new Simple_Elementor_Carousel();
