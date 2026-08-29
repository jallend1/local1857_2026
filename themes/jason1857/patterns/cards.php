<?php
/**
 * Title: Cards
 * Slug: jason1857/cards
 * Categories: jason1857
 * Description: A container of manually-edited, clickable cards — icon/image on top, text below — for linking to different areas of the site.
 */
?>

<!-- wp:group {"className":"cards-container","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group cards-container">

	<!-- wp:group {"className":"card","layout":{"type":"constrained"}} -->
	<div class="wp-block-group card">
		<!-- wp:group {"className":"card-header","layout":{"type":"constrained"}} -->
		<div class="wp-block-group card-header">
			<!-- wp:image {"sizeSlug":"large","className":"card-icon","scale":"contain"} -->
			<figure class="wp-block-image size-large card-icon"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/icons/graduation-cap.png' ); ?>" alt="Graduation Cap" /></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"card-text","layout":{"type":"constrained"}} -->
		<div class="wp-block-group card-text">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Card Title</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Card Description</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"stretched-link"} -->
			<div class="wp-block-button stretched-link">
				<a class="wp-block-button__link wp-element-button" href="#">Read More</a>
			</div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"card","layout":{"type":"constrained"}} -->
	<div class="wp-block-group card">
		<!-- wp:group {"className":"card-header","layout":{"type":"constrained"}} -->
		<div class="wp-block-group card-header">
			<!-- wp:image {"sizeSlug":"large","className":"card-icon","scale":"contain"} -->
			<figure class="wp-block-image size-large card-icon"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/icons/glasses.png' ); ?>" alt="Glasses on some books" /></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"card-text","layout":{"type":"constrained"}} -->
		<div class="wp-block-group card-text">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Card Title</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Card Description</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"stretched-link"} -->
			<div class="wp-block-button stretched-link">
				<a class="wp-block-button__link wp-element-button" href="#">Read More</a>
			</div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"card","layout":{"type":"constrained"}} -->
	<div class="wp-block-group card">
		<!-- wp:group {"className":"card-header","layout":{"type":"constrained"}} -->
		<div class="wp-block-group card-header">
			<!-- wp:image {"sizeSlug":"large","className":"card-icon","scale":"contain"} -->
			<figure class="wp-block-image size-large card-icon"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/icons/library.png' ); ?>" alt="A Library" /></figure>
			
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"card-text","layout":{"type":"constrained"}} -->
		<div class="wp-block-group card-text">
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Card Title</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Card Description</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"stretched-link"} -->
			<div class="wp-block-button stretched-link">
				<a class="wp-block-button__link wp-element-button" href="#">Read More</a>
			</div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->