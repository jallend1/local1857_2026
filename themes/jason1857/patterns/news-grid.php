<?php
/**
 * Title: News Grid
 * Slug: jason1857/news-grid
 * Categories: jason1857
 * Description: News grid pattern for the homepage displaying the three recent posts.
 */
?>
<!-- wp:group {"tagName":"section","className":"news-grid","layout":{"type":"flex","orientation":"vertical"}} -->
<section class="wp-block-group news-grid"><!-- wp:group {"tagName":"header","className":"section-header","layout":{"type":"flex","orientation":"vertical"}} -->
    <header class="wp-block-group section-header">
        <!-- wp:paragraph {"className":"section-eyebrow"} -->
            <p class="section-eyebrow">From the Union</p>
        <!-- /wp:paragraph -->

        <!-- wp:heading {"className":"section-title"} -->
            <h2 class="wp-block-heading section-title">Latest News</h2>
        <!-- /wp:heading -->

        <!-- wp:group {"className":"section-sub-container"} -->
        <div class="wp-block-group section-sub-container"><!-- wp:paragraph {"className":"section-sub","fontSize":"sm"} -->
            <p class="section-sub has-sm-font-size">Updates, announcements, and dispatches from your Eboard and stewards</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"className":"section-buttons"} -->
                <div class="wp-block-buttons section-buttons">
                    <!-- wp:button -->
                    <div class="wp-block-button">
                        <a class="wp-block-button__link wp-element-button" href="/news">All News  →</a>
                    </div>
                    <!-- /wp:button -->
                </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:group -->
    </header>
<!-- /wp:group -->

    <!-- wp:query {"queryId":15,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"metadata":{"categories":["posts"],"patternName":"core/query-grid-posts","name":"Grid"},"className":"news-grid"} -->
    <div class="wp-block-query news-grid">
        <!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
            <!-- wp:group {"className":"news-card"} -->
            <div class="wp-block-group news-card">
                <!-- wp:group {"className":"news-card-header","layout":{"type":"constrained"}} -->
                <div class="wp-block-group news-card-header">
                    <!-- wp:post-featured-image /-->
                    <!-- wp:post-terms {"term":"category", "className":"news-card-category"} /-->
                </div>
                <!-- /wp:group -->
                <!-- wp:group {"className":"news-card-text","layout":{"type":"constrained"}} -->
                <div class="wp-block-group news-card-text">
                    <!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"css":"news-grid-post-date"}} /-->
                    <!-- wp:post-title {"isLink":true} /-->
                    <!-- wp:post-excerpt {"moreText":"","excerptLength":30} /-->
                </div>
                <!-- /wp:group -->
                <!-- wp:read-more {"content":"Read More  →","className":"news-grid-read-more"} /-->
            </div>
            <!-- /wp:group -->
        <!-- /wp:post-template -->
    </div>
    <!-- /wp:query -->
</section>
<!-- /wp:group -->