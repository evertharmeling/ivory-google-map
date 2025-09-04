<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Utility;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface OptionsAwareInterface
{
    /**
     * @return bool
     */
    public function hasOptions();

    /**
     * @return mixed[]
     */
    public function getOptions();

    /**
     * @param mixed[] $options
     * @return void
     */
    public function setOptions(array $options);

    /**
     * @param mixed[] $options
     * @return void
     */
    public function addOptions(array $options);

    /**
     * @param string $option
     *
     * @return bool
     */
    public function hasOption($option);

    /**
     * @param string $option
     *
     * @return mixed
     */
    public function getOption($option);

    /**
     * @param string $option
     * @param mixed  $value
     * @return void
     */
    public function setOption($option, $value);

    /**
     * @param string $option
     * @return void
     */
    public function removeOption($option);
}
