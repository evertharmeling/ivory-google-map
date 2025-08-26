<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Base;

use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Point
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Point implements VariableAwareInterface
{
    use VariableAwareTrait;

    private float $x;
    private float $y;

    public function __construct(float $x = 0.0, float $y = 0.0)
    {
        $this->setX($x);
        $this->setY($y);
    }

    /**
     * @return float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param float $x
     * @return void
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param float $y
     * @return void
     */
    public function setY($y)
    {
        $this->y = $y;
    }
}
