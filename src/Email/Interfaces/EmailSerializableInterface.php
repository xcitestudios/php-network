<?php
namespace com\xcitestudios\Network\Email\Interfaces;

use com\xcitestudios\Generic\Data\Manipulation\Interfaces\SerializationInterface;

/**
 * Interface for an email that is serializable.
 */
interface EmailSerializableInterface
    extends EmailInterface, SerializationInterface
{
}