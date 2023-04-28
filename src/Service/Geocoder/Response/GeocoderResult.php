<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Geocoder\Response;

use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Geometry;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderResult
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderResult
{
    #[SerializedName('place_id')]
    private ?string $placeId = null;

    /** @var AddressComponent[] */
    #[SerializedName('address_components')]
    private array $addressComponents = [];

    #[SerializedName('formatted_address')]
    private ?string $formattedAddress = null;

    /** @var string[] */
    #[SerializedName('postcode_localities')]
    private $postcodeLocalities = [];

    #[SerializedName('geometry')]
    private ?Geometry $geometry = null;

    #[SerializedName('partial_match')]
    private ?bool $partialMatch = null;

    /** @var string[] */
    #[SerializedName('types')]
    private array $types = [];

    public function hasPlaceId(): bool
    {
        return null !== $this->placeId;
    }

    public function getPlaceId(): ?string
    {
        return $this->placeId;
    }

    public function setPlaceId(?string $placeId): void
    {
        $this->placeId = $placeId;
    }

    public function hasAddressComponents(string $type = null): bool
    {
        $addresses = $this->getAddressComponents($type);

        return !empty($addresses);
    }

    /** @return AddressComponent[] */
    public function getAddressComponents(string $type = null): array
    {
        if (null === $type) {
            return $this->addressComponents;
        }

        $addressComponents = [];

        foreach ($this->addressComponents as $addressComponent) {
            if (in_array($type, $addressComponent->getTypes(), true)) {
                $addressComponents[] = $addressComponent;
            }
        }

        return $addressComponents;
    }

    /** @param AddressComponent[] $addressComponents */
    public function setAddressComponents(array $addressComponents): void
    {
        $this->addressComponents = [];
        $this->addAddressComponents($addressComponents);
    }

    /** @param AddressComponent[] $addressComponents */
    public function addAddressComponents(array $addressComponents): void
    {
        foreach ($addressComponents as $addressComponent) {
            $this->addAddressComponent($addressComponent);
        }
    }

    public function hasAddressComponent(AddressComponent $addressComponent): bool
    {
        return in_array($addressComponent, $this->addressComponents, true);
    }

    public function addAddressComponent(AddressComponent $addressComponent): void
    {
        if (!$this->hasAddressComponent($addressComponent)) {
            $this->addressComponents[] = $addressComponent;
        }
    }

    public function removeAddressComponent(AddressComponent $addressComponent): void
    {
        unset($this->addressComponents[array_search($addressComponent, $this->addressComponents, true)]);
        $this->addressComponents = empty($this->addressComponents) ? [] : array_values($this->addressComponents);
    }

    public function hasFormattedAddress(): bool
    {
        return !empty($this->formattedAddress);
    }

    public function getFormattedAddress(): ?string
    {
        return $this->formattedAddress;
    }

    public function setFormattedAddress(string $formattedAddress = null): void
    {
        $this->formattedAddress = $formattedAddress;
    }

    public function hasPostcodeLocalities(): bool
    {
        return !empty($this->postcodeLocalities);
    }

    public function getPostcodeLocalities(): array
    {
        return $this->postcodeLocalities;
    }

    /** @param string[] $postcodeLocalities */
    public function setPostcodeLocalities(array $postcodeLocalities): void
    {
        $this->postcodeLocalities = [];
        $this->addPostcodeLocalities($postcodeLocalities);
    }

    /** @param string[] $postcodeLocalities */
    public function addPostcodeLocalities(array $postcodeLocalities): void
    {
        foreach ($postcodeLocalities as $postcodeLocality) {
            $this->addPostcodeLocality($postcodeLocality);
        }
    }

    public function hasPostcodeLocality(string $postcodeLocality): bool
    {
        return in_array($postcodeLocality, $this->postcodeLocalities, true);
    }

    public function addPostcodeLocality(string $postcodeLocality): void
    {
        if (!$this->hasPostcodeLocality($postcodeLocality)) {
            $this->postcodeLocalities[] = $postcodeLocality;
        }
    }

    public function removePostcodeLocality(string $postcodeLocality): void
    {
        unset($this->postcodeLocalities[array_search($postcodeLocality, $this->postcodeLocalities, true)]);
        $this->postcodeLocalities = empty($this->postcodeLocalities) ? [] : array_values($this->postcodeLocalities);
    }

    public function hasGeometry(): bool
    {
        return null !== $this->geometry;
    }

    public function getGeometry(): ?Geometry
    {
        return $this->geometry;
    }

    public function setGeometry(Geometry $geometry = null): void
    {
        $this->geometry = $geometry;
    }

    public function hasPartialMatch(): bool
    {
        return null !== $this->partialMatch;
    }

    public function isPartialMatch(): ?bool
    {
        return $this->partialMatch;
    }

    public function setPartialMatch(bool $partialMatch = null): void
    {
        $this->partialMatch = $partialMatch;
    }

    public function hasTypes(): bool
    {
        return !empty($this->types);
    }

    /** @return string[] */
    public function getTypes(): array
    {
        return $this->types;
    }

    /** @param string[] $types */
    public function setTypes(array $types): void
    {
        $this->types = [];
        $this->addTypes($types);
    }

    /** @param string[] $types */
    public function addTypes(array $types): void
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    public function hasType(string $type): bool
    {
        return in_array($type, $this->types, true);
    }

    public function addType(string $type): void
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    public function removeType(string $type): void
    {
        unset($this->types[array_search($type, $this->types, true)]);
        $this->types = empty($this->types) ? [] : array_values($this->types);
    }
}
