<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Renderer\Image;

use Ivory\GoogleMap\Helper\Renderer\Image\StyleRenderer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StyleRendererTest extends TestCase
{
    /**
     * @var StyleRenderer
     */
    private $styleRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->styleRenderer = new StyleRenderer();
    }

    /**
     * @param mixed[] $style
     */
    #[DataProvider('renderProvider')]
    public function testRender(string $expected, array $style)
    {
        $this->assertSame($expected, $this->styleRenderer->render($style));
    }

    /**
     * @return mixed[]
     */
    public static function renderProvider(): iterable
    {
        return [
            ['color:0x00ff00', ['rules' => ['color' => '0x00ff00']]],
            ['color:0x00ff00|lightness:50', ['rules' => ['color' => '0x00ff00', 'lightness' => '50']]],
            ['feature:road|color:0x00ff00|lightness:50', [
                'feature' => 'road',
                'rules'   => ['color' => '0x00ff00', 'lightness' => '50'],
            ]],
            ['element:geometry|color:0x00ff00|lightness:50', [
                'element' => 'geometry',
                'rules'   => ['color' => '0x00ff00', 'lightness' => '50'],
            ]],
            ['feature:road.local|element:geometry|color:0x00ff00|lightness:50', [
                'feature' => 'road.local',
                'element' => 'geometry',
                'rules'   => ['color' => '0x00ff00', 'lightness' => '50'],
            ]],
        ];
    }
}
