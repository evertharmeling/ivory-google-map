<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Geometry
{
    #[SerializedName('location')]
    private ?Coordinate $location = null;

    #[SerializedName('location_type')]
    private ?string $locationType = null;

    #[SerializedName('viewport')]
    private ?Bound $viewport = null;

    #[SerializedName('bounds')]
    private ?Bound $bound = null;

    /**
     * @return bool
     */
    public function hasLocation()
    {
        return null !== $this->location;
    }

    /**
     * @return Coordinate|null
     */
    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation(Coordinate $location = null)
    {
        $this->location = $location;
    }

    /**
     * @return bool
     */
    public function hasLocationType()
    {
        return null !== $this->locationType;
    }

    /**
     * @return string|null
     */
    public function getLocationType()
    {
        return $this->locationType;
    }

    /**
     * @param string|null $locationType
     */
    public function setLocationType($locationType = null)
    {
        $this->locationType = $locationType;
    }

    /**
     * @return bool
     */
    public function hasViewport()
    {
        return null !== $this->viewport;
    }

    /**
     * @return Bound|null
     */
    public function getViewport()
    {
        return $this->viewport;
    }

    public function setViewport(Bound $viewport = null)
    {
        $this->viewport = $viewport;
    }

    /**
     * @return bool
     */
    public function hasBound()
    {
        return null !== $this->bound;
    }

    /**
     * @return Bound|null
     */
    public function getBound()
    {
        return $this->bound;
    }

    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }
}
