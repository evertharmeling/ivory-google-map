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
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionWaypoint
{
    #[SerializedName('location')]
    private ?Coordinate $location = null;

    #[SerializedName('step_index')]
    private ?int $stepIndex = null;

    #[SerializedName('step_interpolation')]
    private ?float $stepInterpolation = null;

    public function hasLocation(): bool
    {
        return null !== $this->location;
    }

    public function getLocation(): ?Coordinate
    {
        return $this->location;
    }

    public function setLocation(Coordinate $location): void
    {
        $this->location = $location;
    }

    public function hasStepIndex(): bool
    {
        return null !== $this->stepIndex;
    }

    public function getStepIndex(): ?int
    {
        return $this->stepIndex;
    }

    public function setStepIndex(?int $stepIndex): void
    {
        $this->stepIndex = $stepIndex;
    }

    public function hasStepInterpolation(): bool
    {
        return null !== $this->stepInterpolation;
    }

    public function getStepInterpolation(): ?float
    {
        return $this->stepInterpolation;
    }

    public function setStepInterpolation(?float $stepInterpolation): void
    {
        $this->stepInterpolation = $stepInterpolation;
    }
}
