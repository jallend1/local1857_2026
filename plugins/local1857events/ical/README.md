# PHP ical parser
A simple PHP ical parser, that allows to pass in a URL to an ics file and get all event details.

## Motivation
For a client project I needed a simple way to read a ics file from a google calendar.

## Technologies used
- PHP
- HTML

## How to use
Please find an example implementation of the ical parser in the **[index.php](index.php)** file.

### 1. Include the ical classes into your project
To use the ical parser you need to include the files **[ical/ical.php](ical/ical.php)** and **[ical/icalEvent.php](ical/icalEvent.php)** into your project.

### 2. Create a iCal instance
Create a new instance of the iCal class and pass the URL to the ics file into the constructor.

```
$calendar = new iCal("https://calendar.google.com/calendar/ical/de.german%23holiday%40group.v.calendar.google.com/public/basic.ics");
```

### 3. Get events
You can get either all future events or all currently active events as follows:

**Future events**
```
$icsEvents = $calendar->getEventsAfterDate(date('Y-m-d'));
```

**Active events**
```
$icsEvents = $calendar->getActiveEvents();
```
