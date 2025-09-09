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

use Symfony\Component\Panther\PantherTestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractFunctional extends PantherTestCase
{
    private static string $directory;

    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass(): void
    {
        $dir = __DIR__ . '/../../Resources/public';

        if (!is_dir($dir) && !mkdir($dir, 0777, true) && !is_dir($dir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }

        self::$directory = realpath($dir);
    }

    /**
     * {@inheritdoc}
     */
    public static function tearDownAfterClass(): void
    {
        foreach (glob(self::$directory . '/*') as $file) {
            if (basename($file) !== 'favicon.ico') {
                unlink($file);
            }
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

//        $options = ['--headless', '--disable-gpu', '--no-sandbox', '--window-size=1920,1080'];
//        $managerOptions = [
        $options = [
            'browser' => $_SERVER['BROWSER_NAME'] ?? PantherTestCase::CHROME,
            'chromeDriverBinary' => $chromeDriverPath,
            'webServerDir' => self::$directory,
            'port' => \random_int(9500, 9800),
        ];

        self::$pantherClient = self::createPantherClient($options);
    }

    /**
     * @param string|string[] $html
     */
    protected function renderHtml($html)
    {
        $filePath = self::$directory . DIRECTORY_SEPARATOR . uniqid('ivory-google-map_', true) . '.html';

        $content = '<html><body>' . implode('', (array) $html) . '</body></html>';

        if (@file_put_contents($filePath, $content, LOCK_EX) === false) {
            throw new \RuntimeException(sprintf('Unable to write to the file "%s".', $filePath));
        }

        // load the generated html file with PantherClient
        $filename = basename($filePath);
        self::$pantherClient->get('/' . $filename);

        if (false === @unlink($filePath)) {
            throw new \RuntimeException(sprintf('Unable to remove the file "%s".', $filePath));
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
     * @param mixed[] $args
     *
     * @return mixed
     */
    private function executeJavascript(string $script, array $args = [])
    {
        return self::$pantherClient->executeScript('return ('.$script.')', $args);
    }
}
