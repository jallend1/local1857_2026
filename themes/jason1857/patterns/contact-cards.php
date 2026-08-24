<?php
/**
 * Title: Contact Cards
 * Slug: jason1857/contact-cards
 * Categories: jason1857
 * Description: Contact cards pattern for the homepage.
 */
?>
<!-- wp:group {"tagName":"section","className":"contact-cards","layout":{"type":"flex","orientation":"vertical"}} -->
<section class="wp-block-group contact-cards"><!-- wp:group {"tagName":"header","className":"section-header","layout":{"type":"flex","orientation":"vertical"}} -->
<header class="wp-block-group section-header"><!-- wp:paragraph {"className":"section-eyebrow"} -->
<p class="section-eyebrow">Get Connected</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"section-title"} -->
<h2 class="wp-block-heading section-title">Stay In Touch</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"section-sub-container"} -->
<div class="wp-block-group section-sub-container"><!-- wp:paragraph {"className":"section-sub","fontSize":"sm"} -->
<p class="section-sub has-sm-font-size">Multiple ways to stay connected with your union and your colleagues.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></header>
<!-- /wp:group -->

<!-- wp:group {"className":"contact-card-row","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group contact-card-row">
    <!-- wp:group {"className":"contact-card","layout":{"type":"flex","orientation":"vertical"}} -->
        <div class="wp-block-group contact-card">
            <!-- wp:image {"className":"contact-card-image"} -->
                <figure class="wp-block-image contact-card-image"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/email.svg" alt="Email Icon"/></figure>
            <!-- /wp:image -->
            <!-- wp:heading {"level":3,"className":"contact-card-heading"} -->
                <h3 class="wp-block-heading contact-card-heading">Email Newsletter</h3>
            <!-- /wp:heading -->
            <!-- wp:paragraph {"className":"contact-card-text"} -->
                <p class="contact-card-text">Weekly missives from union leadership with bargaining news and meeting details.</p>
            <!-- /wp:paragraph -->
            <!-- wp:paragraph {"className":"contact-card-link"} -->
                <p class="contact-card-link">Sign Up →</p>
            <!-- /wp:paragraph -->
        </div>
    <!-- /wp:group -->

<!-- wp:group {"className":"contact-card","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group contact-card"><!-- wp:image {"className":"contact-card-image"} -->
<figure class="wp-block-image contact-card-image"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/chat.svg" alt="Text Alerts Icon"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"className":"contact-card-heading"} -->
<h3 class="wp-block-heading contact-card-heading">Text Alerts</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"contact-card-text"} -->
<p class="contact-card-text">Infrequent messages to your phone with urgent action items and meeting reminders</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"contact-card-link"} -->
<p class="contact-card-link">Sign Up →</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"contact-card","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group contact-card"><!-- wp:image {"className":"contact-card-image"} -->
<figure class="wp-block-image contact-card-image"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/watercooler.svg" alt="Watercooler Icon"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"className":"contact-card-heading"} -->
<h3 class="wp-block-heading contact-card-heading">Watercooler</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"contact-card-text"} -->
<p class="contact-card-text">An informal newsgroup style space for member-to-member conversation across branches.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"contact-card-link"} -->
<p class="contact-card-link"><a href="/watercooler/">Sign Up →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"contact-card","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group contact-card"><!-- wp:image {"className":"contact-card-image"} -->
<figure class="wp-block-image contact-card-image"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/people.svg" alt="Find Your Steward Icon"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"className":"contact-card-heading"} -->
<h3 class="wp-block-heading contact-card-heading">Find Your Steward</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"contact-card-text"} -->
<p class="contact-card-text">Your shop steward is the union person at your branch. Find yours by location</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"contact-card-link"} -->
<p class="contact-card-link"><a href="shop-stewards/">Search →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->