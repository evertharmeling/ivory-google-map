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

use Facebook\WebDriver\WebDriverWait;
use Ivory\GoogleMap\Control\ControlPosition;
use Ivory\GoogleMap\Control\CustomControl;
use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\PlaceAutocompleteHelperBuilder;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Helper\PlaceAutocompleteHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Place\Autocomplete;

/**
 * @author GeLo <geloen.eric@gmail.com>
 *
 * @group functional
 */
class CompoundFunctionalTest extends AbstractApiFunctional
{
    /**
     * @var PlaceAutocompleteHelper
     */
    private $placeAutocompleteHelper;

    /**
     * @var MapHelper
     */
    private $mapHelper;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->placeAutocompleteHelper = $this->createPlaceAutocompleteHelper();
        $this->mapHelper = $this->createMapHelper();
    }

    public function testRender()
    {
        $autocomplete = new Autocomplete();

        $control = new CustomControl(
            ControlPosition::RIGHT_TOP,
            'return document.getElementById("'.$autocomplete->getHtmlId().'")'
        );

        $map = new Map();
        $map->getControlManager()->addCustomControl($control);

        $this->render($autocomplete, $map);
    }

    private function render(Autocomplete $autocomplete, Map $map): void
    {
        $this->renderHtml(implode('', [
            $this->placeAutocompleteHelper->render($autocomplete),
            $this->mapHelper->render($map),
            $this->renderApi([$autocomplete, $map]),
        ]));

        try {
            $this->waitUntil(function () use ($autocomplete, $map) {
                try {
                    $this->assertObjectExists($autocomplete);
                    $this->assertObjectExists($map);

                    return true;
                } catch (\Exception $e) {
                }
            }, 5000);
        } catch (\Exception $e) {
        }

        // currently 2 warnings and 1 severe is thrown, which should be handled separately
        // 1: 'message' => 'https://maps.googleapis.com/maps/api/js?libraries=places&callback=ivory_google_map_init 1411:286 "Google Maps JavaScript API has been loaded directly without loading=async. This can result in suboptimal performance. For best-practice loading patterns please see https://goo.gle/js-api-loading"'
        // 2: 'message' => 'https://maps.googleapis.com/maps/api/js?libraries=places&callback=ivory_google_map_init 74:226 "As of March 1st, 2025, google.maps.places.Autocomplete is not available to new customers. Please use google.maps.places.PlaceAutocompleteElement instead. At this time, google.maps.places.Autocomplete is not scheduled to be discontinued, but google.maps.places.PlaceAutocompleteElement is recommended over google.maps.places.Autocomplete. While google.maps.places.Autocomplete will continue to receive bug fixes for any major regressions, existing bugs in google.maps.places.Autocomplete will not be addressed. At least 12 months notice will be given before support is discontinued. Please see https://developers.google.com/maps/legacy for additional details and https://developers.google.com/maps/documentation/javascript/places-migration-overview for the migration guide."'
        // 3: 'message' => 'https://maps.googleapis.com/maps/api/js?libraries=places&callback=ivory_google_map_init 1287:142 "Google Maps JavaScript API error: ApiProjectMapError\nhttps://developers.google.com/maps/documentation/javascript/error-messages#api-project-map-error"'
        $this->assertCount(3, self::$pantherClient->getWebDriver()->manage()->getLog('browser'));
    }

    /**
     * @return PlaceAutocompleteHelper
     */
    protected function createPlaceAutocompleteHelper()
    {
        return PlaceAutocompleteHelperBuilder::create($_SERVER['API_KEY'] ?? null)->build();
    }

    /**
     * @return MapHelper
     */
    protected function createMapHelper()
    {
        return MapHelperBuilder::create($_SERVER['API_KEY'] ?? null)->build();
    }

    protected function waitUntil(callable $callback, ?int $timeout = null): void
    {
        $wait = new WebDriverWait(self::$pantherClient->getWebDriver(), $timeout);
        $wait->until(function () use ($callback) {
            return $callback($this);
        });
    }
}
