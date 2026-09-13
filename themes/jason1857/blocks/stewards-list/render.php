<?php
/**
 * Server-side render for jason1857/stewards-list block.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$terms = get_terms(
	array(
		'taxonomy'   => 'region',
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	)
);

if ( is_wp_error( $terms ) || empty( $terms ) ) {
	echo '<p>' . esc_html__( 'No regions found.', 'jason1857' ) . '</p>';
	return;
}

$accents = array( '#2f6f4e', '#2a5d8f', '#a24b3a', '#7a5a9e', '#b8862e' );
$i       = 0;
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'stewards-list' ) );  ?>>
	<?php foreach ( $terms as $term ) : ?>
		<?php
		$stewards = get_posts(
			array(
				'post_type'      => 'steward',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
				'tax_query'      => array( 
					array(
						'taxonomy' => 'region',
						'field'    => 'term_id',
						'terms'    => $term->term_id,
					),
				),
			)
		);

		if ( empty( $stewards ) ) {
			continue;
		}

		$accent = $accents[ $i % count( $accents ) ];
		$i++;
		?>
		<div class="region-card">
			<div class="region-card__header" style="background-color: <?php echo esc_attr( $accent ); ?>;">
				<?php echo esc_html( $term->name ); ?>
			</div>
			<ul class="region-card__names">
				<?php foreach ( $stewards as $steward ) : ?>
					<li><?php echo esc_html( $steward->post_title ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endforeach; ?>
</div>
