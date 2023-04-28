<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Direction\Response;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Base\Time;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionLeg
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionLeg
{
    #[SerializedName('distance')]
    private ?Distance $distance = null;

    #[SerializedName('duration')]
    private ?Duration $duration = null;

    #[SerializedName('duration_in_traffic')]
    private ?Duration $durationInTraffic = null;

    #[SerializedName('arrival_time')]
    private ?Time $arrivalTime = null;

    #[SerializedName('departure_time')]
    private ?Time $departureTime = null;

    #[SerializedName('end_address')]
    private ?string $endAddress = null;

    #[SerializedName('end_location')]
    private ?Coordinate $endLocation = null;

    #[SerializedName('start_address')]
    private ?string $startAddress = null;

    #[SerializedName('start_location')]
    private ?Coordinate $startLocation = null;

    /** @var DirectionStep[] */
    #[SerializedName('steps')]
    private array $steps = [];

    /** @var DirectionWaypoint[] */
    #[SerializedName('via_waypoint')]
    private array $viaWaypoints = [];

    public function hasDistance(): bool
    {
        return null !== $this->distance;
    }

    public function getDistance(): ?Distance
    {
        return $this->distance;
    }

    public function setDistance(Distance $distance = null): void
    {
        $this->distance = $distance;
    }

    public function hasDuration(): bool
    {
        return null !== $this->duration;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function setDuration(Duration $duration = null): void
    {
        $this->duration = $duration;
    }

    public function hasDurationInTraffic(): bool
    {
        return null !== $this->durationInTraffic;
    }

    public function getDurationInTraffic(): ?Duration
    {
        return $this->durationInTraffic;
    }

    public function setDurationInTraffic(Duration $durationInTraffic = null): void
    {
        $this->durationInTraffic = $durationInTraffic;
    }

    public function hasArrivalTime(): bool
    {
        return null !== $this->arrivalTime;
    }

    public function getArrivalTime(): ?Time
    {
        return $this->arrivalTime;
    }

    public function setArrivalTime(Time $arrivalTime = null): void
    {
        $this->arrivalTime = $arrivalTime;
    }

    public function hasDepartureTime(): bool
    {
        return null !== $this->departureTime;
    }

    public function getDepartureTime(): ?Time
    {
        return $this->departureTime;
    }

    public function setDepartureTime(Time $departureTime = null): void
    {
        $this->departureTime = $departureTime;
    }

    public function hasEndAddress(): bool
    {
        return null !== $this->endAddress;
    }

    public function getEndAddress(): ?string
    {
        return $this->endAddress;
    }

    public function setEndAddress(string $endAddress = null): void
    {
        $this->endAddress = $endAddress;
    }

    public function hasEndLocation(): bool
    {
        return null !== $this->endLocation;
    }

    public function getEndLocation(): ?Coordinate
    {
        return $this->endLocation;
    }

    public function setEndLocation(?Coordinate $endLocation = null): void
    {
        $this->endLocation = $endLocation;
    }

    public function hasStartAddress(): bool
    {
        return null !== $this->startAddress;
    }

    public function getStartAddress(): ?string
    {
        return $this->startAddress;
    }

    public function setStartAddress(string $startAddress = null): void
    {
        $this->startAddress = $startAddress;
    }

    public function hasStartLocation(): bool
    {
        return null !== $this->startLocation;
    }

    public function getStartLocation(): ?Coordinate
    {
        return $this->startLocation;
    }

    public function setStartLocation(Coordinate $startLocation = null): void
    {
        $this->startLocation = $startLocation;
    }

    public function hasSteps(): bool
    {
        return !empty($this->steps);
    }

    /** @return DirectionStep[] */
    public function getSteps(): array
    {
        return $this->steps;
    }

    /** @param DirectionStep[] $steps */
    public function setSteps(array $steps): void
    {
        $this->steps = [];
        $this->addSteps($steps);
    }

    /** @param DirectionStep[] $steps */
    public function addSteps(array $steps): void
    {
        foreach ($steps as $step) {
            $this->addStep($step);
        }
    }

    public function hasStep(DirectionStep $step): bool
    {
        return in_array($step, $this->steps, true);
    }

    public function addStep(DirectionStep $step): void
    {
        if (!$this->hasStep($step)) {
            $this->steps[] = $step;
        }
    }

    public function removeStep(DirectionStep $step): void
    {
        unset($this->steps[array_search($step, $this->steps, true)]);
        $this->steps = empty($this->steps) ? [] : array_values($this->steps);
    }

    public function hasViaWaypoints(): bool
    {
        return !empty($this->viaWaypoints);
    }

    /** @return DirectionWaypoint[] */
    public function getViaWaypoints(): array
    {
        return $this->viaWaypoints;
    }

    /** @param DirectionWaypoint[] $viaWaypoints */
    public function setViaWaypoints(array $viaWaypoints): void
    {
        $this->viaWaypoints = [];
        $this->addViaWaypoints($viaWaypoints);
    }

    /** @param DirectionWaypoint[] $viaWaypoints */
    public function addViaWaypoints(array $viaWaypoints): void
    {
        foreach ($viaWaypoints as $viaWaypoint) {
            $this->addViaWaypoint($viaWaypoint);
        }
    }

    public function hasViaWaypoint(DirectionWaypoint $viaWaypoint): bool
    {
        return in_array($viaWaypoint, $this->viaWaypoints, true);
    }

    public function addViaWaypoint(DirectionWaypoint $viaWaypoint): void
    {
        if (!$this->hasViaWaypoint($viaWaypoint)) {
            $this->viaWaypoints[] = $viaWaypoint;
        }
    }

    public function removeViaWaypoint(DirectionWaypoint $viaWaypoint): void
    {
        unset($this->viaWaypoints[array_search($viaWaypoint, $this->viaWaypoints, true)]);
        $this->viaWaypoints = empty($this->viaWaypoints) ? [] : array_values($this->viaWaypoints);
    }
}
