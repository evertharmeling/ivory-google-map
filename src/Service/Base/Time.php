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

use DateTime;
use DateTimeZone;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Time
{
    #[SerializedName('value')]
    private DateTime $value;

    #[SerializedName('time_zone')]
    private string $timeZone;

    #[SerializedName('text')]
    private string $text;

    public function __construct(DateTime $value, string $timeZone, string $text)
    {
        $this->setValue($value);
        $this->setTimeZone($timeZone);
        $this->setText($text);
    }

    public function getValue(): DateTime
    {
        return $this->value;
    }

    public function setValue(DateTime $value): void
    {
        $this->value = $value;
    }

    public function getTimeZone(): string
    {
        return $this->timeZone;
    }

    public function setTimeZone(string $timeZone): void
    {
        $this->timeZone = $timeZone;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
