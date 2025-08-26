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
class DirectionTransitVehicle
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $icon;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var string|null
     */
    private $localIcon;

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
    public function hasType()
    {
        return null !== $this->type;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function hasLocalIcon()
    {
        return null !== $this->localIcon;
    }

    /**
     * @return string|null
     */
    public function getLocalIcon()
    {
        return $this->localIcon;
    }

    /**
     * @param string|null $localIcon
     * @return void
     */
    public function setLocalIcon($localIcon)
    {
        $this->localIcon = $localIcon;
    }
}
