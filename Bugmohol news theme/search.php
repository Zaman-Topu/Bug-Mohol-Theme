<?php
/**
 * The template for displaying search results pages
 *
 * @package Bug_Mohol
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container">
        <div class="row">
            <!-- Left Column: List View -->
            <div class="col-lg-8 pe-lg-4">

                <?php if (have_posts()): ?>
                    <header class="mb-5">
                        <h1 class="page-title h2 fw-bold border-bottom pb-2">
                            <?php
                            /* translators: %s: search query. */
                            printf(esc_html__('Search Results for: %s', 'bug-mohol'), '<span>' . get_search_query() . '</span>');
                            ?>
                        </h1>
                    </header>
                <?php endif; ?>

                <div class="list-view-container">
                    <?php
                    if (have_posts()):
                        /* Start the Loop */
                        while (have_posts()):
                            the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('list-view-post'); ?>>

                                <?php if (has_post_thumbnail()): ?>
                                    <a href="<?php the_permalink(); ?>" class="d-block flex-shrink-0">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'bug-mohol-list-thumb'); ?>"
                                            alt="<?php the_title_attribute(); ?>" class="list-view-thumb" loading="lazy">
                                    </a>
                                <?php else: ?>
                                    <div
                                        class="list-view-thumb bg-secondary d-flex align-items-center justify-content-center text-white">
                                        <i class="fas fa-image fa-2x"></i>
                                    </div>
                                <?php endif; ?>

                                <div class="list-view-content">
                                    <h2 class="h3 fw-bold"><a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a></h2>

                                    <div class="post-meta font-monospace">
                                        <span class="text-primary fw-semibold"><i class="fas fa-folder-open me-1"></i>
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo esc_html($categories[0]->name) . ' | ';
                                            }
                                            ?>
                                        </span>
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <?php echo get_the_date(); ?> &nbsp;&bull;&nbsp;
                                        <i class="fas fa-user-edit me-1"></i>
                                        <?php the_author(); ?>
                                    </div>

                                    <div class="entry-summary text-muted">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>

                            </article><!-- #post-<?php the_ID(); ?> -->
                            <?php
                        endwhile;

                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => __('<i class="fas fa-chevron-left me-1"></i> Prev', 'bug-mohol'),
                            'next_text' => __('Next <i class="fas fa-chevron-right ms-1"></i>', 'bug-mohol'),
                            'class' => 'pagination justify-content-center mt-5 mb-5 mb-lg-0',
                            'before_page_number' => '<span class="btn btn-outline-primary border-0 me-1">',
                            'after_page_number' => '</span>',
                        ));

                    else:
                        ?>
                        <section class="no-results not-found">
                            <header class="mb-5">
                                <h1 class="page-title h2 fw-bold border-bottom pb-2">
                                    <?php esc_html_e('Nothing Found', 'bug-mohol'); ?>
                                </h1>
                            </header>
                            <div class="page-content">
                                <p>
                                    <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bug-mohol'); ?>
                                </p>
                                <?php get_search_form(); ?>
                            </div>
                        </section>
                        <?php
                    endif;
                    ?>
                </div>
            </div> <!-- .col-lg-8 -->

            <!-- Right Column: Sidebar -->
            <div class="col-lg-4 mt-5 mt-lg-0">
                <?php get_sidebar(); ?>
            </div> <!-- .col-lg-4 -->

        </div> <!-- .row -->

    </div> <!-- .container -->
</main><!-- #main -->

<?php
get_footer();
