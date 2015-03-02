<?php
namespace com\xcitestudios\Network\Server\Configuration\Interfaces;

use com\xcitestudios\Generic\Data\Manipulation\Interfaces\SerializationInterface;

/**
 * Extend server configuration to add in authentication.
 */
interface UsernameAuthenticatedServerConfigurationSerializableInterface
    extends UsernameAuthenticatedServerConfigurationInterface, SerializationInterface
{
}