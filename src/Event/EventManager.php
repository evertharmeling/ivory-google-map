<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Event;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManager
{
    /**
     * @var Event[]
     */
    private $domEvents = [];

    /**
     * @var Event[]
     */
    private $domEventsOnce = [];

    /**
     * @var Event[]
     */
    private $events = [];

    /**
     * @var Event[]
     */
    private $eventsOnce = [];

    /**
     * @return bool
     */
    public function hasDomEvents()
    {
        return !empty($this->domEvents);
    }

    /**
     * @return Event[]
     */
    public function getDomEvents()
    {
        return $this->domEvents;
    }

    /**
     * @param Event[] $domEvents
     * @return void
     */
    public function setDomEvents(array $domEvents)
    {
        $this->domEvents = [];
        $this->addDomEvents($domEvents);
    }

    /**
     * @param Event[] $domEvents
     * @return void
     */
    public function addDomEvents(array $domEvents)
    {
        foreach ($domEvents as $domEvent) {
            $this->addDomEvent($domEvent);
        }
    }

    /**
     * @return bool
     */
    public function hasDomEvent(Event $domEvent)
    {
        return in_array($domEvent, $this->domEvents, true);
    }
    /**
     * @return void
     */
    public function addDomEvent(Event $domEvent)
    {
        if (!$this->hasDomEvent($domEvent)) {
            $this->domEvents[] = $domEvent;
        }
    }
    /**
     * @return void
     */
    public function removeDomEvent(Event $domEvent)
    {
        unset($this->domEvents[array_search($domEvent, $this->domEvents, true)]);
        $this->domEvents = empty($this->domEvents) ? [] : array_values($this->domEvents);
    }

    /**
     * @return bool
     */
    public function hasDomEventsOnce()
    {
        return !empty($this->domEventsOnce);
    }

    /**
     * @return Event[]
     */
    public function getDomEventsOnce()
    {
        return $this->domEventsOnce;
    }

    /**
     * @param Event[] $domEventsOnce
     * @return void
     */
    public function setDomEventsOnce(array $domEventsOnce)
    {
        $this->domEventsOnce = [];
        $this->addDomEventsOnce($domEventsOnce);
    }

    /**
     * @param Event[] $domEventsOnce
     * @return void
     */
    public function addDomEventsOnce(array $domEventsOnce)
    {
        foreach ($domEventsOnce as $domEventOnce) {
            $this->addDomEventOnce($domEventOnce);
        }
    }

    /**
     * @return bool
     */
    public function hasDomEventOnce(Event $domEventOnce)
    {
        return in_array($domEventOnce, $this->domEventsOnce, true);
    }
    /**
     * @return void
     */
    public function addDomEventOnce(Event $domEventOnce)
    {
        if (!$this->hasDomEventOnce($domEventOnce)) {
            $this->domEventsOnce[] = $domEventOnce;
        }
    }
    /**
     * @return void
     */
    public function removeDomEventOnce(Event $domEventOnce)
    {
        unset($this->domEventsOnce[array_search($domEventOnce, $this->domEventsOnce, true)]);
        $this->domEventsOnce = empty($this->domEventsOnce) ? [] : array_values($this->domEventsOnce);
    }

    /**
     * @return bool
     */
    public function hasEvents()
    {
        return !empty($this->events);
    }

    /**
     * @return Event[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param Event[] $events
     * @return void
     */
    public function setEvents(array $events)
    {
        $this->events = [];
        $this->addEvents($events);
    }

    /**
     * @param Event[] $events
     * @return void
     */
    public function addEvents(array $events)
    {
        foreach ($events as $event) {
            $this->addEvent($event);
        }
    }

    /**
     * @return bool
     */
    public function hasEvent(Event $event)
    {
        return in_array($event, $this->events, true);
    }
    /**
     * @return void
     */
    public function addEvent(Event $event)
    {
        if (!$this->hasEvent($event)) {
            $this->events[] = $event;
        }
    }
    /**
     * @return void
     */
    public function removeEvent(Event $event)
    {
        unset($this->events[array_search($event, $this->events, true)]);
        $this->events = empty($this->events) ? [] : array_values($this->events);
    }

    /**
     * @return bool
     */
    public function hasEventsOnce()
    {
        return !empty($this->eventsOnce);
    }

    /**
     * @return Event[]
     */
    public function getEventsOnce()
    {
        return $this->eventsOnce;
    }

    /**
     * @param Event[] $eventsOnce
     * @return void
     */
    public function setEventsOnce(array $eventsOnce)
    {
        $this->eventsOnce = [];
        $this->addEventsOnce($eventsOnce);
    }

    /**
     * @param Event[] $eventsOnce
     * @return void
     */
    public function addEventsOnce(array $eventsOnce)
    {
        foreach ($eventsOnce as $eventOnce) {
            $this->addEventOnce($eventOnce);
        }
    }

    /**
     * @return bool
     */
    public function hasEventOnce(Event $eventOnce)
    {
        return in_array($eventOnce, $this->eventsOnce, true);
    }
    /**
     * @return void
     */
    public function addEventOnce(Event $eventOnce)
    {
        $this->eventsOnce[] = $eventOnce;
    }
    /**
     * @return void
     */
    public function removeEventOnce(Event $eventOnce)
    {
        unset($this->eventsOnce[array_search($eventOnce, $this->eventsOnce, true)]);
        $this->eventsOnce = empty($this->eventsOnce) ? [] : array_values($this->eventsOnce);
    }
}
