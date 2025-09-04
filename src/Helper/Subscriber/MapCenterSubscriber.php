<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber;

use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\MapCenterRenderer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapCenterSubscriber extends AbstractSubscriber
{
    /**
     * @var MapCenterRenderer
     */
    private $mapCenterRenderer;

    public function __construct(Formatter $formatter, MapCenterRenderer $mapCenterRenderer)
    {
        parent::__construct($formatter);

        $this->setMapCenterRenderer($mapCenterRenderer);
    }

    /**
     * @return MapCenterRenderer
     */
    public function getMapCenterRenderer()
    {
        return $this->mapCenterRenderer;
    }
    /**
     * @return void
     */
    public function setMapCenterRenderer(MapCenterRenderer $mapCenterRenderer)
    {
        $this->mapCenterRenderer = $mapCenterRenderer;
    }
    /**
     * @return void
     */
    public function handleMap(MapEvent $event)
    {
        $map = $event->getMap();

        if (!$map->isAutoZoom()) {
            $event->addCode($this->getFormatter()->renderCode($this->mapCenterRenderer->render($map)));
        }
    }

    /**
     * {@inheritdoc}
     * @return array<string,string>
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_FINISH => 'handleMap'];
    }
}
