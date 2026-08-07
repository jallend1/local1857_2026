<?php declare(strict_types=1);

class iCalEvent
{
    public $title;
    public $description;
    public $startDateTime;
    public $endDateTime;
    public $location;
    public $created;
    public $lastModified;
    
    public function __construct(string $eventContent)
    {
        $this->parseEvent($eventContent);   
    }

    protected function parseEvent(string $eventContent) : iCalEvent
    {
        $content = str_replace("\r\n ", '', $eventContent);

        $this->title = $this->getEventDetail($content, "SUMMARY:");
        $this->description = $this->getEventDetail($content, "DESCRIPTION:");
        $this->startDateTime = $this->getEventDateTime($content, "DTSTART");
        $this->endDateTime = $this->getEventDateTime($content, "DTEND");
        $this->location = $this->getEventDetail($content, "LOCATION:");
        $this->created = date('d.m.Y H:i', strtotime($this->getEventDetail($content, "CREATED:")));
        $this->lastModified = date('d.m.Y H:i', strtotime($this->getEventDetail($content, "LAST-MODIFIED:")));

		return $this;
    }

    protected function getEventDetail(string $eventContent, string $eventDetailKey) : string
    {
        $output = "";

        if (preg_match('`^' . $eventDetailKey . '(.*)$`m', $eventContent, $match))
        {
            $output = trim($match[1]);
        }

        return $output;
    }

    protected function getEventDateTime(string $eventContent, string $eventDetailKey) : string
    {
        $output = "";

        if (preg_match('`^' . $eventDetailKey . '(?:;.+)?:([0-9]+(T[0-9]+Z?)?)`m', $eventContent, $match))
        {
			$output = date('d.m.Y H:i', strtotime($match[1]));
        }

        return $output;
    }
}