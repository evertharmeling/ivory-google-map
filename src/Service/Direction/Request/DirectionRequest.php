<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Request;

use DateTime;
use Ivory\GoogleMap\Service\Base\Location\LocationInterface;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionRequest
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionRequest implements DirectionRequestInterface
{
    /**
     * @var LocationInterface
     */
    private $origin;

    /**
     * @var LocationInterface
     */
    private $destination;

    /**
     * @var \DateTime|null
     */
    private $departureTime;

    /**
     * @var \DateTime|null
     */
    private $arrivalTime;

    /**
     * @var DirectionWaypoint[]
     */
    private $waypoints = [];

    /**
     * @var bool|null
     */
    private $optimizeWaypoints;

    /**
     * @var string|null
     */
    private $travelMode;

    /**
     * @var string|null
     */
    private $avoid;

    /**
     * @var bool|null
     */
    private $provideRouteAlternatives;

    /**
     * @var string|null
     */
    private $trafficModel;

    /**
     * @var string[]
     */
    private $transitModes = [];

    /**
     * @var string|null
     */
    private $transitRoutingPreference;

    /**
     * @var string|null
     */
    private $region;

    /**
     * @var string|null
     */
    private $unitSystem;

    /**
     * @var string|null
     */
    private $language;

    public function __construct(LocationInterface $origin, LocationInterface $destination)
    {
        $this->setOrigin($origin);
        $this->setDestination($destination);
    }

    /**
     * @return LocationInterface
     */
    public function getOrigin()
    {
        return $this->origin;
    }
    /**
     * @return void
     */
    public function setOrigin(LocationInterface $origin)
    {
        $this->origin = $origin;
    }

    /**
     * @return LocationInterface
     */
    public function getDestination()
    {
        return $this->destination;
    }
    /**
     * @return void
     */
    public function setDestination(LocationInterface $destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return bool
     */
    public function hasDepartureTime()
    {
        return null !== $this->departureTime;
    }

    /**
     * @return \DateTime|null
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }
    /**
     * @return void
     */
    public function setDepartureTime(\DateTime $departureTime = null)
    {
        $this->departureTime = $departureTime;
    }

    /**
     * @return bool
     */
    public function hasArrivalTime()
    {
        return null !== $this->arrivalTime;
    }

    /**
     * @return \DateTime|null
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }
    /**
     * @return void
     */
    public function setArrivalTime(\DateTime $arrivalTime = null)
    {
        $this->arrivalTime = $arrivalTime;
    }

    /**
     * @return bool
     */
    public function hasWaypoints()
    {
        return !empty($this->waypoints);
    }

    /**
     * @return DirectionWaypoint[]
     */
    public function getWaypoints()
    {
        return $this->waypoints;
    }

    /**
     * @param DirectionWaypoint[] $waypoints
     * @return void
     */
    public function setWaypoints(array $waypoints)
    {
        $this->waypoints = [];
        $this->addWaypoints($waypoints);
    }

    /**
     * @param DirectionWaypoint[] $waypoints
     * @return void
     */
    public function addWaypoints(array $waypoints)
    {
        foreach ($waypoints as $waypoint) {
            $this->addWaypoint($waypoint);
        }
    }

    /**
     * @return bool
     */
    public function hasWaypoint(DirectionWaypoint $waypoint)
    {
        return in_array($waypoint, $this->waypoints, true);
    }
    /**
     * @return void
     */
    public function addWaypoint(DirectionWaypoint $waypoint)
    {
        if (!$this->hasWaypoint($waypoint)) {
            $this->waypoints[] = $waypoint;
        }
    }
    /**
     * @return void
     */
    public function removeWaypoint(DirectionWaypoint $waypoint)
    {
        unset($this->waypoints[array_search($waypoint, $this->waypoints, true)]);
        $this->waypoints = empty($this->waypoints) ? [] : array_values($this->waypoints);
    }

    /**
     * @return bool
     */
    public function hasOptimizeWaypoints()
    {
        return null !== $this->optimizeWaypoints;
    }

    /**
     * @return bool|null
     */
    public function getOptimizeWaypoints()
    {
        return $this->optimizeWaypoints;
    }

    /**
     * @param bool|null $optimizeWaypoints
     * @return void
     */
    public function setOptimizeWaypoints($optimizeWaypoints = null)
    {
        $this->optimizeWaypoints = $optimizeWaypoints;
    }

    /**
     * @return bool
     */
    public function hasTravelMode()
    {
        return null !== $this->travelMode;
    }

    /**
     * @return string|null
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }

    /**
     * @param string|null $travelMode
     * @return void
     */
    public function setTravelMode($travelMode = null)
    {
        $this->travelMode = $travelMode;
    }

    /**
     * @return bool
     */
    public function hasAvoid()
    {
        return null !== $this->avoid;
    }

    /**
     * @return string|null
     */
    public function getAvoid()
    {
        return $this->avoid;
    }

    /**
     * @param string|null $avoid
     * @return void
     */
    public function setAvoid($avoid = null)
    {
        $this->avoid = $avoid;
    }

    /**
     * @return bool
     */
    public function hasProvideRouteAlternatives()
    {
        return null !== $this->provideRouteAlternatives;
    }

    /**
     * @return bool|null
     */
    public function getProvideRouteAlternatives()
    {
        return $this->provideRouteAlternatives;
    }

    /**
     * @param bool|null $provideRouteAlternatives
     * @return void
     */
    public function setProvideRouteAlternatives($provideRouteAlternatives = null)
    {
        $this->provideRouteAlternatives = $provideRouteAlternatives;
    }

    /**
     * @return bool
     */
    public function hasTrafficModel()
    {
        return null !== $this->trafficModel;
    }

    /**
     * @return string|null
     */
    public function getTrafficModel()
    {
        return $this->trafficModel;
    }

    /**
     * @param string|null $trafficModel
     * @return void
     */
    public function setTrafficModel($trafficModel)
    {
        $this->trafficModel = $trafficModel;
    }

    /**
     * @return bool
     */
    public function hasTransitModes()
    {
        return !empty($this->transitModes);
    }

    /**
     * @return string[]
     */
    public function getTransitModes()
    {
        return $this->transitModes;
    }

    /**
     * @param string[] $transitModes
     * @return void
     */
    public function setTransitModes(array $transitModes)
    {
        $this->transitModes = [];
        $this->addTransitModes($transitModes);
    }

    /**
     * @param string[] $transitModes
     * @return void
     */
    public function addTransitModes(array $transitModes)
    {
        foreach ($transitModes as $transitMode) {
            $this->addTransitMode($transitMode);
        }
    }

    /**
     * @param string $transitMode
     *
     * @return bool
     */
    public function hasTransitMode($transitMode)
    {
        return in_array($transitMode, $this->transitModes, true);
    }

    /**
     * @param string $transitMode
     * @return void
     */
    public function addTransitMode($transitMode)
    {
        if (!$this->hasTransitMode($transitMode)) {
            $this->transitModes[] = $transitMode;
        }
    }

    /**
     * @param string $transitMode
     * @return void
     */
    public function removeTransitMode($transitMode)
    {
        unset($this->transitModes[array_search($transitMode, $this->transitModes, true)]);
        $this->transitModes = empty($this->transitModes) ? [] : array_values($this->transitModes);
    }

    /**
     * @return bool
     */
    public function hasTransitRoutingPreference()
    {
        return null !== $this->transitRoutingPreference;
    }

    /**
     * @return string|null
     */
    public function getTransitRoutingPreference()
    {
        return $this->transitRoutingPreference;
    }

    /**
     * @param string|null $transitRoutingPreference
     * @return void
     */
    public function setTransitRoutingPreference($transitRoutingPreference)
    {
        $this->transitRoutingPreference = $transitRoutingPreference;
    }

    /**
     * @return bool
     */
    public function hasRegion()
    {
        return null !== $this->region;
    }

    /**
     * @return string|null
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string|null $region
     * @return void
     */
    public function setRegion($region = null)
    {
        $this->region = $region;
    }

    /**
     * @return bool
     */
    public function hasUnitSystem()
    {
        return null !== $this->unitSystem;
    }

    /**
     * @return string|null
     */
    public function getUnitSystem()
    {
        return $this->unitSystem;
    }

    /**
     * @param string|null $unitSystem
     * @return void
     */
    public function setUnitSystem($unitSystem = null)
    {
        $this->unitSystem = $unitSystem;
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
    public function setLanguage($language = null)
    {
        $this->language = $language;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = [
            'origin'      => $this->origin->buildQuery(),
            'destination' => $this->destination->buildQuery(),
        ];

        if ($this->hasDepartureTime()) {
            $query['departure_time'] = $this->departureTime->getTimestamp();
        }

        if ($this->hasArrivalTime()) {
            $query['arrival_time'] = $this->arrivalTime->getTimestamp();
        }

        if ($this->hasWaypoints()) {
            $waypoints = [];

            if ($this->optimizeWaypoints) {
                $waypoints[] = 'optimize:true';
            }

            foreach ($this->waypoints as $waypoint) {
                $waypoints[] = ($waypoint->getStopover() ? 'via:' : '').$waypoint->getLocation()->buildQuery();
            }

            $query['waypoints'] = implode('|', $waypoints);
        }

        if ($this->hasTravelMode()) {
            $query['mode'] = strtolower($this->travelMode);
        }

        if ($this->hasAvoid()) {
            $query['avoid'] = $this->avoid;
        }

        if ($this->hasProvideRouteAlternatives()) {
            $query['alternatives'] = $this->provideRouteAlternatives ? 'true' : 'false';
        }

        if ($this->hasTrafficModel()) {
            $query['traffic_model'] = $this->trafficModel;
        }

        if ($this->hasTransitModes()) {
            $query['transit_mode'] = implode('|', $this->transitModes);
        }

        if ($this->hasTransitRoutingPreference()) {
            $query['transit_routing_preference'] = $this->transitRoutingPreference;
        }

        if ($this->hasRegion()) {
            $query['region'] = $this->region;
        }

        if ($this->hasUnitSystem()) {
            $query['units'] = strtolower($this->unitSystem);
        }

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }
}
