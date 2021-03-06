<?php
/**
 * com.xcitestudios.Network
 *
 * @copyright Wade Womersley (xcitestudios)
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link https://xcitestudios.com/
 */

namespace com\xcitestudios\Network\Email\Interfaces;

use DateTime;
use stdClass;

/**
 * Interface for an email.
 *
 * @package com.xcitestudios.Network
 * @subpackage Email.Interfaces
 */
interface EmailInterface
{
    /**
     * Set any non standard headers here - these should never overwrite the explicit headers.
     *
     * @param object|null $headers
     * @return void
     */
    public function setCustomHeaders(stdClass $headers = null);

    /**
     * Get any non standard headers here - these should never overwrite the explicit headers.
     *
     * @return object|null
     */
    public function getCustomHeaders();

    /**
     * Set who is the email from. Can be multiple people.
     *
     * @param ContactInterface[] $from
     * @return void
     */
    public function setFrom(array $from);

    /**
     * Get who is the email from. Can be multiple people.
     *
     * @return array
     */
    public function getFrom();

    /**
     * Sets the sender.
     * Optional OR Required. Optional where From is one person. Required where From is multiple people.
     *
     * @param ContactInterface|null $sender
     * @return void
     */
    public function setSender(ContactInterface $sender = null);

    /**
     * Gets the sender.
     * Optional OR Required. Optional where From is one person. Required where From is multiple people.
     *
     * @return ContactInterface|null
     */
    public function getSender();

    /**
     * Sets who a reply should go to when hitting reply in an email client.
     *
     * @param ContactInterface[]|null $replyTo
     * @return void
     */
    public function setReplyTo(array $replyTo = null);

    /**
     * Gets who a reply should go to when hitting reply in an email client.
     *
     * @return ContactInterface[]|null
     */
    public function getReplyTo();

    /**
     * Set the recipients of the email.
     *
     * @param ContactInterface[]|null  $to
     * @return void
     */
    public function setTo(array $to);

    /**
     * Get the recipients of the email.
     *
     * @return ContactInterface[]|null
     */
    public function getTo();

    /**
     * Set the CC recipients of the email.
     *
     * @param ContactInterface[]|null  $cc
     * @return void
     */
    public function setCc(array $cc = null);

    /**
     * Get the CC recipients of the email.
     *
     * @return ContactInterface[]|null
     */
    public function getCc();

    /**
     * Set the BCC recipients of the email.
     *
     * @param ContactInterface[]|null $bcc
     * @return void
     */
    public function setBcc(array $bcc = null);

    /**
     * Get the BCC recipients of the email.
     *
     * @return ContactInterface[]|null
     */
    public function getBcc();

    /**
     * Set the time the email was "sent" (finished by a person/system). This is not
     * necessarily the time the email entered a mail server.
     *
     * @param DateTime|null $date
     * @return void
     */
    public function setDate(DateTime $date = null);

    /**
     * Get the time the email was "sent" (finished by a person/system). This is not
     * necessarily the time the email entered a mail server.
     *
     * @return DateTime|null
     */
    public function getDate();

    /**
     * Set the subject of the email.
     *
     * @param string|null $subject
     * @return void
     */
    public function setSubject($subject = null);

    /**
     * Get the subject of the email.
     *
     * @return mixed
     */
    public function getSubject();

    /**
     * Set which unique MessageID this is in reply to.
     *
     * @param string|null $inReplyTo
     * @return void
     */
    public function setInReplyTo($inReplyTo = null);

    /**
     * Get which unique MessageID this is in reply to.
     *
     * @return mixed
     */
    public function getInReplyTo();

    /**
     * Set the body of the email. For a single content-type email, just put one in this array.
     * It is presumed if you add multiple items to this array then it must be multipart.
     *
     * For multipart/alternative (multiple versions of the body such as text / html) add in
     * one body part of type multipart/alternative which has multiple body parts.
     *
     * @param EmailBodyPartInterface[] $bodyParts
     * @return void
     */
    public function setBodyParts(array $bodyParts);

    /**
     * Get the body of the email. For a single content-type email, just put one in this array.
     * It is presumed if you add multiple items to this array then it must be multipart.
     *
     * For multipart/alternative (multiple versions of the body such as text / html) add in
     * one body part of type multipart/alternative which has multiple body parts.
     *
     * @return EmailBodyPartInterface[]
     */
    public function getBodyParts();
}