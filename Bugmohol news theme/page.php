<?php
/**
 * The template for displaying all single pages
 *
 * @package Bug_Mohol
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <?php
                while (have_posts()):
                    the_post();
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <header class="entry-header mb-5 text-center border-bottom pb-4">
                            <?php the_title('<h1 class="entry-title fw-bold display-5">', '</h1>'); ?>
                        </header><!-- .entry-header -->

                        <?php if (has_post_thumbnail()): ?>
                            <div class="post-thumbnail mb-5 text-center">
                                <?php the_post_thumbnail('full', array('class' => 'img-fluid rounded shadow-sm')); ?>
                            </div><!-- .post-thumbnail -->
                        <?php endif; ?>

                        <div class="entry-content" style="font-size: 1.1rem; line-height: 1.8;">
                            <?php
                            the_content();

                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'bug-mohol'),
                                    'after' => '</div>',
                                )
                            );
                            ?>
                        </div><!-- .entry-content -->

                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()):
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>

            </div><!-- .col-lg-10 -->
        </div><!-- .row -->
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
