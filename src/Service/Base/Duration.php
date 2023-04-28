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
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Duration
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Duration
{
    #[SerializedName('value')]
    private float $value;

    #[SerializedName('text')]
    private string $text;

    public function __construct(float $value, string $text)
    {
        $this->setValue($value);
        $this->setText($text);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
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
