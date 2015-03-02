<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Email\Interfaces;

use com\xcitestudios\Generic\Data\Manipulation\Interfaces\SerializationInterface;

/**
 * Interface for a contact used in emails and is serializable.
 *
 * @package com.xcitestudios.Network
 * @subpackage Email.Interfaces
 */
interface ContactSerializableInterface
    extends ContactInterface, SerializationInterface
{
}