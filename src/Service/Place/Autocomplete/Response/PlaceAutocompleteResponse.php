<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Autocomplete\Response;

use Ivory\GoogleMap\Service\Place\Autocomplete\Request\PlaceAutocompleteRequestInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompleteResponse
{
    private ?PlaceAutocompleteRequestInterface $request = null;

    #[SerializedName('status')]
    private ?string $status = null;

    /** @var PlaceAutocompletePrediction[] */
    #[SerializedName('predictions')]
    private array $predictions = [];

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

    public function getRequest(): ?PlaceAutocompleteRequestInterface
    {
        return $this->request;
    }

    public function setRequest(PlaceAutocompleteRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasPredictions(): bool
    {
        return !empty($this->predictions);
    }

    /** @return PlaceAutocompletePrediction[] */
    public function getPredictions(): array
    {
        return $this->predictions;
    }

    /** @param PlaceAutocompletePrediction[] $predictions */
    public function setPredictions(array $predictions): void
    {
        $this->predictions = [];
        $this->addPredictions($predictions);
    }

    /** @param PlaceAutocompletePrediction[] $predictions */
    public function addPredictions(array $predictions): void
    {
        foreach ($predictions as $prediction) {
            $this->addPrediction($prediction);
        }
    }

    public function hasPrediction(PlaceAutocompletePrediction $prediction): bool
    {
        return in_array($prediction, $this->predictions, true);
    }

    public function addPrediction(PlaceAutocompletePrediction $prediction): void
    {
        if (!$this->hasPrediction($prediction)) {
            $this->predictions[] = $prediction;
        }
    }

    public function removePrediction(PlaceAutocompletePrediction $prediction): void
    {
        unset($this->predictions[array_search($prediction, $this->predictions, true)]);
        $this->predictions = empty($this->predictions) ? [] : array_values($this->predictions);
    }
}
