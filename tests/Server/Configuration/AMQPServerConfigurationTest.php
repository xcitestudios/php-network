<?php
namespace com\xcitestudios\Network\Server\Configuration\Test;

use com\xcitestudios\Network\Server\Configuration\AMQPServerConfiguration;
use JsonSchema\Constraints\Constraint;

class AMQPServerConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Check the JSON output adheres to the specified schema.
     */
    public function testSerializationAdheranceStandard()
    {
        $config = new AMQPServerConfiguration();
        $config->setVHost('leveehost');

        $serialized = $config->serializeJSON();

        $retriever = new \JsonSchema\Uri\UriRetriever;
        $schema = $retriever->retrieve('file://' . realpath('vendor/xcitestudios/json-schemas/com/xcitestudios/schemas/Network/Server/Configuration/AMQPServerConfiguration.json'));

        $refResolver = new \JsonSchema\RefResolver($retriever);
        $refResolver->resolve($schema, 'file://' . realpath('vendor/xcitestudios/json-schemas/com/xcitestudios/schemas/Network/Server/Configuration/.') . '/');

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
