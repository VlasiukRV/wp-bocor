<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_About_Widget extends \Elementor\Widget_Base {

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
        return 'about';
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
        return __( 'About', 'elementor-bocor-extension' );
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
                'type' => \Elementor\Controls_Manager::TEXT,
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => __( 'Title', 'elementor-bocor-extension' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'List Title' , 'plugin-domain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => __( 'Content', 'elementor-bocor-extension' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'List Content' , 'elementor-bocor-extension' ),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'list_icon', [
                'label' => __( 'Icon', 'elementor-bocor-extensionn' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'List Icon' , 'elementor-bocor-extension' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __( 'Repeater List', 'elementor-bocor-extension' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __( 'Title #1', 'elementor-bocor-extension' ),
                        'list_content' => __( 'Item content. Click the edit button to change this text.', 'elementor-bocor-extension' ),
                    ],
                    [
                        'list_title' => __( 'Title #2', 'elementor-bocor-extension' ),
                        'list_content' => __( 'Item content. Click the edit button to change this text.', 'elementor-bocor-extension' ),
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
    protected function render() {

        $settings = $this->get_settings_for_display();


        $team_items_html = '';
        foreach (  $settings['list'] as $item ) {

            $team_items_html = '' . $team_items_html . sprintf(
    '
            
        <div class="col-md-12 icon-box aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                          <i class="%3$s"></i>
                          <h4><a href="#">%1$s</a></h4>
                          <p>%2$s</p>
                        </div>
            
            
            ',
            esc_html__( $item['list_title'] ),
             $item['list_content'],
             $item[ 'list_icon' ]
        );
        }

        $html = sprintf(
            '

        <div class="container">

                <div class="row">
                  <div class="image col-xl-7 d-flex align-items-stretch justify-content-center justify-content-lg-start">
                    <img src="%3$s" alt="...">
                  </div>
                  <div class="col-xl-5 pl-0 pl-lg-5 pr-lg-1 d-flex align-items-stretch">
                    <div class="content d-flex flex-column justify-content-center">
                      <h3 data-aos="fade-in" data-aos-delay="100" class="aos-init aos-animate">%1$s</h3>
                      <p data-aos="fade-in" class="aos-init aos-animate">
                        %2$s
                      </p>
                      <div class="row">

                        %4$s

                      </div>
                    </div><!-- End .content-->
                  </div>
                </div>

              </div>

        ',
            esc_html__( $settings['title'] ),
            esc_html__( $settings['description'] ),
            esc_html__( $settings['img']['url'] ),
            $team_items_html
        );


        echo '<section id="about" class="about section-bg">';

            echo ( $html );

        echo '</section>';

    }

}