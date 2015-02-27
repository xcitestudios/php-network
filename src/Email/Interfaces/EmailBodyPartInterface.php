<?php
namespace com\xcitestudios\Network\Email\Interfaces;

/**
 * Interface for part of an email body.
 */
interface EmailBodyPartInterface
{
    /**
     * Set the  ncoding of this body part. For a singular email this should go into the headers
     * of the original email.
     *
     * @param string $encoding
     * @return void
     */
    public function setContentTransferEncoding($encoding);

    /**
     * Get the  ncoding of this body part. For a singular email this should go into the headers
     * of the original email.
     *
     * @return string
     */
    public function getContentTransferEncoding();

    /**
     * Set the RawContent type of the body. Can be a single type such as text/plain, text/html; or
     * a multipart type such as multipart/alternative or multipart/mixed.
     *
     * @param string $contentType
     * @return void
     */
    public function setContentType($contentType);

    /**
     * Get the RawContent type of the body. Can be a single type such as text/plain, text/html; or
     * a multipart type such as multipart/alternative or multipart/mixed.
     *
     * @return string
     */
    public function getContentType();

    /**
     * Get the raw content of this body part if it doesn't contain sub parts.
     *
     * @param string|null $content
     * @return void
     */
    public function setRawContent($content);

    /**
     * Set the raw content of this body part if it doesn't contain sub parts.
     *
     * @return string|null
     */
    public function getRawContent();

    /**
     * Set the body of the body part. If you're using a singular ContentType this should be an array
     * of length one with the body set.
     *
     * @param EmailBodyPartInterface[]|null $bodyParts
     * @return void
     */
    public function setBodyParts(array $bodyParts = null);

    /**
     * Get the body of the body part. If you're using a singular ContentType this should be an array
     * of length one with the body set.
     *
     * @return EmailBodyPartInterface[]|null
     */
    public function getBodyParts();
}