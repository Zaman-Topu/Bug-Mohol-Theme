<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Bug_Mohol
 */
?>

<aside id="secondary" class="widget-area">

    <!-- Placeholder for 300x250 Ad Banner -->
    <div class="ad-banner-container mb-5 text-center">
        <div class="ad-placeholder bg-light border d-flex align-items-center justify-content-center text-muted shadow-sm"
            style="width: 300px; height: 250px; margin: 0 auto;">
            <span>Ad Banner 300x250</span>
        </div>
    </div>

    <!-- Professional Tabbed Widget (Latest & Popular) -->
    <section class="widget tabbed-widget mb-5 bg-white shadow-sm border rounded overflow-hidden">
        <div class="tabbed-widget-header d-flex border-bottom bg-light">
            <button class="tab-btn active text-primary fw-bold pb-2 pt-3 px-3 border-0 bg-transparent flex-grow-1 position-relative" data-target="tab-latest" style="font-size: 1.1rem; border-bottom: 2px solid transparent;">সর্বশেষ</button>
            <button class="tab-btn fw-bold pb-2 pt-3 px-3 border-0 bg-transparent flex-grow-1 position-relative text-muted" data-target="tab-popular" style="font-size: 1.1rem; border-bottom: 2px solid transparent;">সর্বাধিক পঠিত</button>
        </div>

        <div class="tab-content-container p-3 pt-4 position-relative">
            <!-- Latest Tab -->
            <div id="tab-latest" class="tab-pane fade show active">
                <?php
                $latest_tab_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 5,
                    'ignore_sticky_posts' => true,
                ));
                if ($latest_tab_query->have_posts()):
                    $counter = 1;
                    while ($latest_tab_query->have_posts()): $latest_tab_query->the_post();
                    ?>
                    <article class="tab-post d-flex align-items-center mb-3 pb-3 border-bottom">
                        <div class="tab-post-rank fw-bold text-muted me-3" style="min-width: 24px; font-size: 1.8rem; line-height: 1; opacity: 0.5;"><?php echo bug_mohol_bangla_number($counter); ?></div>
                        <div class="tab-post-content pe-2 flex-grow-1">
                            <h4 class="h6 fw-bold mb-0 line-clamp-2" style="font-size: 1.05rem; line-height: 1.4;"><a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a></h4>
                        </div>
                    </article>
                    <?php
                    $counter++;
                    endwhile; wp_reset_postdata();
                else: echo '<p>No posts found.</p>'; endif;
                ?>
            </div>

            <!-- Popular Tab -->
            <div id="tab-popular" class="tab-pane fade d-none">
                <?php
                $popular_tab_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 5,
                    'orderby' => 'comment_count',
                    'order' => 'DESC',
                    'ignore_sticky_posts' => true,
                ));
                if ($popular_tab_query->have_posts()):
                    $counter = 1;
                    while ($popular_tab_query->have_posts()): $popular_tab_query->the_post();
                    ?>
                    <article class="tab-post d-flex align-items-center mb-3 pb-3 border-bottom">
                        <div class="tab-post-rank fw-bold text-muted me-3" style="min-width: 24px; font-size: 1.8rem; line-height: 1; opacity: 0.5;"><?php echo bug_mohol_bangla_number($counter); ?></div>
                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>" class="flex-shrink-0 me-3 hover-opacity">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="<?php the_title_attribute(); ?>" class="rounded" style="width: 70px; height: 60px; object-fit: cover;" loading="lazy">
                            </a>
                        <?php endif; ?>
                        <div class="tab-post-content flex-grow-1">
                            <h4 class="h6 fw-bold mb-0 line-clamp-2" style="font-size: 1.05rem; line-height: 1.4;"><a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a></h4>
                        </div>
                    </article>
                    <?php
                    $counter++;
                    endwhile; wp_reset_postdata();
                else: echo '<p>No posts found.</p>'; endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Dynamic Widget Area -->
    <?php if (is_active_sidebar('sidebar-1')): ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php endif; ?>

</aside><!-- #secondary -->