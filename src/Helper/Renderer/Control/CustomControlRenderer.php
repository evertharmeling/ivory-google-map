<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer\Control;

use Ivory\GoogleMap\Control\CustomControl;
use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\AbstractRenderer;
use Ivory\GoogleMap\Map;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CustomControlRenderer extends AbstractRenderer
{
    /**
     * @var ControlPositionRenderer
     */
    private $controlPositionRenderer;

    public function __construct(Formatter $formatter, ControlPositionRenderer $controlPositionRenderer)
    {
        parent::__construct($formatter);

        $this->setControlPositionRenderer($controlPositionRenderer);
    }

    /**
     * @return ControlPositionRenderer
     */
    public function getControlPositionRenderer()
    {
        return $this->controlPositionRenderer;
    }
    /**
     * @return void
     */
    public function setControlPositionRenderer(ControlPositionRenderer $controlPositionRenderer)
    {
        $this->controlPositionRenderer = $controlPositionRenderer;
    }

    /**
     * @return string
     */
    public function render(CustomControl $customControl, Map $map)
    {
        $formatter = $this->getFormatter();

        return $formatter->renderObjectCall(
            $map,
            $formatter->renderProperty(
                'controls['.$this->controlPositionRenderer->render($customControl->getPosition()).']',
                'push'
            ),
            [$formatter->renderCall('('.$formatter->renderClosure($customControl->getControl()).')')]
        );
    }
}
