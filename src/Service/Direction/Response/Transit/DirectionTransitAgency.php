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
class DirectionTransitAgency
{
    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $phone;

    /**
     * @var string|null
     */
    private $url;

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
    public function hasPhone()
    {
        return null !== $this->phone;
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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
}
