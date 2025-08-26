<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Layer;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\ExtendableInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class LayerManager
{
    /**
     * @var Map|null
     */
    private $map;

    /**
     * @var GeoJsonLayer[]
     */
    private $geoJsonLayers = [];

    /**
     * @var HeatmapLayer[]
     */
    private $heatmapLayers = [];

    /**
     * @var KmlLayer[]
     */
    private $kmlLayers = [];

    /**
     * @return bool
     */
    public function hasMap()
    {
        return null !== $this->map;
    }

    /**
     * @return Map|null
     */
    public function getMap()
    {
        return $this->map;
    }
    /**
     * @return void
     */
    public function setMap(Map $map)
    {
        $this->map = $map;

        if ($map->getLayerManager() !== $this) {
            $map->setLayerManager($this);
        }
    }

    /**
     * @return bool
     */
    public function hasGeoJsonLayers()
    {
        return !empty($this->geoJsonLayers);
    }

    /**
     * @return GeoJsonLayer[]
     */
    public function getGeoJsonLayers()
    {
        return $this->geoJsonLayers;
    }

    /**
     * @param GeoJsonLayer[] $geoJsonLayers
     * @return void
     */
    public function setGeoJsonLayers(array $geoJsonLayers)
    {
        $this->geoJsonLayers = [];
        $this->addGeoJsonLayers($geoJsonLayers);
    }

    /**
     * @param GeoJsonLayer[] $geoJsonLayers
     * @return void
     */
    public function addGeoJsonLayers(array $geoJsonLayers)
    {
        foreach ($geoJsonLayers as $geoJsonLayer) {
            $this->addGeoJsonLayer($geoJsonLayer);
        }
    }

    /**
     * @return bool
     */
    public function hasGeoJsonLayer(GeoJsonLayer $geoJsonLayer)
    {
        return in_array($geoJsonLayer, $this->geoJsonLayers, true);
    }
    /**
     * @return void
     */
    public function addGeoJsonLayer(GeoJsonLayer $geoJsonLayer)
    {
        if (!$this->hasGeoJsonLayer($geoJsonLayer)) {
            $this->geoJsonLayers[] = $geoJsonLayer;
        }
    }
    /**
     * @return void
     */
    public function removeGeoJsonLayer(GeoJsonLayer $geoJsonLayer)
    {
        unset($this->geoJsonLayers[array_search($geoJsonLayer, $this->geoJsonLayers, true)]);
        $this->geoJsonLayers = empty($this->geoJsonLayers) ? [] : array_values($this->geoJsonLayers);
    }

    /**
     * @return bool
     */
    public function hasHeatmapLayers()
    {
        return !empty($this->heatmapLayers);
    }

    /**
     * @return HeatmapLayer[]
     */
    public function getHeatmapLayers()
    {
        return $this->heatmapLayers;
    }

    /**
     * @param HeatmapLayer[] $heatmapLayers
     * @return void
     */
    public function setHeatmapLayers(array $heatmapLayers)
    {
        foreach ($this->heatmapLayers as $heatmapLayer) {
            $this->removeHeatmapLayer($heatmapLayer);
        }

        $this->addHeatmapLayers($heatmapLayers);
    }

    /**
     * @param HeatmapLayer[] $heatmapLayers
     * @return void
     */
    public function addHeatmapLayers(array $heatmapLayers)
    {
        foreach ($heatmapLayers as $heatmapLayer) {
            $this->addHeatmapLayer($heatmapLayer);
        }
    }

    /**
     * @return bool
     */
    public function hasHeatmapLayer(HeatmapLayer $heatmapLayer)
    {
        return in_array($heatmapLayer, $this->heatmapLayers, true);
    }
    /**
     * @return void
     */
    public function addHeatmapLayer(HeatmapLayer $heatmapLayer)
    {
        if (!$this->hasHeatmapLayer($heatmapLayer)) {
            $this->heatmapLayers[] = $heatmapLayer;
        }

        $this->addExtendable($heatmapLayer);
    }
    /**
     * @return void
     */
    public function removeHeatmapLayer(HeatmapLayer $heatmapLayer)
    {
        unset($this->heatmapLayers[array_search($heatmapLayer, $this->heatmapLayers, true)]);
        $this->heatmapLayers = empty($this->heatmapLayers) ? [] : array_values($this->heatmapLayers);
        $this->removeExtendable($heatmapLayer);
    }

    /**
     * @return bool
     */
    public function hasKmlLayers()
    {
        return !empty($this->kmlLayers);
    }

    /**
     * @return KmlLayer[]
     */
    public function getKmlLayers()
    {
        return $this->kmlLayers;
    }

    /**
     * @param KmlLayer[] $kmlLayers
     * @return void
     */
    public function setKmlLayers(array $kmlLayers)
    {
        foreach ($this->kmlLayers as $kmlLayer) {
            $this->removeKmlLayer($kmlLayer);
        }

        $this->addKmlLayers($kmlLayers);
    }

    /**
     * @param KmlLayer[] $kmlLayers
     * @return void
     */
    public function addKmlLayers(array $kmlLayers)
    {
        foreach ($kmlLayers as $kmlLayer) {
            $this->addKmlLayer($kmlLayer);
        }
    }

    /**
     * @return bool
     */
    public function hasKmlLayer(KmlLayer $kmlLayer)
    {
        return in_array($kmlLayer, $this->kmlLayers, true);
    }
    /**
     * @return void
     */
    public function addKmlLayer(KmlLayer $kmlLayer)
    {
        if (!$this->hasKmlLayer($kmlLayer)) {
            $this->kmlLayers[] = $kmlLayer;
        }

        $this->addExtendable($kmlLayer);
    }
    /**
     * @return void
     */
    public function removeKmlLayer(KmlLayer $kmlLayer)
    {
        unset($this->kmlLayers[array_search($kmlLayer, $this->kmlLayers, true)]);
        $this->kmlLayers = empty($this->kmlLayers) ? [] : array_values($this->kmlLayers);
        $this->removeExtendable($kmlLayer);
    }
    /**
     * @return void
     */
    private function addExtendable(ExtendableInterface $extendable)
    {
        if ($this->isAutoZoom()) {
            $this->getMap()->getBound()->addExtendable($extendable);
        }
    }
    /**
     * @return void
     */
    private function removeExtendable(ExtendableInterface $extendable)
    {
        if ($this->isAutoZoom()) {
            $this->getMap()->getBound()->removeExtendable($extendable);
        }
    }

    /**
     * @return bool
     */
    private function isAutoZoom()
    {
        return $this->hasMap() && $this->getMap()->isAutoZoom();
    }
}
