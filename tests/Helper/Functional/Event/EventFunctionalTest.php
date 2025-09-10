<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional\Event;

use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class EventFunctionalTest extends AbstractEventFunctional
{
    public function testRender(): void
    {
        $map = new Map();
        $map->getEventManager()->addEvent($this->createEvent($map->getVariable()));

        $html = $this->initializeSpyCounter();
        $this->renderMap($map, $html);
        $this->fixErrorPopup();

        $this->assertMap($map);

        $this->byId($map->getHtmlId())->click();

        $this->assertSpyCount(1);
    }
}
