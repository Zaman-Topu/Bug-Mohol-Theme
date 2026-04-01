<?php
/**
 * The template for displaying author pages
 *
 * @package Bug_Mohol
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container">
        <!-- Author Profile Header -->
        <header class="author-header p-4 p-md-5 bg-light rounded shadow-sm mb-5 border">
            <div class="row align-items-center">
                <div class="col-md-auto text-center mb-3 mb-md-0">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 120, '', '', array( 'class' => 'rounded-circle shadow-sm border' ) ); ?>
                </div>
                <div class="col-md">
                    <span class="badge bg-primary mb-2">প্রতিবেদক</span>
                    <h1 class="page-title fw-bold mb-2"><?php echo get_the_author(); ?></h1>
                    
                    <?php if ( get_the_author_meta( 'description' ) ) : ?>
                        <div class="author-bio text-muted mb-3" style="max-width: 700px;">
                            <?php the_author_meta( 'description' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="author-social d-flex gap-3">
                        <?php if ( get_the_author_meta( 'user_url' ) ) : ?>
                            <a href="<?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?>" class="text-dark"><i class="fas fa-globe me-1"></i> ওয়েবসাইট</a>
                        <?php endif; ?>
                        <span class="text-muted"><i class="fas fa-newspaper me-1"></i> মোট খবর: <?php echo count_user_posts( get_the_author_meta( 'ID' ) ); ?>টি</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="row">
            <!-- Left Column: Author's Posts -->
            <div class="col-lg-8 pe-lg-4">
                <h2 class="h4 fw-bold mb-4 border-bottom pb-2"><?php echo get_the_author(); ?>-এর সব খবর:</h2>

                <div class="list-view-container">
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'list-view-post mb-4 pb-4 border-bottom d-flex flex-column flex-md-row gap-4' ); ?>>
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="flex-shrink-0" style="width: 240px;">
                                        <a href="<?php the_permalink(); ?>" class="d-block overflow-hidden rounded-1 border">
                                            <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>" alt="<?php the_title_attribute(); ?>" class="w-100 image-scale-hover" style="height: 160px; object-fit: cover;" loading="lazy">
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="list-view-content flex-grow-1">
                                    <div class="post-meta small text-muted mb-2">
                                        <span class="text-primary fw-bold me-2"><i class="fas fa-folder-open me-1"></i><?php the_category( ', ' ); ?></span>
                                        <i class="far fa-calendar-alt me-1"></i> <?php echo get_the_date(); ?>
                                    </div>
                                    <h3 class="h4 fw-bold mb-2">
                                        <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="entry-summary text-muted mb-0 small line-clamp-2">
                                        <?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>

                        <?php the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => __( '<i class="fas fa-chevron-left me-1"></i> Prev', 'bug-mohol' ),
                            'next_text' => __( 'Next <i class="fas fa-chevron-right ms-1"></i>', 'bug-mohol' ),
                            'class'     => 'pagination justify-content-center mt-5',
                        ) ); ?>

                    <?php else : ?>
                        <p>এই প্রতিবেদকের কোনো খবর পাওয়া যায়নি।</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="col-lg-4 mt-5 mt-lg-0">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
