<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Hero_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'hero';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Hero', 'elementor-bocor-extension' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa fa-code';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'bocor-extension' ];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'elementor-bocor-extension' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'elementor-bocor-extension' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'input_type' => 'text',
                'placeholder' => __( 'Team', 'elementor-bocor-extension' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'elementor-bocor-extension' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'input_type' => 'textarea',
                'placeholder' => __( 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.', 'elementor-bocor-extension' ),
            ]
        );

        $this->add_control(
            'img', [
                'label' => __( 'Img', 'elementor-bocor-extension' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
            ]
        );

        $this->add_control(
            'hero_url',
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
    protected function render() {

        $settings = $this->get_settings_for_display();

        $html = sprintf(
            '

        <div class="container">
              <div class="row d-flex align-items-center" "="">
              <div class="col-lg-6 py-5 py-lg-0 order-2 order-lg-1 aos-init aos-animate" data-aos="fade-right">
                <h1>%1$s</h1>
                <h2>%2$s</h2>
                <a href="%4$s" class="btn-get-started scrollto">Get Started</a>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 hero-img aos-init aos-animate" data-aos="fade-left">
                <img src="%3$s" class="img-fluid" alt="">
              </div>
            </div>
            </div>

        ',
            esc_html__( $settings['title'] ),
            esc_html__( $settings['description'] ),
            esc_html__( $settings['img']['url'] ),
            esc_html__( $settings['hero_url']['url'] )
        );


        echo '<section id="hero">';

            echo ( $html );

        echo '</section>';

    }

}