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

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Overlay\EncodedPolyline;
use Ivory\GoogleMap\Service\Base\Fare;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionRoute
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionRoute
{
    #[SerializedName('bounds')]
    private ?Bound $bound = null;

    #[SerializedName('copyright')]
    private ?string $copyrights = null;

    /** @var DirectionLeg[] */
    #[SerializedName('legs')]
    private array $legs = [];

    #[SerializedName('overview_polyline')]
    private ?EncodedPolyline $overviewPolyline = null;

    #[SerializedName('summary')]
    private ?string $summary = null;

    #[SerializedName('fare')]
    private ?Fare $fare = null;

    /** @var string[] */
    #[SerializedName('warnings')]
    private array $warnings = [];

    /** @var int[] */
    #[SerializedName('waypoint_order')]
    private array $waypointOrders = [];

    public function hasBound(): bool
    {
        return null !== $this->bound;
    }

    public function getBound(): ?Bound
    {
        return $this->bound;
    }

    public function setBound(?Bound $bound = null): void
    {
        $this->bound = $bound;
    }

    public function hasCopyrights(): bool
    {
        return null !== $this->copyrights;
    }

    public function getCopyrights(): ?string
    {
        return $this->copyrights;
    }

    public function setCopyrights($copyrights = null): void
    {
        $this->copyrights = $copyrights;
    }

    public function hasLegs(): bool
    {
        return !empty($this->legs);
    }

    /** @return DirectionLeg[] */
    public function getLegs(): array
    {
        return $this->legs;
    }

    /** @param DirectionLeg[] $legs */
    public function setLegs(array $legs): void
    {
        $this->legs = [];
        $this->addLegs($legs);
    }

    /** @param DirectionLeg[] $legs */
    public function addLegs(array $legs): void
    {
        foreach ($legs as $leg) {
            $this->addLeg($leg);
        }
    }

    public function hasLeg(DirectionLeg $leg): bool
    {
        return in_array($leg, $this->legs, true);
    }

    public function addLeg(DirectionLeg $leg): void
    {
        if (!$this->hasLeg($leg)) {
            $this->legs[] = $leg;
        }
    }

    public function removeLeg(DirectionLeg $leg): void
    {
        unset($this->legs[array_search($leg, $this->legs, true)]);
        $this->legs = empty($this->legs) ? [] : array_values($this->legs);
    }

    public function hasOverviewPolyline(): bool
    {
        return null !== $this->overviewPolyline;
    }

    public function getOverviewPolyline(): ?EncodedPolyline
    {
        return $this->overviewPolyline;
    }

    public function setOverviewPolyline(EncodedPolyline $overviewPolyline = null): void
    {
        $this->overviewPolyline = $overviewPolyline;
    }

    public function hasSummary(): bool
    {
        return null !== $this->summary;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary = null): void
    {
        $this->summary = $summary;
    }

    public function hasFare(): bool
    {
        return null !== $this->fare;
    }

    public function getFare(): ?Fare
    {
        return $this->fare;
    }

    public function setFare(Fare $fare = null): void
    {
        $this->fare = $fare;
    }

    public function hasWarnings(): bool
    {
        return !empty($this->warnings);
    }

    public function getWarnings(): array
    {
        return $this->warnings;
    }

    public function setWarnings(array $warnings): void
    {
        $this->warnings = [];
        $this->addWarnings($warnings);
    }

    /** @param string[] $warnings */
    public function addWarnings(array $warnings): void
    {
        foreach ($warnings as $warning) {
            $this->addWarning($warning);
        }
    }

    public function hasWarning(string $warning): bool
    {
        return in_array($warning, $this->warnings, true);
    }

    public function addWarning(string $warning): void
    {
        if (!$this->hasWarning($warning)) {
            $this->warnings[] = $warning;
        }
    }

    public function removeWarning(string $warning): void
    {
        unset($this->warnings[array_search($warning, $this->warnings, true)]);
        $this->warnings = empty($this->warnings) ? [] : array_values($this->warnings);
    }

    public function hasWaypointOrders(): bool
    {
        return !empty($this->waypointOrders);
    }

    /** @return int[] */
    public function getWaypointOrders(): array
    {
        return $this->waypointOrders;
    }

    /** @param int[] $waypointOrders */
    public function setWaypointOrders(array $waypointOrders): void
    {
        $this->waypointOrders = [];
        $this->addWaypointOrders($waypointOrders);
    }

    /** @param int[] $waypointOrders */
    public function addWaypointOrders(array $waypointOrders): void
    {
        $this->waypointOrders = [];

        foreach ($waypointOrders as $waypointOrder) {
            $this->addWaypointOrder($waypointOrder);
        }
    }

    public function hasWaypointOrder($waypointOrder): bool
    {
        return in_array($waypointOrder, $this->waypointOrders, true);
    }

    public function addWaypointOrder(int $waypointOrder): void
    {
        $this->waypointOrders[] = $waypointOrder;
    }
}
