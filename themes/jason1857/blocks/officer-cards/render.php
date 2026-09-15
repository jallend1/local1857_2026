<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$officers = new WP_Query( [
    'post_type'      => 'officer',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
] );

if ( ! $officers->have_posts() ) {
    echo '<p>No officers to display.</p>';
    return;
}

// Builds officer array to sort by position priority
$officer_list = [];
while ( $officers->have_posts() ) {
    $officers->the_post();
    $officer_list[] = [
        'id'       => get_the_ID(),
        'position' => get_post_meta( get_the_ID(), 'position', true ),
    ];
}
wp_reset_postdata();

// Put these positions at the front since they're executive
$priority_order = [ 'president', 'vice president', 'treasurer', 'secretary' ];

function jason1857_officer_sort_rank( string $position, array $priority_order ): int {
    $position_lower = strtolower( trim( $position ) );
    foreach ( $priority_order as $index => $needle ) {
        if ( str_starts_with( $position_lower, $needle ) ) {
            return $index;
        }
    }
    return count( $priority_order );
}

usort( $officer_list, function( $a, $b ) use ( $priority_order ) {
    $rank_a = jason1857_officer_sort_rank( $a['position'], $priority_order );
    $rank_b = jason1857_officer_sort_rank( $b['position'], $priority_order );

    if ( $rank_a !== $rank_b ) {
        return $rank_a <=> $rank_b;
    }

    return strcasecmp( $a['position'], $b['position'] );
} );
$accent_colors = [ '--blue-darker', '--green-darker', '--burgundy-deep' ];
$i = 0;
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'jason1857-officer-cards' ] ); ?>>
    <?php foreach ( $officer_list as $officer ) :
        global $post;
        $post = get_post( $officer['id'] );
        setup_postdata( $post );

        $accent   = $accent_colors[ $i % count( $accent_colors ) ];
        $position = $officer['position'];
        $location = get_post_meta( get_the_ID(), 'location', true );
        $bio      = get_post_meta( get_the_ID(), 'bio', true );
        $i++;
        ?>
        <div class="officer-card" style="--officer-accent: var(<?php echo esc_attr( $accent ); ?>);">
        <header>
            <div class="officer-card__photo">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'medium' ); ?>
                <?php else :
                    $fallback = jason1857_get_officer_fallback_image( get_the_ID() );
                    ?>
                    <img src="<?php echo esc_url( $fallback['url'] ); ?>" alt="<?php echo esc_attr( $fallback['alt'] ); ?>" />
                <?php endif; ?>
            </div>
        </header>
        <main>
            <?php if ( ! empty( $position ) ) : ?>
                <h3 class="officer-card__title"><?php echo esc_html( $position ); ?></h3>
            <?php endif; ?>

            <p class="officer-card__name"><?php the_title(); ?></p>

            <?php if ( ! empty( $location ) ) : ?>
                <p class="officer-card__location"><?php echo esc_html( $location ); ?></p>
            <?php endif; ?>

            <?php if ( ! empty( $bio ) ) : ?>
                <p class="officer-card__bio"><?php echo esc_html( $bio ); ?></p>
            <?php endif; ?>
        </main>
    </div>
    <?php endforeach; wp_reset_postdata(); ?>
</div>