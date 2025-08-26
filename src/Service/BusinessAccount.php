<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BusinessAccount
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $channel;

    /**
     * @param string $clientId
     * @param string $secret
     * @param string $channel
     */
    public function __construct($clientId, $secret, $channel = null)
    {
        $this->setClientId($clientId);
        $this->setSecret($secret);
        $this->setChannel($channel);
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return void
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return void
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return bool
     */
    public function hasChannel()
    {
        return null !== $this->channel;
    }

    /**
     * @return string|null
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string|null $channel
     * @return void
     */
    public function setChannel($channel = null)
    {
        $this->channel = $channel;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function signUrl($url)
    {
        return UrlSigner::sign($url, $this->secret, $this->clientId, $this->channel);
    }
}
