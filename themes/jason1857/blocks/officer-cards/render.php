<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$officers = new WP_Query( [
    'post_type'      => 'officer',
    'posts_per_page' => -1, 
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
] );

if ( ! $officers->have_posts() ) {
    echo '<p>No officers to display.</p>';
    return;
}

// $executives = new WP_Query( [
//     'post_type'   => 'officer',
//     'meta_key'    => 'is_executive',
//     'meta_value'  => '1',
//     'posts_per_page' => -1,
// ] );

// $members_at_large = new WP_Query( [
//     'post_type'   => 'officer',
//     'meta_query'  => [
//         [
//             'key'     => 'is_executive',
//             'compare' => 'NOT EXISTS',
//         ],
//     ],
//     'posts_per_page' => -1,
// ] );

$accent_colors = [ '--blue-darker', '--green-darker', '--burgundy-deep' ];
$i = 0;
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'jason1857-officer-cards' ] ); ?>>
    <?php while ( $officers->have_posts() ) : $officers->the_post(); ?>
        <?php
        $accent   = $accent_colors[ $i % count( $accent_colors ) ];
        $position = get_post_meta( get_the_ID(), 'position', true );
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
                <p class="officer-card__location">Work Location: <?php echo esc_html( $location ); ?></p>
            <?php endif; ?>

            <?php if ( ! empty( $bio ) ) : ?>
                <p class="officer-card__bio"><?php echo esc_html( $bio ); ?></p>
            <?php endif; ?>
        </main>
    </div>
    <?php endwhile; wp_reset_postdata(); ?>
</div>