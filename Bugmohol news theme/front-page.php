<?php
/**
 * The front page template file
 *
 * @package Bug_Mohol
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container">

        <?php
        // Determine pagination status
        $paged = (get_query_var('paged')) ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
        $is_first_page = (1 === $paged);
        ?>

        <!-- Top Ad Banner (728x90 Placeholder) - ONLY ON FIRST PAGE -->
        <?php if ($is_first_page): ?>
            <div class="ad-banner-container text-center mb-4">
                <div class="ad-placeholder bg-light border d-inline-flex align-items-center justify-content-center text-muted shadow-sm w-100"
                    style="max-width: 728px; height: 90px; border-radius: 4px;">
                    <span class="small fw-semibold"><i class="fas fa-ad me-1"></i> Advertisement Banner (728 x 90)</span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Breaking News Ticker - ONLY ON FIRST PAGE -->
        <?php if ($is_first_page): ?>
            <?php
            $ticker_query = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 8,
                'ignore_sticky_posts' => true
            ));
            if ($ticker_query->have_posts()):
            ?>
            <div class="breaking-news-ticker bg-white shadow-sm rounded mb-4 d-flex align-items-center border overflow-hidden">
                <div class="ticker-label bg-primary text-white fw-bold px-3 py-2 d-flex align-items-center z-1 position-relative" style="white-space: nowrap;">
                    <span class="live-circle bg-danger me-2 shadow-sm" style="width: 8px; height: 8px; border-radius: 50%; display: inline-block; animation: blinker 1.5s linear infinite;"></span>
                    <span>শিরোনাম</span>
                </div>
                <div class="ticker-content flex-grow-1 overflow-hidden position-relative ms-2">
                    <div class="ticker-items d-flex align-items-center">
                        <?php 
                        $ticker_posts = [];
                        while ($ticker_query->have_posts()) : $ticker_query->the_post(); 
                            $ticker_posts[] = '
                            <a href="'.get_the_permalink().'" class="ticker-item text-dark text-decoration-none hover-primary mx-4 d-inline-flex align-items-center">
                                <i class="fas fa-chevron-right text-primary me-2 fs-6" style="font-size: 0.85rem !important;"></i> '.get_the_title().'
                            </a>';
                        endwhile; 
                        wp_reset_postdata(); 
                        
                        // Output duplicated items for infinite smooth scrolling CSS animation
                        foreach($ticker_posts as $post_html) echo $post_html;
                        foreach($ticker_posts as $post_html) echo $post_html;
                        ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Hero Section (Samakal Style) - ONLY ON FIRST PAGE -->
        <?php if ($is_first_page): ?>
            <section class="samakal-hero-section mb-5 mt-4">
                <?php
                $hero_query = new WP_Query(array(
                    'post_type'           => 'post',
                    'posts_per_page'      => 6, // 1 Main Post + 5 Side Posts
                    'ignore_sticky_posts' => true,
                ));

                if ($hero_query->have_posts()):
                    ?>
                    <div class="row g-4">
                        
                        <!-- Main Post (Left Column) -->
                        <div class="col-lg-7 border-end-lg">
                            <?php
                            $hero_query->the_post(); // Get the very first post
                            $bg_image_url = get_the_post_thumbnail_url(get_the_ID(), 'large') ? get_the_post_thumbnail_url(get_the_ID(), 'large') : get_template_directory_uri() . '/images/default-hero.jpg';
                            ?>
                            <div class="samakal-main-post">
                                
                                <!-- Large Thumbnail -->
                                <a href="<?php the_permalink(); ?>" class="d-block position-relative overflow-hidden mb-3">
                                    <img src="<?php echo esc_url($bg_image_url); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 samakal-main-img shadow-sm" style="object-fit: cover; aspect-ratio: 16/9;" loading="eager">
                                </a>
                                
                                <!-- Title with Badge -->
                                <h1 class="h2 fw-bold mb-3 samakal-main-title mt-3" style="font-size: 2.1rem; line-height: 1.35;">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                        <?php 
                                        $badge_text = get_theme_mod('hero_badge_text', 'সর্বশেষ');
                                        if (!empty($badge_text)) : 
                                        ?>
                                            <span class="hero-live-badge">
                                                <span class="live-circle"></span>
                                                <span class="live-text"><?php echo esc_html($badge_text); ?></span>
                                                <span class="live-separator">&bull;</span>
                                            </span>
                                        <?php endif; ?>
                                        <?php the_title(); ?>
                                    </a>
                                </h1>
                                
                                <!-- Excerpt -->
                                <div class="samakal-main-excerpt text-muted mb-0" style="font-size: 1.05rem; line-height: 1.6;">
                                    <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- 5 Small Posts List (Right Column) -->
                        <div class="col-lg-5 ps-lg-2">
                            <div class="samakal-side-posts">
                                <?php
                                while ($hero_query->have_posts()):
                                    $hero_query->the_post();
                                    $bg_image_url_small = get_the_post_thumbnail_url(get_the_ID(), 'medium') ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : get_template_directory_uri() . '/images/default-hero-small.jpg';
                                    ?>
                                    <div class="samakal-side-post d-flex align-items-center mb-3 pb-3 border-bottom">
                                        
                                        <!-- Title and Excerpt on the Left -->
                                        <div class="samakal-side-content pe-3 w-100">
                                            <h3 class="h6 fw-bold mb-1 line-clamp-2" style="font-size: 1.15rem; line-height: 1.45;">
                                                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="samakal-side-excerpt text-muted mb-0" style="font-size: 0.95rem; line-height: 1.5;">
                                                <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
                                            </div>
                                        </div>

                                        <!-- Small Thumbnail on the Right -->
                                        <div class="samakal-side-thumb flex-shrink-0">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url($bg_image_url_small); ?>" alt="<?php the_title_attribute(); ?>" class="shadow-sm" style="width: 140px; height: 90px; object-fit: cover;" loading="lazy">
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                ?>
                            </div>
                        </div>

                    </div>
                    <?php
                    wp_reset_postdata();
                else:
                    // If no posts are found
                    echo '<div class="alert alert-info">No featured posts found.</div>';
                endif;
                ?>
            </section>
        <?php endif; ?>

        <!-- Main Content Area (Full Width) -->
        <div class="row">
            <div class="col-12">
                
                <!-- Section 1: Selected News (Left 8) + Latest/Popular (Right 4) -->
                <div class="row mb-5">
                    <!-- Left: Selected News -->
                    <div class="col-lg-8 pe-lg-4 border-end-lg">
                        <div class="section-heading mb-4 border-bottom position-relative" style="border-bottom-width: 2px !important; border-color: #e5e5e5 !important;">
                            <span class="d-inline-flex bg-primary text-white fw-bold px-3 py-2 align-items-center" style="font-size: 1.15rem; margin-bottom: -2px;">
                                <span style="width: 4px; height: 16px; background-color: #fff; display: inline-block; margin-right: 8px;"></span> নির্বাচিত
                            </span>
                        </div>
                        
                        <div class="row g-4">
                            <?php
                            $selected_query = new WP_Query(array(
                                'post_type' => 'post',
                                'posts_per_page' => 4,
                                'category_name' => 'নির্বাচিত', // Try slug first
                                'ignore_sticky_posts' => true
                            ));
                            
                            // Fallback if no posts in 'Selected'
                            if (!$selected_query->have_posts()) {
                                $selected_query = new WP_Query(array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 4,
                                    'offset' => 6,
                                    'ignore_sticky_posts' => true
                                ));
                            }

                            if ($selected_query->have_posts()):
                                while ($selected_query->have_posts()): $selected_query->the_post();
                                ?>
                                <div class="col-md-6">
                                    <article class="category-post-grid h-100 border-0 overflow-hidden hover-card group-hover-underline">
                                        <div class="position-relative overflow-hidden rounded-1 mb-3">
                                            <a href="<?php the_permalink(); ?>" class="d-block image-scale-hover">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 bg-light" style="height: 200px; object-fit: cover;" loading="lazy">
                                                <?php else : ?>
                                                    <div class="w-100 bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 200px; opacity: 0.1;">
                                                        <i class="fas fa-image fa-3x"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div class="p-0">
                                            <h3 class="h6 fw-bold mb-2 line-clamp-2" style="font-size: 1.25rem; line-height: 1.45;">
                                                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="small text-muted mb-0 line-clamp-2" style="font-size: 1rem; line-height: 1.6;"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></div>
                                        </div>
                                    </article>
                                </div>
                                <?php
                                endwhile; wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                    
                    <!-- Right: Tabbed Widget -->
                    <div class="col-lg-4 mt-5 mt-lg-0 ps-lg-4">
                        <section class="widget tabbed-widget bg-white shadow-sm border rounded overflow-hidden h-100 mb-0">
                            <div class="tabbed-widget-header d-flex border-bottom bg-light">
                                <button class="tab-btn active text-primary fw-bold pb-2 pt-3 px-3 border-0 bg-transparent flex-grow-1 position-relative" data-target="tab-latest" style="font-size: 1.1rem; border-bottom: 2px solid transparent;">সর্বশেষ</button>
                                <button class="tab-btn fw-bold pb-2 pt-3 px-3 border-0 bg-transparent flex-grow-1 position-relative text-muted" data-target="tab-popular" style="font-size: 1.1rem; border-bottom: 2px solid transparent;">সর্বাধিক পঠিত</button>
                            </div>

                            <div class="tab-content-container p-3 pt-4 position-relative">
                                <!-- Latest Tab -->
                                <div id="tab-latest" class="tab-pane fade show active">
                                    <?php
                                    $latest_tab_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'ignore_sticky_posts' => true));
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
                                    endif;
                                    ?>
                                </div>

                                <!-- Popular Tab -->
                                <div id="tab-popular" class="tab-pane fade d-none">
                                    <?php
                                    $popular_tab_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'orderby' => 'comment_count', 'order' => 'DESC', 'ignore_sticky_posts' => true));
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
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Ad Banner (Optional) -->
                <div class="ad-banner-container text-center mb-5">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/ad-meril.jpg" alt="Advertisement" class="img-fluid rounded" onerror="this.outerHTML='<div class=\'bg-primary text-white p-3 rounded text-center my-4\'>Advertisement Space</div>'" style="max-height: 90px; width: 100%; object-fit: cover;">
                </div>

                <!-- Section 2: National (Full Width 4 cols) -->
                <div class="category-block mb-5">
                    <div class="section-heading mb-4 border-bottom position-relative mx-auto text-center" style="border-bottom-width: 2px !important; border-color: #e5e5e5 !important;">
                        <span class="d-inline-flex bg-dark text-white fw-bold px-4 py-2" style="font-size: 1.25rem; margin-bottom: -2px;">জাতীয়</span>
                    </div>
                    
                    <div class="row g-4 mb-4">
                        <?php
                        $national_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 8, 'category_name' => 'national', 'ignore_sticky_posts' => true));
                        if (!$national_query->have_posts()) {
                            $national_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 8, 'offset' => 10, 'ignore_sticky_posts' => true));
                        }
                        if ($national_query->have_posts()):
                            while ($national_query->have_posts()): $national_query->the_post();
                            ?>
                            <div class="col-lg-3 col-md-6 border-bottom pb-4">
                                <article class="category-post-grid h-100 border-0 overflow-hidden hover-card group-hover-underline">
                                    <div class="position-relative overflow-hidden rounded-1 mb-3">
                                        <a href="<?php the_permalink(); ?>" class="d-block image-scale-hover">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 bg-light border" style="height: 150px; object-fit: cover;" loading="lazy">
                                            <?php else : ?>
                                                <div class="w-100 bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 150px; opacity: 0.1;">
                                                    <i class="fas fa-image fa-2x"></i>
                                                </div>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div class="p-0 mt-2">
                                        <h3 class="h6 fw-bold mb-2 line-clamp-2" style="font-size: 1.15rem; line-height: 1.45;">
                                            <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="small text-muted mb-0 line-clamp-2" style="font-size: 0.95rem; line-height: 1.5;"><?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?></div>
                                    </div>
                                </article>
                            </div>
                            <?php
                            endwhile; wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>

                <!-- Section 3: More Categories (World & Sports) - 2 Columns Full Width -->
                <div class="row mb-5">
                    <!-- World News -->
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="section-heading mb-3 border-bottom position-relative" style="border-bottom-width: 2px !important; border-color: #e5e5e5 !important;">
                            <span class="d-inline-block bg-primary text-white fw-bold px-3 py-2" style="font-size: 1.15rem; margin-bottom: -2px;">বিশ্ব</span>
                        </div>
                        <?php
                        $world_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'category_name' => 'international', 'ignore_sticky_posts' => true));
                        if (!$world_query->have_posts()) {
                            $world_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'offset' => 18, 'ignore_sticky_posts' => true));
                        }
                        if ($world_query->have_posts()):
                            while ($world_query->have_posts()): $world_query->the_post();
                            ?>
                            <article class="category-post-small d-flex align-items-center mb-3 pb-3 border-bottom">
                                <div class="pe-3 flex-grow-1">
                                    <h4 class="h6 fw-bold mb-1 line-clamp-2" style="font-size: 1.1rem; line-height: 1.4;">
                                        <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a>
                                    </h4>
                                    <div class="text-muted small mt-1" style="font-size: 0.85rem;"><i class="far fa-clock me-1"></i><?php echo bug_mohol_bangla_date(get_the_date()); ?></div>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="<?php the_permalink(); ?>" class="d-block image-scale-hover rounded-1 overflow-hidden">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="<?php the_title_attribute(); ?>" class="bg-light" style="width: 120px; height: 80px; object-fit: cover;" loading="lazy">
                                        <?php else : ?>
                                            <div class="bg-secondary d-flex align-items-center justify-content-center text-white" style="width: 120px; height: 80px; opacity: 0.1;">
                                                <i class="fas fa-image fa-lg"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </article>
                            <?php
                            endwhile; wp_reset_postdata();
                        endif;
                        ?>
                    </div>

                    <!-- Sports News -->
                    <div class="col-lg-6">
                        <div class="section-heading mb-3 border-bottom position-relative" style="border-bottom-width: 2px !important; border-color: #e5e5e5 !important;">
                            <span class="d-inline-block bg-primary text-white fw-bold px-3 py-2" style="font-size: 1.15rem; margin-bottom: -2px;">খেলা</span>
                        </div>
                        <div class="row g-3">
                        <?php
                        $sports_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'sports', 'ignore_sticky_posts' => true));
                        if (!$sports_query->have_posts()) {
                            $sports_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'offset' => 21, 'ignore_sticky_posts' => true));
                        }
                        if ($sports_query->have_posts()):
                            while ($sports_query->have_posts()): $sports_query->the_post();
                            ?>
                            <div class="col-6">
                                <article class="group-hover-underline">
                                    <a href="<?php the_permalink(); ?>" class="d-block overflow-hidden rounded-1 mb-2 image-scale-hover">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 bg-light" style="height: 120px; object-fit: cover;" loading="lazy">
                                        <?php else : ?>
                                            <div class="w-100 bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 120px; opacity: 0.1;">
                                                <i class="fas fa-image fa-lg"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                     <h4 class="h6 fw-bold mb-1 line-clamp-2" style="font-size: 1rem; line-height: 1.35;">
                                         <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a>
                                     </h4>
                                     <div class="small text-muted line-clamp-2" style="font-size: 0.88rem; line-height: 1.4;"><?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?></div>
                                 </article>
                            </div>
                            <?php
                            endwhile; wp_reset_postdata();
                        endif;
                        ?>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Jobs/Health/Tech Row -->
                <div class="row mb-5">
                    <!-- Jobs -->
                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                        <div class="section-heading mb-3 border-bottom position-relative" style="border-bottom-width: 2px !important; border-color: #e5e5e5 !important;">
                            <span class="d-inline-block bg-primary text-white fw-bold px-3 py-2" style="font-size: 1.15rem; margin-bottom: -2px;">চাকরি</span>
                        </div>
                        <?php
                        $jobs_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'jobs', 'ignore_sticky_posts' => true));
                        if (!$jobs_query->have_posts()) {
                            $jobs_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'offset' => 25, 'ignore_sticky_posts' => true));
                        }
                        if ($jobs_query->have_posts()):
                            while ($jobs_query->have_posts()): $jobs_query->the_post();
                            ?>
                            <article class="mb-3 pb-3 border-bottom">
                                <h4 class="h6 fw-bold mb-1 line-clamp-2" style="font-size: 1rem; line-height: 1.4;">
                                    <i class="fas fa-arrow-right text-primary me-2 flex-shrink-0" style="font-size: 0.7rem;"></i>
                                    <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a>
                                </h4>
                            </article>
                            <?php endwhile; wp_reset_postdata(); endif; ?>
                    </div>
                    <!-- Health -->
                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                        <div class="section-heading mb-3 border-bottom position-relative" style="border-bottom-width: 2px !important; border-color: #e5e5e5 !important;">
                            <span class="d-inline-block bg-primary text-white fw-bold px-3 py-2" style="font-size: 1.15rem; margin-bottom: -2px;">স্বাস্থ্যকথা</span>
                        </div>
                        <?php
                        $health_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 2, 'category_name' => 'health', 'ignore_sticky_posts' => true));
                        if (!$health_query->have_posts()) {
                            $health_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 2, 'offset' => 29, 'ignore_sticky_posts' => true));
                        }
                        if ($health_query->have_posts()):
                            while ($health_query->have_posts()): $health_query->the_post();
                            ?>
                            <article class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                <div class="pe-3 flex-grow-1">
                                    <h4 class="h6 fw-bold mb-1 line-clamp-2" style="font-size: 1rem; line-height: 1.4;">
                                        <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a>
                                    </h4>
                                </div>
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" class="rounded-1" style="width: 80px; height: 60px; object-fit: cover;" loading="lazy">
                                <?php else : ?>
                                    <div class="bg-secondary d-flex align-items-center justify-content-center text-white rounded-1" style="width: 80px; height: 60px; opacity: 0.1;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                <?php endif; ?>
                            </article>
                            <?php endwhile; wp_reset_postdata(); endif; ?>
                    </div>
                    <!-- Doctor -->
                    <div class="col-lg-4 col-md-6">
                        <div class="section-heading mb-3 border-bottom position-relative" style="border-bottom-width: 2px !important; border-color: #e5e5e5 !important;">
                            <span class="d-inline-block bg-primary text-white fw-bold px-3 py-2" style="font-size: 1.15rem; margin-bottom: -2px;">ডাক্তারবাড়ি</span>
                        </div>
                         <?php
                        $doc_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 2, 'category_name' => 'lifestyle', 'ignore_sticky_posts' => true));
                        if (!$doc_query->have_posts()) {
                            $doc_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 2, 'offset' => 31, 'ignore_sticky_posts' => true));
                        }
                        if ($doc_query->have_posts()):
                            while ($doc_query->have_posts()): $doc_query->the_post();
                            ?>
                            <article class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                <div class="pe-3 flex-grow-1">
                                    <h4 class="h6 fw-bold mb-1 line-clamp-2" style="font-size: 1rem; line-height: 1.4;">
                                        <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a>
                                    </h4>
                                </div>
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" class="rounded-1" style="width: 80px; height: 60px; object-fit: cover;" loading="lazy">
                                <?php else : ?>
                                    <div class="bg-secondary d-flex align-items-center justify-content-center text-white rounded-1" style="width: 80px; height: 60px; opacity: 0.1;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                <?php endif; ?>
                            </article>
                            <?php endwhile; wp_reset_postdata(); endif; ?>
                    </div>
                </div>

                <!-- Section 6: Story Section (Google Discover Style) -->
                <div class="stories-section mb-5">
                    <!-- Section Header -->
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="story-heading-bar"></div>
                            <h2 class="fw-bold mb-0" style="font-size: 1.25rem; letter-spacing: -0.2px;">স্টোরি</h2>
                        </div>
                        <!-- Scroll Arrows -->
                        <div class="d-flex gap-2">
                            <button class="story-scroll-btn" onclick="document.getElementById('story-scroll-track').scrollBy({left: -280, behavior:'smooth'})" aria-label="Previous">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="story-scroll-btn" onclick="document.getElementById('story-scroll-track').scrollBy({left: 280, behavior:'smooth'})" aria-label="Next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Horizontal Scroll Track -->
                    <div id="story-scroll-track" class="story-scroll-track">
                        <?php
                        $stories_query = new WP_Query(array(
                            'post_type'           => 'web-story',
                            'posts_per_page'      => 10,
                            'ignore_sticky_posts' => true,
                        ));
                        if ($stories_query->have_posts()):
                            while ($stories_query->have_posts()): $stories_query->the_post();
                                // Google Web Stories uses specific poster sizes
                                $thumb = get_the_post_thumbnail_url(get_the_ID(), 'web-stories-poster-portrait');
                                if (!$thumb) $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                if (!$thumb) $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                        ?>
                        <a href="<?php the_permalink(); ?>" class="story-card" title="<?php the_title_attribute(); ?>">
                            <!-- Actual image tag - fixes blank card issue -->
                            <img
                                src="<?php echo $thumb ? esc_url($thumb) : get_template_directory_uri() . '/images/default-thumb.jpg'; ?>"
                                alt="<?php the_title_attribute(); ?>"
                                class="story-card-img"
                                loading="lazy"
                            >
                            <!-- Gradient Overlay -->
                            <div class="story-overlay"></div>
                            <!-- Bottom Content -->
                            <div class="story-content">
                                <p class="story-title"><?php the_title(); ?></p>
                                <span class="story-meta"><i class="far fa-clock me-1"></i><?php echo get_the_date('d M'); ?></span>
                            </div>
                        </a>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>

            </div> <!-- .col-12 -->
        </div> <!-- .row -->

    </div> <!-- .container -->
</main><!-- #main -->

<?php
get_footer();
