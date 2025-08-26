<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response\Transit;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionTransitStop
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var Coordinate|null
     */
    private $location;

    /**
     * @return bool
     */
    public function hasName()
    {
        return null !== $this->name;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

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
    /**
     * @return void
     */
    public function setLocation(Coordinate $location = null)
    {
        $this->location = $location;
    }
}
