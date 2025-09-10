<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Event;

use Ivory\GoogleMap\Utility\VariableAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareTrait;

/**
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MapsEventListener
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Event implements VariableAwareInterface
{
    use VariableAwareTrait;

    /**
     * @var string
     */
    private $instance;

    /**
     * @var string
     */
    private $trigger;

    /**
     * @var string
     */
    private $handle;

    /**
     * @var bool
     */
    private $capture;

    public function __construct(string $instance, string $trigger, string $handle, bool $capture = false)
    {
        $this->setInstance($instance);
        $this->setTrigger($trigger);
        $this->setHandle($handle);
        $this->setCapture($capture);
    }

    /**
     * @return string
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * @param string $instance
     * @return void
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
    }

    /**
     * @return string
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * @param string $trigger
     * @return void
     */
    public function setTrigger($trigger)
    {
        $this->trigger = $trigger;
    }

    /**
     * @return string
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param string $handle
     * @return void
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @return bool
     */
    public function isCapture()
    {
        return $this->capture;
    }

    /**
     * @param bool $capture
     * @return void
     */
    public function setCapture($capture)
    {
        $this->capture = $capture;
    }
}
