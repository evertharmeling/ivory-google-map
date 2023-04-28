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
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Service\Base\Distance;
use Ivory\GoogleMap\Service\Base\Duration;
use Ivory\GoogleMap\Service\Direction\Response\Transit\DirectionTransitDetails;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionStep
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionStep
{
    #[SerializedName('distance')]
    private ?Distance $distance = null;

    #[SerializedName('duration')]
    private ?Duration $duration = null;

    #[SerializedName('end_location')]
    private ?Coordinate $endLocation = null;

    #[SerializedName('html_instructions')]
    private ?string $instructions = null;

    #[SerializedName('polyline')]
    private ?EncodedPolyline $encodedPolyline = null;

    #[SerializedName('start_location')]
    private ?Coordinate $startLocation = null;

    #[SerializedName('travel_mode')]
    private ?string $travelMode = null;

    #[SerializedName('transit_details')]
    private ?DirectionTransitDetails $transitDetails = null;

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

    public function hasEndLocation(): bool
    {
        return null !== $this->endLocation;
    }

    public function getEndLocation(): ?Coordinate
    {
        return $this->endLocation;
    }

    public function setEndLocation(Coordinate $endLocation = null): void
    {
        $this->endLocation = $endLocation;
    }

    public function hasInstructions(): bool
    {
        return null !== $this->instructions;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions = null): void
    {
        $this->instructions = $instructions;
    }

    public function hasEncodedPolyline(): bool
    {
        return null !== $this->encodedPolyline;
    }

    public function getEncodedPolyline(): ?EncodedPolyline
    {
        return $this->encodedPolyline;
    }

    public function setEncodedPolyline(EncodedPolyline $encodedPolyline = null): void
    {
        $this->encodedPolyline = $encodedPolyline;
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

    public function hasTravelMode(): bool
    {
        return null !== $this->travelMode;
    }

    public function getTravelMode(): ?string
    {
        return $this->travelMode;
    }

    public function setTravelMode(string $travelMode = null): void
    {
        $this->travelMode = $travelMode;
    }

    public function hasTransitDetails(): bool
    {
        return null !== $this->transitDetails;
    }

    public function getTransitDetails(): ?DirectionTransitDetails
    {
        return $this->transitDetails;
    }

    public function setTransitDetails(DirectionTransitDetails $transitDetails = null): void
    {
        $this->transitDetails = $transitDetails;
    }
}
