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

use Ivory\GoogleMap\Event\Event;
use Ivory\GoogleMap\Event\MouseEvent;
use Ivory\Tests\GoogleMap\Helper\Functional\AbstractMapFunctional;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractEventFunctional extends AbstractMapFunctional
{
    private string $spyCount;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->spyCount = 'spy_count';
    }

    protected function assertSpyCount(int $count): void
    {
        $this->assertSame($count, self::$pantherClient->executeScript("return window.$this->spyCount;"));
//        $this->assertSameVariable($count, 'window.'.$this->spyCount);
    }

    protected function initializeSpyCounter(): string
    {
        return '<script type="text/javascript">window.spy_count = 0;</script>';
    }

    protected function createEvent(?string $instance = null): Event
    {
        return new Event(
            $instance ?: '',
            MouseEvent::CLICK,
            <<<EOF
function () { window.$this->spyCount = (window.$this->spyCount || 0) + 1; }
EOF
        );
    }
}
