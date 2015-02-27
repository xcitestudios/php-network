<?php
namespace com\xcitestudios\Network\Email\Interfaces;

use com\xcitestudios\Generic\Data\Manipulation\Interfaces\SerializationInterface;

/**
 * Interface for part of an email body that is serializable.
 */
interface EmailBodyPartSerializableInterface
    extends EmailBodyPartInterface, SerializationInterface
{
}