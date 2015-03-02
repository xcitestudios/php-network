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

/**
 * A class implementing the Interfaces\ContactSerializableInterface interface.
 *
 * @package com.xcitestudios.Network
 * @subpackage Email
 */
class Contact implements Interfaces\ContactSerializableInterface,
    JsonSerializable
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * Quickly create a new contact.
     *
     * @param string|null $name
     * @param string|null $email
     */
    public function __construct($name = null, $email = null)
    {
        if ($name !== null) {
            $this->setName($name);
        }

        if ($email !== null) {
            $this->setEmail($email);
        }
    }

    /**
     * Sets the name of this contact.
     *
     * @param string|null $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Gets the name of this contact.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the email of this contact.
     *
     * @param string $email
     *
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Gets the email of this contact.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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

        $this->name  = property_exists($object, 'name') ? $object->name : null;
        $this->email = property_exists($object, 'email') ? $object->email : null;
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

        $ret->name  = $this->name;
        $ret->email = $this->email;

        return $ret;
    }

    /**
     * Create an array of contacts from an array of stdClass objects.
     *
     * @param stdClass[] $objects
     *
     * @return static[]|null
     */
    public static function createContactsFromObjects(array $objects = null)
    {
        if ($objects === null) {
            return null;
        }

        $contacts = [];

        foreach ($objects as $object) {
            $contact = new static();
            $contact->updateFromObject($object);

            $contacts[] = $contact;
        }

        return $contacts;
    }
}