<?php

declare(strict_types=1);

require_once('icalEvent.php');
class iCal
{
    public $Events = array();

    public function __construct(string $content)
    {
        $isUrl = strpos($content, 'http') === 0 && filter_var($content, FILTER_VALIDATE_URL);
        $isFile = strpos($content, "\n") === false && file_exists($content);

        if ($isUrl || $isFile) {
            $this->parse(file_get_contents($content));
        }
    }

    protected function parse(string $content): iCal
    {
        $content = str_replace("\r\n ", '', $content);

        preg_match_all('`BEGIN:VEVENT(.+)END:VEVENT`Us', $content, $matches);
        foreach ($matches[0] as $eventContent) {
            $this->Events[] = new iCalEvent($eventContent);
        }

        return $this;
    }

    public function getEventsAfterDate(string $date): array
    {
        $output = array();

        $date = strtotime($date);
        foreach ($this->Events as $event) {
            $eventTimestamp = strtotime($event->startDateTime);
            if ($eventTimestamp >= $date) {
                // Strips out HTML tags from the description before adding it to the array
                $event->description = strip_tags($event->description);
                // TODO: Converts the time from GMT to PST, though I'm unclear why this is necessary :(
                $event->startDateTime = date('Y-m-d H:i:s', strtotime($event->startDateTime) - 25200);
                $output[] = $event;
            }
        }

        // Sorts the array by start date
        usort($output, function ($a, $b) {
            return strtotime($a->startDateTime) - strtotime($b->startDateTime);
        });
        
        // Returns only the next 3 events
        if (count($output) > 3) {
            $output = array_slice($output, 0, 3);
        }
    
        return $output;
    }
}
