<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Server\Configuration\Interfaces;

/**
 * Extend authenticated server configuration to add in VHost for AMQP.
 *
 * @package com.xcitestudios.Network
 * @subpackage Server.Configuration.Interfaces
 */
interface AMQPServerConfigurationInterface
    extends UsernameAuthenticatedServerConfigurationInterface
{
    /**
     * Set VHost to use on server.
     *
     * @param string $vhost Optional. Default /
     * @return void
     */
    public function setVHost($vhost = '/');

    /**
     * Get VHost to use on server.
     *
     * @return string
     */
    public function getVHost();
}