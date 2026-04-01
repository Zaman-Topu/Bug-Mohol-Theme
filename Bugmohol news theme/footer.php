<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Bug_Mohol
 */

?>

<footer id="colophon" class="site-footer bg-light border-top">
    <div class="container pt-4 pb-2">
        <!-- Top Row: Links -->
        <div class="row mb-4 pb-3 border-bottom border-secondary-subtle">
            <div class="col-md-12">
                 <?php
                 // Horizontal menu for important links
                 wp_nav_menu(array(
                     'theme_location' => 'footer',
                     'container' => false,
                     'menu_class' => 'd-flex flex-wrap justify-content-center justify-content-md-start gap-3 list-unstyled m-0 footer-top-nav',
                     'fallback_cb' => false,
                 ));
                 ?>
            </div>
        </div>

        <!-- Middle Row: Editor Info & Contact -->
        <div class="row mb-4 pb-3 border-bottom border-secondary-subtle">
            <div class="col-md-6 mb-4 mb-md-0 pe-md-5">
                <!-- Editor Info -->
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                <?php else: ?>
                <div class="footer-editor-info text-muted small" style="font-size: 0.95rem; line-height: 1.8;">
                    <p class="mb-1"><strong class="text-dark fw-bold">সম্পাদক:</strong> [আপনার নাম] <span class="mx-2 text-secondary">|</span> <strong class="text-dark fw-bold">প্রকাশক:</strong> [প্রকাশকের নাম]</p>
                    <p class="mb-0">[পত্রিকার নাম] মিডিয়া লিমিটেডের পক্ষে প্রকাশক কর্তৃক [প্রেসের নাম ও ঠিকানা] থেকে মুদ্রিত এবং [অফিসের ঠিকানা, যেমন: ১২৩/এ, কারওয়ান বাজার, ঢাকা-১২১৫] থেকে প্রকাশিত।</p>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 text-md-end text-muted small" style="font-size: 0.95rem; line-height: 1.8;">
                <!-- Contact Info -->
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                <?php else: ?>
                <p class="mb-1"><strong class="text-dark fw-bold">ই-মেইল:</strong> info@bugmohol.com</p>
                <p class="mb-0"><strong class="text-dark fw-bold">বিজ্ঞাপন:</strong> <span dir="ltr">+৮৮ ০১৯XX XXXXXX</span> <span class="mx-2 text-secondary">|</span> <strong class="text-dark fw-bold">ই-মেইল:</strong> ads@bugmohol.com</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Bottom Row: Social & Apps -->
        <div class="row align-items-center mb-3">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="d-flex align-items-center gap-3 justify-content-center justify-content-md-start">
                    <?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-4' ); ?>
                    <?php else: ?>
                    <span class="fw-bold text-dark small">সোশ্যাল মিডিয়া:</span>
                    <a href="#" class="social-icon-pro facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon-pro youtube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-icon-pro twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon-pro instagram"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4 mb-md-0">
                 <?php
                        if (has_custom_logo()):
                            the_custom_logo();
                        else:
                            ?>
                            <h2 class="h2 fw-bold mb-0 text-dark"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="text-dark text-decoration-none" style="font-family: var(--heading-font); letter-spacing: -1px;">
                                    <?php bloginfo('name'); ?>
                                </a></h2>
                        <?php endif; ?>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <div class="footer-important-links d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                    <?php if ( is_active_sidebar( 'footer-5' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-5' ); ?>
                    <?php else: ?>
                    <a href="#" class="footer-outline-link">আমাদের সম্পর্কে</a>
                    <a href="#" class="footer-outline-link">যোগাযোগ</a>
                    <a href="#" class="footer-outline-link">ব্যবহারের শর্তাবলি</a>
                    <a href="#" class="footer-outline-link">গোপনীয়তার নীতি</a>
                    <a href="#" class="footer-outline-link">বিজ্ঞাপন</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Very Bottom Copyright -->
    <div class="bg-white py-3 border-top border-secondary-subtle footer-copyright-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start small text-muted mb-2 mb-md-0" style="font-size: 0.85rem;">
                    স্বত্ব &copy; <?php echo bug_mohol_bangla_number(date('Y')); ?> <strong class="text-dark"><?php bloginfo('name'); ?></strong>। সর্বস্বত্ব সংরক্ষিত।
                </div>
                <div class="col-md-6 text-center text-md-end small text-muted" style="font-size: 0.85rem;">
                     Developed by <a href="#" class="text-dark text-decoration-none fw-medium hover-primary">Toufique Zaman Topu</a>
                </div>
            </div>
        </div>
    </div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>