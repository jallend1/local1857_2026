<section class="local1857-events-block">
	<div class="local1857-events-container">
		<?php foreach ($events as $event) {
			// Converts the date to the correct timezone
			$eventDate = get_date_from_gmt($event->startDateTime, 'Y-m-d H:i:s');
		?>
			<div class="local1857-menu-card">
				<div class="local1857-menu-card__header">
					<?php if ($event->title == "Executive Board Meeting") : ?>
						<img class="local1857-menu-card__icon" src="<?php echo plugin_dir_url(__FILE__) . 'assets/calendar.svg'; ?>" alt="Discussion icon">
					<?php else : ?>
						<img class="local1857-menu-card__icon" src="<?php echo plugin_dir_url(__FILE__) . 'assets/megaphone.svg'; ?>" alt="Listening icon">
					<?php endif; ?>
					<h3 class="local1857-menu-card__title"><?php echo esc_html($event->title); ?></h3>
					<p class="local1857-menu-card-time"><?php echo date('F j, Y', strtotime($eventDate)); ?> @ <?php echo date('ga', strtotime($eventDate)); ?></p>
				</div>
				<div class="local1857-menu-card__body">
					<p class="local1857-menu-card__description"><?php echo esc_html($event->description); ?></p>
				</div>
			</div>
		<?php }; ?>
	</div>
</section>