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
use com\xcitestudios\Network\Server\Configuration\Interfaces\AMQPServerConfigurationInterface;
use PhpAmqpLib\Connection\AbstractConnection;
use PhpAmqpLib\Connection\AMQPSocketConnection;
use PhpAmqpLib\Connection\AMQPSSLConnection;
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
     * @param AMQPServerConfigurationInterface $config
     * @return \AMQPConnection
     * @throws RuntimeException connection failed or extension not available.
     */
    public static function createConnectionUsingPHPAMQPExtension(AMQPServerConfigurationInterface $config)
    {
        if (!static::canUsePHPAMQPExtension()) {
            throw new RuntimeException('amqp extension is not installed - run pecl install amqp');
        }

        $amqp = new \AMQPConnection([
            'host'            => $config->getHost(),
            'login'           => $config->getUsername(),
            'password'        => $config->getPassword(),
            'vhost'           => $config->getVHost(),
            'port'            => $config->getPort(),
            'connect_timeout' => $config->getConnectionTimeout()
        ]);

        if (!$amqp->connect()) {
            throw new RuntimeException('Could not connect to AMQP server');
        }

        return $amqp;
    }

    /**
     * Create a connection using PHPAMQPLib.
     *
     * @param AMQPServerConfiguration $config
     * @return AbstractConnection
     */
    public static function createConnectionUsingPHPAMQPLib(AMQPServerConfigurationInterface $config, $sslCAPath = null, $sslHost = null)
    {
        if($config->getSSL() === true) {
            $sslOptions = [
                'verify_peer' => true,
            ];

            if ($sslCAPath !== null) {
                $sslOptions['capath'] = $sslCAPath;
            }

            if ($sslHost !== null) {
                $sslOptions['CN_match'] = $sslHost;
            } elseif(!filter_var($config->getHost(), FILTER_VALIDATE_IP)) {
                $sslOptions['CN_match'] = $config->getHost();
            }

            $amqp = new AMQPSSLConnection(
                $config->getHost(),
                $config->getPort(),
                $config->getUsername(),
                $config->getPassword(),
                $config->getVHost(),
                $sslOptions,
                [
                    'connection_timeout' => $config->getConnectionTimeout(),
                ]
            );
        } else {
            $amqp = new AMQPSocketConnection(
                $config->getHost(),
                $config->getPort(),
                $config->getUsername(),
                $config->getPassword(),
                $config->getVHost(),
                false,
                'AMQPLAIN',
                null,
                'en_US',
                $config->getConnectionTimeout(),
                true
            );
        }

        register_shutdown_function(function() use ($amqp){
            if ($amqp instanceof AbstractConnection && $amqp->isConnected()) {
                $amqp->close();
            }
        });

        return $amqp;
    }
}