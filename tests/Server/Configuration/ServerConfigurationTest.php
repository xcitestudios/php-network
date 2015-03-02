<?php
namespace com\xcitestudios\Network\Server\Configuration\Test;

use com\xcitestudios\Network\Server\Configuration\ServerConfiguration;

class ServerConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Check the JSON output adheres to the specified schema.
     */
    public function testSerializationAdheranceStandard()
    {
        $config = new ServerConfiguration();
        $config->setHost('192.168.5.1')
            ->setPort(32555)
            ->setSSL(true)
            ->setTLS(true);

        $serialized = $config->serializeJSON();

        $retriever = new \JsonSchema\Uri\UriRetriever;
        $schema = $retriever->retrieve('file://' . realpath('vendor/xcitestudios/json-schemas/com/xcitestudios/schemas/Network/Server/Configuration/ServerConfiguration.json'));

        $validator = new \JsonSchema\Validator();
        $validator->check(\json_decode($serialized), $schema);

        $message = 'Errors: ';
        if (!$validator->isValid()) {
            foreach ($validator->getErrors() as $error) {
                $message .= $error['property'] . ': ' . $error['message'] . "; ";
            }
        }

        $this->assertTrue($validator->isValid(), $message);
    }

    public function testRestrictionsSSL()
    {
        $config = new ServerConfiguration();

        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '#.*only accepts a boolean.*#');
        $config->setSSL('apple');
    }

    public function testRestrictionsTLS()
    {
        $config = new ServerConfiguration();

        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '#.*only accepts a boolean.*#');
        $config->setTLS('apple');
    }

    public function testRestrictionsPort()
    {
        $config = new ServerConfiguration();

        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '#only accepts a port between 0 and 65535 inclusive#');
        $config->setPort(-1);
    }
}
