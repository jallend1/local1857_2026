<?php

/**
 * Plugin Name:       Local 1857 Latest News
 * Description:       Displays the latest blog posts
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.1.0
 * Author:            Two Dogs Web Development
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       latest-news
 *
 * @package           local1857
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

function local1857_latest_news_block_renderer($_attr)
{
    $cached = get_transient('local1857_latest_news_v2');
    if ($cached !== false) {
        return $cached;
    }

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $the_query = new WP_Query($args);
    ob_start();
?>
    <section class="local1857-latest-news-block">
        <div class="local1857-recent-posts">
            <?php if ($the_query->have_posts()) ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <div class="local1857-news-card">
                    <header>
                        <div class="local1857-news-image">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('large');
                            }
                            // If no featured image, display the first image from the post or default logo
                            else {
                                $local1857_post_img = local1857_get_post_image();
                                echo '<img src="' . $local1857_post_img . '" alt="' . get_the_title() . '">';
                            } ?>
                        </div>
                        <a href="<?php the_permalink(); ?>">
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </header>
                    <main class="local1857-news-content">
                        <p class="local1857-recent-post-time"><?php the_date('F j, Y'); ?></p>
                        <div class="local1857-recent-post-expanded">
                            <p>
                                <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                            </p>
                        </div>
                    </main>
                    <footer class="wp-block-button local1857-read-more-section">
                        <a class="wp-block-button__link w-element-button local1857-read-more" href="<?php the_permalink(); ?>">Read More</a>
                    </footer>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php
    wp_reset_postdata();
    $output = ob_get_clean();
    set_transient('local1857_latest_news_v2', $output, HOUR_IN_SECONDS);
    return $output;
}

function local1857_get_post_image()
{
    global $post;
    $blocks = parse_blocks($post->post_content);
    foreach ($blocks as $block) {
        if ($block['blockName'] === 'core/image' && !empty($block['attrs']['id'])) {
            $img = wp_get_attachment_image_src($block['attrs']['id'], 'large');
            if ($img) {
                return $img[0];
            }
        }
    }
    return get_theme_file_uri('assets/images/local1857logo.webp');
}

function local1857_latest_news_clear_cache()
{
    delete_transient('local1857_latest_news_v2');
}

add_action('save_post', 'local1857_latest_news_clear_cache');

function local1857_latest_news_block_init()
{
    register_block_type(
        __DIR__ . '/build',
        array(
            'render_callback' => 'local1857_latest_news_block_renderer'
        )
    );
}

add_action('init', 'local1857_latest_news_block_init');
