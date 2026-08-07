<?php

/**
 * Plugin Name:       Local1857events
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       local1857events
 *
 * @package           create-block
 */

// Requires the iCal parser
require_once(plugin_dir_path(__FILE__) . 'ical/ical.php');

// The URL of the Google Calendar to import events from
define('LOCAL1857_SOURCE_CALENDAR', 'https://calendar.google.com/calendar/ical/1857comms%40gmail.com/public/basic.ics');

function local1857_compile_events_data()
{
    $cached = get_transient('local1857_events');
    if ($cached !== false) {
        return $cached;
    }

    $calendar = new iCal(LOCAL1857_SOURCE_CALENDAR);
    $events = $calendar->getEventsAfterDate(date('Y-m-d'));
    set_transient('local1857_events', $events, HOUR_IN_SECONDS);
    return $events;
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

function create_block_local1857events_block_init()
{
    register_block_type(
        __DIR__ . '/build',
        array(
            'render_callback' => 'local1857_render_events_block',
        )
    );
}

function local1857_render_events_block($_attributes)
{
    $events = local1857_compile_events_data(); // used in render.php via include
    ob_start();
    include plugin_dir_path(__FILE__) . 'render.php';
    return ob_get_clean();
}

add_action('init', 'create_block_local1857events_block_init');
