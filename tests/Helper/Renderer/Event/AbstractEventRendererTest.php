<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Event;

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Event\AbstractEventRenderer;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractEventRendererTest extends TestCase
{
    private EventRendererMock $eventRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->eventRenderer = new EventRendererMock(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->eventRenderer);
    }

    public function testRender()
    {
        $event = new Event('instance', 'trigger', 'handle');
        $event->setVariable('event');

        $this->assertSame(
            'event=google.maps.event.method(instance,"trigger",handle,false)',
            $this->eventRenderer->render($event)
        );
    }
}

class EventRendererMock extends AbstractEventRenderer
{
    protected function getMethod()
    {
        return 'method';
    }
}