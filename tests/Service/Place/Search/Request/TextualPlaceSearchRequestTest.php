<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Search\Request;

use Ivory\GoogleMap\Service\Place\Search\Request\AbstractPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\AbstractTextualPlaceSearchRequest;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TextualPlaceSearchRequestTest extends TestCase
{
    private TextualPlaceSearchRequestMock $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->request = new TextualPlaceSearchRequestMock();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractPlaceSearchRequest::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->request->hasKeyword());
        $this->assertNull($this->request->getKeyword());
    }

    public function testKeyword()
    {
        $this->request->setKeyword($keyword = 'foo');

        $this->assertTrue($this->request->hasKeyword());
        $this->assertSame($keyword, $this->request->getKeyword());
    }

    public function testBuildQuery()
    {
        $this->assertEmpty($this->request->buildQuery());
    }

    public function testBuildQueryWithKeyword()
    {
        $this->request->setKeyword($keyword = 'foo');

        $this->assertSame(['keyword' => $keyword], $this->request->buildQuery());
    }
}

class TextualPlaceSearchRequestMock extends AbstractTextualPlaceSearchRequest
{
    public function buildContext()
    {
        return 'textual_place_search_request_mock';
    }
}
