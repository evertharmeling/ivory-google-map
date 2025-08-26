<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Collector\Overlay;

use Ivory\GoogleMap\Helper\Collector\AbstractCollector;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlay\Icon;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IconCollector extends AbstractCollector
{
    /**
     * @var MarkerCollector
     */
    private $markerCollector;

    public function __construct(MarkerCollector $markerCollector)
    {
        $this->setMarkerCollector($markerCollector);
    }

    /**
     * @return MarkerCollector
     */
    public function getMarkerCollector()
    {
        return $this->markerCollector;
    }
    /**
     * @return void
     */
    public function setMarkerCollector(MarkerCollector $markerCollector)
    {
        $this->markerCollector = $markerCollector;
    }

    /**
     * @param Icon[] $icons
     *
     * @return Icon[]
     */
    public function collect(Map $map, array $icons = [])
    {
        foreach ($this->markerCollector->collect($map) as $marker) {
            if ($marker->hasIcon()) {
                $icons = $this->collectValue($marker->getIcon(), $icons);
            }
        }

        return $icons;
    }
}
