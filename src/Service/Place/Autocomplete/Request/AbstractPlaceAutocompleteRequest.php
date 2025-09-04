<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Autocomplete\Request;

use Ivory\GoogleMap\Base\Coordinate;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractPlaceAutocompleteRequest implements PlaceAutocompleteRequestInterface
{
    /**
     * @var string
     */
    private $input;

    /**
     * @var int|null
     */
    private $offset;

    /**
     * @var Coordinate|null
     */
    private $location;

    /**
     * @var float|null
     */
    private $radius;

    /**
     * @var string|null
     */
    private $language;

    /**
     * @param string $input
     */
    public function __construct($input)
    {
        $this->setInput($input);
    }

    /**
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @param string $input
     * @return void
     */
    public function setInput($input)
    {
        $this->input = $input;
    }

    /**
     * @return bool
     */
    public function hasOffset()
    {
        return null !== $this->offset;
    }

    /**
     * @return int|null
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int|null $offset
     * @return void
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return bool
     */
    public function hasLocation()
    {
        return null !== $this->location;
    }

    /**
     * @return Coordinate|null
     */
    public function getLocation()
    {
        return $this->location;
    }
    /**
     * @return void
     */
    public function setLocation(Coordinate $location = null)
    {
        $this->location = $location;
    }

    /**
     * @return bool
     */
    public function hasRadius()
    {
        return null !== $this->radius;
    }

    /**
     * @return float|null
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @param float|null $radius
     * @return void
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    /**
     * @return bool
     */
    public function hasLanguage()
    {
        return null !== $this->language;
    }

    /**
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     * @return void
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * {@inheritdoc}
     */
    public function buildQuery()
    {
        $query = ['input' => $this->input];

        if ($this->hasOffset()) {
            $query['offset'] = $this->offset;
        }

        if ($this->hasLocation()) {
            $query['location'] = $this->buildCoordinate($this->location);
        }

        if ($this->hasRadius()) {
            $query['radius'] = $this->radius;
        }

        if ($this->hasLanguage()) {
            $query['language'] = $this->language;
        }

        return $query;
    }

    /**
     * @return string
     */
    private function buildCoordinate(Coordinate $coordinate)
    {
        return $coordinate->getLatitude().','.$coordinate->getLongitude();
    }
}
