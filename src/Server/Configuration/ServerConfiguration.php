<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Server\Configuration;

use InvalidArgumentException;
use JsonSerializable;
use stdClass;

/**
 * A class implementing the Interfaces\ServerConfigurationSerializableInterface interface.
 *
 * @package com.xcitestudios.Network
 * @subpackage Server.Configuration
 */
class ServerConfiguration implements Interfaces\ServerConfigurationSerializableInterface,
    JsonSerializable
{
    /**
     * @var int
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var bool
     */
    protected $ssl = false;

    /**
     * @var bool
     */
    protected $tls = false;

    /**
     * Set the hostname/IPv4/IPv6 address to connect.
     *
     * @param string $host
     * @return static
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get the hostname/IPv4/IPv6 address to connect.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set the port to connect to.
     *
     * @param int $port
     * @return static
     * @throws InvalidArgumentException
     */
    public function setPort($port)
    {
        if (!is_int($port) || $port < 0 || $port > 65535) {
            throw new InvalidArgumentException(
                sprintf('%s only accepts a port between 0 and 65535 inclusive', __FUNCTION__)
            );
        }

        $this->port = $port;

        return $this;
    }

    /**
     * Get the port to connect to.
     *
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set if SSL should be used for the connection.
     *
     * @param bool $isEnabled
     * @return static
     * @throws InvalidArgumentException
     */
    public function setSSL($isEnabled)
    {
        if (!is_bool($isEnabled)) {
            throw new InvalidArgumentException(
                sprintf('%s only accepts a boolean', __FUNCTION__)
            );
        }

        $this->ssl = (bool)$isEnabled;

        return $this;
    }

    /**
     * Get if SSL should be used for the connection.
     *
     * @return bool
     */
    public function getSSL()
    {
        return $this->ssl;
    }

    /**
     * Set if TLS should be used for the connection.
     *
     * @param bool $isEnabled
     * @return static
     * @throws InvalidArgumentException
     */
    public function setTLS($isEnabled)
    {
        if (!is_bool($isEnabled)) {
            throw new InvalidArgumentException(
                sprintf('%s only accepts a boolean', __FUNCTION__)
            );
        }

        $this->tls = (bool)$isEnabled;

        return $this;
    }

    /**
     * Get if SSL should be used for the connection.
     *
     * @return bool
     */
    public function getTLS()
    {
        return $this->tls;
    }

    /**
     * Updates the element implementing this interface using a JSON representation.
     *
     * This means updating the state of this object with that defined in the JSON
     * as opposed to returning a new instance of this object.
     *
     * @param string $jsonString Representation of the object.
     *
     * @return stdClass
     */
    public function deserializeJSON($jsonString)
    {
        $data = json_decode($jsonString);

        $this->host = property_exists($data, 'host') ? $data->host : null;
        $this->port = property_exists($data, 'port') ? $data->port : null;
        $this->ssl  = property_exists($data, 'ssl') ? $data->ssl : false;
        $this->tls  = property_exists($data, 'tls') ? $data->tls : false;

        return $data;
    }

    /**
     * Convert this object into JSON so it can be handled by anything that supports JSON.
     *
     * @return string A JSON representation of this object.
     */
    public function serializeJSON()
    {
        return json_encode($this);
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *       which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $ret = new stdClass;

        $ret->host = $this->host;
        $ret->port = $this->port;
        $ret->ssl  = $this->ssl;
        $ret->tls  = $this->tls;

        return $ret;
    }
}