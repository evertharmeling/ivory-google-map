<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Html;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\AbstractTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\TagRenderer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractTagRendererTest extends TestCase
{
    private TagRendererMock $tagRenderer;

    private TagRenderer|MockObject $innerTagRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->innerTagRenderer = $this->createTagRendererMock();
        $this->tagRenderer = new TagRendererMock($this->createFormatterMock(), $this->innerTagRenderer);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->tagRenderer);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->innerTagRenderer, $this->tagRenderer->getTagRenderer());
    }

    public function testTagRenderer()
    {
        $this->tagRenderer->setTagRenderer($tagRenderer = $this->createTagRendererMock());

        $this->assertSame($tagRenderer, $this->tagRenderer->getTagRenderer());
    }

    /**
     * @return MockObject|Formatter
     */
    private function createFormatterMock()
    {
        return $this->createMock(Formatter::class);
    }

    /**
     * @return MockObject|TagRenderer
     */
    private function createTagRendererMock()
    {
        return $this->createMock(TagRenderer::class);
    }
}

class TagRendererMock extends AbstractTagRenderer
{
}
