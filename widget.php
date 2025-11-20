<?php
if (!defined('ABSPATH')) exit;

class Simple_Carousel_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'simple_carousel';
    }
    public function get_title()
    {
        return 'Simple Carousel';
    }
    public function get_icon()
    {
        return 'eicon-carousel';
    }
    public function get_categories()
    {
        return ['general'];
    }

    public function get_script_depends()
    {
        return ['swiper-js'];
    }

    public function get_style_depends()
    {
        return ['swiper-css'];
    }

    protected function register_controls()
    {
        // Slides Section
        $this->start_controls_section('section_slides', [
            'label' => 'Slides'
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('image', [
            'label' => 'Image',
            'type' => \Elementor\Controls_Manager::MEDIA,
        ]);

        $repeater->add_control('title', [
            'label' => 'Title',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Slide Title'
        ]);

        $repeater->add_control('description', [
            'label' => 'Description',
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Slide description'
        ]);

        $this->add_control('slides', [
            'label' => 'Slides',
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['title' => 'Slide 1'],
                ['title' => 'Slide 2'],
                ['title' => 'Slide 3'],
            ],
            'title_field' => '{{{ title }}}'
        ]);

        $this->end_controls_section();

        // Carousel Settings
        $this->start_controls_section('section_settings', [
            'label' => 'Carousel Settings'
        ]);

        $this->add_control('slides_to_show', [
            'label' => 'Slides to Show',
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 6,
            'default' => 3,
        ]);

        $this->add_control('autoplay', [
            'label' => 'Autoplay',
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes'
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = 'carousel-' . $this->get_id();
?>
        <div class="simple-carousel-wrapper" id="<?php echo $id; ?>">
            <div class="swiper simple-carousel">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['slides'] as $slide): ?>
                        <div class="swiper-slide">
                            <div class="slide-content">
                                <?php if (!empty($slide['image']['url'])): ?>
                                    <img src="<?php echo $slide['image']['url']; ?>" alt="<?php echo $slide['title']; ?>">
                                <?php endif; ?>
                                <h3><?php echo $slide['title']; ?></h3>
                                <p><?php echo $slide['description']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <style>
            .simple-carousel-wrapper {
                width: 100%;
                padding: 20px 0;
            }

            .simple-carousel {
                width: 100%;
                height: 300px;
            }

            .swiper-slide {
                background: #fff;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .slide-content img {
                width: 100%;
                height: 150px;
                object-fit: cover;
                border-radius: 5px;
            }
        </style>

        <script>
            jQuery(document).ready(function($) {
                new Swiper('#<?php echo $id; ?> .simple-carousel', {
                    slidesPerView: <?php echo $settings['slides_to_show']; ?>,
                    spaceBetween: 20,
                    loop: true,
                    autoplay: <?php echo $settings['autoplay'] === 'yes' ? '{ delay: 3000 }' : 'false'; ?>,
                    breakpoints: {
                        320: {
                            slidesPerView: 1
                        },
                        768: {
                            slidesPerView: 2
                        },
                        1024: {
                            slidesPerView: <?php echo $settings['slides_to_show']; ?>
                        }
                    }
                });
            });
        </script>
<?php
    }
}
