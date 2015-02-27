<?php
namespace com\xcitestudios\Network\Email\Interfaces;

use com\xcitestudios\Generic\Data\Manipulation\Interfaces\SerializationInterface;

/**
 * Interface for an email that is serializable.
 */
interface ContactSerializableInterface
    extends ContactInterface, SerializationInterface
{
}