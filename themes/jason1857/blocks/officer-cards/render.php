<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function jason1857_get_first_heading( string $content ): string {
    if ( preg_match( '/<h[1-6][^>]*>(.*?)<\/h[1-6]>/is', $content, $m ) ) {
        return trim( wp_strip_all_tags( $m[1] ) );
    }
    return '';
}

// Removes the first heading from the content so only the first sentence is displayed on the contract card
function jason1857_remove_first_heading( string $content ): string {
    return preg_replace( '/<h[1-6][^>]*>.*?<\/h[1-6]>/is', '', $content, 1 );
}

// Extracts first sentence of contract to render on contract acrd
function jason1857_get_first_sentence( string $text ): string {
    $text = trim( $text );
    if ( '' === $text ) {
        return '';
    }
    $pos = strpos( $text, '.' );
    if ( false === $pos ) {
        return $text; // No period found — return the whole thing.
    }
    return substr( $text, 0, $pos + 1 );
}

$officers = new WP_Query( [
    'post_type'      => 'officer',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
] );

if ( ! $officers->have_posts() ) {
    echo '<p>No officers to display.</p>';
    return;
}

$accent_colors = [ '--blue-darker', '--green-darker', '--burgundy-deep' ];
$i = 0;
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'jason1857-officer-cards' ] ); ?>>
    <?php while ( $officers->have_posts() ) : $officers->the_post(); ?>
        <?php
        $accent  = $accent_colors[ $i % count( $accent_colors ) ];
        $content = get_the_content();
        $heading = jason1857_get_first_heading( $content );

        if ( has_excerpt() ) {
            $source = get_the_excerpt();
        } else {
            $content_without_heading = jason1857_remove_first_heading( $content );
            $source = wp_strip_all_tags( $content_without_heading );
        }

        $excerpt = jason1857_get_first_sentence( $source );
        $i++;
        ?>
        <div class="officer-card" style="--officer-accent: var(<?php echo esc_attr( $accent ); ?>);">
            <p class="officer-card__eyebrow"><?php the_title(); ?></p>
            <h3 class="officer-card__title"><?php the_title(); ?></h3>
            <?php if ( ! empty( $heading ) ) : ?>
                <p class="officer-card__subheading"><?php echo esc_html( $heading ); ?></p>
            <?php endif; ?>
            <p class="officer-card__excerpt"><?php echo esc_html( $excerpt ); ?></p>
            <div class="officer-card__separator"></div>
            <a class="officer-card__link" href="<?php the_permalink(); ?>">
                <svg class="officer-card__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 3h7v7"/><path d="M10 14 21 3"/><path d="M21 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h5"/></svg>
                Open Officer Page &gt;
            </a>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
</div>