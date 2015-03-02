<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Email\Interfaces;

/**
 * Interface for a contact used in emails.
 */
interface ContactInterface
{
    /**
     * Sets the name of this contact.
     *
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * Gets the name of this contact.
     *
     * @return string
     */
    public function getName();

    /**
     * Sets the email of this contact.
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email);

    /**
     * Gets the email of this contact.
     *
     * @return string
     */
    public function getEmail();
}