<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\TimeZone\Request;

use DateTime;
use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TimeZoneRequest implements TimeZoneRequestInterface
{
    /**
     * @var Coordinate
     */
    private $location;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string|null
     */
    private $language;

    public function __construct(Coordinate $location, \DateTime $date = null)
    {
        $this->setLocation($location);
        $this->setDate($date);
    }

    /**
     * @return Coordinate
     */
    public function getLocation()
    {
        return $this->location;
    }
    /**
     * @return void
     */
    public function setLocation(Coordinate $location)
    {
        $this->location = $location;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * @return void
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return bool
     */
    public function hasLanguage()
    {
        return null !== $this->language;
    }

    /**
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     * @return void
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed[]
     */
    public function buildQuery()
    {
        $query = [
            'location'  => $this->buildCoordinate($this->location),
            'timestamp' => $this->date->getTimestamp(),
        ];

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }

    /**
     * @return string
     */
    private function buildCoordinate(Coordinate $coordinate)
    {
        return $coordinate->getLatitude().','.$coordinate->getLongitude();
    }
}
