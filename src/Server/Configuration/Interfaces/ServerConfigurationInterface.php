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
 * Simple configuration for connecting to a server.
 *
 * @package com.xcitestudios.Network
 * @subpackage Server.Configuration.Interfaces
 */
interface ServerConfigurationInterface
{
    /**
     * Set the hostname/IPv4/IPv6 address to connect.
     *
     * @param string $host
     * @return void
     */
    public function setHost($host);

    /**
     * Get the hostname/IPv4/IPv6 address to connect.
     *
     * @return string
     */
    public function getHost();

    /**
     * Set the port to connect to.
     *
     * @param int $port
     * @return void
     */
    public function setPort($port);

    /**
     * Get the port to connect to.
     *
     * @return int
     */
    public function getPort();

    /**
     * Set if SSL should be used for the connection.
     *
     * @param bool $isEnabled
     * @return void
     */
    public function setSSL($isEnabled);

    /**
     * Get if SSL should be used for the connection.
     *
     * @return bool
     */
    public function getSSL();

    /**
     * Set if TLS should be used for the connection.
     *
     * @param bool $isEnabled
     * @return void
     */
    public function setTLS($isEnabled);

    /**
     * Get if SSL should be used for the connection.
     *
     * @return bool
     */
    public function getTLS();
}