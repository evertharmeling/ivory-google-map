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

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class OpeningHours
{
    #[SerializedName('open_now')]
    private ?bool $openNow = null;

    /** @var Period[] */
    #[SerializedName('periods')]
    private array $periods = [];

    /** @var string[] */
    #[SerializedName('weekday_text')]
    private array $weekdayTexts = [];

    public function hasOpenNow(): bool
    {
        return null !== $this->openNow;
    }

    public function isOpenNow(): ?bool
    {
        return $this->openNow;
    }

    public function setOpenNow(?bool $openNow): void
    {
        $this->openNow = $openNow;
    }

    public function hasPeriods(): bool
    {
        return !empty($this->periods);
    }

    /** @return Period[] */
    public function getPeriods(): array
    {
        return $this->periods;
    }

    /** @param Period[] $periods */
    public function setPeriods(array $periods): void
    {
        $this->periods = [];
        $this->addPeriods($periods);
    }

    /** @param Period[] $periods */
    public function addPeriods(array $periods): void
    {
        foreach ($periods as $period) {
            $this->addPeriod($period);
        }
    }

    public function hasPeriod(Period $period): bool
    {
        return in_array($period, $this->periods, true);
    }

    public function addPeriod(Period $period): void
    {
        if (!$this->hasPeriod($period)) {
            $this->periods[] = $period;
        }
    }

    public function removePeriod(Period $period): void
    {
        unset($this->periods[array_search($period, $this->periods, true)]);
        $this->periods = empty($this->periods) ? [] : array_values($this->periods);
    }

    public function hasWeekdayTexts(): bool
    {
        return !empty($this->weekdayTexts);
    }

    /** @return string[] */
    public function getWeekdayTexts(): array
    {
        return $this->weekdayTexts;
    }

    /** @param string[] $weekdayTexts */
    public function setWeekdayTexts(array $weekdayTexts): void
    {
        $this->weekdayTexts = [];
        $this->addWeekdayTexts($weekdayTexts);
    }

    /** @param string[] $weekdayTexts */
    public function addWeekdayTexts(array $weekdayTexts): void
    {
        foreach ($weekdayTexts as $weekdayText) {
            $this->addWeekdayText($weekdayText);
        }
    }

    public function hasWeekdayText(string $weekdayText): bool
    {
        return in_array($weekdayText, $this->weekdayTexts, true);
    }

    public function addWeekdayText(string $weekdayText): void
    {
        if (!$this->hasWeekdayText($weekdayText)) {
            $this->weekdayTexts[] = $weekdayText;
        }
    }

    public function removeWeekdayText(string $weekdayText): void
    {
        unset($this->weekdayTexts[array_search($weekdayText, $this->weekdayTexts, true)]);
        $this->weekdayTexts = empty($this->weekdayTexts) ? [] : array_values($this->weekdayTexts);
    }
}
