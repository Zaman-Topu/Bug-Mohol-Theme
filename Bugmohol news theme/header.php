<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text d-none" href="#primary"><?php esc_html_e( 'Skip to content', 'bug-mohol' ); ?></a>

	<header id="masthead" class="site-header">
		
		<!-- Image Match Top Bar -->
		<div class="header-top py-3 py-lg-4 bg-white">
			<div class="container">
				<div class="row align-items-center">
					
					<!-- Left: Location & Date (Matching Image) -->
					<div class="col-lg-5 col-md-12 d-flex align-items-center justify-content-center justify-content-lg-start gap-2 mb-3 mb-lg-0">
						<div class="d-flex align-items-center gap-2">
							<i class="fas fa-map-marker-alt text-danger"></i>
							<span class="fw-bold text-dark" style="font-size: 15px;">ঢাকা</span>
						</div>
						<div class="vr mx-2 bg-secondary opacity-50" style="height: 20px; width: 1.5px;"></div>
						<div class="d-flex align-items-center gap-2 text-muted live-bangla-clock" style="font-size: 14px;">
							<i class="far fa-calendar-alt"></i>
							<span><?php echo bug_mohol_bangla_date(date_i18n('l, d F Y')); ?></span>
						</div>
					</div>

					<!-- Center: Logo (Matching Image) -->
					<div class="col-lg-2 col-12 text-center mb-3 mb-lg-0">
						<div class="site-branding">
							<?php
							if ( has_custom_logo() ) :
								the_custom_logo();
							else :
								?>
								<h1 class="site-title m-0">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-dark text-decoration-none site-title-image-match">
										<?php bloginfo( 'name' ); ?>
									</a>
								</h1>
							<?php endif; ?>
						</div>
					</div>

					<!-- Right: Social & Button (Matching Image) -->
					<div class="col-lg-5 col-md-12 d-flex justify-content-center justify-content-lg-end align-items-center gap-3">
						<div class="header-social-links-match d-flex gap-2">
							<a href="#" class="social-circle-match"><i class="fab fa-facebook-f"></i></a>
							<a href="#" class="social-circle-match">
								<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
									<path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
								</svg>
							</a>
							<a href="#" class="social-circle-match"><i class="fab fa-linkedin-in"></i></a>
							<a href="#" class="social-circle-match"><i class="fab fa-youtube"></i></a>
							<a href="#" class="social-circle-match"><i class="fab fa-instagram"></i></a>
							<a href="#" class="social-circle-match"><i class="fab fa-whatsapp"></i></a>
						</div>
						<a href="#" class="english-btn-match btn btn-sm rounded-1 px-3 py-1 fw-bold text-dark border">English</a>
					</div>

				</div>
			</div>
		</div>

		<!-- Main Navigation Bar -->
		<nav id="site-navigation" class="navbar navbar-expand-lg navbar-light bg-white py-0 sticky-top image-match-navbar border-top border-bottom">
			<div class="container position-relative">
				
				<!-- Mobile Header -->
				<div class="d-flex d-lg-none w-100 justify-content-between align-items-center py-2 px-2">
					<button class="navbar-toggler border-0 p-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#primary-navbar">
						<i class="fas fa-bars-staggered fs-3"></i>
					</button>
					<div class="mobile-logo-match">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-dark text-decoration-none fw-bold fs-4 site-title-image-match" style="font-size: 24px !important;">
							<?php bloginfo( 'name' ); ?>
						</a>
					</div>
					<a href="#searchOffcanvas" data-bs-toggle="offcanvas" class="text-dark"><i class="fas fa-search"></i></a>
				</div>

				<!-- Desktop Menu Centered -->
				<div class="collapse navbar-collapse w-100">
					<div class="d-flex justify-content-center w-100">
						<?php
						if ( has_nav_menu( 'primary' ) ) {
							wp_nav_menu( array(
								'theme_location'  => 'primary',
								'menu_id'         => 'primary-menu-desktop',
								'container'       => false,
								'menu_class'      => 'navbar-nav image-match-nav-links',
								'fallback_cb'     => 'wp_page_menu',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 1,
								'walker'          => new Bootstrap_5_WP_Nav_Walker(),
							) );
						}
						?>
					</div>

					<!-- Icons on right -->
					<div class="nav-icons-right d-none d-lg-flex align-items-center gap-3 ms-auto" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%);">
						<a href="#searchOffcanvas" data-bs-toggle="offcanvas" class="text-dark hover-primary"><i class="fas fa-search"></i></a>
						<button id="darkModeToggle" class="btn btn-link p-0 text-dark border-0 shadow-none hover-primary">
							<i id="themeIcon" class="fas fa-moon"></i>
						</button>
					</div>
				</div>

			</div>
		</nav>

		<!-- Offcanvas Menu Drawer for Mobile -->
		<div class="offcanvas offcanvas-start" tabindex="-1" id="primary-navbar">
			<div class="offcanvas-header border-bottom py-3 px-4">
				<h5 class="offcanvas-title fw-bold site-title-image-match" id="primaryNavbarLabel">
					<?php bloginfo( 'name' ); ?>
				</h5>
				<button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body p-0">
				<div class="mobile-menu-container">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array(
							'theme_location'  => 'primary',
							'menu_id'         => 'primary-menu-mobile',
							'container'       => false,
							'menu_class'      => 'navbar-nav mobile-nav-links w-100',
							'fallback_cb'     => 'wp_page_menu',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 2,
							'walker'          => new Bootstrap_5_WP_Nav_Walker(),
						) );
					}
					?>
				</div>
				
				<!-- Mobile Sidebar Footer Actions -->
				<div class="offcanvas-footer mt-auto border-top p-4 bg-light">
					<div class="row text-center">
						<div class="col-6 border-end">
							<button id="darkModeToggleMobile" class="btn btn-link text-dark text-decoration-none shadow-none flex-column d-flex align-items-center gap-2">
								<i class="fas fa-moon"></i>
								<span class="small fw-bold">ডার্ক মোড</span>
							</button>
						</div>
						<div class="col-6">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-link text-dark text-decoration-none shadow-none flex-column d-flex align-items-center gap-2">
								<i class="fas fa-home"></i>
								<span class="small fw-bold">প্রচ্ছদ</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header><!-- #masthead -->

	<!-- Full Screen Search Overlay -->
	<div class="offcanvas offcanvas-top search-overlay" tabindex="-1" id="searchOffcanvas" style="height: auto;">
		<div class="offcanvas-header container py-3">
			<h5 class="offcanvas-title fw-bold" id="searchOffcanvasLabel">অনুসন্ধান করুন</h5>
			<button type="button" class="btn-close ms-auto shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body container py-5 d-flex align-items-center justify-content-center">
			<form role="search" method="get" class="search-form w-100" style="max-width: 800px;" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="input-group search-input-group shadow-sm rounded-pill overflow-hidden border">
					<input type="search" class="form-control border-0 px-4 py-3 shadow-none" placeholder="কী খুঁজতে চাইছেন?" value="<?php echo get_search_query(); ?>" name="s" required>
					<button class="btn btn-primary border-0 px-4" type="submit"><i class="fas fa-search"></i> খুঁজুন</button>
				</div>
			</form>
		</div>
	</div>
