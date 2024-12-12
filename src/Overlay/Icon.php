<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlay;

use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Icon
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Icon implements VariableAwareInterface
{
    const DEFAULT_URL = 'https://maps.gstatic.com/mapfiles/markers/marker.png';

    use VariableAwareTrait;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Point|null
     */
    private $anchor;

    /**
     * @var Point|null
     */
    private $origin;

    /**
     * @var Size|null
     */
    private $scaledSize;

    /**
     * @var Size|null
     */
    private $size;

    /**
     * @var Point|null
     */
    private $labelOrigin;

    /**
     * @param string $url
     */
    public function __construct(
        $url = self::DEFAULT_URL,
        ?Point $anchor = null,
        ?Point $origin = null,
        ?Size $scaledSize = null,
        ?Size $size = null,
        ?Point $labelOrigin = null
    ) {
        $this->setUrl($url);
        $this->setAnchor($anchor);
        $this->setOrigin($origin);
        $this->setScaledSize($scaledSize);
        $this->setSize($size);
        $this->setLabelOrigin($labelOrigin);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function hasAnchor()
    {
        return null !== $this->anchor;
    }

    /**
     * @return Point|null
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    public function setAnchor(?Point $anchor = null)
    {
        $this->anchor = $anchor;
    }

    /**
     * @return bool
     */
    public function hasOrigin()
    {
        return null !== $this->origin;
    }

    /**
     * @return Point|null
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin(?Point $origin = null)
    {
        $this->origin = $origin;
    }

    /**
     * @return bool
     */
    public function hasScaledSize()
    {
        return null !== $this->scaledSize;
    }

    /**
     * @return Size|null
     */
    public function getScaledSize()
    {
        return $this->scaledSize;
    }

    public function setScaledSize(?Size $scaledSize = null)
    {
        $this->scaledSize = $scaledSize;
    }

    /**
     * @return bool
     */
    public function hasSize()
    {
        return null !== $this->size;
    }

    /**
     * @return Size|null
     */
    public function getSize()
    {
        return $this->size;
    }

    public function setSize(Size $size = null)
    {
        $this->size = $size;
    }

    /**
     * @return bool
     */
    public function hasLabelOrigin()
    {
        return null !== $this->labelOrigin;
    }

    /**
     * @return Point|null
     */
    public function getLabelOrigin()
    {
        return $this->labelOrigin;
    }

    public function setLabelOrigin(Point $labelOrigin = null)
    {
        $this->labelOrigin = $labelOrigin;
    }

}
