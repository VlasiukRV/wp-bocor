<?php
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_ContactForm_Widget extends \Elementor\Widget_Base {

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
        return 'contactForm';
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
        return __( 'contactForm', 'elementor-bocor-extension' );
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
                'placeholder' => __( 'CONTACT', 'elementor-bocor-extension' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'elementor-bocor-extension' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'input_type' => 'textarea',
                'placeholder' => __( 'Description', 'elementor-bocor-extension' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'contactData_section',
            [
                'label' => __( 'Contact Data', 'elementor-bocor-extension' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'contact_address',
            [
                'label' => __( 'Address', 'elementor-bocor-extension' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => __( 'A108 Adam Street, New York, NY 535022', 'elementor-bocor-extension' ),
            ]
        );

        $this->add_control(
            'contact_email',
            [
                'label' => __( 'Email', 'elementor-bocor-extension' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'email',
                'placeholder' => __( 'contact@example.com', 'elementor-bocor-extension' ),
            ]
        );

        $this->add_control(
            'contact_phone',
            [
                'label' => __( 'Phone', 'elementor-bocor-extension' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => __( '+1 5589 55488 55', 'elementor-bocor-extension' ),
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

        $html = wp_oembed_get( $settings['url'] );

        $html = sprintf(
            '
            <div class="container">
            <div class="section-title">
            <h2 data-aos="fade-in" class="aos-init aos-animate">%1$s</h2>
            <p data-aos="fade-in" class="aos-init aos-animate">%2$s</p>
            </div>
            <div class="row">
            <div class="col-lg-6">
            <div class="row">
            <div class="col-md-12">
            <div class="info-box aos-init aos-animate" data-aos="fade-up"><i class="bx bx-map"></i>
            <h3>Our Address</h3>
            <p>%3$s</p>
            </div>
            </div>
            <div class="col-md-6">
            <div class="info-box mt-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100"><i class="bx bx-envelope"></i>
            <h3>Email Us</h3>
            <p>%4$s</p>
            </div>
            </div>
            <div class="col-md-6">
            <div class="info-box mt-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100"><i class="bx bx-phone-call"></i>
            <h3>Call Us</h3>
            <p>%5$s</p>
            </div>
            </div>
            </div>
            </div>
            <div class="col-lg-6"><form class="php-email-form aos-init aos-animate" role="form" action="forms/contact.php" method="post" data-aos="fade-up">
            <div class="form-row">
            <div class="col-md-6 form-group"><input id="name" class="form-control" name="name" type="text" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
            <div class="validate">&nbsp;</div>
            </div>
            <div class="col-md-6 form-group"><input id="email" class="form-control" name="email" type="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
            <div class="validate">&nbsp;</div>
            </div>
            </div>
            <div class="form-group"><input id="subject" class="form-control" name="subject" type="text" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
            <div class="validate">&nbsp;</div>
            </div>
            <div class="form-group"><textarea class="form-control" name="message" rows="5" placeholder="Message" data-rule="required" data-msg="Please write something for us"></textarea></div>
                <div class="mb-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                
                <div class="text-center"><button type="submit">Send Message</button></div>
                                
            </form></div>
            </div>
            </div>        
        ',
            esc_html__( $settings['title'] ),
            esc_html__( $settings['description'] ),
            esc_html__( $settings['contact_address'] ),
            esc_html__( $settings['contact_email'] ),
            esc_html__( $settings['contact_phone'] )
        );

        echo '<section id="contact" class="contact section-bg">';

            echo ( $html );

        echo '</section>';

    }

}