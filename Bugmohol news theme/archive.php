<?php
/**
 * The template for displaying archive pages
 *
 * @package Bug_Mohol
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container">
        <div class="row">
            <!-- Left Column: Archive Content -->
            <div class="col-lg-8 pe-lg-4">
                
                <header class="page-header mb-5 border-bottom pb-3">
                    <?php
                    $archive_prefix = '';
                    if ( is_category() ) {
                        $archive_prefix = 'ক্যাটাগরি: ';
                    } elseif ( is_tag() ) {
                        $archive_prefix = 'ট্যাগ: ';
                    } elseif ( is_day() ) {
                        $archive_prefix = 'দিনের আর্কাইভ: ';
                    } elseif ( is_month() ) {
                        $archive_prefix = 'মাসের আর্কাইভ: ';
                    } elseif ( is_year() ) {
                        $archive_prefix = 'বছরের আর্কাইভ: ';
                    }
                    ?>
                    <h1 class="page-title fw-bold display-6 mb-1">
                        <?php if ( $archive_prefix ) : ?>
                            <span class="text-primary small d-block mb-1 fw-normal" style="font-size: 0.9rem;"><?php echo $archive_prefix; ?></span>
                        <?php endif; ?>
                        <?php the_archive_title( '', '' ); ?>
                    </h1>
                    <?php the_archive_description( '<div class="archive-description text-muted mt-2 small">', '</div>' ); ?>
                </header><!-- .page-header -->

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
                                <?php else : ?>
                                    <div class="flex-shrink-0 bg-light border d-flex align-items-center justify-content-center rounded-1" style="width: 240px; height: 160px;">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                <?php endif; ?>

                                <div class="list-view-content flex-grow-1">
                                    <div class="post-meta small text-muted mb-2">
                                        <span class="text-primary fw-bold me-2"><i class="fas fa-folder-open me-1"></i><?php the_category( ', ' ); ?></span>
                                        <i class="far fa-calendar-alt me-1"></i> <?php echo bug_mohol_bangla_date(get_the_date()); ?>
                                        &nbsp;&bull;&nbsp;
                                        <i class="fas fa-user-edit me-1"></i> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="text-muted text-decoration-none"><?php the_author(); ?></a>
                                    </div>
                                    <h3 class="h4 fw-bold mb-2">
                                        <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none hover-primary"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="entry-summary text-muted mb-0 small line-clamp-2">
                                        <?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>

                        <?php 
                        // Custom pagination to ensure Bengali numbers
                        $pagination = paginate_links( array(
                            'mid_size'  => 2,
                            'prev_text' => __( '<i class="fas fa-chevron-left me-1"></i> আগের খবর', 'bug-mohol' ),
                            'next_text' => __( 'পরের খবর <i class="fas fa-chevron-right ms-1"></i>', 'bug-mohol' ),
                            'type'      => 'array',
                        ) );

                        if ( is_array( $pagination ) ) {
                            echo '<nav class="pagination-container mt-5 mb-5 mb-lg-0"><ul class="pagination justify-content-center">';
                            foreach ( $pagination as $page ) {
                                // Translate numbers in pagination
                                $page = bug_mohol_bangla_number($page);
                                echo '<li class="page-item">' . str_replace( 'page-numbers', 'page-link border-0 shadow-sm mx-1 rounded', $page ) . '</li>';
                            }
                            echo '</ul></nav>';
                        }
                        ?>

                    <?php else : ?>
                        <div class="py-5 text-center">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <p class="lead">এই শাখায় কোনো খবর পাওয়া যায়নি।</p>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary mt-3">হোমপেজে ফিরে যান</a>
                        </div>
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
