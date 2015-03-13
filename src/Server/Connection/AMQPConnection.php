<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Server\Connection;

use com\xcitestudios\Network\Server\Configuration\AMQPServerConfiguration;
use RuntimeException;

/**
 * A class to aid in the connection to AMQP servers.
 *
 * @package    com.xcitestudios.Network
 * @subpackage Server.Configuration
 */
class AMQPConnection
{
    /**
     * See if the PHP-AMQP extension is available for use.
     *
     * @return bool
     */
    public static function canUsePHPAMQPExtension()
    {
        return extension_loaded('amqp');
    }

    /**
     * If you have PHP-AMQP (PECL) installed, you can get a connection using this method.
     *
     * @param AMQPServerConfiguration $config
     * @return \AMQPConnection
     * @throws RuntimeException connection failed or extension not available.
     */
    public static function createConnectionUsingPHPAMQP(AMQPServerConfiguration $config)
    {
        if (!static::canUsePHPAMQPExtension()) {
            throw new RuntimeException('amqp extension is not installed - run pecl install amqp');
        }

        $amqp = new \AMQPConnection([
            'host'     => $config->getHost(),
            'login'    => $config->getUsername(),
            'password' => $config->getPassword(),
            'vhost'    => $config->getVHost(),
            'port'     => $config->getPort(),
        ]);

        if (!$amqp->connect()) {
            throw new RuntimeException('Could not connect to AMQP server');
        }

        return $amqp;
    }
}