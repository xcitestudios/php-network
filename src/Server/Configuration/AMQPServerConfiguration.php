<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Server\Configuration;

/**
 * A class implementing the Interfaces\UsernameAuthenticatedServerConfigurationSerializableInterface interface.
 *
 * @package com.xcitestudios.Network
 * @subpackage Server.Configuration
 */
class AMQPServerConfiguration extends UsernameAuthenticatedServerConfiguration
    implements Interfaces\AMQPServerConfigurationSerializableInterface
{
    /**
     * @var int
     */
    protected $host = 'localhost';

    /**
     * @var string
     */
    protected $username = 'guest';

    /**
     * @var string
     */
    protected $password = 'guest';

    /**
     * @var int
     */
    protected $port = 5672;

    /**
     * @var string
     */
    protected $vhost = '/';

    /**
     * Set VHost to use on server.
     *
     * @param string $vhost Optional. Default /
     *
     * @return static
     */
    public function setVHost($vhost = '/')
    {
        $this->vhost = $vhost;

        return $this;
    }

    /**
     * Get VHost to use on server.
     *
     * @return string
     */
    public function getVHost()
    {
        return $this->vhost;
    }

    /**
     * Updates the element implementing this interface using a JSON representation.
     *
     * This means updating the state of this object with that defined in the JSON
     * as opposed to returning a new instance of this object.
     *
     * @param string $jsonString Representation of the object.
     *
     * @return void
     */
    public function deserializeJSON($jsonString)
    {
        $data = parent::deserializeJSON($jsonString);

        $this->vhost = property_exists($data, 'vhost') ? $data->vhost : '/';
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
        $ret = parent::jsonSerialize();
        $ret->vhost = $this->vhost;

        return $ret;
    }
}