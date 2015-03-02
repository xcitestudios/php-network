<?php
namespace com\xcitestudios\Network\Server\Configuration\Test;

use com\xcitestudios\Network\Server\Configuration\UsernameAuthenticatedServerConfiguration;
use JsonSchema\Constraints\Constraint;

class UsernameAuthenticatedServerConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Check the JSON output adheres to the specified schema.
     */
    public function testSerializationAdheranceStandard()
    {
        $config = new UsernameAuthenticatedServerConfiguration();
        $config->setHost('192.168.5.1')
            ->setPort(32555)
            ->setSSL(true)
            ->setTLS(true)
            ->setUsername('abc')
            ->setPassword('123');

        $serialized = $config->serializeJSON();

        $retriever = new \JsonSchema\Uri\UriRetriever;
        $schema = $retriever->retrieve('file://' . realpath('vendor/xcitestudios/json-schemas/com/xcitestudios/schemas/Network/Server/Configuration/UsernameAuthenticatedServerConfiguration.json'));

        $refResolver = new \JsonSchema\RefResolver($retriever);
        $refResolver->resolve($schema, 'file://' . realpath('vendor/xcitestudios/json-schemas/com/xcitestudios/schemas/Network/Server/Configuration/.'));

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
}
