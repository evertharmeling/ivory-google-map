<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Base;

use Ivory\GoogleMap\Service\Base\AddressComponent;
use Ivory\GoogleMap\Service\Base\Geometry;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Place
{
    #[SerializedName('id')]
    private ?string $id = null;

    #[SerializedName('place_id')]
    private ?string $placeId = null;

    #[SerializedName('name')]
    private ?string $name = null;

    #[SerializedName('formatted_address')]
    private ?string $formattedAddress = null;

    #[SerializedName('formatted_phone_number')]
    private ?string $formattedPhoneNumber = null;

    #[SerializedName('international_phone_number')]
    private ?string $internationalPhoneNumber = null;

    #[SerializedName('url')]
    private ?string $url = null;

    #[SerializedName('icon')]
    private ?string $icon = null;

    #[SerializedName('scope')]
    private ?string $scope = null;

    #[SerializedName('price_level')]
    private ?int $priceLevel = null;

    #[SerializedName('rating')]
    private ?float $rating = null;

    #[SerializedName('utc_offset')]
    private ?int $utcOffset = null;

    #[SerializedName('vicinity')]
    private ?string $vicinity = null;

    #[SerializedName('website')]
    private ?string $website = null;

    #[SerializedName('geometry')]
    private ?Geometry $geometry = null;

    #[SerializedName('opening_hours')]
    private ?OpeningHours $openingHours = null;

    /** @var AddressComponent[] */
    #[SerializedName('address_components')]
    private array $addressComponents = [];

    /** @var Photo[] */
    #[SerializedName('photos')]
    private array $photos = [];

    /**
     * @var AlternatePlaceId[]
     * @deprecated
     */
    #[SerializedName('alternate_place_ids')]
    private array $alternatePlaceIds = [];

    /** @var Review[] */
    #[SerializedName('reviews')]
    private array $reviews = [];

    /** @var string[] */
    #[SerializedName('types')]
    private array $types = [];

    /** @deprecated */
    #[SerializedName('permanently_close')]
    private ?bool $permanentlyClose = null;

    public function hasId(): bool
    {
        return null !== $this->id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

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

    public function hasName(): bool
    {
        return null !== $this->name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function hasFormattedAddress(): bool
    {
        return null !== $this->formattedAddress;
    }

    public function getFormattedAddress(): ?string
    {
        return $this->formattedAddress;
    }

    public function setFormattedAddress(?string $formattedAddress): void
    {
        $this->formattedAddress = $formattedAddress;
    }

    public function hasFormattedPhoneNumber(): bool
    {
        return null !== $this->formattedPhoneNumber;
    }

    public function getFormattedPhoneNumber(): ?string
    {
        return $this->formattedPhoneNumber;
    }

    public function setFormattedPhoneNumber(?string $formattedPhoneNumber): void
    {
        $this->formattedPhoneNumber = $formattedPhoneNumber;
    }

    public function hasInternationalPhoneNumber(): bool
    {
        return null !== $this->internationalPhoneNumber;
    }

    public function getInternationalPhoneNumber(): ?string
    {
        return $this->internationalPhoneNumber;
    }

    public function setInternationalPhoneNumber(?string $internationalPhoneNumber): void
    {
        $this->internationalPhoneNumber = $internationalPhoneNumber;
    }

    public function hasUrl(): bool
    {
        return null !== $this->url;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function hasIcon(): bool
    {
        return null !== $this->icon;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    public function hasScope(): bool
    {
        return null !== $this->scope;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }

    public function setScope(?string $scope): void
    {
        $this->scope = $scope;
    }

    public function hasPriceLevel(): bool
    {
        return null !== $this->priceLevel;
    }

    public function getPriceLevel(): ?int
    {
        return $this->priceLevel;
    }

    public function setPriceLevel(?int $priceLevel): void
    {
        $this->priceLevel = $priceLevel;
    }

    public function hasRating(): bool
    {
        return null !== $this->rating;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): void
    {
        $this->rating = $rating;
    }

    public function hasUtcOffset(): bool
    {
        return null !== $this->utcOffset;
    }

    public function getUtcOffset(): ?int
    {
        return $this->utcOffset;
    }

    public function setUtcOffset(?int $utcOffset): void
    {
        $this->utcOffset = $utcOffset;
    }

    public function hasVicinity(): bool
    {
        return null !== $this->vicinity;
    }

    public function getVicinity(): ?string
    {
        return $this->vicinity;
    }

    public function setVicinity(?string $vicinity): void
    {
        $this->vicinity = $vicinity;
    }

    public function hasWebsite(): bool
    {
        return null !== $this->website;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): void
    {
        $this->website = $website;
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

    public function hasOpeningHours(): bool
    {
        return null !== $this->openingHours;
    }

    public function getOpeningHours(): ?OpeningHours
    {
        return $this->openingHours;
    }

    public function setOpeningHours(OpeningHours $openingHours = null): void
    {
        $this->openingHours = $openingHours;
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

    public function hasPhotos(): bool
    {
        return !empty($this->photos);
    }

    /** @return Photo[] */
    public function getPhotos(): array
    {
        return $this->photos;
    }

    /** @param Photo[] $photos */
    public function setPhotos(array $photos): void
    {
        $this->photos = [];
        $this->addPhotos($photos);
    }

    /** @param Photo[] $photos */
    public function addPhotos(array $photos): void
    {
        foreach ($photos as $photo) {
            $this->addPhoto($photo);
        }
    }

    public function hasPhoto(Photo $photo): bool
    {
        return in_array($photo, $this->photos, true);
    }

    public function addPhoto(Photo $photo): void
    {
        if (!$this->hasPhoto($photo)) {
            $this->photos[] = $photo;
        }
    }

    public function removePhoto(Photo $photo): void
    {
        unset($this->photos[array_search($photo, $this->photos, true)]);
        $this->photos = empty($this->photos) ? [] : array_values($this->photos);
    }

    public function hasAlternatePlaceIds(): bool
    {
        return !empty($this->alternatePlaceIds);
    }

    /**
     * @return AlternatePlaceId[]
     * @deprecated
     */
    public function getAlternatePlaceIds(): array
    {
        return $this->alternatePlaceIds;
    }

    /** @param AlternatePlaceId[] $alternatePlaceIds */
    public function setAlternatePlaceIds(array $alternatePlaceIds): void
    {
        $this->alternatePlaceIds = [];
        $this->addAlternatePlaceIds($alternatePlaceIds);
    }

    /** @param AlternatePlaceId[] $alternatePlaceIds */
    public function addAlternatePlaceIds(array $alternatePlaceIds): void
    {
        foreach ($alternatePlaceIds as $alternatePlaceId) {
            $this->addAlternatePlaceId($alternatePlaceId);
        }
    }

    public function hasAlternatePlaceId(AlternatePlaceId $alternatePlaceId): bool
    {
        return in_array($alternatePlaceId, $this->alternatePlaceIds, true);
    }

    public function addAlternatePlaceId(AlternatePlaceId $alternatePlaceId): void
    {
        if (!$this->hasAlternatePlaceId($alternatePlaceId)) {
            $this->alternatePlaceIds[] = $alternatePlaceId;
        }
    }

    public function removeAlternatePlaceId(AlternatePlaceId $alternatePlaceId): void
    {
        unset($this->alternatePlaceIds[array_search($alternatePlaceId, $this->alternatePlaceIds, true)]);
        $this->alternatePlaceIds = empty($this->alternatePlaceIds) ? [] : array_values($this->alternatePlaceIds);
    }

    public function hasReviews(): bool
    {
        return !empty($this->reviews);
    }

    /** @return Review[] */
    public function getReviews(): array
    {
        return $this->reviews;
    }

    /** @param Review[] $reviews */
    public function setReviews(array $reviews): void
    {
        $this->reviews = [];
        $this->addReviews($reviews);
    }

    /** @param Review[] $reviews */
    public function addReviews(array $reviews): void
    {
        foreach ($reviews as $review) {
            $this->addReview($review);
        }
    }

    public function hasReview(Review $review): bool
    {
        return in_array($review, $this->reviews, true);
    }

    public function addReview(Review $review): void
    {
        if (!$this->hasReview($review)) {
            $this->reviews[] = $review;
        }
    }

    public function removeReview(Review $review): void
    {
        unset($this->reviews[array_search($review, $this->reviews, true)]);
        $this->reviews = empty($this->reviews) ? [] : array_values($this->reviews);
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

    public function hasPermanentlyClose(): bool
    {
        return null !== $this->permanentlyClose;
    }

    /** @deprecated  */
    public function isPermanentlyClose(): ?bool
    {
        return $this->permanentlyClose;
    }

    public function setPermanentlyClose(?bool $permanentlyClose): void
    {
        $this->permanentlyClose = $permanentlyClose;
    }
}
