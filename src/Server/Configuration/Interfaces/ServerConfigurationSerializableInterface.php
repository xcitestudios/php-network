<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Server\Configuration\Interfaces;

use com\xcitestudios\Generic\Data\Manipulation\Interfaces\SerializationInterface;

/**
 * Simple configuration for connecting to a server with serialization.
 *
 * @package com.xcitestudios.Network
 * @subpackage Server.Configuration.Interfaces
 */
interface ServerConfigurationSerializableInterface
    extends ServerConfigurationInterface, SerializationInterface
{
}