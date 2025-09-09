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

use Facebook\WebDriver\Remote\WebDriverBrowserType;
use Symfony\Component\Panther\PantherTestCase;

use function realpath;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractFunctional extends PantherTestCase
{
    /**
     * @var string
     */
    private static $directory;

    /**
     * @var bool
     */
    private static $hasDirectory;

    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass(): void
    {
        self::$directory = sys_get_temp_dir().'/ivory-google-map';
        self::$hasDirectory = is_dir(self::$directory);

        if (!self::$hasDirectory) {
            mkdir(self::$directory);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function tearDownAfterClass(): void
    {
        if (!self::$hasDirectory) {
            rmdir(self::$directory);
        }

        self::$pantherClient?->quit();
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $chromeDriverPath = realpath(__DIR__ . '/../../../drivers/chromedriver');
        if ($chromeDriverPath === false) {
            throw new \RuntimeException('ChromeDriver binary not found at expected path.');
        }

        $cwd = realpath(__DIR__ . '/../Resources/public');
        if (!is_dir($cwd)) {
            mkdir($cwd, 0777, true);
        }

        $options = ['--headless', '--disable-gpu', '--no-sandbox', '--window-size=1920,1080'];
        $managerOptions = [
            'browser' => $_SERVER['BROWSER_NAME'] ?? WebDriverBrowserType::CHROME,
            'chromeDriverBinary' => $chromeDriverPath,
            'cwd' => $cwd,
        ];

        self::$pantherClient = self::createPantherClient($options, [], $managerOptions);
    }

    /**
     * @param string|string[] $html
     */
    protected function renderHtml($html)
    {
        if (false === ($name = @tempnam(self::$directory, 'ivory-google-map').'.html')) {
            throw new \RuntimeException(sprintf('Unable to generate a unique file name in "%s".', self::$directory));
        }

        if (!is_resource($file = @fopen($name, 'w+'))) {
            throw new \RuntimeException(sprintf('Unable to create the file "%s".', $name));
        }

        chmod($name, 0644);

        if (false === @fwrite($file, '<html><body>'.implode('', (array) $html).'</body></html>')) {
            throw new \RuntimeException(sprintf('Unable to write in the file "%s".', $name));
        }

        if (false === @fflush($file)) {
            throw new \RuntimeException(sprintf('Unable to flush the file "%s".', $name));
        }

        if (false === @fclose($file)) {
            throw new \RuntimeException(sprintf('Unable to close the file "%s".', $name));
        }

        self::$pantherClient->get(basename($name));

        if (false === @unlink($name)) {
            throw new \RuntimeException(sprintf('Unable to remove the file "%s".', $name));
        }
    }

    /**
     * @param string $variable
     */
    protected function assertVariableExists($variable)
    {
        $this->assertTrue($this->executeJavascript($script = 'typeof '.$variable.' !== typeof undefined'), $script);
    }

    protected function assertSameVariable(string $expected, string $variable, ?callable $formatter = null)
    {
        $defaultFormatter = function ($expected, $variable) {
            return $expected.' === '.$variable;
        };

        $formatter = $formatter ?: $defaultFormatter;

        $this->assertTrue($this->executeJavascript($script = call_user_func(
            $formatter,
            $expected,
            $variable,
            $defaultFormatter
        )), $script);
    }

    /**
     * @param string  $script
     * @param mixed[] $args
     *
     * @return mixed
     */
    private function executeJavascript($script, array $args = [])
    {
        return $this->execute(['script' => 'return ('.$script.')', 'args' => $args]);
    }
}
