<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Detail\Response;

use Ivory\GoogleMap\Service\Place\Base\Place;
use Ivory\GoogleMap\Service\Place\Detail\Request\PlaceDetailRequestInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceDetailResponse
{
    private ?PlaceDetailRequestInterface $request = null;

    #[SerializedName('status')]
    private ?string $status = null;

    #[SerializedName('result')]
    private ?Place $result = null;

    /** @var string[] */
    #[SerializedName('html_attributions')]
    private array $htmlAttributions = [];

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

    public function getRequest(): ?PlaceDetailRequestInterface
    {
        return $this->request;
    }

    public function setRequest(PlaceDetailRequestInterface $request = null): void
    {
        $this->request = $request;
    }

    public function hasResult(): bool
    {
        return null !== $this->result;
    }

    public function getResult(): ?Place
    {
        return $this->result;
    }

    public function setResult(Place $result = null): void
    {
        $this->result = $result;
    }

    public function hasHtmlAttributions(): bool
    {
        return !empty($this->htmlAttributions);
    }

    /** @return string[] */
    public function getHtmlAttributions(): array
    {
        return $this->htmlAttributions;
    }

    /** @param string[] $htmlAttributions */
    public function setHtmlAttributions(array $htmlAttributions): void
    {
        $this->htmlAttributions = [];
        $this->addHtmlAttributions($htmlAttributions);
    }

    /** @param string[] $htmlAttributions */
    public function addHtmlAttributions(array $htmlAttributions): void
    {
        foreach ($htmlAttributions as $htmlAttribution) {
            $this->addHtmlAttribution($htmlAttribution);
        }
    }

    public function hasHtmlAttribution(string $htmlAttribution): bool
    {
        return in_array($htmlAttribution, $this->htmlAttributions, true);
    }

    public function addHtmlAttribution(string $htmlAttribution): void
    {
        if (!$this->hasHtmlAttribution($htmlAttribution)) {
            $this->htmlAttributions[] = $htmlAttribution;
        }
    }

    public function removeHtmlAttribution(string $htmlAttribution): void
    {
        unset($this->htmlAttributions[array_search($htmlAttribution, $this->htmlAttributions, true)]);
        $this->htmlAttributions = empty($this->htmlAttributions) ? [] : array_values($this->htmlAttributions);
    }
}
