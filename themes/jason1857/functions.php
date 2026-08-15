<?php
require_once get_theme_file_path( '/inc/ical-parser.php' );

add_action( 'init', 'jason1857_register_event_cards_block' );

// Enqueue styles
function jason1857_enqueue_styles() {
    $style_path = get_theme_file_path( 'style.css' );
    $version    = file_exists( $style_path ) ? filemtime( $style_path ) : wp_get_theme()->get( 'Version' );

    wp_enqueue_style(
        'jason1857-style',
        get_stylesheet_uri(),
        [],
        $version
    );
}

add_action( 'wp_enqueue_scripts', 'jason1857_enqueue_styles' );

// Handle missing featured images in the news grid pattern
function jason1857_handle_missing_featured_image( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    // Don't run this on Pages, yo
    if ( 'page' === get_post_type( $post_id ) ) {
        return $html;
    }

    if ( ! empty( $html ) || ! in_array( $size, ['post-thumbnail', 'full'] ) ) {
        return $html;
    }

    // No featured image set — look for the first image in the post content
    $first_image_url = jason1857_get_first_content_image( $post_id );

    if ( $first_image_url ) {
        return '<div class="news-card-image">
            <img src="' . esc_url( $first_image_url ) . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '" class="news-card-content-image" />
        </div>';
    }

    // No featured image and no in-content images — fall back to the default icon
    $icon_url = get_template_directory_uri() . '/assets/images/icon-1857-update.png';
    return '<div class="news-card-image-placeholder">
        <img src="' . esc_url( $icon_url ) . '" alt="News Update" class="news-card-placeholder-icon" />
    </div>';
}
add_filter( 'post_thumbnail_html', 'jason1857_handle_missing_featured_image', 10, 5 );

// Get the first image and cache it tyo speed things up a bit
function jason1857_get_first_content_image( $post_id ) {
    $cached = get_post_meta( $post_id, '_jason1857_first_image', true );
    if ( $cached !== '' ) {
        return $cached === 'none' ? false : $cached;
    }

    $content = get_post_field( 'post_content', $post_id );
    $image_url = false;

    // Regex to find first img tag
    if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/i', $content, $matches ) ) {
        $image_url = $matches[1];
    }

    update_post_meta( $post_id, '_jason1857_first_image', $image_url ? $image_url : 'none' );

    return $image_url;
}

// Clear the cached first image when a post is saved so it can be updated when business changes
function jason1857_clear_first_image_cache( $post_id ) {
    delete_post_meta( $post_id, '_jason1857_first_image' );
}
add_action( 'save_post', 'jason1857_clear_first_image_cache' );

// Displays only the first term in the news grid, and adds class
function jason1857_modify_post_terms( $block_content, $block ) {
    if ( isset( $block['attrs']['term'] ) && $block['attrs']['term'] === 'category' ) {
        $terms = get_the_terms( get_the_ID(), 'category' );

        if ( $terms && ! is_wp_error( $terms ) ) {
            $block_content = '<div class="wp-block-post-terms news-card-category">' . esc_html( $terms[0]->name ) . '</div>';
        }
    }
    return $block_content;
}

add_filter( 'render_block_core/post-terms', 'jason1857_modify_post_terms', 10, 2 );

function jason1857_register_event_cards_block() {
    register_block_type( __DIR__ . '/blocks/event-cards' );
}

add_action( 'init', 'jason1857_register_event_cards_block' );

function jason1857_register_contract_cards_block() {
    register_block_type( __DIR__ . '/blocks/contract-cards' );
}

add_action( 'init', 'jason1857_register_contract_cards_block' );

// Register custom post type for contracts
function jason1857_register_contracts() {
    $labels = array(
        'name' => 'Contracts',
        'singular_name' => 'Contract',
        'add_new' => 'Add New Contract',
        'add_new_item' => 'Add New Contract',
        'edit_item' => 'Edit Contract',
        'new_item' => 'New Contract',
        'view_item' => 'View Contract',
        'search_items' => 'Search Contracts',
        'not_found' => 'No contracts found',
        'not_found_in_trash' => 'No contracts found in Trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'custom-fields' ),
    );

    register_post_type( 'contract', $args );
}

add_action( 'init', 'jason1857_register_contracts' );

// TODO: Not used yet!!
// Register custom post type for profiles
function jason1857_register_profiles(){
    $labels = array(
        'name' => 'Profiles',
        'singular_name' => 'Profile',
        'add_new' => 'Add New Profile',
        'add_new_item' => 'Add New Profile',
        'edit_item' => 'Edit Profile',
        'new_item' => 'New Profile',
        'view_item' => 'View Profile',
        'search_items' => 'Search Profiles',
        'not_found' => 'No profiles found',
        'not_found_in_trash' => 'No profiles found in Trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'custom-fields' ),
    );

    register_post_type( 'profile', $args );
}

add_action( 'init', 'jason1857_register_profiles' );

