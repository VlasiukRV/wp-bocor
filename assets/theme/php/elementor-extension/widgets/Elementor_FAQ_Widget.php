<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_FAQ_Widget extends \Elementor\Widget_Base {

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
        return 'faq';
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
        return __( 'FAQ', 'elementor-bocor-extension' );
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
                'placeholder' => __( 'Frequently Asked Questions', 'elementor-bocor-extension' ),
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => __( 'Title', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'List Title' , 'plugin-domain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => __( 'Content', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'List Content' , 'plugin-domain' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => __( 'Repeater List', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __( 'Title #1', 'plugin-domain' ),
                        'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
                    ],
                    [
                        'list_title' => __( 'Title #2', 'plugin-domain' ),
                        'list_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
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


        $faq_items_html = '';
        foreach (  $settings['list'] as $item ) {

            $faq_items_html = '' . $faq_items_html . sprintf(
    '
            
        <div class="row faq-item d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up">
          <div class="col-lg-5">
            <i class="bx bx-help-circle"></i>
            <h4>%1$s</h4>
          </div>
          <div class="col-lg-7">
            <p>
              %2$s
            </p>
          </div>
        </div><!-- End F.A.Q Item-->
            
            
            ',
            esc_html__( $item['list_title'] ),
             $item['list_content']
        );
        }

        $html = sprintf(
            '
        
        <div class="container">

        <div class="section-title">
          <h2 data-aos="fade-in" class="aos-init aos-animate">%1$s</h2>
          <p data-aos="fade-in" class="aos-init aos-animate">%2$s</p>
        </div>

        %3$s

      </div>        
        
        ',
            esc_html__( $settings['title'] ),
            esc_html__( $settings['description'] ),
            $faq_items_html
        );


        echo '<section id="faq" class="faq section-bg">';

        echo ( $html );

        echo '</section>';

    }

}