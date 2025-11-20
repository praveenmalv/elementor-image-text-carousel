<?php

/**
 * Plugin Name: Elementor Free Carousel
 * Description: Simple carousel for Elementor - multiple slides visible
 * Version: 1.0.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) exit;

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
