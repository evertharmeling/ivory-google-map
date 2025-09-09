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
use Ivory\GoogleMap\Helper\Renderer\Html\AbstractTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\StylesheetRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\StylesheetTagRenderer;
use Ivory\GoogleMap\Helper\Renderer\Html\TagRenderer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StylesheetTagRendererTest extends TestCase
{
    /**
     * @var StylesheetTagRenderer
     */
    private $stylesheetTagRenderer;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->stylesheetTagRenderer = new StylesheetTagRenderer(
            $formatter = new Formatter(),
            new TagRenderer($formatter),
            new StylesheetRenderer($formatter)
        );
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractTagRenderer::class, $this->stylesheetTagRenderer);
    }

    public function testStylesheetRenderer()
    {
        $stylesheetRenderer = $this->createStylesheetRendererMock();
        $this->stylesheetTagRenderer->setStylesheetRenderer($stylesheetRenderer);

        $this->assertSame($stylesheetRenderer, $this->stylesheetTagRenderer->getStylesheetRenderer());
    }

    /**
     * @param string[] $stylesheets
     * @param string[] $attributes
     */
    #[DataProvider('renderProvider')]
    public function testRender(
        string $expected,
        string $name,
        array $stylesheets = [],
        array $attributes = [],
        bool $newLine = true,
        bool $debug = false
    ) {
        $this->stylesheetTagRenderer->getFormatter()->setDebug($debug);

        $this->assertSame($expected, $this->stylesheetTagRenderer->render($name, $stylesheets, $attributes, $newLine));
    }

    /**
     * @return mixed[][]
     */
    public static function renderProvider(): iterable
    {
        return [
            // Debug disabled
            ['<style type="text/css">name{}</style>', 'name'],
            ['<style type="text/css">name{foo:bar;}</style>', 'name', ['foo' => 'bar']],
            ['<style type="text/css" foo="bar">name{}</style>', 'name', [], ['foo' => 'bar']],
            ['<style type="text/css">name{}</style>', 'name', [], [], false],
            ['<style type="text/css" baz="bat">name{foo:bar;}</style>', 'name', ['foo' => 'bar'], ['baz' => 'bat'], false],

            // Debug enabled
            ['<style type="text/css">'."\n".'    name {}'."\n".'</style>'."\n", 'name', [], [], true, true],
            ['<style type="text/css">'."\n".'    name {'."\n".'        foo: bar;'."\n".'    }'."\n".'</style>'."\n", 'name', ['foo' => 'bar'], [], true, true],
            ['<style type="text/css" foo="bar">'."\n".'    name {}'."\n".'</style>'."\n", 'name', [], ['foo' => 'bar'], true, true],
            ['<style type="text/css">'."\n".'    name {}'."\n".'</style>', 'name', [], [], false, true],
            ['<style type="text/css" baz="bat">'."\n".'    name {'."\n".'        foo: bar;'."\n".'    }'."\n".'</style>', 'name', ['foo' => 'bar'], ['baz' => 'bat'], false, true],
        ];
    }

    /**
     * @return MockObject|StylesheetRenderer
     */
    private function createStylesheetRendererMock()
    {
        return $this->createMock(StylesheetRenderer::class);
    }
}
