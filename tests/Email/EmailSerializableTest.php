<?php
namespace com\xcitestudios\Network\Email\Test;

use com\xcitestudios\Network\Email\Contact;
use com\xcitestudios\Network\Email\EmailBodyPart;
use com\xcitestudios\Network\Email\EmailSerializable;

class EmailSerializableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Check the JSON output adheres to the specified schema.
     */
    public function testSerializationAdheranceStandard()
    {
        $subject = 'A Subject';
        $inReplyTo = 'abc@local';
        $date = new \DateTime();
        $contact = new Contact('Name', 'Email');

        $customHeaders = new \stdClass();
        $customHeaders->alpha = 'beta';

        $bodyPart = new EmailBodyPart('enc', 'text/plain', 'abc');

        $email = new EmailSerializable();

        $email->setBodyParts([$bodyPart])
              ->setReplyTo([$contact])
              ->setFrom([$contact])
              ->setSender($contact)
              ->setBcc([$contact])
              ->setCc([$contact])
              ->setCustomHeaders($customHeaders)
              ->setDate($date)
              ->setInReplyTo($inReplyTo)
              ->setSubject($subject)
              ->setTo([$contact]);

        $serialized = $email->serializeJSON();

        $retriever = new \JsonSchema\Uri\UriRetriever;
        $schema = $retriever->retrieve('file://' . realpath('vendor/xcitestudios/json-schemas/com/xcitestudios/schemas/Network/Email.json'));

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
    /**
     * Check the JSON output adheres to the specified schema.
     */
    public function testSerializationAdheranceNoTo()
    {
        $subject = 'A Subject';
        $inReplyTo = 'abc@local';
        $date = new \DateTime();
        $contact = new Contact('Name', 'Email');

        $customHeaders = new \stdClass();
        $customHeaders->alpha = 'beta';

        $bodyPart = new EmailBodyPart('enc', 'text/plain', 'abc');

        $email = new EmailSerializable();

        $email->setBodyParts([$bodyPart])
              ->setReplyTo([$contact])
              ->setFrom([$contact])
              ->setSender($contact)
              ->setBcc([$contact])
              ->setCc([$contact])
              ->setCustomHeaders($customHeaders)
              ->setDate($date)
              ->setInReplyTo($inReplyTo)
              ->setSubject($subject)
              ->setTo([]);

        $serialized = $email->serializeJSON();

        $retriever = new \JsonSchema\Uri\UriRetriever;
        $schema = $retriever->retrieve('file://' . realpath('vendor/xcitestudios/json-schemas/com/xcitestudios/schemas/Network/Email.json'));

        $validator = new \JsonSchema\Validator();
        $validator->check(\json_decode($serialized), $schema);

        $message = 'Errors: ';
        if (!$validator->isValid()) {
            foreach ($validator->getErrors() as $error) {
                $message .= $error['property'] . ': ' . $error['message'] . "; ";
            }
        }

        $this->assertFalse($validator->isValid(), $message);
    }
}
