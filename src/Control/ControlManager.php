<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Control;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlManager
{
    /**
     * @var FullscreenControl|null
     */
    private $fullscreenControl;

    /**
     * @var MapTypeControl|null
     */
    private $mapTypeControl;

    /**
     * @var RotateControl|null
     */
    private $rotateControl;

    /**
     * @var ScaleControl|null
     */
    private $scaleControl;

    /**
     * @var StreetViewControl|null
     */
    private $streetViewControl;

    /**
     * @var ZoomControl|null
     */
    private $zoomControl;

    /**
     * @var CustomControl[]
     */
    private $customControls = [];

    /**
     * @return bool
     */
    public function hasFullscreenControl()
    {
        return null !== $this->fullscreenControl;
    }

    /**
     * @return FullscreenControl|null
     */
    public function getFullscreenControl()
    {
        return $this->fullscreenControl;
    }
    /**
     * @return void
     */
    public function setFullscreenControl(?FullscreenControl $fullscreenControl = null)
    {
        $this->fullscreenControl = $fullscreenControl;
    }

    /**
     * @return bool
     */
    public function hasMapTypeControl()
    {
        return null !== $this->mapTypeControl;
    }

    /**
     * @return MapTypeControl|null
     */
    public function getMapTypeControl()
    {
        return $this->mapTypeControl;
    }
    /**
     * @return void
     */
    public function setMapTypeControl(?MapTypeControl $mapTypeControl = null)
    {
        $this->mapTypeControl = $mapTypeControl;
    }

    /**
     * @return bool
     */
    public function hasRotateControl()
    {
        return null !== $this->rotateControl;
    }

    /**
     * @return RotateControl|null
     */
    public function getRotateControl()
    {
        return $this->rotateControl;
    }
    /**
     * @return void
     */
    public function setRotateControl(?RotateControl $rotateControl = null)
    {
        $this->rotateControl = $rotateControl;
    }

    /**
     * @return bool
     */
    public function hasScaleControl()
    {
        return null !== $this->scaleControl;
    }

    /**
     * @return ScaleControl|null
     */
    public function getScaleControl()
    {
        return $this->scaleControl;
    }
    /**
     * @return void
     */
    public function setScaleControl(?ScaleControl $scaleControl = null)
    {
        $this->scaleControl = $scaleControl;
    }

    /**
     * @return bool
     */
    public function hasStreetViewControl()
    {
        return null !== $this->streetViewControl;
    }

    /**
     * @return StreetViewControl|null
     */
    public function getStreetViewControl()
    {
        return $this->streetViewControl;
    }
    /**
     * @return void
     */
    public function setStreetViewControl(?StreetViewControl $streetViewControl = null)
    {
        $this->streetViewControl = $streetViewControl;
    }

    /**
     * @return bool
     */
    public function hasZoomControl()
    {
        return null !== $this->zoomControl;
    }

    /**
     * @return ZoomControl|null
     */
    public function getZoomControl()
    {
        return $this->zoomControl;
    }
    /**
     * @return void
     */
    public function setZoomControl(?ZoomControl $zoomControl = null)
    {
        $this->zoomControl = $zoomControl;
    }

    /**
     * @return bool
     */
    public function hasCustomControls()
    {
        return !empty($this->customControls);
    }

    /**
     * @return CustomControl[]
     */
    public function getCustomControls()
    {
        return $this->customControls;
    }

    /**
     * @param CustomControl[] $customControls
     * @return void
     */
    public function setCustomControls(array $customControls)
    {
        $this->customControls = [];
        $this->addCustomControls($customControls);
    }

    /**
     * @param CustomControl[] $customControls
     * @return void
     */
    public function addCustomControls(array $customControls)
    {
        foreach ($customControls as $customControl) {
            $this->addCustomControl($customControl);
        }
    }

    /**
     * @return bool
     */
    public function hasCustomControl(CustomControl $customControl)
    {
        return in_array($customControl, $this->customControls, true);
    }
    /**
     * @return void
     */
    public function addCustomControl(CustomControl $customControl)
    {
        if (!$this->hasCustomControl($customControl)) {
            $this->customControls[] = $customControl;
        }
    }
    /**
     * @return void
     */
    public function removeCustomControl(CustomControl $customControl)
    {
        unset($this->customControls[array_search($customControl, $this->customControls, true)]);
        $this->customControls = empty($this->customControls) ? [] : array_values($this->customControls);
    }
}
