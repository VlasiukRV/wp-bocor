<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require_once locate_template('/php/ThemeFunctions.php' );

if (!class_exists('ThemeSpg')) {

    class ThemeBocor
    {
        public $domain = 'bocor';

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;

        }

        function __construct(){
            $this->init();
        }

        public function init() {
//
//            $theme_functions = new ThemeFunctions($this);
//
//            $theme_functions->add_actions();
//            $theme_functions->add_filters();
//            $theme_functions->add_shortcodes();
//
//            add_action( 'widgets_init', array($theme_functions, 'register_sidebar') );
//            $this->init_widgets();
//
            $this->add_opportuninty_upload_svg();
        }

        public function init_widgets() {

            //require_once(__DIR__ . '/widgets/blog-call-to-action-widget.php');

        }

        public function init_elementor_blocks() {

            //require_once(__DIR__ . '/blocks/Widget_SPG_Contact_Us_Form_Block.php');

        }

        private function add_opportuninty_upload_svg() {
            add_filter('upload_mimes', function($mimes) {
                $mimes['svg'] = 'image/svg+xml';
                return $mimes;
            });
        }

        /**
         * Recursively get taxonomy and its children
         *
         * @param string $taxonomy
         * @param int $parent - parent term id
         * @return array
         */
        function get_taxonomy_hierarchy( $taxonomy, $parent = 0 ) {
            // only 1 taxonomy
            $taxonomy = is_array( $taxonomy ) ? array_shift( $taxonomy ) : $taxonomy;
            // get all direct decendants of the $parent
            $terms = get_terms( $taxonomy, array( 'parent' => $parent ) );
            // prepare a new array.  these are the children of $parent
            // we'll ultimately copy all the $terms into this new array, but only after they
            // find their own children
            $children = array();
            // go through all the direct decendants of $parent, and gather their children
            foreach ( $terms as $term ){
                // recurse to get the direct decendants of "this" term
                $term->children = $this->get_taxonomy_hierarchy( $taxonomy, $term->term_id );
                // add the term to our new array
                $children[ $term->term_id ] = $term;
            }
            // send the results back to the caller
            return $children;
        }

        /**
         * Recursively get all taxonomies as complete hierarchies
         *
         * @param $taxonomies array of taxonomy slugs
         * @param $parent int - Starting parent term id
         *
         * @return array
         */
        function get_taxonomy_hierarchy_multiple( $taxonomies, $parent = 0 ) {
            if ( ! is_array( $taxonomies )  ) {
                $taxonomies = array( $taxonomies );
            }
            $results = array();
            foreach( $taxonomies as $taxonomy ){
                $terms = $this->get_taxonomy_hierarchy( $taxonomy, $parent );
                if ( $terms ) {
                    $results[ $taxonomy ] = $terms;
                }
            }
            return $results;
        }

    }

}

ThemeBocor::instance();