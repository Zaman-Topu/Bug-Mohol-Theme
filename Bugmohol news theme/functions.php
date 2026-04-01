<?php
/**
 * Bug Mohol functions and definitions
 *
 * @package Bug_Mohol
 */

if (!defined('_S_VERSION')) {
	define('_S_VERSION', '1.0.0');
}

function bug_mohol_setup()
{
	// Let WordPress manage the document title.
	add_theme_support('title-tag');

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support('post-thumbnails');

	// Define custom image sizes
	add_image_size('bug-mohol-hero-large', 800, 600, true);
	add_image_size('bug-mohol-hero-small', 400, 300, true);
	add_image_size('bug-mohol-list-thumb', 250, 180, true);
	add_image_size('bug-mohol-sidebar-thumb', 80, 80, true);

	// Switch default core markup to valid HTML5.
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));

	// Add support for core custom logo.
	add_theme_support('custom-logo', array(
		'height' => 90,
		'width' => 300,
		'flex-width' => true,
		'flex-height' => true,
	));

	// Register Navigation Menus
	register_nav_menus(array(
		'primary'       => esc_html__('Primary Menu', 'bug-mohol'),
		'footer'        => esc_html__('Footer Menu', 'bug-mohol'),
	));
}
add_action('after_setup_theme', 'bug_mohol_setup');

/**
 * Register widget area.
 */
function bug_mohol_widgets_init()
{
	register_sidebar(array(
		'name' => esc_html__('Sidebar', 'bug-mohol'),
		'id' => 'sidebar-1',
		'description' => esc_html__('Add widgets here.', 'bug-mohol'),
		'before_widget' => '<section id="%1$s" class="widget %2$s mb-5">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title h5 border-bottom pb-2 mb-3">',
		'after_title' => '</h2>',
	));
    
    // Footer Widget Area 1
    register_sidebar(array(
        'name'          => esc_html__( 'Footer Widget Area 1', 'bug-mohol' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here for the first footer column.', 'bug-mohol' ),
        'before_widget' => '<div id="%1$s" class="widget text-dark footer-widget %2$s mb-4 pb-2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title footer-widget-title h5 fw-bold mb-4 text-dark position-relative pb-2">',
        'after_title'   => '</h3>',
    ));

    // Footer Widget Area 2
    register_sidebar(array(
        'name'          => esc_html__( 'Footer Widget Area 2', 'bug-mohol' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here for the second footer column.', 'bug-mohol' ),
        'before_widget' => '<div id="%1$s" class="widget text-dark footer-widget %2$s mb-4 pb-2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title footer-widget-title h5 fw-bold mb-4 text-dark position-relative pb-2">',
        'after_title'   => '</h3>',
    ));

    // Footer Widget Area 3
    register_sidebar(array(
        'name'          => esc_html__( 'Footer Widget Area 3', 'bug-mohol' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here for the third footer column.', 'bug-mohol' ),
        'before_widget' => '<div id="%1$s" class="widget text-dark footer-widget %2$s mb-4 pb-2">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title footer-widget-title h5 fw-bold mb-4 text-dark position-relative pb-2">',
        'after_title'   => '</h3>',
    ));

    // Footer Widget Area 4 (Bottom Left)
    register_sidebar(array(
        'name'          => esc_html__( 'Footer Widget Area 4 (Bottom Left)', 'bug-mohol' ),
        'id'            => 'footer-4',
        'description'   => esc_html__( 'Add widgets here for the bottom left section (e.g. Social Icons).', 'bug-mohol' ),
        'before_widget' => '<div id="%1$s" class="widget inline-widget %2$s d-inline-block">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="fw-bold text-dark small me-3">',
        'after_title'   => '</span>',
    ));

    // Footer Widget Area 5 (Bottom Right / Apps)
    register_sidebar(array(
        'name'          => esc_html__( 'Footer Widget Area 5 (Bottom Right)', 'bug-mohol' ),
        'id'            => 'footer-5',
        'description'   => esc_html__( 'Add widgets here for the bottom right section (e.g. App Links).', 'bug-mohol' ),
        'before_widget' => '<div id="%1$s" class="widget inline-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title sr-only visually-hidden">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'bug_mohol_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function bug_mohol_scripts()
{
	// Bootstrap 5 CSS via CDN
	wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2');

	// FontAwesome
	wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

	// Google Fonts (Anek Bangla)
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@300;400;500;600;700;800&display=swap', array(), null);

	// Theme Main Stylesheet
	wp_enqueue_style('bug-mohol-style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));

	// Bootstrap 5 JS via CDN
	wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '5.3.2', true);

	// Theme Custom JS
	wp_enqueue_script('bug-mohol-custom', get_template_directory_uri() . '/js/custom.js', array(), filemtime(get_stylesheet_directory() . '/js/custom.js'), true);
}
add_action('wp_enqueue_scripts', 'bug_mohol_scripts');

/**
 * Preload Critical Fonts (Anek Bangla & FontAwesome) for PageSpeed
 */
function bug_mohol_preload_fonts() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@300;400;500;600;700;800&display=swap" as="style">' . "\n";
	echo '<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin="anonymous">' . "\n";
	echo '<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin="anonymous">' . "\n";
}
add_action('wp_head', 'bug_mohol_preload_fonts', 1);

/**
 * Defer JavaScript to prevent render-blocking (PageSpeed Fix)
 */
function bug_mohol_defer_scripts($tag, $handle, $src) {
	if (is_admin()) {
		return $tag;
	}
	$defer_scripts = array('bootstrap-js', 'bug-mohol-custom');
	if (in_array($handle, $defer_scripts)) {
		return str_replace(' src', ' defer="defer" src', $tag);
	}
	return $tag;
}
add_filter('script_loader_tag', 'bug_mohol_defer_scripts', 10, 3);

/**
 * Custom walker for Bootstrap 5 navbar
 */
class Bootstrap_5_WP_Nav_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $output .= '<ul class="dropdown-menu shadow-sm">';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $is_dropdown = ($depth > 0);
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $args_array = (array) $args;
        if ( isset( $args_array['walker'] ) && is_object( $args_array['walker'] ) && method_exists( $args_array['walker'], 'has_children' ) ) {
            $has_children = $args_array['walker']->has_children;
        } else {
            $has_children = false; 
            if ( in_array('menu-item-has-children', $classes) ) {
                $has_children = true;
            }
        }

        $output .= '<li class="' . ($is_dropdown ? '' : 'nav-item') . ($has_children ? ' dropdown' : '') . '">';

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        $atts['class'] = $is_dropdown ? 'dropdown-item' : 'nav-link';

        if ($has_children) {
            $atts['class'] .= ' dropdown-toggle';
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['aria-expanded'] = 'false';
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . $title . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Custom excerpt length
 */
function bug_mohol_custom_excerpt_length($length)
{
	return 25; // Change excerpt to 25 words
}
add_filter('excerpt_length', 'bug_mohol_custom_excerpt_length', 999);

/**
 * Custom "Read More" link
 */
function bug_mohol_excerpt_more($more)
{
	return '... <a class="read-more small text-primary fw-bold text-decoration-none" href="' . get_permalink(get_the_ID()) . '">Read More <i class="fas fa-angle-double-right"></i></a>';
}
add_filter('excerpt_more', 'bug_mohol_excerpt_more');

/**
 * Helper function to convert English dates to Bengali
 */
function bug_mohol_bangla_date($date_str) {
	$eng = array('1','2','3','4','5','6','7','8','9','0', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
	$bng = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার');
	return str_replace($eng, $bng, $date_str);
}

/**
 * Helper function to convert English numbers to Bengali
 */
function bug_mohol_bangla_number($number) {
	$eng = array('1','2','3','4','5','6','7','8','9','0');
	$bng = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
	return str_replace($eng, $bng, $number);
}

/**
 * =========================================================================
 * Custom Built-in SEO Framework for Bug Mohol
 * =========================================================================
 * Generates comprehensive meta tags, OpenGraph, and Twitter cards.
 */
function bug_mohol_custom_seo() {
    global $post;
    
    // Default site info
    $site_name = get_bloginfo('name');
    $site_desc = get_bloginfo('description');
    $url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    // 1. Meta Description & Title vars
    $meta_desc = $site_desc;
    $meta_img = '';
    $post_title = $site_name;

    if (is_singular()) {
        $post_title = get_the_title() . ' - ' . $site_name;
        
        // Extract a clean excerpt for description
        if (has_excerpt()) {
            $meta_desc = strip_tags(get_the_excerpt());
        } elseif (!empty($post->post_content)) {
            $meta_desc = wp_trim_words(strip_shortcodes(strip_tags($post->post_content)), 30, '...');
        }
        
        // Get featured image for Open Graph sharing
        if (has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
            if ($img_src) {
                $meta_img = $img_src[0];
            }
        }
    } elseif (is_category()) {
        $post_title = single_cat_title('', false) . ' - ' . $site_name;
        $meta_desc = strip_tags(category_description());
    } elseif (is_tag()) {
        $post_title = single_tag_title('', false) . ' - ' . $site_name;
        $meta_desc = strip_tags(tag_description());
    } elseif (is_archive()) {
        $post_title = get_the_archive_title() . ' - ' . $site_name;
    }
    
    // Strip empty lines and enforce raw strings for meta
    $meta_desc = trim(str_replace(array("\r", "\n"), '', $meta_desc));
    if (empty($meta_desc)) {
        $meta_desc = $site_desc;
    }

    // Default image fallback if none found
    if (empty($meta_img)) {
        // Use a high-quality placeholder if the images directory is missing
        $meta_img = 'https://placehold.co/1200x630/0d6efd/ffffff?text=' . urlencode(get_bloginfo('name')); 
    }

    echo "\n<!-- Bug Mohol Custom SEO Start -->\n";
    
    // Canonical URL
    echo '<link rel="canonical" href="' . esc_url($url) . '" />' . "\n";
    
    // Standard Meta Description
    echo '<meta name="description" content="' . esc_attr($meta_desc) . '" />' . "\n";

    // Standard Keywords (Extract from tags if single post)
    $keywords = 'News, Newspaper, Theme, WordPress';
    if (is_singular()) {
        $tags = get_the_tags($post->ID);
        if ($tags) {
            $tag_names = array();
            foreach ($tags as $tag) {
                $tag_names[] = $tag->name;
            }
            $keywords = implode(', ', $tag_names);
        }
    }
    echo '<meta name="keywords" content="' . esc_attr($keywords) . '" />' . "\n";
    
    // Open Graph (Facebook / LinkedIn)
    echo '<meta property="og:locale" content="' . get_locale() . '" />' . "\n";
    echo '<meta property="og:type" content="' . (is_single() ? 'article' : 'website') . '" />' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($post_title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($meta_desc) . '" />' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '" />' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '" />' . "\n";
    if (!empty($meta_img)) {
        echo '<meta property="og:image" content="' . esc_url($meta_img) . '" />' . "\n";
        echo '<meta property="og:image:width" content="1200" />' . "\n";
        echo '<meta property="og:image:height" content="630" />' . "\n";
    }
    
    // Twitter Card Data
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($post_title) . '" />' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($meta_desc) . '" />' . "\n";
    if (!empty($meta_img)) {
        echo '<meta name="twitter:image" content="' . esc_url($meta_img) . '" />' . "\n";
    }

    echo "<!-- Bug Mohol Custom SEO End -->\n\n";
}

// Hook SEO function into wp_head with high priority so it appears near the top
add_action('wp_head', 'bug_mohol_custom_seo', 5);

/**
 * =========================================================================
 * Theme Customizer Settings
 * =========================================================================
 */
function bug_mohol_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'bug_mohol_hero_section' , array(
        'title'      => esc_html__( 'Hero Section Settings', 'bug-mohol' ),
        'priority'   => 30,
    ) );
    
    $wp_customize->add_setting( 'hero_badge_text' , array(
        'default'   => 'সর্বশেষ',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control( 'hero_badge_text', array(
        'label'      => esc_html__( 'Live Badge Text', 'bug-mohol' ),
        'description'=> esc_html__( 'e.g. সর্বশেষ, সরাসরি. Leave entirely blank to hide the badge.', 'bug-mohol' ),
        'section'    => 'bug_mohol_hero_section',
        'settings'   => 'hero_badge_text',
        'type'       => 'text',
    ) );
}
add_action( 'customize_register', 'bug_mohol_customize_register' );

