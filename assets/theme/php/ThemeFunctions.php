<?php
// Custom Elementor_Bocor_Extension .
require_once locate_template( 'php/elementor-extension/Elementor_Bocor_Extension.php' );

if (!class_exists('ThemeFunctions')) {

    class ThemeFunctions
    {
        private $theme;

        function __construct(ThemeBocor $theme){
            $this->theme = $theme;
        }

        public function add_actions() {
            add_action( 'elementor/widgets/widgets_registered', array( $this->theme, 'init_elementor_blocks' ), 26 );

            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_theme_frontend'), 111 );

        }

        public function add_filters() {

        }

        public function register_sidebar() {

            register_sidebar(
                array(
                    'id'            => 'blog_page_sidebar',
                    'name'          => esc_html__( 'Blog Page Sidebar', 'uptime' ),
                    'before_widget' => '<div id="%1$s" class="widget mb-4 %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h5>',
                    'after_title'   => '</h5>'
                )
            );

            register_sidebar(
                array(
                    'id'            => 'mobile_blog_sidebar',
                    'name'          => esc_html__( 'Mobile Blog Sidebar', 'uptime' ),
                    'before_widget' => '<div id="%1$s" class="widget mb-4 %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h5>',
                    'after_title'   => '</h5>'
                )
            );

        }

        public function add_shortcodes() {
            add_shortcode( 'spg_video_outline_button', array( $this, 'spg_video_outline_button_shortcode') );
        }

        public function enqueue_theme_frontend() {
            $this->enqueue_theme_styles();
            $this->enqueue_theme_scripts();
        }

        public function enqueue_theme_styles() {
            $theme_version = wp_get_theme()->get('Version');

            // Add Vendor CSS Files.
            wp_enqueue_style( 'bootstrap-css',  get_stylesheet_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css',    null, $theme_version );
            wp_enqueue_style( 'icofont-css',    get_stylesheet_directory_uri() . '/vendor/icofont/icofont.min.css',            null, $theme_version );
            wp_enqueue_style( 'boxicons-css',   get_stylesheet_directory_uri() . '/vendor/boxicons/css/boxicons.min.css',      null, $theme_version );
            wp_enqueue_style( 'venobox-css',    get_stylesheet_directory_uri() . '/vendor/venobox/venobox.css',                null, $theme_version );
            wp_enqueue_style( 'aos-css',        get_stylesheet_directory_uri() . '/vendor/aos/aos.css',                        null, $theme_version );

            // Add Theme CSS Files.
            wp_enqueue_style('style-bocor', get_stylesheet_directory_uri() . '/css/bocor-style.css');
            wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css',                                        null, $theme_version);
            wp_enqueue_style('theme-child-style',get_stylesheet_directory_uri() . '/style.css',                                 array('theme-style'), $theme_version);

        }

        public function enqueue_theme_scripts() {
            $theme_version = wp_get_theme()->get('Version');

            wp_register_style('google-open-sans', 'https://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,700,700i');

            // Vendor JS Files
            wp_enqueue_script( 'jquery-js', get_stylesheet_directory_uri() . '/vendor/jquery/jquery.min.js', array(), $theme_version, true );
            wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js', array(), $theme_version, true );
            wp_enqueue_script( 'jquery-easing-js', get_stylesheet_directory_uri() . '/vendor/jquery.easing/jquery.easing.min.js', array(), $theme_version, true );
            wp_enqueue_script( 'php-email-form-validate-js', get_stylesheet_directory_uri() . '/vendor/php-email-form/validate.js', array(), $theme_version, true );
            wp_enqueue_script( 'isotope-layout-js', get_stylesheet_directory_uri() . '/vendor/isotope-layout/isotope.pkgd.min.js', array(), $theme_version, true );
            wp_enqueue_script( 'venobox-js', get_stylesheet_directory_uri() . '/vendor/venobox/venobox.min.js', array(), $theme_version, true );
            wp_enqueue_script( 'aos-js', get_stylesheet_directory_uri() . '/vendor/aos/aos.js', array(), $theme_version, true );

            wp_register_script('scripts-bocor', get_stylesheet_directory_uri() . '/js/main.js', array('jquery-js', 'bootstrap-js', 'jquery-easing-js', 'php-email-form-validate-js', 'isotope-layout-js', 'venobox-js', 'aos-js'), $theme_version, true);
            wp_enqueue_script('scripts-bocor' );
            wp_localize_script( 'scripts-bocor', 'wp_var', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
        }

        public function spg_video_outline_button_shortcode($atts) {
            $values = shortcode_atts(
                array(
                    'media_url' 	=> '',
                    'button_style'	=> 'icon',
                    'button_label'	=> 'Watch Video'
                ),
                $atts );

            if( 'button' == $values['button_style'] ) {
                $output = '
                <a class="btn btn-md btn-outline-primary aos-init aos-animate" data-fancybox data-aos="fade-up" href="'. esc_url( $values['media_url'] ) .'">'. $values['button_label'] .'</a>';
            } else {
                $output = '
				<a data-fancybox href="'. esc_url( $values['media_url'] ) .'" class="btn btn-xlg btn-primary btn-round mx-auto mb-4 aos-init aos-animate" data-aos="fade-up">
		    		'. tommusrhodus_svg_icons_pluck( 'Play', 'icon' ) .'
		    	</a>';
            }

            return $output;

        }

    }

}

