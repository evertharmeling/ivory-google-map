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

use Ivory\GoogleMap\Service\Base\Time;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionTransitDetails
{
    #[SerializedName('departure_stop')]
    private ?DirectionTransitStop $departureStop = null;

    #[SerializedName('arrival_stop')]
    private ?DirectionTransitStop $arrivalStop = null;

    #[SerializedName('departure_time')]
    private ?Time $departureTime = null;

    #[SerializedName('arrival_time')]
    private ?Time $arrivalTime = null;

    #[SerializedName('headsign')]
    private ?string $headSign = null;

    #[SerializedName('line')]
    private ?DirectionTransitLine $line = null;

    #[SerializedName('num_stops')]
    private ?int $numStops = null;

    #[SerializedName('headway')]
    private string|int|null $headWay = null;

    public function hasDepartureStop(): bool
    {
        return null !== $this->departureStop;
    }

    public function getDepartureStop(): ?DirectionTransitStop
    {
        return $this->departureStop;
    }

    public function setDepartureStop(DirectionTransitStop $departureStop = null): void
    {
        $this->departureStop = $departureStop;
    }

    public function hasArrivalStop(): bool
    {
        return null !== $this->arrivalStop;
    }

    public function getArrivalStop(): ?DirectionTransitStop
    {
        return $this->arrivalStop;
    }

    public function setArrivalStop(DirectionTransitStop $arrivalStop = null): void
    {
        $this->arrivalStop = $arrivalStop;
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

    public function hasHeadSign(): bool
    {
        return null !== $this->headSign;
    }

    public function getHeadSign(): ?string
    {
        return $this->headSign;
    }

    public function setHeadSign(?string $headSign): void
    {
        $this->headSign = $headSign;
    }

    public function hasHeadWay(): bool
    {
        return null !== $this->headWay;
    }

    public function getHeadWay()
    {
        return $this->headWay;
    }

    public function setHeadWay($headWay): void
    {
        $this->headWay = $headWay;
    }

    public function hasLine(): bool
    {
        return null !== $this->line;
    }

    public function getLine(): ?DirectionTransitLine
    {
        return $this->line;
    }

    public function setLine(DirectionTransitLine $line = null): void
    {
        $this->line = $line;
    }

    public function hasNumStops(): bool
    {
        return null !== $this->numStops;
    }

    public function getNumStops(): ?int
    {
        return $this->numStops;
    }

    public function setNumStops(?int $numStops): void
    {
        $this->numStops = $numStops;
    }
}
