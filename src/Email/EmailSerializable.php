<?php
namespace com\xcitestudios\Network\Email;

use com\xcitestudios\Network\Email\Interfaces\ContactInterface;
use DateTime;
use JsonSerializable;
use stdClass;
use InvalidArgumentException;

class EmailSerializable implements Interfaces\EmailSerializableInterface,
    JsonSerializable
{
    /**
     * @var {Object.<string, string>}|null
     */
    protected $customHeaders;

    /**
     * @var ContactCollection|null
     */
    protected $from;

    /**
     * @var Contact|null
     */
    protected $sender;

    /**
     * @var ContactCollection|null
     */
    protected $replyTo;

    /**
     * @var ContactCollection|null
     */
    protected $to;

    /**
     * @var ContactCollection|null
     */
    protected $cc;

    /**
     * @var ContactCollection|null
     */
    protected $bcc;

    /**
     * @var DateTime|null
     */
    protected $date;

    /**
     * @var string|null
     */
    protected $subject;

    /**
     * @var string|null
     */
    protected $inReplyTo;

    /**
     * @var EmailBodyPartCollection
     */
    protected $bodyParts;

    /**
     * Set any non standard headers here - these should never overwrite the explicit headers.
     *
     * @param {Object.<string, string>}|null $headers
     *
     * @return void
     */
    public function setCustomHeaders(stdClass $headers = null)
    {
        $this->customHeaders = $headers;
    }

    /**
     * Get any non standard headers here - these should never overwrite the explicit headers.
     *
     * @return {Object.<string, string>}|null
     */
    public function getCustomHeaders()
    {
        return $this->customHeaders;
    }

    /**
     * Set who is the email from. Can be multiple people.
     *
     * @param Contact[] $from
     *
     * @return void
     */
    public function setFrom(array $from)
    {
        $this->from = ContactCollection::createFromObjects($from);
    }

    /**
     * Get who is the email from. Can be multiple people.
     *
     * @return Contact[]|null
     */
    public function getFrom()
    {
        return $this->from !== null ? $this->from->toArray() : null;
    }

    /**
     * Sets the sender.
     * Optional OR Required. Optional where From is one person. Required where From is multiple people.
     *
     * @param Contact|null $sender
     *
     * @throws InvalidArgumentException
     * @return void
     */
    public function setSender(ContactInterface $sender = null)
    {
        if ($sender !== null && !($sender instanceof Contact)) {
            throw new InvalidArgumentException(
                sprintf(
                    '%s expects an instance of %s.',
                    __FUNCTION__, Contact::class
                )
            );
        }
        $this->sender = $sender;
    }

    /**
     * Gets the sender.
     * Optional OR Required. Optional where From is one person. Required where From is multiple people.
     *
     * @return Contact|null
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Sets who a reply should go to when hitting reply in an email client.
     *
     * @param Contact[]|null $replyTo
     *
     * @return void
     */
    public function setReplyTo(array $replyTo = null)
    {
        $this->replyTo = ContactCollection::createFromObjects($replyTo);
    }

    /**
     * Gets who a reply should go to when hitting reply in an email client.
     *
     * @return Contact[]|null
     */
    public function getReplyTo()
    {
        return $this->replyTo !== null ? $this->replyTo->toArray() : null;
    }

    /**
     * Set the recipients of the email.
     *
     * @param Contact[]|null $to
     *
     * @return void
     */
    public function setTo(array $to)
    {
        $this->to = ContactCollection::createFromObjects($to);
    }

    /**
     * Get the recipients of the email.
     *
     * @return Contact[]|null
     */
    public function getTo()
    {
        return $this->to != null ? $this->to->toArray() : null;
    }

    /**
     * Set the CC recipients of the email.
     *
     * @param Contact[]|null $cc
     *
     * @return void
     */
    public function setCc(array $cc = null)
    {
        $this->cc = ContactCollection::createFromObjects($cc);
    }

    /**
     * Get the CC recipients of the email.
     *
     * @return Contact[]|null
     */
    public function getCc()
    {
        return $this->cc !== null ? $this->cc->toArray() : null;
    }

    /**
     * Set the BCC recipients of the email.
     *
     * @param Contact[]|null $bcc
     *
     * @return void
     */
    public function setBcc(array $bcc = null)
    {
        $this->bcc = ContactCollection::createFromObjects($bcc);
    }

    /**
     * Get the BCC recipients of the email.
     *
     * @return ContactInterface[]|null
     */
    public function getBcc()
    {
        return $this->bcc !== null ? $this->bcc->toArray() : null;
    }

    /**
     * Set the time the email was "sent" (finished by a person/system). This is not
     * necessarily the time the email entered a mail server.
     *
     * @param DateTime|null $date
     *
     * @return void
     */
    public function setDate(DateTime $date = null)
    {
        $this->date = $date;
    }

    /**
     * Get the time the email was "sent" (finished by a person/system). This is not
     * necessarily the time the email entered a mail server.
     *
     * @return DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the subject of the email.
     *
     * @param string|null $subject
     *
     * @return void
     */
    public function setSubject($subject = null)
    {
        $this->subject = $subject;
    }

    /**
     * Get the subject of the email.
     *
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set which unique MessageID this is in reply to.
     *
     * @param string|null $inReplyTo
     *
     * @return void
     */
    public function setInReplyTo($inReplyTo = null)
    {
        $this->inReplyTo = $inReplyTo;
    }

    /**
     * Get which unique MessageID this is in reply to.
     *
     * @return mixed
     */
    public function getInReplyTo()
    {
        return $this->inReplyTo;
    }

    /**
     * Set the body of the email. For a single content-type email, just put one in this array.
     * It is presumed if you add multiple items to this array then it must be multipart.
     *
     * For multipart/alternative (multiple versions of the body such as text / html) add in
     * one body part of type multipart/alternative which has multiple body parts.
     *
     * @param EmailBodyPart[] $bodyParts
     *
     * @throws InvalidArgumentException
     * @return void
     */
    public function setBodyParts(array $bodyParts)
    {
        $collection = new EmailBodyPartCollection();

        foreach ($bodyParts as $k => $v) {
            $collection->add($v);
        }

        $this->bodyParts = $collection;
    }

    /**
     * Get the body of the email. For a single content-type email, just put one in this array.
     * It is presumed if you add multiple items to this array then it must be multipart.
     *
     * For multipart/alternative (multiple versions of the body such as text / html) add in
     * one body part of type multipart/alternative which has multiple body parts.
     *
     * @return EmailBodyPart[]
     */
    public function getBodyParts()
    {
        return $this->bodyParts->toArray();
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
        $this->customHeaders = property_exists($object, 'customHeaders') ? $object->customHeaders : null;

        $this->sender = null;

        if (property_exists($object, 'sender')) {
            $sender = new Contact();
            $sender->updateFromObject($object->sender);

            $this->sender = $sender;
        }

        $this->from    = ContactCollection::createFromObjects(property_exists($object, 'from') ? $object->from : null);
        $this->replyTo = ContactCollection::createFromObjects(property_exists($object, 'replyTo') ? $object->from : null);
        $this->to      = ContactCollection::createFromObjects(property_exists($object, 'to') ? $object->to : null);
        $this->cc      = ContactCollection::createFromObjects(property_exists($object, 'cc') ? $object->cc : null);
        $this->bcc     = ContactCollection::createFromObjects(property_exists($object, 'bcc') ? $object->bcc : null);

        $this->date      = property_exists($object, 'date') ? new DateTime($object->date) : null;
        $this->subject   = property_exists($object, 'subject') ? $object->subject : null;
        $this->inReplyTo = property_exists($object, 'inReplyTo') ? $object->inReplyTo : null;

        $this->bodyParts = EmailBodyPartCollection::createFromObjects(property_exists($object, 'bodyParts') ? $object->bodyParts : null);
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

        $ret->customHeaders = $this->customHeaders;
        $ret->from          = $this->from !== null ? $this->from->jsonSerialize() : null;
        $ret->sender        = $this->sender;
        $ret->replyTo       = $this->replyTo !== null ? $this->replyTo->jsonSerialize() : null;
        $ret->to            = $this->to !== null ? $this->to->jsonSerialize() : null;
        $ret->cc            = $this->cc !== null ? $this->cc->jsonSerialize() : null;
        $ret->bcc           = $this->bcc !== null ? $this->bcc->jsonSerialize() : null;
        $ret->date          = $this->date !== null ? $this->date->format(DateTime::ISO8601) : null;
        $ret->subject       = $this->subject;
        $ret->inReplyTo     = $this->inReplyTo;
        $ret->bodyParts     = $this->bodyParts !== null ? $this->bodyParts->jsonSerialize() : null;

        return $ret;
    }
}