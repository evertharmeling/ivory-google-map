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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionTransitLine
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $shortName;

    /**
     * @var string|null
     */
    private $color;

    /**
     * @var string|null
     */
    private $url;

    /**
     * @var string|null
     */
    private $icon;

    /**
     * @var string|null
     */
    private $textColor;

    /**
     * @var DirectionTransitVehicle|null
     */
    private $vehicle;

    /**
     * @var DirectionTransitAgency[]
     */
    private $agencies = [];

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
    public function hasShortName()
    {
        return null !== $this->shortName;
    }

    /**
     * @return string|null
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param string|null $shortName
     * @return void
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return bool
     */
    public function hasColor()
    {
        return null !== $this->color;
    }

    /**
     * @return string|null
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     * @return void
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return bool
     */
    public function hasUrl()
    {
        return null !== $this->url;
    }

    /**
     * @return string|null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function hasIcon()
    {
        return null !== $this->icon;
    }

    /**
     * @return string|null
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     * @return void
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return bool
     */
    public function hasTextColor()
    {
        return null !== $this->textColor;
    }

    /**
     * @return string|null
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * @param string|null $textColor
     * @return void
     */
    public function setTextColor($textColor)
    {
        $this->textColor = $textColor;
    }

    /**
     * @return bool
     */
    public function hasVehicle()
    {
        return null !== $this->vehicle;
    }

    /**
     * @return DirectionTransitVehicle|null
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }
    /**
     * @return void
     */
    public function setVehicle(DirectionTransitVehicle $vehicle = null)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @return bool
     */
    public function hasAgencies()
    {
        return !empty($this->agencies);
    }

    /**
     * @return DirectionTransitAgency[]
     */
    public function getAgencies()
    {
        return $this->agencies;
    }

    /**
     * @param DirectionTransitAgency[] $agencies
     * @return void
     */
    public function setAgencies(array $agencies)
    {
        $this->agencies = $agencies;
        $this->addAgencies($agencies);
    }

    /**
     * @param DirectionTransitAgency[] $agencies
     * @return void
     */
    public function addAgencies(array $agencies)
    {
        foreach ($agencies as $agency) {
            $this->addAgency($agency);
        }
    }

    /**
     * @return bool
     */
    public function hasAgency(DirectionTransitAgency $agency)
    {
        return in_array($agency, $this->agencies, true);
    }
    /**
     * @return void
     */
    public function addAgency(DirectionTransitAgency $agency)
    {
        if (!$this->hasAgency($agency)) {
            $this->agencies[] = $agency;
        }
    }
    /**
     * @return void
     */
    public function removeAgency(DirectionTransitAgency $agency)
    {
        unset($this->agencies[array_search($agency, $this->agencies, true)]);
        $this->agencies = empty($this->agencies) ? [] : array_values($this->agencies);
    }
}
