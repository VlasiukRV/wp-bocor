<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>


            <title>Bocor Bootstrap Template - Index</title>
            <meta content="" name="descriptison">
            <meta content="" name="keywords">

            <!-- Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	</head>

	<body <?php body_class(); ?> data-aos-easing="ease-in-out" data-aos-duration="800" data-aos-delay="0">

		<?php
		wp_body_open();
		?>

		<header id="header" class="header-footer-group" role="banner">

            <button type="button" class="mobile-nav-toggle d-lg-none"><i class="icofont-navigation-menu"></i></button>

            <!-- ======= Header ======= -->
                <div class="container d-flex">

                    <div class="logo mr-auto">

                        <h1 class="text-light"><a href="index.html">

						<?php
							// Site title or logo.
							twentytwenty_site_logo('<span>.</span>');

							// Site description.
							//twentytwenty_site_description();
						?>

                        </h1>

                    </div>

                    <nav class="nav-menu d-none d-lg-block">
                        <ul>

								<?php
								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);

								} elseif ( ! has_nav_menu( 'expanded' ) ) {

									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new TwentyTwenty_Walker_Page(),
										)
									);

								}
								?>
                            <li class="get-started"><a href="#contact">Get Started</a></li>

                        </ul>
                    </nav><!-- .nav-menu -->

                </div>
            <!-- End Header -->

		</header><!-- #site-header -->

    <nav class="mobile-nav d-lg-none">
        <ul>
            <li class="active"><a href="#header">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#portfolio">Portfolio</a></li>
            <li><a href="#team">Team</a></li>
            <li class="drop-down"><a href="">Drop Down</a>
                <ul>
                    <li><a href="#">Drop Down 1</a></li>
                    <li class="drop-down"><a href="#">Drop Down 2</a>
                        <ul>
                            <li><a href="#">Deep Drop Down 1</a></li>
                            <li><a href="#">Deep Drop Down 2</a></li>
                            <li><a href="#">Deep Drop Down 3</a></li>
                            <li><a href="#">Deep Drop Down 4</a></li>
                            <li><a href="#">Deep Drop Down 5</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Drop Down 3</a></li>
                    <li><a href="#">Drop Down 4</a></li>
                    <li><a href="#">Drop Down 5</a></li>
                </ul>
            </li>
            <li><a href="#contact">Contact Us</a></li>

            <li class="get-started"><a href="#about">Get Started</a></li>
        </ul>
    </nav>

		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
