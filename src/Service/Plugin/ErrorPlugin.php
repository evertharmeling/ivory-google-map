<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Plugin;

use Http\Client\Common\Exception\ClientErrorException;
use Http\Client\Common\Exception\ServerErrorException;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ErrorPlugin implements Plugin
{
    /**
     * @var string[]
     */
    private static $errors = [
        'ERROR'                   => ServerErrorException::class,
        'INVALID_REQUEST'         => ClientErrorException::class,
        'MAX_DIMENSIONS_EXCEEDED' => ClientErrorException::class,
        'MAX_ELEMENTS_EXCEEDED'   => ClientErrorException::class,
        'MAX_WAYPOINTS_EXCEEDED'  => ClientErrorException::class,
        'NOT_FOUND'               => ClientErrorException::class,
        'OVER_QUERY_LIMIT'        => ServerErrorException::class,
        'REQUEST_DENIED'          => ClientErrorException::class,
        'UNKNOWN_ERROR'           => ServerErrorException::class,
    ];

    private static $placeholders = [
        '"status" : "%s"',
        '<status>%s</status>',
    ];

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response) use ($request) {
            return $this->transformResponseToException($request, $response);
        });
    }

    protected function transformResponseToException(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $bodyStream = $response->getBody();
        $body = $bodyStream->__toString();
        if ($bodyStream->isSeekable()) {
            $bodyStream->rewind();
        }

        foreach (self::$errors as $error => $exception) {
            foreach (self::$placeholders as $placeholder) {
                if (str_contains($body, sprintf($placeholder, $error))) {
                    throw new $exception($error, $request, $response);
                }
            }
        }

        return $response;
    }
}
