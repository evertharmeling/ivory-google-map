<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Place\Event;

use Ivory\GoogleMap\Helper\Collector\Place\Event\AutocompleteDomEventOnceCollector;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvent;
use Ivory\GoogleMap\Helper\Event\PlaceAutocompleteEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Event\DomEventOnceRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteDomEventOnceSubscriber extends AbstractSubscriber
{
    /**
     * @var AutocompleteDomEventOnceCollector
     */
    private $domEventOnceCollector;

    /**
     * @var DomEventOnceRenderer
     */
    private $domEventOnceRenderer;

    public function __construct(
        Formatter $formatter,
        AutocompleteDomEventOnceCollector $domEventOnceCollector,
        DomEventOnceRenderer $domEventOnceRenderer
    ) {
        parent::__construct($formatter);

        $this->setDomEventOnceCollector($domEventOnceCollector);
        $this->setDomEventOnceRenderer($domEventOnceRenderer);
    }

    /**
     * @return AutocompleteDomEventOnceCollector
     */
    public function getDomEventOnceCollector()
    {
        return $this->domEventOnceCollector;
    }
    /**
     * @return void
     */
    public function setDomEventOnceCollector(AutocompleteDomEventOnceCollector $domEventOnceCollector)
    {
        $this->domEventOnceCollector = $domEventOnceCollector;
    }

    /**
     * @return DomEventOnceRenderer
     */
    public function getDomEventOnceRenderer()
    {
        return $this->domEventOnceRenderer;
    }
    /**
     * @return void
     */
    public function setDomEventOnceRenderer(DomEventOnceRenderer $domEventOnceRenderer)
    {
        $this->domEventOnceRenderer = $domEventOnceRenderer;
    }
    /**
     * @return void
     */
    public function handleAutocomplete(PlaceAutocompleteEvent $event)
    {
        $formatter = $this->getFormatter();
        $autocomplete = $event->getAutocomplete();

        foreach ($this->domEventOnceCollector->collect($autocomplete) as $domEventOnce) {
            $event->addCode($formatter->renderContainerAssignment(
                $autocomplete,
                $this->domEventOnceRenderer->render($domEventOnce),
                'events.dom_events_once',
                $domEventOnce
            ));
        }
    }

    /**
     * {@inheritdoc}
     * @return array<string,string>
     */
    public static function getSubscribedEvents()
    {
        return [PlaceAutocompleteEvents::JAVASCRIPT_EVENT_DOM_EVENT_ONCE => 'handleAutocomplete'];
    }
}
