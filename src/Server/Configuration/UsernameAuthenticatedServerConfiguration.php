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
class UsernameAuthenticatedServerConfiguration extends ServerConfiguration
    implements Interfaces\UsernameAuthenticatedServerConfigurationSerializableInterface
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * Set username for authentication.
     *
     * @param string $username
     * @return static
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username for authentication.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password for authentication.
     *
     * @param string $password
     * @return static
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password for authentication.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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

        $this->username = property_exists($data, 'username') ? $data->username : null;
        $this->password = property_exists($data, 'password') ? $data->password : null;
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

        $ret->username = $this->username;
        $ret->password = $this->password;

        return $ret;
    }
}