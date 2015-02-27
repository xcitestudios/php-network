<?php
namespace com\xcitestudios\Network\Email;

use com\xcitestudios\Network\Email\Interfaces\EmailBodyPartInterface;
use com\xcitestudios\Network\Email\Interfaces\EmailBodyPartSerializableInterface;
use JsonSerializable;
use stdClass;
use InvalidArgumentException;

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
     * @var EmailBodyPartInterface[]|null
     */
    protected $bodyParts;

    /**
     * Set the encoding of this body part. For a singular email this should go into the headers
     * of the original email.
     *
     * @param string $encoding
     * @return void
     */
    public function setContentTransferEncoding($encoding)
    {
        $this->contentTransferEncoding = $encoding;
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
     * @return void
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
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
     * @return void
     */
    public function setRawContent($content)
    {
        $this->rawContent = $content;
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
     * @param EmailBodyPartInterface[]|null $bodyParts
     * @throws InvalidArgumentException
     * @return void
     */
    public function setBodyParts(array $bodyParts = null)
    {
        foreach ($bodyParts as $k => $v) {
            if (!($v instanceof EmailBodyPartSerializableInterface)) {
                throw new InvalidArgumentException(
                    sprintf(
                        'setBodyParts() element index %d is not of type %s',
                        $k, EmailBodyPartSerializableInterface::class
                    )
                );
            }
        }
        $this->bodyParts = $bodyParts;
    }

    /**
     * Get the body of the body part. If you're using a singular ContentType this should be an array
     * of length one with the body set.
     *
     * @return EmailBodyPartInterface[]|null
     */
    public function getBodyParts()
    {
        return $this->bodyParts;
    }


    /**
     * Updates the element implementing this interface using a JSON representation.
     * This means updating the state of this object with that defined in the JSON
     * as opposed to returning a new instance of this object.
     *
     * @param string $jsonString Representation of the object
     * @return void
     */
    public function deserializeJSON($jsonString)
    {
        $data = \json_decode($jsonString);

        $this->setContentTransferEncoding($data->contentTransferEncoding);
        $this->setContentType($data->contentType);
        $this->setBodyParts(property_exists($data, 'bodyParts') ? $data->bodyParts : null);
        $this->setRawContent(property_exists($data, 'rawContent') ? $data->rawContent : null);
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
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $ret = new stdClass;

        $ret->contentTransferEncoding = $this->getContentTransferEncoding();
        $ret->contentType             = $this->getContentType();
        $ret->bodyParts               = $this->getBodyParts();
        $ret->rawContent              = $this->getRawContent();

        return $ret;
    }
}