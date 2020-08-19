<?php

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Services_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'services';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Services', 'elementor-bocor-extension');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'fa fa-code';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @return array Widget categories.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_categories()
    {
        return ['bocor-extension'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-bocor-extension'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'elementor-bocor-extension'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => __('Team', 'elementor-bocor-extension'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'elementor-bocor-extension'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'input_type' => 'textarea',
                'placeholder' => __('Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.', 'elementor-bocor-extension'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => __('Title', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('List Title', 'plugin-domain'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => __('Content', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('List Content', 'plugin-domain'),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'list_img', [
                'label' => __('Content', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_content_url',
            [
                'label' => __('Text Position', 'elementor-bocor-extension'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
                'show_external' => true,
                'default' => [
                        'url' => '#',
                        'is_external' => true,
                        'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'fade_option',
            [
                'label' => __('Text Position', 'elementor-bocor-extension'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left' => __('Fade left', 'elementor-bocor-extension'),
                    'right' => __('Fade right', 'elementor-bocor-extension'),
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __('Repeater List', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __('Title #1', 'plugin-domain'),
                        'list_content' => __('Item content. Click the edit button to change this text.', 'plugin-domain'),
                    ],
                    [
                        'list_title' => __('Title #2', 'plugin-domain'),
                        'list_content' => __('Item content. Click the edit button to change this text.', 'plugin-domain'),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();


        $services_items_html = '';
        foreach ($settings['list'] as $item) {

            $fade_option = ($item["fade_option"] == "right") ? "fade-right" : "fade-left";

            $service_item_html_template = '

            <div class="col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="' . $fade_option . '">
                        <div class="card">
                          <div class="card-img">
                            <img src="%3$s" alt="...">
                          </div>
                          <div class="card-body">
                            <h5 class="card-title"><a href="">%1$s</a></h5>
                            <p class="card-text">%2$s</p>
                            <div class="read-more"><a href="%2$s"><i class="icofont-arrow-right"></i> Read More</a></div>
                          </div>
                        </div>
                      </div>

            ';

            $services_items_html = '' . $services_items_html .
                sprintf($service_item_html_template,
                    esc_html__($item['list_title']),
                    $item['list_content'],
                    $item['list_img']['url'],
                    $item['list_content_url']['url']
                );

        }

        $html = sprintf(
            '        
            <div class="container">
                <div class="section-title">
                    <h2 data-aos="fade-in" class="aos-init aos-animate">%1$s</h2>
                    <p data-aos="fade-in" class="aos-init aos-animate">%2$s</p>
                </div>
                <div class="row">
                    %3$s
                </div>
            </div>        
        ',
            esc_html__($settings['title']),
            esc_html__($settings['description']),
            $services_items_html
        );


        echo '<section id="services" class="services section-bg">';

            echo($html);

        echo '</section>';

    }

}