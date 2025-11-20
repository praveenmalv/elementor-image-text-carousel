<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class ITC_Loader
{

    public function __construct()
    {
        // Elementor widget load
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Scripts load
        add_action('wp_enqueue_scripts', [$this, 'frontend_scripts']);
    }

    /**
     * Load JS + CSS
     */
    public function frontend_scripts()
    {
        wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper@8/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', [], '8.4.4', true);
    }

    /**
     * Register Elementor Widgets
     */
    public function register_widgets($widgets_manager)
    {

        // Include widget file
        require_once ITC_PLUGIN_PATH . 'widget.php';

        // Register widget
        if (class_exists('Simple_Carousel_Widget')) {
            $widgets_manager->register(new Simple_Carousel_Widget());
        }
    }
}

// Initialize loader
new ITC_Loader();
