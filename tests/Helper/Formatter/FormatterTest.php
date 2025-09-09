<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Helper\Formatter;

use Ivory\GoogleMap\Helper\Formatter\Formatter;
use Ivory\GoogleMap\Utility\VariableAwareInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class FormatterTest extends TestCase
{
    private Formatter $formatter;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->formatter = new Formatter();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->formatter->isDebug());
        $this->assertSame(4, $this->formatter->getIndentationStep());
    }

    public function testInitialState()
    {
        $this->formatter = new Formatter(true, $indentationStep = 2);

        $this->assertTrue($this->formatter->isDebug());
        $this->assertSame($indentationStep, $this->formatter->getIndentationStep());
    }

    #[DataProvider('classProvider')]
    public function testRenderClass(string $expected, ?string $name = null, ?string $namespace = null)
    {
        $this->assertSame($expected, $this->formatter->renderClass($name, $namespace));
    }

    #[DataProvider('constantProvider')]
    public function testRenderConstant(string $expected, string $class, string $value, ?string $namespace = null)
    {
        $this->assertSame($expected, $this->formatter->renderConstant($class, $value, $namespace));
    }

    /**
     * @param string[] $arguments
     */
    #[DataProvider('objectProvider')]
    public function testRenderObject(
        string $expected,
        string $class,
        array $arguments = [],
        ?string $namespace = null,
        bool $semicolon = false,
        bool $newLine = false,
        bool $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderObject(
            $class,
            $arguments,
            $namespace,
            $semicolon,
            $newLine
        ));
    }

    #[DataProvider('propertyProvider')]
    public function testRenderProperty(string $expected, string $object, ?string $property = null)
    {
        $this->assertSame($expected, $this->formatter->renderProperty($object, $property));
    }

//    /**
//     * @param string[] $arguments
//     */
//    #[DataProvider('objectCallProvider')]
//    public function testRenderObjectCall(
//        string $expected,
//        VariableAwareInterface $object,
//        string $method,
//        array $arguments = [],
//        bool $semicolon = false,
//        bool $newLine = false,
//        bool $debug = false
//    ) {
//        $this->markTestSkipped('dataProvider needs to be refactored as per phpunit 12 it needs to be static.');
//
//        $this->formatter->setDebug($debug);
//
//        $this->assertSame($expected, $this->formatter->renderObjectCall(
//            $object,
//            $method,
//            $arguments,
//            $semicolon,
//            $newLine
//        ));
//    }

    /**
     * @param string[] $arguments
     */
    #[DataProvider('callProvider')]
    public function testRenderCall(
        string $expected,
        string $method,
        array $arguments = [],
        bool $semicolon = false,
        bool $newLine = false,
        bool $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderCall(
            $method,
            $arguments,
            $semicolon,
            $newLine
        ));
    }

    /**
     * @param string[] $arguments
     */
    #[DataProvider('closureProvider')]
    public function testRenderClosure(
        string $expected,
        ?string $code = null,
        array $arguments = [],
        ?string $name = null,
        bool $semicolon = false,
        bool $newLine = false,
        bool $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderClosure(
            $code,
            $arguments,
            $name,
            $semicolon,
            $newLine
        ));
    }

//    #[DataProvider('objectAssignmentProvider')]
//    public function testRenderObjectAssignment(
//        string $expected,
//        VariableAwareInterface $object,
//        string $declaration,
//        bool $semicolon = false,
//        bool $newLine = false,
//        bool $debug = false
//    ) {
//        $this->markTestSkipped('dataProvider needs to be refactored as per phpunit 12 it needs to be static.');
//
//        $this->formatter->setDebug($debug);
//
//        $this->assertSame($expected, $this->formatter->renderObjectAssignment(
//            $object,
//            $declaration,
//            $semicolon,
//            $newLine
//        ));
//    }

//    #[DataProvider('containerAssignmentProvider')]
//    public function testRenderContainerAssignment(
//        string $expected,
//        VariableAwareInterface $root,
//        string $declaration,
//        ?string $propertyPath = null,
//        ?VariableAwareInterface $object = null,
//        bool $semicolon = true,
//        bool $newLine = true,
//        bool $debug = false
//    ) {
//        $this->markTestSkipped('dataProvider needs to be refactored as per phpunit 12 it needs to be static.');
//
//        $this->formatter->setDebug($debug);
//
//        $this->assertSame($expected, $this->formatter->renderContainerAssignment(
//            $root,
//            $declaration,
//            $propertyPath,
//            $object,
//            $semicolon,
//            $newLine
//        ));
//    }

//    #[DataProvider('containerVariableProvider')]
//    public function testRenderContainerVariable(
//        string $expected,
//        VariableAwareInterface $root,
//        ?string $propertyPath = null,
//        ?VariableAwareInterface $object = null,
//        bool $debug = false
//    ) {
//        $this->markTestSkipped('dataProvider needs to be refactored as per phpunit 12 it needs to be static.');
//
//        $this->formatter->setDebug($debug);
//
//        $this->assertSame($expected, $this->formatter->renderContainerVariable($root, $propertyPath, $object));
//    }

    #[DataProvider('assignmentProvider')]
    public function testRenderAssignment(
        string $expected,
        string $variable,
        string $declaration,
        bool $semicolon = false,
        bool $newLine = false,
        bool $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderAssignment(
            $variable,
            $declaration,
            $semicolon,
            $newLine
        ));
    }

    #[DataProvider('statementProvider')]
    public function testRenderStatement(
        string $expected,
        string $statement,
        string $code,
        ?string $condition = null,
        ?string $next = null,
        bool $newLine = true,
        bool $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderStatement(
            $statement,
            $code,
            $condition,
            $next,
            $newLine
        ));
    }

    #[DataProvider('codeProvider')]
    public function testRenderCode(
        string $expected,
        string $code,
        bool $semicolon = true,
        bool $newLine = true,
        bool $debug = false
    ) {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderCode($code, $semicolon, $newLine));
    }

    #[DataProvider('indentationProvider')]
    public function testRenderIndentation(string $expected, ?string $code = null, bool $debug = false)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderIndentation($code));
    }

    /**
     * @param string[] $codes
     */
    #[DataProvider('linesProvider')]
    public function testRenderLines(string $expected, array $codes = [], bool $newLine = true, bool $eolLine = true, bool $debug = false)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderLines($codes, $newLine, $eolLine));
    }

    #[DataProvider('lineProvider')]
    public function testRenderLine(string $expected, ?string $code = null, bool $newLine = true, bool $debug = false)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderLine($code, $newLine));
    }

    #[DataProvider('escapeProvider')]
    public function testRenderEscape(string $expected, string $argument)
    {
        $this->assertSame($expected, $this->formatter->renderEscape($argument));
    }

    #[DataProvider('separatorProvider')]
    public function testRenderSeparator(string $expected, bool $debug = false)
    {
        $this->formatter->setDebug($debug);

        $this->assertSame($expected, $this->formatter->renderSeparator());
    }

    /**
     * @return mixed[][]
     */
    public static function classProvider(): iterable
    {
        return [
            ['google.maps'],
            ['google.maps.name', 'name'],
            ['namespace', null, 'namespace'],
            ['namespace.name', 'name', 'namespace'],
        ];
    }

    /**
     * @return string[][]
     */
    public static function constantProvider(): iterable
    {
        return [
            ['google.maps.class.VALUE', 'class', 'value'],
            ['namespace.class.VALUE', 'class', 'value', 'namespace'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function objectProvider(): iterable
    {
        return [
            // Debug disabled
            ['new google.maps.class()', 'class'],
            ['new google.maps.class(arg1,arg2)', 'class', ['arg1', 'arg2']],
            ['new namespace.class()', 'class', [], 'namespace'],
            ['new google.maps.class();', 'class', [], null, true],
            ['new google.maps.class()', 'class', [], null, false, true],
            ['new namespace.class(arg1,arg2);', 'class', ['arg1', 'arg2'], 'namespace', true, true],

            // Debug enabled
            ['new google.maps.class()', 'class', [], null, false, false, true],
            ['new google.maps.class(arg1, arg2)', 'class', ['arg1', 'arg2'], null, false, false, true],
            ['new namespace.class()', 'class', [], 'namespace', false, false, true],
            ['new google.maps.class();', 'class', [], null, true, false, true],
            ['new google.maps.class()'."\n", 'class', [], null, false, true, true],
            ['new namespace.class(arg1, arg2);'."\n", 'class', ['arg1', 'arg2'], 'namespace', true, true, true],
        ];
    }

    /**
     * @return string[][]
     */
    public static function propertyProvider(): iterable
    {
        return [
            ['object', 'object'],
            ['object.property', 'object', 'property'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function objectCallProvider(): iterable
    {
        return [];

//        return [
//            // Debug disabled
//            ['variable.method()', $this->createVariableAwareMock(), 'method'],
//            ['variable.method(arg1,arg2)', $this->createVariableAwareMock(), 'method', ['arg1', 'arg2']],
//            ['variable.method();', $this->createVariableAwareMock(), 'method', [], true],
//            ['variable.method()', $this->createVariableAwareMock(), 'method', [], false, true],
//            ['variable.method(arg1,arg2);', $this->createVariableAwareMock(), 'method', ['arg1', 'arg2'], true, true],
//
//            // Debug enabled
//            ['variable.method()', $this->createVariableAwareMock(), 'method', [], false, false, true],
//            ['variable.method(arg1, arg2)', $this->createVariableAwareMock(), 'method', ['arg1', 'arg2'], false, false, true],
//            ['variable.method();', $this->createVariableAwareMock(), 'method', [], true, false, true],
//            ['variable.method()'."\n", $this->createVariableAwareMock(), 'method', [], false, true, true],
//            ['variable.method(arg1, arg2);'."\n", $this->createVariableAwareMock(), 'method', ['arg1', 'arg2'], true, true, true],
//        ];
    }

    /**
     * @return mixed[][]
     */
    public static function callProvider(): iterable
    {
        return [
            // Debug disabled
            ['method()', 'method'],
            ['method(arg1,arg2)', 'method', ['arg1', 'arg2']],
            ['method();', 'method', [], true],
            ['method()', 'method', [], false, true],
            ['method(arg1,arg2);', 'method', ['arg1', 'arg2'], true, true],

            // Debug enabled
            ['method()', 'method', [], false, false, true],
            ['method(arg1, arg2)', 'method', ['arg1', 'arg2'], false, false, true],
            ['method();', 'method', [], true, false, true],
            ['method()'."\n", 'method', [], false, true, true],
            ['method(arg1, arg2);'."\n", 'method', ['arg1', 'arg2'], true, true, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function closureProvider(): iterable
    {
        return [
            // Debug disabled
            ['function(){}'],
            ['function(){code}', 'code'],
            ['function(arg1,arg2){}', null, ['arg1', 'arg2']],
            ['function name(){}', null, [], 'name'],
            ['function(){};', null, [], null, true],
            ['function(){}', null, [], null, false, true],
            ['function name(arg1,arg2){code};', 'code', ['arg1', 'arg2'], 'name', true, true],

            // Debug enabled
            ['function () {}', null, [], null, false, false, true],
            ['function () {'."\n".'    code'."\n".'}', 'code', [], null, false, false, true],
            ['function (arg1, arg2) {}', null, ['arg1', 'arg2'], null, false, false, true],
            ['function name () {}', null, [], 'name', false, false, true],
            ['function () {};', null, [], null, true, false, true],
            ['function () {}'."\n", null, [], null, false, true, true],
            ['function name (arg1, arg2) {'."\n".'    code'."\n".'};'."\n", 'code', ['arg1', 'arg2'], 'name', true, true, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function objectAssignmentProvider(): iterable
    {
        return [];
//        return [
//            // Debug disabled
//            ['variable=declaration', $this->createVariableAwareMock(), 'declaration'],
//            ['variable=declaration;', $this->createVariableAwareMock(), 'declaration', true],
//            ['variable=declaration', $this->createVariableAwareMock(), 'declaration', false, true],
//            ['variable=declaration;', $this->createVariableAwareMock(), 'declaration', true, true],
//
//            // Debug enabled
//            ['variable = declaration', $this->createVariableAwareMock(), 'declaration', false, false, true],
//            ['variable = declaration;', $this->createVariableAwareMock(), 'declaration', true, false, true],
//            ['variable = declaration'."\n", $this->createVariableAwareMock(), 'declaration', false, true, true],
//            ['variable = declaration;'."\n", $this->createVariableAwareMock(), 'declaration', true, true, true],
//        ];
    }

    /**
     * @return mixed[][]
     */
    public static function containerAssignmentProvider(): iterable
    {
        return [];
//        return [
//            // Debug disabled
//            ['root_container=declaration;', $this->createVariableAwareMock('root'), 'declaration'],
//            ['root_container.path=declaration;', $this->createVariableAwareMock('root'), 'declaration', 'path'],
//            ['root_container.variable=declaration;', $this->createVariableAwareMock('root'), 'declaration', null, $this->createVariableAwareMock()],
//            ['root_container=declaration', $this->createVariableAwareMock('root'), 'declaration', null, null, false],
//            ['root_container=declaration;', $this->createVariableAwareMock('root'), 'declaration', null, null, true, false],
//            ['root_container.path.variable=declaration', $this->createVariableAwareMock('root'), 'declaration', 'path', $this->createVariableAwareMock(), false, false],
//
//            // Debug enabled
//            ['root_container = declaration;'."\n", $this->createVariableAwareMock('root'), 'declaration', null, null, true, true, true],
//            ['root_container.path = declaration;'."\n", $this->createVariableAwareMock('root'), 'declaration', 'path', null, true, true, true],
//            ['root_container.variable = declaration;'."\n", $this->createVariableAwareMock('root'), 'declaration', null, $this->createVariableAwareMock(), true, true, true],
//            ['root_container = declaration'."\n", $this->createVariableAwareMock('root'), 'declaration', null, null, false, true, true],
//            ['root_container = declaration;', $this->createVariableAwareMock('root'), 'declaration', null, null, true, false, true],
//            ['root_container.path.variable = declaration', $this->createVariableAwareMock('root'), 'declaration', 'path', $this->createVariableAwareMock(), false, false, true],
//        ];
    }

    /**
     * @return mixed[]
     */
    public static function containerVariableProvider(): iterable
    {
        return [];
//        return [
//            ['root_container', $this->createVariableAwareMock('root')],
//            ['root_container.path', $this->createVariableAwareMock('root'), 'path'],
//            ['root_container.variable', $this->createVariableAwareMock('root'), null, $this->createVariableAwareMock()],
//            ['root_container.path.variable', $this->createVariableAwareMock('root'), 'path', $this->createVariableAwareMock()],
//        ];
    }

    /**
     * @return mixed[]
     */
    public static function assignmentProvider(): iterable
    {
        return [
            // Debug disabled
            ['variable=declaration', 'variable', 'declaration'],
            ['variable=declaration;', 'variable', 'declaration', true],
            ['variable=declaration', 'variable', 'declaration', false, true],
            ['variable=declaration;', 'variable', 'declaration', true, true],

            // Debug enabled
            ['variable = declaration', 'variable', 'declaration', false, false, true],
            ['variable = declaration;', 'variable', 'declaration', true, false, true],
            ['variable = declaration'."\n", 'variable', 'declaration', false, true, true],
            ['variable = declaration;'."\n", 'variable', 'declaration', true, true, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function statementProvider(): iterable
    {
        return [
            // Debug disabled
            ['else{code}', 'else', 'code'],
            ['if(condition){code}', 'if', 'code', 'condition'],
            ['if(condition){code}else{}', 'if', 'code', 'condition', 'else{}', false],

            // Debug enabled
            ['else {'."\n".'    code'."\n".'}'."\n", 'else', 'code', null, null, true, true],
            ['if (condition) {'."\n".'    code'."\n".'}'."\n", 'if', 'code', 'condition', null, true, true],
            ['if (condition) {'."\n".'    code'."\n".'} else {}', 'if', 'code', 'condition', 'else {}', false, true],
        ];
    }

    /**
     * @return mixed[]
     */
    public static function codeProvider(): iterable
    {
        return [
            // Debug disabled
            ['code;', 'code'],
            ['code', 'code', false],
            ['code;', 'code', true, false],

            // Debug enabled
            ['code;'."\n", 'code', true, true, true],
            ['code'."\n", 'code', false, true, true],
            ['code;', 'code', true, false, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function indentationProvider(): iterable
    {
        return [
            // Debug disabled
            [''],
            ['code', 'code'],

            // Debug enabled
            ['', null, true],
            ['    code', 'code', true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function linesProvider(): iterable
    {
        return [
            // Debug disabled
            [''],
            ['line1;line2;', ['line1;', 'line2;']],
            ['line1;line2;', ['line1;', 'line2;'], false],
            ['line1;line2;', ['line1;', 'line2;'], true, false],
            ['line1;line2;', ['line1;', 'line2;'], false, false],

            // Debug enabled
            ['', [], true, true, true],
            ['line1;'."\n".'line2;'."\n", ['line1;', 'line2;'], true, true, true],
            ['line1;line2;'."\n", ['line1;', 'line2;'], false, true, true],
            ['line1;'."\n".'line2;', ['line1;', 'line2;'], true, false, true],
            ['line1;line2;', ['line1;', 'line2;'], false, false, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function lineProvider(): iterable
    {
        return [
            // Debug disabled
            [''],
            ['line', 'line'],
            ['line', 'line', false],

            // Debug enabled
            ['', null, true, true],
            ['line'."\n", 'line', true, true],
            ['line', 'line', false, true],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function escapeProvider(): iterable
    {
        return [
            ['"foo"', 'foo'],
            ['"/"', '/'],
            ['"\'"', '\''],
            ['"\\""', '"'],
            ['"Dakar, Sénégal"', 'Dakar, Sénégal'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public static function separatorProvider(): iterable
    {
        return [
            [''],
            [' ', true],
        ];
    }

    /**
     * @param string $variable
     *
     * @return MockObject|VariableAwareInterface
     */
    private function createVariableAwareMock($variable = 'variable')
    {
        $variableAware = $this->createMock(VariableAwareInterface::class);
        $variableAware
            ->expects($this->once())
            ->method('getVariable')
            ->willReturn($variable);

        return $variableAware;
    }
}
