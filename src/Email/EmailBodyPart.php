<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Email;

use JsonSerializable;
use stdClass;
use InvalidArgumentException;

/**
 * A class implementing the Interfaces\EmailBodyPartSerializableInterface interface.
 *
 * @package com.xcitestudios.Network
 * @subpackage Email
 */
class EmailBodyPart implements Interfaces\EmailBodyPartSerializableInterface,
    JsonSerializable
{
    /**
     * @var string
     */
    protected $contentTransferEncoding;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var string|null
     */
    protected $rawContent;

    /**
     * @var EmailBodyPartCollection|null
     */
    protected $bodyParts;

    /**
     * Quickly create a new email body part.
     *
     * @param string|null        $contentTransferEncoding
     * @param string|null        $contentType
     * @param string|null        $rawContent
     * @param EmailBodyPart|null $bodyParts
     */
    public function __construct($contentTransferEncoding = null, $contentType = null, $rawContent = null, array $bodyParts = null)
    {
        if ($contentTransferEncoding !== null) {
            $this->setContentTransferEncoding($contentTransferEncoding);
        }

        if ($contentType !== null) {
            $this->setContentType($contentType);
        }

        if ($rawContent !== null) {
            $this->setRawContent($rawContent);
        }

        if ($bodyParts !== null) {
            $this->setBodyParts($bodyParts);
        }
    }

    /**
     * Set the encoding of this body part. For a singular email this should go into the headers
     * of the original email.
     *
     * @param string $encoding
     *
     * @return static
     */
    public function setContentTransferEncoding($encoding)
    {
        $this->contentTransferEncoding = $encoding;

        return $this;
    }

    /**
     * Get the encoding of this body part. For a singular email this should go into the headers
     * of the original email.
     *
     * @return string
     */
    public function getContentTransferEncoding()
    {
        return $this->contentTransferEncoding;
    }

    /**
     * Set the RawContent type of the body. Can be a single type such as text/plain, text/html; or
     * a multipart type such as multipart/alternative or multipart/mixed.
     *
     * @param string $contentType
     *
     * @return static
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get the RawContent type of the body. Can be a single type such as text/plain, text/html; or
     * a multipart type such as multipart/alternative or multipart/mixed.
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Get the raw content of this body part if it doesn't contain sub parts.
     *
     * @param string|null $content
     *
     * @return static
     */
    public function setRawContent($content)
    {
        $this->rawContent = $content;

        return $this;
    }

    /**
     * Set the raw content of this body part if it doesn't contain sub parts.
     *
     * @return string|null
     */
    public function getRawContent()
    {
        return $this->rawContent;
    }

    /**
     * Set the body of the body part. If you're using a singular ContentType this should be an array
     * of length one with the body set.
     *
     * @param EmailBodyPart[]|null $bodyParts
     *
     * @throws InvalidArgumentException
     * @return static
     */
    public function setBodyParts(array $bodyParts = null)
    {
        $collection = new EmailBodyPartCollection();

        foreach ($bodyParts as $k => $v) {
            $collection->add($v);
        }

        $this->bodyParts = $collection;

        return $this;
    }

    /**
     * Get the body of the body part. If you're using a singular ContentType this should be an array
     * of length one with the body set.
     *
     * @return EmailBodyPart[]|null
     */
    public function getBodyParts()
    {
        return $this->bodyParts !== null ? $this->bodyParts->toArray() : null;
    }

    /**
     * Updates this object from a stdClass instance.
     *
     * @param stdClass $object
     *
     * @return void
     */
    public function updateFromObject(stdClass $object)
    {
        $this->bodyParts               = EmailBodyPartCollection::createFromObjects(property_exists($object, 'bodyParts') ? $object->bodyParts : null);
        $this->contentTransferEncoding = $object->contentTransferEncoding;
        $this->contentType             = $object->contentType;
        $this->rawContent              = property_exists($object, 'rawContent') ? $object->rawContent : null;
    }

    /**
     * Updates the element implementing this interface using a JSON representation.
     * This means updating the state of this object with that defined in the JSON
     * as opposed to returning a new instance of this object.
     *
     * @param string $jsonString Representation of the object
     *
     * @return void
     */
    public function deserializeJSON($jsonString)
    {
        $data = \json_decode($jsonString);

        $this->updateFromObject($data);
    }

    /**
     * Convert this object into JSON so it can be handled by anything that supports JSON.
     *
     * @return string A JSON representation of this object.
     */
    public function serializeJSON()
    {
        return \json_encode($this);
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *       which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $ret = new stdClass;

        $ret->contentTransferEncoding = $this->contentTransferEncoding;
        $ret->contentType             = $this->contentType;
        $ret->bodyParts               = $this->bodyParts !== null ? $this->bodyParts->jsonSerialize() : null;
        $ret->rawContent              = $this->rawContent;

        return $ret;
    }
}