<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\DistanceMatrix\Response;

use Ivory\GoogleMap\Service\DistanceMatrix\Request\DistanceMatrixRequestInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class DistanceMatrixResponse
{
    private ?DistanceMatrixRequestInterface $request = null;

    #[SerializedName('status')]
    private ?string $status = null;

    /** @var string[] */
    #[SerializedName('origin_addresses')]
    private array $origins = [];

    /** @var string[] */
    #[SerializedName('destination_addresses')]
    private array $destinations = [];

    /** @var DistanceMatrixRow[] */
    #[SerializedName('rows')]
    private array $rows = [];

    public function hasStatus(): bool
    {
        return null !== $this->status;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function hasRequest(): bool
    {
        return null !== $this->request;
    }

    public function getRequest(): ?DistanceMatrixRequestInterface
    {
        return $this->request;
    }

    public function setRequest(DistanceMatrixRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasOrigins(): bool
    {
        return !empty($this->origins);
    }
    /**
     * @return string[]
     */
    public function getOrigins(): array
    {
        return $this->origins;
    }

    /** @param string[] $origins */
    public function setOrigins(array $origins): void
    {
        $this->origins = [];
        $this->addOrigins($origins);
    }

    /** @param string[] $origins */
    public function addOrigins(array $origins): void
    {
        foreach ($origins as $origin) {
            $this->addOrigin($origin);
        }
    }

    public function hasOrigin(string $origin): bool
    {
        return in_array($origin, $this->origins, true);
    }

    public function addOrigin(string $origin): void
    {
        if (!$this->hasOrigin($origin)) {
            $this->origins[] = $origin;
        }
    }

    public function removeOrigin(string $origin): void
    {
        unset($this->origins[array_search($origin, $this->origins, true)]);
        $this->origins = empty($this->origins) ? [] : array_values($this->origins);
    }

    public function hasDestinations(): bool
    {
        return !empty($this->destinations);
    }

    /** @return string[] */
    public function getDestinations(): array
    {
        return $this->destinations;
    }

    /** @param string[] $destinations */
    public function setDestinations(array $destinations): void
    {
        $this->destinations = [];
        $this->addDestinations($destinations);
    }

    /** @param string[] $destinations */
    public function addDestinations(array $destinations): void
    {
        foreach ($destinations as $destination) {
            $this->addDestination($destination);
        }
    }

    public function hasDestination(string $destination): bool
    {
        return in_array($destination, $this->destinations, true);
    }

    public function addDestination(string $destination): void
    {
        if (!$this->hasDestination($destination)) {
            $this->destinations[] = $destination;
        }
    }

    public function removeDestination(string $destination): void
    {
        unset($this->destinations[array_search($destination, $this->destinations, true)]);
        $this->destinations = empty($this->destinations) ? [] : array_values($this->destinations);
    }

    public function hasRows(): bool
    {
        return !empty($this->rows);
    }

    /** @return DistanceMatrixRow[] */
    public function getRows(): array
    {
        return $this->rows;
    }

    /** @param DistanceMatrixRow[] $rows */
    public function setRows(array $rows): void
    {
        $this->rows = [];
        $this->addRows($rows);
    }

    /** @param DistanceMatrixRow[] $rows */
    public function addRows(array $rows): void
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }
    }

    public function hasRow(DistanceMatrixRow $row): bool
    {
        return in_array($row, $this->rows, true);
    }

    public function addRow(DistanceMatrixRow $row): void
    {
        if (!$this->hasRow($row)) {
            $this->rows[] = $row;
        }
    }

    public function removeRow(DistanceMatrixRow $row): void
    {
        unset($this->rows[array_search($row, $this->rows, true)]);
        $this->rows = empty($this->rows) ? [] : array_values($this->rows);
    }
}
