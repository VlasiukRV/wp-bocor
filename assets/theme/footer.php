<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">

        <div class="container" data-aos="fade-up">

            <div class="row  justify-content-center">
                <div class="col-lg-6">
                    <h3><?php bloginfo('name'); ?></h3>
                    <p>Sign up for our monthly newsletters to get the latest blog posts and updates.</p>
                </div>
            </div>

            <div class="row footer-newsletter justify-content-center">
                <div class="col-lg-6">
                    <form action="" method="post">
                        <input type="email" name="email" placeholder="Enter your Email"><input type="submit"
                                                                                               value="Subscribe">
                    </form>
                </div>
            </div>

            <?php
            if (has_nav_menu('social')) {

                if (!class_exists('Bocor_Walker')) {


                    class Bocor_Walker extends Walker_Nav_Menu
                    {
                        function start_el(&$output, $item, $depth = 0, $args = NULL, $id = 0)
                        {
                            $classes = empty($item->classes) ? array() : (array)$item->classes;
                            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
                            !empty ($class_names) and $class_names = ' class="' . $item->title . esc_attr($class_names) . '"';
                            $output .= "";
                            $attributes = " class='" . $item->title . "' ";
                            !empty($item->attr_title) and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
                            !empty($item->target) and $attributes .= ' target="' . esc_attr($item->target) . '"';
                            !empty($item->xfn) and $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
                            !empty($item->url) and $attributes .= ' href="' . esc_attr($item->url) . '"';

                            $item_output = $args->before
                                . "<a $attributes>"
                                . $args->link_before

                                . '<i class="' . implode(' ', $item->classes) . '"></i>'

                                . '</a>'
                                . $args->link_after
                                . $args->after;
                            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
                        }
                    }
                }

                wp_nav_menu(
                    array(
                        'theme_location' => 'social',
                        'container' => 'div',
                        'container_class' => 'social-links',
                        'link_before' => '',
                        'items_wrap' => '%3$s',
                        'menu_id' => '',
                        'menu_class' => '',
                        'depth' => 1,
                        'fallback_cb' => '',
                        'walker' => new Bocor_Walker
                    )
                );
            }
            ?>

        </div>
    </div>

    <div class="container footer-bottom clearfix">
        <div class="copyright">
            &copy;
            <?php
            echo date_i18n(
            /* translators: Copyright date format, see https://www.php.net/date */
                _x('Y', 'copyright date format', 'twentytwenty')
            );
            ?>
            Copyright
            <strong><span><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></span></strong>.
            All Rights Reserved
        </div>
    </div>

</footer>

<!-- End Footer -->

<?php wp_footer(); ?>

</body>
</html>
