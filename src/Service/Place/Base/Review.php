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

use DateTime;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Review
{
    #[SerializedName('author_name')]
    private ?string $authorName = null;

    #[SerializedName('author_url')]
    private ?string $authorUrl = null;

    #[SerializedName('text')]
    private ?string $text = null;

    #[SerializedName('rating')]
    private ?float $rating = null;

    #[SerializedName('time')]
    private ?DateTime $time = null;

    #[SerializedName('language')]
    private ?string $language = null;

    /**
     * @var AspectRating[]
     * @deprecated
     */
    #[SerializedName('aspects')]
    private array $aspects = [];

    public function hasAuthorName(): bool
    {
        return null !== $this->authorName;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(?string $authorName): void
    {
        $this->authorName = $authorName;
    }

    public function hasAuthorUrl(): bool
    {
        return null !== $this->authorUrl;
    }

    public function getAuthorUrl(): ?string
    {
        return $this->authorUrl;
    }

    public function setAuthorUrl(?string $authorUrl): void
    {
        $this->authorUrl = $authorUrl;
    }

    public function hasText(): bool
    {
        return null !== $this->text;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
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

    public function hasTime(): bool
    {
        return null !== $this->time;
    }

    public function getTime(): ?DateTime
    {
        return $this->time;
    }

    public function setTime(DateTime $time = null): void
    {
        $this->time = $time;
    }

    public function hasLanguage(): bool
    {
        return null !== $this->language;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function hasAspects(): bool
    {
        return !empty($this->aspects);
    }

    /**
     * @return AspectRating[]
     * @deprecated
     */
    public function getAspects(): array
    {
        return $this->aspects;
    }

    /** @param AspectRating[] $aspects */
    public function setAspects(array $aspects): void
    {
        $this->aspects = [];
        $this->addAspects($aspects);
    }

    /** @param AspectRating[] $aspects */
    public function addAspects(array $aspects): void
    {
        foreach ($aspects as $aspect) {
            $this->addAspect($aspect);
        }
    }

    public function hasAspect(AspectRating $aspect): bool
    {
        return in_array($aspect, $this->aspects, true);
    }

    public function addAspect(AspectRating $aspect): void
    {
        if (!$this->hasAspect($aspect)) {
            $this->aspects[] = $aspect;
        }
    }

    public function removeAspect(AspectRating $aspect): void
    {
        unset($this->aspects[array_search($aspect, $this->aspects, true)]);
        $this->aspects = empty($this->aspects) ? [] : array_values($this->aspects);
    }
}
