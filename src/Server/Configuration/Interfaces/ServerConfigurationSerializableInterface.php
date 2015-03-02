<?php
namespace com\xcitestudios\Network\Server\Configuration\Interfaces;

use com\xcitestudios\Generic\Data\Manipulation\Interfaces\SerializationInterface;

/**
 * Simple configuration for connecting to a server with serialization.
 */
interface ServerConfigurationSerializableInterface
    extends ServerConfigurationInterface, SerializationInterface
{
}