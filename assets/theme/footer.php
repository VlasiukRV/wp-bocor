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
                                <h3>Bocor</h3>
                                <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
                            </div>
                        </div>

                        <div class="row footer-newsletter justify-content-center">
                            <div class="col-lg-6">
                                <form action="" method="post">
                                    <input type="email" name="email" placeholder="Enter your Email"><input type="submit" value="Subscribe">
                                </form>
                            </div>
                        </div>

                        <div class="social-links">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>

                    </div>
                </div>

                <div class="container footer-bottom clearfix">
                    <div class="copyright">
                        &copy;
                            <?php
							echo date_i18n(
								/* translators: Copyright date format, see https://www.php.net/date */
								_x( 'Y', 'copyright date format', 'twentytwenty' )
							);
							?>
                        Copyright
                        <strong><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></span></strong>.
                        All Rights Reserved
                    </div>
                    <div class="credits">
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>
                </div>

            </footer>

<!-- End Footer -->

<?php wp_footer(); ?>

	</body>
</html>
