<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Functional;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Helper\ApiHelper;
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
use Ivory\GoogleMap\Utility\OptionsAwareInterface;
use Ivory\GoogleMap\Utility\VariableAwareInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractApiFunctional extends AbstractFunctional
{
    /**
     * @var ApiHelper
     */
    private $apiHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->apiHelper = $this->createApiHelper();
    }

    /**
     * @param object[] $objects
     *
     * @return string
     */
    protected function renderApi(array $objects)
    {
        return $this->apiHelper->render($objects);
    }

    /**
     * @param string[] $libraries
     */
    protected function assertLibraries(array $libraries)
    {
        foreach ($libraries as $library) {
            $this->assertVariableExists('google.maps.'.$library);
        }
    }

    protected function assertBound(VariableAwareInterface $object, Bound $bound, ?string $expected = null)
    {
        $this->assertSameContainerVariable(
            $object,
            'base.bounds',
            $bound,
            $expected,
            function ($expected, $variable) {
                $formatter = function ($expected, $variable, $method) {
                    return $expected.'.contains('.$variable.'.'.$method.'())';
                };

                return implode(' && ', [
                    call_user_func($formatter, $expected, $variable, 'getSouthWest'),
                    call_user_func($formatter, $expected, $variable, 'getNorthEast'),
                ]);
            }
        );

        if (!empty($expected)) {
            return;
        }

        if ($bound->hasSouthWest()) {
            $this->assertCoordinate($object, $bound->getSouthWest(), $bound->getVariable().'.getSouthWest()');
        }

        if ($bound->hasNorthEast()) {
            $this->assertCoordinate($object, $bound->getNorthEast(), $bound->getVariable().'.getNorthEast()');
        }
    }

    protected function assertCoordinate(VariableAwareInterface $object, Coordinate $coordinate, ?string $expected = null)
    {
        $this->assertSameContainerVariable($object, 'base.coordinates', $coordinate, $expected);
        $this->assertSameVariable($coordinate->getVariable().'.lat()', $coordinate->getLatitude());
        $this->assertSameVariable($coordinate->getVariable().'.lng()', $coordinate->getLongitude());
    }

    protected function assertPoint(VariableAwareInterface $object, Point $point, ?string $expected = null)
    {
        $this->assertSameContainerVariable($object, 'base.points', $point, $expected);
        $this->assertSameVariable($point->getVariable().'.x', $point->getX());
        $this->assertSameVariable($point->getVariable().'.y', $point->getY());
    }

    protected function assertSize(VariableAwareInterface $object, Size $size, ?string $expected = null)
    {
        $this->assertSameContainerVariable($object, 'base.sizes', $size, $expected);
        $this->assertSameVariable($size->getVariable().'.width', $size->getWidth());
        $this->assertSameVariable($size->getVariable().'.height', $size->getHeight());
    }

    protected function assertOptions(OptionsAwareInterface $object)
    {
        foreach ($object->getOptions() as $option => $value) {
            if ($object instanceof VariableAwareInterface) {
                $this->assertSameVariable($object->getVariable().'.'.$option, $value);
            }
        }
    }

    protected function assertContainerVariableExists(VariableAwareInterface $root, ?string $propertyPath = null)
    {
        $this->assertVariableExists($this->getContainer($root, $propertyPath));
    }

    protected function assertSameContainerVariable(
        VariableAwareInterface $root,
        string $propertyPath,
        ?VariableAwareInterface $object = null,
        ?string $expected = null,
        ?callable $formatter = null
    ) {
        $this->assertSameObject($this->getContainer($root, $propertyPath, $object), $object ?: $root);

        if (!empty($expected)) {
            $this->assertSameObject($expected, $object ?: $root, $formatter);
        }
    }

    protected function assertObjectExists(VariableAwareInterface $object)
    {
        $this->assertVariableExists($object->getVariable());
    }

    protected function assertSameObject(string $expected, VariableAwareInterface $object, ?callable $formatter = null)
    {
        $this->assertSameVariable($expected, $object->getVariable(), $formatter);
    }

    /**
     * @return ApiHelper
     */
    protected function createApiHelper()
    {
        return ApiHelperBuilder::create($_SERVER['API_KEY'] ?? null)->build();
    }

    private function getContainer(
        VariableAwareInterface $root,
        ?string $propertyPath = null,
        ?VariableAwareInterface $object = null
    ): string {
        $variable = $root->getVariable().'_container';

        if (!empty($propertyPath)) {
            $variable .= '.'.$propertyPath;
        }

        if (null !== $object) {
            $variable .= '.'.$object->getVariable();
        }

        return $variable;
    }
}
