<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Renderer;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Helper\Renderer\Control\ControlManagerRenderer;
use Ivory\GoogleMap\Helper\Renderer\Utility\RequirementRenderer;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Helper\Builder\JsonBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapRenderer extends AbstractJsonRenderer
{
    /**
     * @var MapTypeIdRenderer
     */
    private $mapTypeIdRenderer;

    /**
     * @var ControlManagerRenderer
     */
    private $controlManagerRenderer;

    /**
     * @var RequirementRenderer
     */
    private $requirementRenderer;

    public function __construct(
        Formatter $formatter,
        JsonBuilder $jsonBuilder,
        MapTypeIdRenderer $mapTypeIdRenderer,
        ControlManagerRenderer $controlManagerRenderer,
        RequirementRenderer $requirementRenderer
    ) {
        parent::__construct($formatter, $jsonBuilder);

        $this->setMapTypeIdRenderer($mapTypeIdRenderer);
        $this->setControlManagerRenderer($controlManagerRenderer);
        $this->setRequirementRenderer($requirementRenderer);
    }

    /**
     * @return MapTypeIdRenderer
     */
    public function getMapTypeIdRenderer()
    {
        return $this->mapTypeIdRenderer;
    }

    public function setMapTypeIdRenderer(MapTypeIdRenderer $mapTypeIdRenderer)
    {
        $this->mapTypeIdRenderer = $mapTypeIdRenderer;
    }

    /**
     * @return ControlManagerRenderer
     */
    public function getControlManagerRenderer()
    {
        return $this->controlManagerRenderer;
    }

    public function setControlManagerRenderer(ControlManagerRenderer $controlManagerRenderer)
    {
        $this->controlManagerRenderer = $controlManagerRenderer;
    }

    /**
     * @return RequirementRenderer
     */
    public function getRequirementRenderer()
    {
        return $this->requirementRenderer;
    }

    /**
     * @param RequirementRenderer $requirementRenderer
     */
    public function setRequirementRenderer($requirementRenderer)
    {
        $this->requirementRenderer = $requirementRenderer;
    }

    /**
     * @return string
     */
    public function render(Map $map)
    {
        $formatter = $this->getFormatter();
        $jsonBuilder = $this->getJsonBuilder();

        $options = $map->getMapOptions();
        unset($options['mapTypeId']);

        if (!$map->isAutoZoom()) {
            if (!isset($options['zoom'])) {
                $options['zoom'] = 3;
            }
        } else {
            unset($options['zoom']);
        }

        $this->controlManagerRenderer->render($map->getControlManager(), $jsonBuilder);

        $jsonBuilder
            ->setValue(
                '[mapTypeId]',
                $this->mapTypeIdRenderer->render($map->getMapOption('mapTypeId') ?: MapTypeId::ROADMAP),
                false
            )
            ->setValues($options);

        return $formatter->renderObjectAssignment($map, $formatter->renderObject('Map', [
            $formatter->renderCall(
                $formatter->renderProperty('document', 'getElementById'),
                [$formatter->renderEscape($map->getHtmlId())]
            ),
            $jsonBuilder->build(),
        ]));
    }

    /**
     * @return string
     */
    public function renderRequirement()
    {
        return $this->requirementRenderer->render($this->getFormatter()->renderClass());
    }
}
