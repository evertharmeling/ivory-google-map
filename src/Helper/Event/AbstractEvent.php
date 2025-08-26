<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractEvent extends Event
{
    /**
     * @var string
     */
    private $code = '';

    /**
     * @return bool
     */
    public function hasCode()
    {
        return !empty($this->code);
    }

    /**
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param string $code
     * @return void
     */
    public function addCode($code)
    {
        $this->code .= $code;
    }
}
