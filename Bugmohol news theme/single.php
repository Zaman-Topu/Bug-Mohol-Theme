<?php
/**
 * The template for displaying all single posts
 *
 * @package Bug_Mohol
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <?php
                while (have_posts()):
                    the_post();
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-area'); ?>>

                        <header class="entry-header mb-4 text-center">
                            <!-- Category -->
                            <!-- Category -->
                            <div class="entry-meta mb-3">
                                <a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>" class="text-uppercase fw-bold samakal-category-link" style="color: #0056b3; letter-spacing: 1px; font-size: 1rem; text-decoration: none;">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo esc_html($categories[0]->name);
                                    }
                                    ?>
                                </a>
                            </div><!-- .entry-meta -->

                            <!-- Title -->
                            <?php the_title('<h1 class="entry-title fw-bold mb-4 samakal-single-title" style="font-size: 2.5rem; line-height: 1.4; color: #111;">', '</h1>'); ?>

                            <!-- Author, Date & Text Resize -->
                            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between border-top border-bottom py-3 mb-4 text-muted small gap-3">
                                <div class="entry-meta d-flex justify-content-center align-items-center flex-wrap gap-2 gap-md-3">
                                    <span class="d-flex align-items-center">
                                        <i class="fas fa-user-circle me-1 fs-6 text-primary"></i> 
                                        <span class="fw-bold text-dark"> <?php the_author(); ?></span>
                                    </span>
                                    <span class="d-none d-sm-inline">&bull;</span>
                                    <span>
                                        <i class="far fa-clock me-1"></i> <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="d-none d-sm-inline">&bull;</span>
                                    <span>
                                        <i class="far fa-comments me-1"></i> <?php comments_number('0 মন্তব্য', '1 মন্তব্য', '% মন্তব্য'); ?>
                                    </span>
                                </div>
                                <div class="text-resize d-flex align-items-center justify-content-center gap-2 bg-light px-3 py-2 rounded-pill shadow-sm">
                                    <span class="fw-bold text-uppercase me-1" style="letter-spacing: 0.5px; font-size: 0.8rem;">ফন্ট সাইজ:</span>
                                    <button class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center border-0 bg-white shadow-sm" onclick="changeFontSize(-1)" title="ছোট করুন" style="width: 26px; height: 26px; padding: 0;">
                                        <i class="fas fa-minus" style="font-size: 10px;"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center border-0 shadow-sm bg-white" onclick="changeFontSize(1)" title="বড় করুন" style="width: 28px; height: 28px; padding: 0;">
                                        <i class="fas fa-plus" style="font-size: 10px;"></i>
                                    </button>
                                </div>
                            </div><!-- .entry-meta -->
                        </header><!-- .entry-header -->

                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="post-thumbnail mb-4 text-center">
                                <?php the_post_thumbnail('full', array('class' => 'img-fluid rounded shadow-sm w-100')); ?>
                            </div><!-- .post-thumbnail -->
                        <?php endif; ?>

                        <!-- Content -->
                        <div id="samakal-article-content" class="entry-content" style="font-size: 1.15rem; line-height: 1.9; color: #333; font-weight: 400;">
                            <?php
                            the_content();

                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links mt-4 fw-bold">' . esc_html__('Pages:', 'bug-mohol'),
                                    'after' => '</div>',
                                    'link_before' => '<span class="page-number px-2 py-1 bg-light border rounded ms-2">',
                                    'link_after'  => '</span>',
                                )
                            );
                            ?>
                        </div><!-- .entry-content -->

                        <!-- Premium Post Footer: Author, Tags & Share -->
                        <div class="premium-post-footer mt-5 pt-3 border-top">
                            <!-- Tags Section -->
                            <?php 
                            $post_tags = get_the_tags();
                            if ($post_tags) : ?>
                                <div class="post-tags-wrapper mb-4 d-flex flex-wrap align-items-center gap-2">
                                    <span class="text-uppercase fw-bold text-dark me-2" style="font-size: 0.9rem; letter-spacing: 1px;"><i class="fas fa-tags text-primary me-2"></i>ট্যাগসমূহ:</span>
                                    <?php foreach($post_tags as $tag) : ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="badge bg-light text-dark border p-2 text-decoration-none hover-primary transition-all shadow-sm" style="font-size: 0.85rem;">#<?php echo esc_html($tag->name); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Author & Share Box -->
                            <div class="author-share-box bg-light rounded-3 p-4 shadow-sm border d-flex flex-column flex-md-row align-items-center justify-content-between gap-4">
                                
                                <!-- Author Info -->
                                <div class="d-flex align-items-center gap-3">
                                    <div class="author-avatar flex-shrink-0">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 70, '', '', array('class' => 'rounded-circle border border-3 border-white shadow-sm')); ?>
                                    </div>
                                    <div class="author-details">
                                        <span class="text-muted small text-uppercase fw-bold" style="letter-spacing: 1px;">লেখক</span>
                                        <h4 class="h5 fw-bold mb-1 text-dark"><?php the_author(); ?></h4>
                                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="text-primary small text-decoration-none fw-medium hover-text-dark">সব লেখা দেখুন <i class="fas fa-arrow-right ms-1" style="font-size: 10px;"></i></a>
                                    </div>
                                </div>

                                <!-- Share Links -->
                                <div class="share-links text-center text-md-end">
                                    <span class="text-muted small text-uppercase fw-bold d-block mb-2" style="letter-spacing: 1px;">শেয়ার করুন</span>
                                    <div class="d-flex align-items-center justify-content-center justify-content-md-end gap-2">
                                        <?php 
                                            $post_url = urlencode(get_permalink());
                                            $post_title = urlencode(get_the_title());
                                        ?>
                                        <!-- Facebook -->
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" target="_blank" class="share-btn flex-center rounded-circle bg-white shadow-sm text-decoration-none" style="width: 40px; height: 40px; color: #1877F2; border: 1px solid #e0e0e0; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                                            <i class="fab fa-facebook-f fs-5"></i>
                                        </a>
                                        <!-- Twitter/X -->
                                        <a href="https://twitter.com/intent/tweet?text=<?php echo $post_title; ?>&url=<?php echo $post_url; ?>" target="_blank" class="share-btn flex-center rounded-circle bg-white shadow-sm text-decoration-none" style="width: 40px; height: 40px; color: #000000; border: 1px solid #e0e0e0; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/></svg>
                                        </a>
                                        <!-- WhatsApp -->
                                        <a href="https://api.whatsapp.com/send?text=<?php echo $post_title . ' - ' . $post_url; ?>" target="_blank" class="share-btn flex-center rounded-circle bg-white shadow-sm text-decoration-none" style="width: 40px; height: 40px; color: #25D366; border: 1px solid #e0e0e0; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                                            <i class="fab fa-whatsapp fs-5"></i>
                                        </a>
                                        <!-- Copy Link -->
                                        <button onclick="navigator.clipboard.writeText('<?php echo esc_js(get_permalink()); ?>'); showCopyToast();" class="share-btn flex-center rounded-circle bg-white shadow-sm border-0 position-relative" style="width: 40px; height: 40px; color: #6c757d; border: 1px solid #e0e0e0 !important; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                                            <i class="fas fa-link fs-5"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .premium-post-footer -->

                    </article><!-- #post-<?php the_ID(); ?> -->

                    <!-- Related Articles Section -->
                    <section class="related-posts mt-5 pt-5 border-top">
                        <h3 class="h4 fw-bold mb-4">Related Articles</h3>

                        <?php
                        $categories = get_the_category($post->ID);
                        if ($categories) {
                            $category_ids = array();
                            foreach ($categories as $individual_category)
                                $category_ids[] = $individual_category->term_id;

                            $args = array(
                                'category__in' => $category_ids,
                                'post__not_in' => array($post->ID),
                                'posts_per_page' => 3, // Fetch 3 related posts
                                'ignore_sticky_posts' => true
                            );

                            $my_query = new wp_query($args);

                            if ($my_query->have_posts()) {
                                echo '<div class="row">';
                                while ($my_query->have_posts()) {
                                    $my_query->the_post();
                                    ?>
                                    <div class="col-md-4 mb-4 mb-md-0">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <!-- Thumbnail -->
                                            <a href="<?php the_permalink(); ?>">
                                                <?php if (has_post_thumbnail()): ?>
                                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                                                        class="card-img-top" alt="<?php the_title_attribute(); ?>"
                                                        style="height: 150px; object-fit: cover;" loading="lazy">
                                                <?php else: ?>
                                                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white"
                                                        style="height: 150px;">
                                                        <i class="fas fa-image fa-2x"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </a>
                                            <!-- Title -->
                                            <div class="card-body p-3">
                                                <h4 class="h6 fw-bold mb-0 line-clamp-2"><a href="<?php the_permalink(); ?>"
                                                        class="text-dark text-decoration-none">
                                                        <?php the_title(); ?>
                                                    </a></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                echo '</div>';
                            } else {
                                echo '<p class="text-muted">No related articles found.</p>';
                            }
                        }
                        wp_reset_query();
                        ?>
                    </section>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()):
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>

            </div><!-- .col-lg-8 -->
        </div><!-- .row -->
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
?>

<!-- Premium Copy Toast Notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
  <div id="copyToast" class="toast align-items-center text-white bg-dark border-0 rounded-pilled shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex px-1 py-1">
      <div class="toast-body d-flex align-items-center gap-2" style="font-size: 0.95rem; font-weight: 500;">
        <i class="fas fa-check-circle text-success fs-5"></i> লিংক সফলভাবে কপি করা হয়েছে!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script>
    // Text Resizer Script
    function changeFontSize(step) {
        const contentArea = document.getElementById('samakal-article-content');
        if (!contentArea) return;
        
        let currentSize = parseFloat(window.getComputedStyle(contentArea, null).getPropertyValue('font-size'));
        
        // Define boundaries (e.g. min 14px, max 28px) to prevent breaking layout
        let newSize = currentSize + (step * 2); 
        if (newSize < 14) newSize = 14;
        if (newSize > 32) newSize = 32;

        contentArea.style.fontSize = newSize + 'px';
        localStorage.setItem('bugmohol_font_size', newSize);
    }

    // Apply saved font size on load
    document.addEventListener("DOMContentLoaded", function() {
        const savedSize = localStorage.getItem('bugmohol_font_size');
        if (savedSize) {
            const contentArea = document.getElementById('samakal-article-content');
            if (contentArea) {
                contentArea.style.fontSize = savedSize + 'px';
            }
        }
    });

    // Elegant Copy Toast Script
    function showCopyToast() {
        const toastEl = document.getElementById('copyToast');
        // Initialize Bootstrap Toast (imported by theme)
        const toast = new bootstrap.Toast(toastEl, {
            delay: 3000 // Display for 3 seconds seamlessly
        });
        toast.show();
    }
</script>
