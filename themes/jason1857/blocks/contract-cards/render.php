<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'jason1857_get_first_heading' ) ) {
    function jason1857_get_first_heading( string $content ): string {
        if ( preg_match( '/<h[1-6][^>]*>(.*?)<\/h[1-6]>/is', $content, $m ) ) {
            return trim( wp_strip_all_tags( $m[1] ) );
        }
        return '';
    }
}

if ( ! function_exists( 'jason1857_remove_first_heading' ) ) {
    function jason1857_remove_first_heading( string $content ): string {
        return preg_replace( '/<h[1-6][^>]*>.*?<\/h[1-6]>/is', '', $content, 1 );
    }
}

if ( ! function_exists( 'jason1857_get_first_sentence' ) ) {
    function jason1857_get_first_sentence( string $text ): string {
        $text = trim( $text );
        if ( '' === $text ) {
            return '';
        }
        $pos = strpos( $text, '.' );
        if ( false === $pos ) {
            return $text;
        }
        return substr( $text, 0, $pos + 1 );
    }
}

$contracts = new WP_Query( [
    'post_type'      => 'contract',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
] );

if ( ! $contracts->have_posts() ) {
    echo '<p>No contracts to display.</p>';
    return;
}

$accent_colors = [ '--blue-darker', '--green-darker', '--burgundy-deep' ];
$i = 0;
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'jason1857-contract-cards' ] ); ?>>
    <?php while ( $contracts->have_posts() ) : $contracts->the_post(); ?>
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
        <div class="contract-card" style="--contract-accent: var(<?php echo esc_attr( $accent ); ?>);">
            <p class="contract-card__eyebrow"><?php the_title(); ?></p>
            <h3 class="contract-card__title"><?php the_title(); ?></h3>
            <?php if ( ! empty( $heading ) ) : ?>
                <p class="contract-card__subheading"><?php echo esc_html( $heading ); ?></p>
            <?php endif; ?>
            <p class="contract-card__excerpt"><?php echo esc_html( $excerpt ); ?></p>
            <div class="contract-card__separator"></div>
            <a class="contract-card__link" href="<?php the_permalink(); ?>">
                <svg class="contract-card__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 3h7v7"/><path d="M10 14 21 3"/><path d="M21 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h5"/></svg>
                Open Contract Page &gt;
            </a>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
</div>