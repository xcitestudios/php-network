<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Server\Configuration;

use stdClass;

/**
 * A class implementing the Interfaces\GearmanServerConfigurationSerializableInterface interface.
 *
 * @package com.xcitestudios.Network
 * @subpackage Server.Configuration
 */
class GearmanServerConfiguration extends ServerConfiguration
    implements Interfaces\GearmanServerConfigurationSerializableInterface
{
    /**
     * @var int
     */
    protected $host = 'localhost';

    /**
     * @var int
     */
    protected $port = 4730;

    /**
     * @var bool
     */
    protected $ssl = false;

    /**
     * @var bool
     */
    protected $tls = false;

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
        $data = parent::deserializeJSON($jsonString);

        return $data;
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

        return $ret;
    }
}