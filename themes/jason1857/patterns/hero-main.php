<?php
/**
 * Title: Hero — Main
 * Slug: jason1857/hero-main
 * Categories: jason1857
 * Description: Main hero pattern for the homepage.
 */
?>
<!-- wp:group {"tagName":"section","className":"hero hero--main","layout":{"type":"constrained"}} -->
<section class="wp-block-group hero hero--main">
	<!-- wp:group {"className":"hero-grid","layout":{"type":"default"}} -->
	<div class="wp-block-group hero-grid">

		<!-- wp:group {"className":"hero-text","layout":{"type":"constrained"}} -->
		<div class="wp-block-group hero-text">
			<!-- wp:paragraph {"className":"hero-eyebrow"} -->
			<p class="hero-eyebrow">AFSCME Local 1857 · Council 2</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":1,"className":"hero-title"} -->
			<h1 class="wp-block-heading hero-title">Stronger<br><span class="accent">Together.</span></h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"className":"hero-sub"} -->
			<p class="hero-sub">We are hundreds of King County Library System workers — pages, librarians, facilities crew, and staff — building power on the job for fair wages, safe workplaces, and the libraries our communities deserve.</p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons {"className":"hero-actions"} -->
			<div class="wp-block-buttons hero-actions">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button btn btn-lg btn-green" href="/get-involved/">Get Involved →</a></div>
				<!-- /wp:button -->
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button btn-ghost btn" href="/about/">About Your Union</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"hero-image-wrap","layout":{"type":"default"},"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
		<div class="wp-block-group hero-image-wrap">
			<!-- wp:image {"className":"hero-image","sizeSlug":"full"} -->
			<figure class="wp-block-image hero-image"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/snoqualmie-sunset.jpg' ); ?>" alt="Pacific Northwest" /></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->