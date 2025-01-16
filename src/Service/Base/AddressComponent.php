<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Base;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AddressComponent
{
    #[SerializedName('long_name')]
    private ?string $longName = null;

    #[SerializedName('short_name')]
    private ?string $shortName = null;

    /** @var string[] */
    #[SerializedName('types')]
    private array $types = [];

    public function hasLongName(): bool
    {
        return null !== $this->longName;
    }

    public function getLongName(): ?string
    {
        return $this->longName;
    }

    public function setLongName(?string $longName = null): void
    {
        $this->longName = $longName;
    }

    public function hasShortName(): bool
    {
        return null !== $this->shortName;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(?string $shortName = null): void
    {
        $this->shortName = $shortName;
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
