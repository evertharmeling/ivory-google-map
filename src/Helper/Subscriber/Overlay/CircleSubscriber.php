<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Subscriber\Overlay;

use Ivory\GoogleMap\Helper\Collector\Overlay\CircleCollector;
use Ivory\GoogleMap\Helper\Event\MapEvent;
use Ivory\GoogleMap\Helper\Event\MapEvents;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Overlay\CircleRenderer;
use Ivory\GoogleMap\Helper\Subscriber\AbstractSubscriber;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleSubscriber extends AbstractSubscriber
{
    /**
     * @var CircleCollector
     */
    private $circleCollector;

    /**
     * @var CircleRenderer
     */
    private $circleRenderer;

    public function __construct(
        Formatter $formatter,
        CircleCollector $circleCollector,
        CircleRenderer $circleRenderer
    ) {
        parent::__construct($formatter);

        $this->setCircleCollector($circleCollector);
        $this->setCircleRenderer($circleRenderer);
    }

    /**
     * @return CircleCollector
     */
    public function getCircleCollector()
    {
        return $this->circleCollector;
    }
    /**
     * @return void
     */
    public function setCircleCollector(CircleCollector $circleCollector)
    {
        $this->circleCollector = $circleCollector;
    }

    /**
     * @return CircleRenderer
     */
    public function getCircleRenderer()
    {
        return $this->circleRenderer;
    }
    /**
     * @return void
     */
    public function setCircleRenderer(CircleRenderer $circleRenderer)
    {
        $this->circleRenderer = $circleRenderer;
    }
    /**
     * @return void
     */
    public function handleMap(MapEvent $event)
    {
        $formatter = $this->getFormatter();
        $map = $event->getMap();

        foreach ($this->circleCollector->collect($map) as $circle) {
            $event->addCode($formatter->renderContainerAssignment(
                $map,
                $this->circleRenderer->render($circle, $map),
                'overlays.circles',
                $circle
            ));
        }
    }

    /**
     * {@inheritdoc}
     * @return array<string,string>
     */
    public static function getSubscribedEvents()
    {
        return [MapEvents::JAVASCRIPT_OVERLAY_CIRCLE => 'handleMap'];
    }
}
