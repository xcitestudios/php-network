<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Server\Connection;

use com\xcitestudios\Network\Server\Configuration\GearmanServerConfiguration;
use com\xcitestudios\Network\Server\Configuration\Interfaces\GearmanServerConfigurationInterface;
use RuntimeException;
use InvalidArgumentException;

/**
 * A class to aid in the connection to Gearman servers.
 *
 * @package    com.xcitestudios.Network
 * @subpackage Server.Configuration
 */
class GearmanConnection
{
    /**
     * See if the PHP-Gearman extension is available for use.
     *
     * @return bool
     */
    public static function canUsePHPGearmanExtension()
    {
        return extension_loaded('gearman');
    }

    /**
     * If you have PHP-AMQP (PECL) installed, you can get a client connection using this method.
     *
     * @param GearmanServerConfigurationInterface[] $config
     * @return \GearmanClient
     * @throws RuntimeException Extension not available.
     * @throws InvalidArgumentException One or more items in the array is not an instance of GearmanServerConfigurationInterface or no items specified.
     */
    public static function createClientConnectionUsingPHPGearman(array $gearmanServerConfigurationObjects)
    {
        if (!static::canUsePHPGearmanExtension()) {
            throw new RuntimeException('gearman extension is not installed - run pecl install gearman');
        }

        if (count($gearmanServerConfigurationObjects) === 0) {
            throw new InvalidArgumentException(
                sprintf(
                    'You must pass at least once instance of %s to %s',
                    GearmanServerConfigurationInterface::class, __FUNCTION__
                )
            );
        }

        $servers = static::serverConfigurationsToArray($gearmanServerConfigurationObjects);

        $gearman = new \GearmanClient();
        $gearman->addServers($servers);

        return $gearman;
    }

    /**
     * If you have PHP-AMQP (PECL) installed, you can get a worker connection using this method.
     *
     * @param GearmanServerConfigurationInterface[] $config
     * @return \GearmanWorker
     * @throws RuntimeException Extension not available.
     * @throws InvalidArgumentException One or more items in the array is not an instance of GearmanServerConfigurationInterface or no items specified.
     */
    public static function createWorkerConnectionUsingPHPGearman(array $gearmanServerConfigurationObjects)
    {
        if (!static::canUsePHPGearmanExtension()) {
            throw new RuntimeException('gearman extension is not installed - run pecl install gearman');
        }

        $servers = static::serverConfigurationsToArray($gearmanServerConfigurationObjects);

        $gearman = new \GearmanWorker();
        $gearman->addServers($servers);

        return $gearman;
    }

    /**
     * Convert an array of GearmanServerConfigurationInterface to an array of strings[] => host:port.
     *
     * @param GearmanServerConfigurationInterface[] $gearmanServerConfigurationObjects
     * @return array
     * @throws InvalidArgumentException One or more items in the array is not an instance of GearmanServerConfigurationInterface or no items specified.
     */
    protected function serverConfigurationsToArray(array $gearmanServerConfigurationObjects)
    {
        if (count($gearmanServerConfigurationObjects) === 0) {
            throw new InvalidArgumentException(
                sprintf(
                    'You must pass at least once instance of %s to %s',
                    GearmanServerConfigurationInterface::class, __FUNCTION__
                )
            );
        }

        $servers = [];

        foreach ($gearmanServerConfigurationObjects as $config) { /** @var GearmanServerConfiguration $config */
            if (!($config instanceof GearmanServerConfigurationInterface)) {
                throw new InvalidArgumentException(
                    sprintf(
                        'All objects passed to %s must be an instance of %s',
                        __FUNCTION__, GearmanServerConfigurationInterface::class
                    )
                );
            }

            $servers[] = sprintf('%s:%d', $config->getHost(), $config->getPort());
        }

        return $servers;
    }
}