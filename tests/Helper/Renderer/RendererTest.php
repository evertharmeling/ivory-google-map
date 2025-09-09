<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class RendererTest extends TestCase
{
    private RendererMock $renderer;

    private Formatter|MockObject $formatter;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->formatter = $this->createFormatterMock();
        $this->renderer = new RendererMock($this->formatter);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->formatter, $this->renderer->getFormatter());
    }

    public function testFormatter()
    {
        $this->renderer->setFormatter($formatter = $this->createFormatterMock());

        $this->assertSame($formatter, $this->renderer->getFormatter());
    }

    /**
     * @return MockObject|Formatter
     */
    private function createFormatterMock()
    {
        return $this->createMock(Formatter::class);
    }
}

class RendererMock extends AbstractRenderer
{
}