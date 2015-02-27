<?php
namespace com\xcitestudios\Network\Email\Interfaces;

use com\xcitestudios\Generic\Data\Manipulation\Interfaces\SerializationInterface;

/**
 * Interface for a contact used in emails and is serializable.
 */
interface ContactSerializableInterface
    extends ContactInterface, SerializationInterface
{
}