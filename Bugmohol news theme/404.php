<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Bug_Mohol
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <section class="error-404 not-found py-5">
                    <div class="error-code mb-4" style="font-size: 8rem; line-height: 1; font-weight: 900; color: var(--primary-color); opacity: 0.1; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: -1;">404</div>
                    
                    <header class="page-header mb-5">
                        <h1 class="page-title fw-bold display-4 mb-3">দুঃখিত! পেজটি পাওয়া যায়নি</h1>
                        <p class="lead text-muted">আপনি যে পাতাটি খুঁজছেন তা হয়তো সরানো হয়েছে অথবা লিঙ্কটি ভুল। নিচের সার্চ বক্সটি ব্যবহার করে দেখতে পারেন।</p>
                    </header><!-- .page-header -->

                    <div class="page-content">
                        <div class="search-form-wrapper p-4 bg-light rounded shadow-sm mb-5 mx-auto" style="max-width: 500px;">
                            <?php get_search_form(); ?>
                        </div>

                        <div class="useful-links">
                            <h2 class="h5 fw-bold mb-4">আপনার জন্য কিছু প্রয়োজনীয় লিঙ্ক:</h2>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary px-4 py-2"><i class="fas fa-home me-2"></i>হোমপেজ</a>
                                <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn-outline-dark px-4 py-2"><i class="fas fa-newspaper me-2"></i>সর্বশেষ খবর</a>
                            </div>
                        </div>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->

                <!-- Recent Posts Suggestion -->
                <section class="recent-posts-suggestion mt-5 pt-5 border-top text-start">
                    <h3 class="h4 fw-bold mb-4">সর্বশেষ খবরগুলো পড়ুন:</h3>
                    <div class="row g-4">
                        <?php
                        $recent_posts = new WP_Query( array(
                            'posts_per_page'      => 3,
                            'post_status'         => 'publish',
                            'ignore_sticky_posts' => 1
                        ) );

                        if ( $recent_posts->have_posts() ) :
                            while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                                <div class="col-md-4">
                                    <div class="card h-100 border-0 shadow-sm hover-card">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>" style="height: 160px; object-fit: cover;">
                                            </a>
                                        <?php endif; ?>
                                        <div class="card-body p-3">
                                            <h4 class="h6 fw-bold mb-0">
                                                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
