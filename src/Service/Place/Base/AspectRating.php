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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AspectRating
{
    /**
     * @var string|null
     */
    private $type;

    /**
     * @var float|null
     */
    private $rating;

    /**
     * @return bool
     */
    public function hasType()
    {
        return null !== $this->type;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function hasRating()
    {
        return null !== $this->rating;
    }

    /**
     * @return float|null
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float|null $rating
     * @return void
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}
