<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'jason1857_parse_ical' ) ) {
    require_once get_theme_file_path( '/inc/ical-parser.php' );
}

$ical_url  = 'https://calendar.google.com/calendar/ical/1857comms%40gmail.com/public/basic.ics';
$cache_key = 'jason1857_upcoming_events';
$events    = get_transient( $cache_key );

if ( false === $events ) {
    $response = wp_remote_get( $ical_url );

    if ( is_wp_error( $response ) ) {
        echo '<p>Unable to load events.</p>';
        return;
    }

    $ical_data = wp_remote_retrieve_body( $response );
    $events    = jason1857_parse_ical( $ical_data );
    set_transient( $cache_key, $events, HOUR_IN_SECONDS );
}

$now      = new DateTime( 'now', wp_timezone() );
$upcoming = array_filter( $events, fn( $e ) => $e['start'] > $now );
usort( $upcoming, fn( $a, $b ) => $a['start'] <=> $b['start'] );
$upcoming = array_slice( $upcoming, 0, 3 );

if ( empty( $upcoming ) ) {
    echo '<p>No upcoming events.</p>';
    return;
}
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'jason1857-event-cards' ] ); ?>>
    <?php foreach ( $upcoming as $event ) : ?>
        <div class="event-card">
            <div class="event-card__header">
                <div class="event-card__date">
                    <span class="event-card__day"><?php echo esc_html( $event['start']->format( 'd' ) ); ?></span>
                    <span class="event-card__month-year">
                        <span class="event-card__month"><?php echo esc_html( $event['start']->format( 'M' ) ); ?></span>
                        <span class="event-card__year"><?php echo esc_html( $event['start']->format( 'Y' ) ); ?></span>
                    </span>
                </div>
                <?php if ( $event['start']->format( 'H:i' ) !== '00:00' ) : ?>
                    <span class="event-card__time"><?php echo esc_html( $event['start']->format( 'g:i A' ) ); ?></span>
                <?php endif; ?>
            </div>
            <div class="event-card__accent"></div>
            <div class="event-card__body">
                <h3 class="event-card__title"><?php echo esc_html( $event['summary'] ); ?></h3>
                <?php if ( ! empty( $event['description'] ) ) : ?>
                    <p class="event-card__description"><?php echo esc_html( wp_strip_all_tags( $event['description'] ) ); ?></p>
                <?php endif; ?>
                <div class="event-card__footer">
                    <span class="event-card__meta">
                        <svg class="event-card__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <?php echo esc_html( $event['start']->format( 'l' ) ); ?>
                    </span>
                    <span class="event-card__meta">
                        <svg class="event-card__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21s-7-6.5-7-11a7 7 0 0 1 14 0c0 4.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        <?php echo empty( $event['location'] ) ? 'Zoom (link via email)' : esc_html( $event['location'] ); ?>
                    </span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>