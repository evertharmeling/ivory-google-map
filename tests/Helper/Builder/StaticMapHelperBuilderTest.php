<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Builder;

use Ivory\GoogleMap\Helper\Builder\AbstractHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\StaticMapHelperBuilder;
use Ivory\GoogleMap\Helper\StaticMapHelper;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StaticMapHelperBuilderTest extends TestCase
{
    /** @var StaticMapHelperBuilder */
    private $staticMapHelperBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->staticMapHelperBuilder = StaticMapHelperBuilder::create($_SERVER['API_KEY'] ?? null);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractHelperBuilder::class, $this->staticMapHelperBuilder);
    }

    public function testKey()
    {
        $this->assertSame($this->staticMapHelperBuilder, $this->staticMapHelperBuilder->setKey($key = 'key'));
        $this->assertTrue($this->staticMapHelperBuilder->hasKey());
        $this->assertSame($key, $this->staticMapHelperBuilder->getKey());
    }

    public function testBuild()
    {
        $this->assertInstanceOf(StaticMapHelper::class, $this->staticMapHelperBuilder->build());
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->staticMapHelperBuilder->hasSubscribers());
        $this->assertEmpty($this->staticMapHelperBuilder->getSubscribers());
    }
}
