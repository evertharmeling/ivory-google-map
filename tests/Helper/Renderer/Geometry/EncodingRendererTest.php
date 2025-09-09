<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Geometry;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Helper\Renderer\Geometry\EncodingRenderer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodingRendererTest extends TestCase
{
    /**
     * @var EncodingRenderer
     */
    private $encodingRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->encodingRenderer = new EncodingRenderer(new Formatter());
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractRenderer::class, $this->encodingRenderer);
    }

    #[DataProvider('renderProvider')]
    public function testRender(string $expected, string $encodedPath)
    {
        $this->assertSame(
            'google.maps.geometry.encoding.decodePath("'.$expected.'")',
            $this->encodingRenderer->renderDecodePath($encodedPath)
        );
    }

    /**
     * @return string[][]
     */
    public static function renderProvider(): iterable
    {
        return [
            ['foo', 'foo'],
            ['\"', '"'],
            ['\'', '\''],
            ['/', '/'],
        ];
    }
}
