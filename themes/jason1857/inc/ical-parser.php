<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function jason1857_get_ical_property( string $block, string $name ): ?string {
    $pattern = '/^' . preg_quote( $name, '/' ) . '(?:;[^:\r\n]*)?:(.*)$/m';
    if ( preg_match( $pattern, $block, $m ) ) {
        return jason1857_unescape_ical_text( $m[1] );
    }
    return null;
}

function jason1857_parse_ical( string $data ): array {
    $data = preg_replace( "/\r\n[ \t]/", '', $data );

    $events = [];
    $raw = explode( 'BEGIN:VEVENT', $data );
    array_shift( $raw );

    foreach ( $raw as $block ) {
        $event = [];

        $event['summary']     = jason1857_get_ical_property( $block, 'SUMMARY' ) ?? '';
        $event['location']    = jason1857_get_ical_property( $block, 'LOCATION' ) ?? '';
        $event['description'] = jason1857_get_ical_property( $block, 'DESCRIPTION' ) ?? '';

        if ( preg_match( '/^DTSTART(?:;TZID=([^:;\r\n]+))?[^:]*:(\d{8}(?:T\d{6})?Z?)/m', $block, $m ) ) {
            $tzid = $m[1] !== '' ? $m[1] : null;
            $event['start'] = jason1857_parse_ical_date( $m[2], $tzid );
        }

        if ( ! empty( $event['start'] ) )
            $events[] = $event;
    }

    return $events;
}

function jason1857_parse_ical_date( string $raw, ?string $tzid = null ): DateTime {
    $raw = trim( $raw );

    // All-day event: date only, no time component — no timezone conversion needed
    if ( strlen( $raw ) === 8 ) {
        return DateTime::createFromFormat( 'Ymd', $raw, wp_timezone() );
    }

    // UTC time (Z suffix) — convert to site timezone for display
    if ( str_ends_with( $raw, 'Z' ) ) {
        $dt = DateTime::createFromFormat( 'Ymd\THis\Z', $raw, new DateTimeZone( 'UTC' ) );
        $dt->setTimezone( wp_timezone() );
        return $dt;
    }

    // Local time tagged with a specific TZID — interpret in that zone, then convert
    $source_tz = wp_timezone();
    if ( $tzid ) {
        try {
            $source_tz = new DateTimeZone( $tzid );
        } catch ( Exception $e ) {
            // Unrecognized TZID string — fall back to site timezone
        }
    }

    $dt = DateTime::createFromFormat( 'Ymd\THis', $raw, $source_tz );
    $dt->setTimezone( wp_timezone() );
    return $dt;
}

function jason1857_unescape_ical_text( string $text ): string {
    $text = str_replace( [ '\\n', '\\N' ], "\n", $text );
    $text = str_replace( [ '\\,', '\\;' ], [ ',', ';' ], $text );
    $text = str_replace( '\\\\', '\\', $text );
    return trim( $text );
}