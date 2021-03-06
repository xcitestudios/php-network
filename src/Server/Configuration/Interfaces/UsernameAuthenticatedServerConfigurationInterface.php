<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Server\Configuration\Interfaces;

/**
 * Extend server configuration to add in authentication.
 *
 * @package com.xcitestudios.Network
 * @subpackage Server.Configuration.Interfaces
 */
interface UsernameAuthenticatedServerConfigurationInterface
    extends ServerConfigurationInterface
{
    /**
     * Set username for authentication.
     *
     * @param string $username
     * @return void
     */
    public function setUsername($username);

    /**
     * Get username for authentication.
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set password for authentication.
     *
     * @param string $password
     * @return void
     */
    public function setPassword($password);

    /**
     * Get password for authentication.
     *
     * @return string
     */
    public function getPassword();
}